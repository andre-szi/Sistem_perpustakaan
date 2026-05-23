<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration — buat tabel categories
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kode', 10)->unique();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Batalkan migration — hapus tabel categories
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
