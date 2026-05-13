@extends('layouts.app')

@section('title', 'Detail Buku')
@section('icon', 'book')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Daftar Buku</a></li>
    <li class="breadcrumb-item active">{{ $book->judul }}</li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">
          <i class="fas fa-info-circle me-2"></i>
          Informasi Buku
        </h5>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Judul Buku</h6>
            <p class="h5 fw-bold">{{ $book->judul }}</p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Penulis</h6>
            <p class="h5">{{ $book->penulis }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Penerbit</h6>
            <p class="h5">{{ $book->penerbit }}</p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Tahun Terbit</h6>
            <p class="h5">{{ $book->tahun }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Kategori</h6>
            <p class="h5">
              <span class="badge bg-primary">{{ $book->category->nama ?? 'Tidak ada' }}</span>
            </p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-2">ISBN</h6>
            <p class="h5">{{ $book->isbn ?? 'Tidak ada' }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Stok Tersedia</h6>
            <p class="h5 fw-bold text-success">{{ $book->stok }} Buku</p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-2">Status</h6>
            <p class="h5">
              @if($book->status == 'tersedia')
                <span class="badge bg-success fs-6">
                  <i class="fas fa-check-circle me-1"></i> Tersedia
                </span>
              @else
                <span class="badge bg-warning text-dark fs-6">
                  <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                </span>
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow-sm">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">
          <i class="fas fa-tools me-2"></i>
          Aksi
        </h5>
      </div>
      <div class="card-body">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning w-100 mb-2">
          <i class="fas fa-edit me-2"></i>
          Edit Buku
        </a>
        <form method="POST" action="{{ route('books.destroy', $book) }}" class="w-100">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger w-100" 
                  onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
            <i class="fas fa-trash me-2"></i>
            Hapus Buku
          </button>
        </form>
        <a href="{{ route('books.index') }}" class="btn btn-secondary w-100 mt-2">
          <i class="fas fa-arrow-left me-2"></i>
          Kembali
        </a>
      </div>
    </div>

    <div class="card shadow-sm mt-3">
      <div class="card-header bg-dark text-white">
        <h6 class="mb-0">
          <i class="fas fa-calendar me-2"></i>
          Informasi Sistem
        </h6>
      </div>
      <div class="card-body small">
        <p class="mb-2">
          <strong>Dibuat:</strong><br>
          {{ $book->created_at->format('d M Y H:i') }}
        </p>
        <p class="mb-0">
          <strong>Diperbarui:</strong><br>
          {{ $book->updated_at->format('d M Y H:i') }}
        </p>
      </div>
    </div>
  </div>
</div>

@endsection
