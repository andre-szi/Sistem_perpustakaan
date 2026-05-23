<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration — buat tabel books
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('penulis', 150);
            $table->string('penerbit', 150);
            $table->year('tahun');
            $table->integer('stok')->default(0);
            $table->string('isbn', 20)->unique()->nullable();
            $table->foreignId('category_id')   // foreign key ke tabel categories
                  ->constrained('categories')   // references categories.id
                  ->onDelete('cascade')         // hapus buku jika kategori dihapus
                  ->onUpdate('cascade');
            $table->enum('status', ['tersedia', 'dipinjam'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration — hapus tabel books
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
