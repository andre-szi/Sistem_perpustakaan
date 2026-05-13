<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Halaman utama redirect ke daftar buku
Route::get('/', fn() => redirect()->route('books.index'));

// Resource route: otomatis buat 7 route CRUD
// GET    /books           → index()
// GET    /books/create    → create()
// POST   /books           → store()
// GET    /books/{id}      → show()
// GET    /books/{id}/edit → edit()
// PUT    /books/{id}      → update()
// DELETE /books/{id}      → destroy()
Route::resource('books', BookController::class);