<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the application kernel so Eloquent and config are available
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Book;

$books = Book::all();
$stored = 0;
$dir = __DIR__ . '/../storage/app/public/books';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

foreach ($books as $book) {
    // use picsum.photos seeded by book id to generate reproducible placeholder covers
    $url = "https://picsum.photos/seed/book{$book->id}/600/800";
    try {
        $img = @file_get_contents($url);
        if ($img === false) {
            echo "Failed to download image for book {$book->id}\n";
            continue;
        }

        $filename = "books/book_{$book->id}.jpg";
        $path = __DIR__ . '/../storage/app/public/' . $filename;
        file_put_contents($path, $img);

        $book->image = $filename;
        $book->save();

        $stored++;
        echo "Saved cover for book {$book->id} -> {$filename}\n";
    } catch (Exception $e) {
        echo "Error for book {$book->id}: " . $e->getMessage() . "\n";
    }
}

echo "Done. Covers stored: {$stored}\n";
