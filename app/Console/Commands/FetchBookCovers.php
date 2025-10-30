<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class FetchBookCovers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:fetch-covers {--limit=50 : Maximum number of books to process}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch missing book covers from Open Library and store them in storage/app/public/books';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limit = (int) $this->option('limit');
        $query = Book::whereNull('image')->orWhere('image', '')->limit($limit)->get();

        if ($query->isEmpty()) {
            $this->info('No books without covers found.');
            return 0;
        }

        foreach ($query as $book) {
            $this->info("Processing: {$book->id} - {$book->title}");

            $search = trim($book->title . ' ' . $book->author);
            if (empty($search)) {
                $this->warn("Skipping book {$book->id} - missing title/author");
                continue;
            }

            try {
                $resp = Http::get('https://openlibrary.org/search.json', ['q' => $search, 'limit' => 5]);
                if ($resp->failed()) {
                    $this->warn('OpenLibrary request failed for: ' . $search);
                    continue;
                }

                $data = $resp->json();
                if (empty($data['docs'])) {
                    $this->warn('No results for: ' . $search);
                    continue;
                }

                $coverId = null;
                foreach ($data['docs'] as $doc) {
                    if (!empty($doc['cover_i'])) {
                        $coverId = $doc['cover_i'];
                        break;
                    }
                }

                if (!$coverId) {
                    $this->warn('No cover id found for: ' . $search);
                    continue;
                }

                $coverUrl = "https://covers.openlibrary.org/b/id/{$coverId}-L.jpg";
                $imageResp = Http::get($coverUrl);

                if ($imageResp->successful()) {
                    $ext = 'jpg';
                    $filename = "books/{$book->id}_{$coverId}.{$ext}";
                    Storage::disk('public')->put($filename, $imageResp->body());
                    $book->image = $filename;
                    $book->save();
                    $this->info("Saved cover for book {$book->id} -> {$filename}");
                } else {
                    $this->warn('Failed to download cover image for cover id: ' . $coverId);
                }

                // be polite with the API
                sleep(1);

            } catch (\Exception $e) {
                $this->error('Error processing book '.$book->id.': '.$e->getMessage());
            }
        }

        $this->info('Done.');
        return 0;
    }
}
