<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tampilkan semua kategori beserta jumlah bukunya (Eloquent: withCount)
    public function index()
    {
        // withCount() → tambah kolom books_count otomatis via Eloquent
        $categories = Category::withCount('books')->orderBy('nama')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kode' => 'required|string|max:10|unique:categories,kode',
        ]);

        // ✅ Eloquent create()
        Category::create($request->only('nama', 'kode'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kode' => 'required|string|max:10|unique:categories,kode,' . $category->id,
        ]);

        // ✅ Eloquent update()
        $category->update($request->only('nama', 'kode'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        // ✅ Eloquent delete()
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
