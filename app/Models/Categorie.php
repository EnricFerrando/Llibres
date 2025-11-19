<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Changed to lowercase to match migration
    protected $fillable = ['name', 'description'];

    public function books() {
        return $this->hasMany(Book::class, 'categorie_id');
    }
}
