<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Categorie extends Model
{
    use HasFactory;

    protected $table = 'Categories';
    protected $fillable = ['name'];
    public function books() {
        return $this->hasMany(Book::class);
    }
}
