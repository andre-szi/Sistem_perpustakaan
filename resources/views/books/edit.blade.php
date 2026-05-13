@extends('layouts.app')

@section('title', 'Edit Buku')
@section('icon', 'pencil')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Daftar Buku</a></li>
    <li class="breadcrumb-item"><a href="{{ route('books.show', $book) }}">{{ $book->judul }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
  </ol>
</nav>

<div class="card shadow-sm">
  <div class="card-header bg-warning text-white">
    <h5 class="mb-0">
      <i class="fas fa-edit me-2"></i>
      Edit Buku
    </h5>
  </div>
  <div class="card-body">

    {{-- Validasi error --}}
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show">
        <strong>Terjadi Kesalahan!</strong>
        <ul class="mb-0 mt-2">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('books.update', $book) }}">
      @csrf
      @method('PUT')
      
      <div class="row g-3">
        <div class="col-md-8">
          <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
          <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                 value="{{ old('judul', $book->judul) }}" required>
          @error('judul')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label class="form-label">Kategori <span class="text-danger">*</span></label>
          <select name="category_id"
                  class="form-select @error('category_id') is-invalid @enderror">
            <option value="">— Pilih Kategori —</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->nama }}
              </option>
            @endforeach
          </select>
          @error('category_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-6">
          <label class="form-label">Penulis <span class="text-danger">*</span></label>
          <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror"
                 value="{{ old('penulis', $book->penulis) }}" required>
          @error('penulis')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-6">
          <label class="form-label">Penerbit <span class="text-danger">*</span></label>
          <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror"
                 value="{{ old('penerbit', $book->penerbit) }}" required>
          @error('penerbit')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label class="form-label">Tahun Terbit</label>
          <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                 value="{{ old('tahun', $book->tahun) }}"
                 min="1900" max="{{ date('Y') }}" required>
          @error('tahun')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label class="form-label">Stok</label>
          <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                 value="{{ old('stok', $book->stok) }}" min="0" required>
          @error('stok')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label class="form-label">ISBN (opsional)</label>
          <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
                 value="{{ old('isbn', $book->isbn) }}"
                 placeholder="978-xxx-xxx-xxx-x">
          @error('isbn')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-12">
          <label class="form-label">Status</label>
          <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="tersedia" {{ old('status', $book->status) == 'tersedia' ? 'selected' : '' }}>
              Tersedia
            </option>
            <option value="dipinjam" {{ old('status', $book->status) == 'dipinjam' ? 'selected' : '' }}>
              Dipinjam
            </option>
          </select>
          @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 d-flex gap-2 mt-3">
          <button type="submit" class="btn btn-warning">
            <i class="fas fa-save me-2"></i>
            Simpan Perubahan
          </button>
          <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">
            <i class="fas fa-times me-2"></i>
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
