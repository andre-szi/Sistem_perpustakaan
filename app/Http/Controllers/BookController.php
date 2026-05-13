<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * INDEX — Menampilkan daftar semua buku
     * Route: GET /books
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Filter pencarian dari query string ?search=...
        if ($request->has('search') && $request->search != '') {
            $query->cari($request->search);
        }

        // Filter berdasarkan kategori ?category_id=...
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books      = $query->orderBy('judul')->paginate(10);
        $categories = Category::all();
        $totalBuku  = Book::count();
        $tersedia   = Book::tersedia()->count();

        return view('books.index', compact(
            'books', 'categories', 'totalBuku', 'tersedia'
        ));
    }

    /**
     * CREATE — Menampilkan form tambah buku
     * Route: GET /books/create
     */
    public function create()
    {
        $categories = Category::orderBy('nama')->get();
        return view('books.create', compact('categories'));
    }

    /**
     * STORE — Menyimpan buku baru ke database
     * Route: POST /books
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:150',
            'penerbit'    => 'required|string|max:150',
            'tahun'       => 'required|digits:4|integer',
            'stok'        => 'required|integer|min:0',
            'isbn'        => 'nullable|string|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * SHOW — Detail satu buku
     * Route: GET /books/{id}
     */
    public function show(Book $book)
    {
        $book->load('category');
        return view('books.show', compact('book'));
    }

    /**
     * EDIT — Form edit buku
     * Route: GET /books/{id}/edit
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('nama')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * UPDATE — Simpan perubahan buku
     * Route: PUT /books/{id}
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:150',
            'penerbit'    => 'required|string|max:150',
            'tahun'       => 'required|digits:4|integer',
            'stok'        => 'required|integer|min:0',
            'isbn'        => 'nullable|string|unique:books,isbn,'.$book->id,
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:tersedia,dipinjam',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * DESTROY — Hapus buku dari database
     * Route: DELETE /books/{id}
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}