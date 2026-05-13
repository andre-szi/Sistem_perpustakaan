{{-- Extends layout utama --}}
@extends('layouts.app')

@section('title', 'Daftar Buku')
@section('icon', 'list')

@section('content')
<!-- Header + statistik ringkas -->
<div class="row mb-4">
  <div class="col-md-3">
    <div class="card stat-card border-start border-primary border-4">
      <div class="card-body">
        <h5>{{ $totalBuku }}</h5>
        <small>Total Buku</small>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card stat-card border-start border-success border-4">
      <div class="card-body">
        <h5>{{ $tersedia }}</h5>
        <small>Buku Tersedia</small>
      </div>
    </div>
  </div>
</div>

{{-- Flash message sukses --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

{{-- Form Pencarian & Filter --}}
<form method="GET" action="{{ route('books.index') }}">
  <div class="row g-2 mb-3">
    <div class="col-md-5">
      <input type="text" name="search" class="form-control"
             placeholder="Cari judul / penulis..."
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
      <button class="btn btn-primary w-100">Cari</button>
    </div>
    <div class="col-md-2">
      <a href="{{ route('books.create') }}" class="btn btn-success w-100">
        + Tambah Buku
      </a>
    </div>
  </div>
</form>

{{-- Tabel Data Buku --}}
<div class="table-responsive">
  <table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th>#</th><th>Judul Buku</th><th>Penulis</th>
        <th>Kategori</th><th>Stok</th><th>Status</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $i => $book)
        <tr>
          <td>{{ $books->firstItem() + $i }}</td>
          <td><strong>{{ $book->judul }}</strong></td>
          <td>{{ $book->penulis }}</td>
          <td>{{ $book->category->nama ?? '-' }}</td>
          <td>{{ $book->stok }}</td>
          <td>
            @if($book->status == 'tersedia')
              <span class="badge bg-success">Tersedia</span>
            @else
              <span class="badge bg-warning text-dark">Dipinjam</span>
            @endif
          </td>
          <td>
            <a href="{{ route('books.show', $book) }}"
               class="btn btn-sm btn-info">Detail</a>
            <a href="{{ route('books.edit', $book) }}"
               class="btn btn-sm btn-warning">Edit</a>
            <form method="POST"
                  action="{{ route('books.destroy', $book) }}"
                  style="display:inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger"
                      onclick="return confirm('Hapus buku ini?')">
                Hapus
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center text-muted">
          Tidak ada buku ditemukan.
        </td></tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Pagination Laravel --}}
{{ $books->links() }}

@endsection