<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // ============================================================
    // KONFIGURASI MODEL
    // ============================================================

    /** Nama tabel di database */
    protected $table = 'categories';

    /** Kolom yang boleh diisi massal (mass assignment) */
    protected $fillable = ['nama', 'kode'];

    // ============================================================
    // RELASI ELOQUENT
    // ============================================================

    /**
     * Relasi: Satu kategori memiliki BANYAK buku
     * Tipe  : hasMany (One-to-Many)
     * Contoh: $category->books → ambil semua buku dalam kategori ini
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }

    // ============================================================
    // ACCESSOR / COMPUTED PROPERTY
    // ============================================================

    /**
     * Hitung jumlah buku dalam kategori ini
     * Contoh: $category->jumlah_buku
     */
    public function getJumlahBukuAttribute(): int
    {
        return $this->books()->count();
    }
}
