<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // ============================================================
    // KONFIGURASI MODEL
    // ============================================================

    /** Nama tabel di database */
    protected $table = 'books';

    /**
     * Kolom yang boleh diisi massal — mass assignment
     * Melindungi kolom sensitif dari pengisian sembarangan
     */
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'isbn',
        'category_id',
        'status',
    ];

    /**
     * Cast tipe data otomatis saat akses properti
     * Laravel otomatis konversi string DB → tipe PHP
     */
    protected $casts = [
        'tahun' => 'integer',
        'stok'  => 'integer',
    ];

    // ============================================================
    // RELASI ELOQUENT (Relationships)
    // ============================================================

    /**
     * Relasi: Buku dimiliki oleh SATU kategori
     * Tipe  : belongsTo (Many-to-One)
     * Contoh: $book->category → ambil objek kategori buku ini
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ============================================================
    // QUERY SCOPE — filter reusable untuk query builder
    // ============================================================

    /**
     * Scope: filter hanya buku berstatus 'tersedia'
     * Penggunaan: Book::tersedia()->get()
     */
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    /**
     * Scope: filter hanya buku berstatus 'dipinjam'
     * Penggunaan: Book::dipinjam()->get()
     */
    public function scopeDipinjam($query)
    {
        return $query->where('status', 'dipinjam');
    }

    /**
     * Scope: pencarian berdasarkan judul atau penulis
     * Penggunaan: Book::cari('laravel')->get()
     */
    public function scopeCari($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('judul',   'LIKE', "%{$keyword}%")
              ->orWhere('penulis', 'LIKE', "%{$keyword}%")
              ->orWhere('isbn',    'LIKE', "%{$keyword}%");
        });
    }

    /**
     * Scope: filter berdasarkan kategori
     * Penggunaan: Book::dariKategori(1)->get()
     */
    public function scopeDariKategori($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // ============================================================
    // ACCESSOR — properti virtual yang bisa diakses seperti kolom
    // ============================================================

    /**
     * Mengembalikan label status dalam Bahasa Indonesia
     * Contoh: $book->label_status → "✅ Tersedia"
     */
    public function getLabelStatusAttribute(): string
    {
        return $this->status === 'tersedia' ? '✅ Tersedia' : '🔖 Dipinjam';
    }
}
