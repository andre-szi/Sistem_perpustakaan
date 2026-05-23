<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    // ============================================================
    // INDEX — Tampilkan daftar buku (Eloquent: where, with, paginate)
    // ============================================================

    public function index(Request $request): View
    {
        // Mulai query dengan eager loading relasi category
        // Eloquent with() → mencegah N+1 query problem
        $query = Book::with('category');

        // Filter pencarian — Eloquent where() + scope cari()
        if ($request->filled('search')) {
            $query->cari($request->search);
        }

        // Filter kategori — Eloquent where()
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter status — Eloquent where()
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data dengan paginasi
        $books = $query->orderBy('judul')->paginate(10)->withQueryString();

        // Data pendukung untuk statistik & dropdown
        $categories = Category::orderBy('nama')->get();           // Eloquent get()
        $totalBuku  = Book::count();                              // Eloquent count()
        $tersedia   = Book::tersedia()->count();                  // Eloquent scope + count()
        $dipinjam   = Book::dipinjam()->count();                  // Eloquent scope + count()

        return view('books.index', compact(
            'books', 'categories', 'totalBuku', 'tersedia', 'dipinjam'
        ));
    }

    // ============================================================
    // CREATE — Tampilkan form tambah buku
    // ============================================================

    public function create(): View
    {
        // Eloquent all() + orderBy() — ambil semua kategori untuk dropdown
        $categories = Category::orderBy('nama')->get();
        return view('books.create', compact('categories'));
    }

    // ============================================================
    // STORE — Simpan buku baru (Eloquent: create)
    // ============================================================

    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:150',
            'penerbit'    => 'required|string|max:150',
            'tahun'       => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'stok'        => 'required|integer|min:0',
            'isbn'        => 'nullable|string|max:20|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
        ]);

        // ✅ Eloquent create() — simpan data baru ke database
        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    // ============================================================
    // SHOW — Detail satu buku (Eloquent: find + relasi)
    // ============================================================

    public function show(Book $book): View
    {
        // Laravel otomatis inject $book via Route Model Binding
        // Sama dengan: Book::find($id) → tapi lebih ringkas
        // Load relasi category secara lazy
        $book->load('category');

        // Buku lain dari kategori yang sama — Eloquent where() + relasi
        $bukuRelasi = Book::where('category_id', $book->category_id)
                          ->where('id', '!=', $book->id)  // Eloquent where() exclude current
                          ->limit(4)
                          ->get();

        return view('books.show', compact('book', 'bukuRelasi'));
    }

    // ============================================================
    // EDIT — Form edit buku (Eloquent: find via Route Model Binding)
    // ============================================================

    public function edit(Book $book): View
    {
        // $book otomatis di-find() oleh Laravel via Route Model Binding
        $categories = Category::orderBy('nama')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    // ============================================================
    // UPDATE — Simpan perubahan (Eloquent: find + update)
    // ============================================================

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:150',
            'penerbit'    => 'required|string|max:150',
            'tahun'       => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'stok'        => 'required|integer|min:0',
            'isbn'        => 'nullable|string|max:20|unique:books,isbn,' . $book->id,
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:tersedia,dipinjam',
        ]);

        // ✅ Eloquent update() — perbarui data di database
        $book->update($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    // ============================================================
    // DESTROY — Hapus buku (Eloquent: delete)
    // ============================================================

    public function destroy(Book $book): RedirectResponse
    {
        $judul = $book->judul;

        // Eloquent delete() — hapus record dari database
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', "Buku \"$judul\" berhasil dihapus!");
    }
}
