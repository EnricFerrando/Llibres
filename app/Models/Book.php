<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'author', 'sumary', 'published_at', 'price', 'image', 'recomended_age', 'categorie_id'];

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('rating', 'review');
    }

    public function category() {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}

