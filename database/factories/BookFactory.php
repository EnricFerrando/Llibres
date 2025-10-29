<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;

class BookFactory extends Factory
{
    protected $model = \App\Models\Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'sumary' => $this->faker->paragraph(),
            'published_at' => $this->faker->date(),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'image' => null,
            'recomended_age' => $this->faker->numberBetween(6, 18),
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
