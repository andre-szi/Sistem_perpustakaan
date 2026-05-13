<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /** Nama tabel di database */
    protected $table = 'books';

    /** Kolom yang boleh diisi secara massal (mass assignment) */
    protected $fillable = [
        'judul', 'penulis', 'penerbit',
        'tahun', 'stok', 'isbn',
        'category_id', 'status',
    ];

    /** Cast tipe data otomatis */
    protected $casts = [
        'tahun' => 'integer',
        'stok'  => 'integer',
    ];

    // ============================================================
    // RELASI ANTAR MODEL (Eloquent Relationships)
    // ============================================================

    /** Relasi: Buku milik satu kategori (belongsTo) */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ============================================================
    // SCOPE / QUERY BUILDER KUSTOM
    // ============================================================

    /** Scope: hanya buku yang tersedia */
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    /** Scope: pencarian berdasarkan judul atau penulis */
    public function scopeCari($query, $keyword)
    {
        return $query->where('judul', 'LIKE', "%{$keyword}%")
                      ->orWhere('penulis', 'LIKE', "%{$keyword}%");
    }
}