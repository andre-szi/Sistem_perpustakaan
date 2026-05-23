@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

{{-- Judul Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-0 fw-bold">📚 Daftar Buku</h3>
        <small class="text-muted">Sistem Manajemen Perpustakaan</small>
    </div>
    <a href="{{ route('books.create') }}" class="btn btn-success">
        ➕ Tambah Buku
    </a>
</div>

{{-- Statistik --}}
<div class="row mb-4 g-3">
    <div class="col-6 col-md-3">
        <div class="card stat-card border-start border-primary border-4 shadow-sm">
            <div class="card-body py-3">
                <h5 class="text-primary">{{ $totalBuku }}</h5>
                <small class="text-muted">Total Buku</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card border-start border-success border-4 shadow-sm">
            <div class="card-body py-3">
                <h5 class="text-success">{{ $tersedia }}</h5>
                <small class="text-muted">Buku Tersedia</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card border-start border-warning border-4 shadow-sm">
            <div class="card-body py-3">
                <h5 class="text-warning">{{ $totalBuku - $tersedia }}</h5>
                <small class="text-muted">Sedang Dipinjam</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card border-start border-info border-4 shadow-sm">
            <div class="card-body py-3">
                <h5 class="text-info">{{ $categories->count() }}</h5>
                <small class="text-muted">Kategori</small>
            </div>
        </div>
    </div>
</div>

{{-- Form Pencarian & Filter --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('books.index') }}">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control"
                           placeholder="🔍 Cari judul atau penulis..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">— Semua Kategori —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">— Semua Status —</option>
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Data Buku --}}
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="50">#</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th width="60" class="text-center">Stok</th>
                        <th width="100" class="text-center">Status</th>
                        <th width="170" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $i => $book)
                        <tr>
                            <td class="text-muted">{{ $books->firstItem() + $i }}</td>
                            <td>
                                <strong>{{ $book->judul }}</strong>
                                @if($book->isbn)
                                    <br><small class="text-muted">ISBN: {{ $book->isbn }}</small>
                                @endif
                            </td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->penerbit }}</td>
                            <td>{{ $book->tahun }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $book->category->kode ?? '-' }}
                                </span>
                                {{ $book->category->nama ?? '-' }}
                            </td>
                            <td class="text-center">
                                <span class="fw-bold {{ $book->stok == 0 ? 'text-danger' : 'text-dark' }}">
                                    {{ $book->stok }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($book->status == 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('books.show', $book) }}"
                                   class="btn btn-sm btn-info text-white">Detail</a>
                                <a href="{{ route('books.edit', $book) }}"
                                   class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST"
                                      action="{{ route('books.destroy', $book) }}"
                                      style="display:inline"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                😔 Tidak ada buku yang ditemukan.
                                <br>
                                <a href="{{ route('books.create') }}">Tambah buku pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($books->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $books->firstItem() }}–{{ $books->lastItem() }}
                    dari {{ $books->total() }} buku
                </small>
                {{ $books->links() }}
            </div>
        </div>
    @endif
</div>

@endsection
