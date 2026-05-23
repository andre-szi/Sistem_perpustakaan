<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;
use App\Models\Member;

class DatabaseSeeder extends Seeder
{
    /**
     * Isi database dengan data sampel menggunakan Eloquent create()
     */
    public function run(): void
    {
        // ============================================================
        // 1. SEED KATEGORI — menggunakan Eloquent create()
        // ============================================================
        $categories = [
            ['nama' => 'Teknologi Informasi', 'kode' => 'TI'],
            ['nama' => 'Matematika',           'kode' => 'MTK'],
            ['nama' => 'Bahasa & Sastra',      'kode' => 'BHS'],
            ['nama' => 'Ilmu Sosial',          'kode' => 'SOS'],
            ['nama' => 'Sains & Alam',         'kode' => 'SAN'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat); // Eloquent create()
        }

        // ============================================================
        // 2. SEED BUKU — menggunakan Eloquent create() + relasi
        // ============================================================
        $ti  = Category::where('kode', 'TI')->first();   // Eloquent where()
        $mtk = Category::where('kode', 'MTK')->first();
        $bhs = Category::where('kode', 'BHS')->first();
        $sos = Category::where('kode', 'SOS')->first();
        $san = Category::where('kode', 'SAN')->first();

        $books = [
            ['judul' => 'Pemrograman Laravel 10',      'penulis' => 'Eko Kurniawan',   'penerbit' => 'Informatika',  'tahun' => 2023, 'stok' => 5,  'isbn' => '978-602-7297-00-1', 'category_id' => $ti->id,  'status' => 'tersedia'],
            ['judul' => 'Belajar MySQL untuk Pemula',   'penulis' => 'Budi Raharjo',    'penerbit' => 'Informatika',  'tahun' => 2022, 'stok' => 3,  'isbn' => '978-602-7297-01-8', 'category_id' => $ti->id,  'status' => 'tersedia'],
            ['judul' => 'Algoritma dan Pemrograman',    'penulis' => 'Rinaldi Munir',   'penerbit' => 'Informatika',  'tahun' => 2021, 'stok' => 7,  'isbn' => '978-602-7297-02-5', 'category_id' => $mtk->id, 'status' => 'dipinjam'],
            ['judul' => 'Kalkulus Multivariabel',       'penulis' => 'Purcell Varberg', 'penerbit' => 'Erlangga',     'tahun' => 2020, 'stok' => 4,  'isbn' => '978-602-7297-03-2', 'category_id' => $mtk->id, 'status' => 'tersedia'],
            ['judul' => 'Laskar Pelangi',               'penulis' => 'Andrea Hirata',   'penerbit' => 'Bentang',      'tahun' => 2005, 'stok' => 10, 'isbn' => '978-602-7297-04-9', 'category_id' => $bhs->id, 'status' => 'tersedia'],
            ['judul' => 'Sosiologi Pendidikan',         'penulis' => 'Nasution',        'penerbit' => 'Bumi Aksara',  'tahun' => 2019, 'stok' => 2,  'isbn' => '978-602-7297-05-6', 'category_id' => $sos->id, 'status' => 'dipinjam'],
            ['judul' => 'Fisika Universitas',           'penulis' => 'Hugh D. Young',   'penerbit' => 'Erlangga',     'tahun' => 2021, 'stok' => 6,  'isbn' => '978-602-7297-06-3', 'category_id' => $san->id, 'status' => 'tersedia'],
            ['judul' => 'Python untuk Data Science',   'penulis' => 'Wes McKinney',    'penerbit' => 'OReilly',      'tahun' => 2022, 'stok' => 4,  'isbn' => '978-602-7297-07-0', 'category_id' => $ti->id,  'status' => 'tersedia'],
        ];

        foreach ($books as $book) {
            Book::create($book); // Eloquent create()
        }

        // ============================================================
        // 3. SEED ANGGOTA — menggunakan Eloquent create()
        // ============================================================
        $members = [
            ['nama' => 'Ahmad Fauzi',    'nim' => '2021001', 'email' => 'ahmad@example.com',  'no_hp' => '08123456789'],
            ['nama' => 'Sari Indah',     'nim' => '2021002', 'email' => 'sari@example.com',   'no_hp' => '08234567890'],
            ['nama' => 'Budi Santoso',   'nim' => '2021003', 'email' => 'budi@example.com',   'no_hp' => '08345678901'],
            ['nama' => 'Dewi Anggraini', 'nim' => '2021004', 'email' => 'dewi@example.com',   'no_hp' => '08456789012'],
            ['nama' => 'Rizky Pratama',  'nim' => '2021005', 'email' => 'rizky@example.com',  'no_hp' => '08567890123'],
        ];

        foreach ($members as $member) {
            Member::create($member); // Eloquent create()
        }

        $this->command->info('✅ Seeder selesai! Data berhasil dimasukkan.');
    }
}
