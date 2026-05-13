<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table    = 'categories';
    protected $fillable = ['nama', 'kode'];

    /** Relasi: Satu kategori punya banyak buku (hasMany) */
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}