<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Categorie;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Categorie::factory(5)->create();
        User::factory(10)->create();
        Book::factory(20)->create();
    }
}
