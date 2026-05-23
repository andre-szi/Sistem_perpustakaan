<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration — buat tabel members
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('nim', 20)->unique();
            $table->string('email', 100)->unique();
            $table->string('no_hp', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration — hapus tabel members
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
