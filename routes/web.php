<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke daftar buku
Route::get('/', fn() => redirect()->route('books.index'));

// Resource route Books — otomatis buat 7 route CRUD
// GET    /books              → index()
// GET    /books/create       → create()
// POST   /books              → store()
// GET    /books/{book}       → show()
// GET    /books/{book}/edit  → edit()
// PUT    /books/{book}       → update()
// DELETE /books/{book}       → destroy()
Route::resource('books', BookController::class);

// Resource route Categories
Route::resource('categories', CategoryController::class)->except(['show']);
