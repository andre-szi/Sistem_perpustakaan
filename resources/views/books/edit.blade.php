@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-0 fw-bold">✏️ Edit Buku</h3>
        <small class="text-muted">Perbarui data buku: <strong>{{ $book->judul }}</strong></small>
    </div>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
        ← Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Form Edit Buku</h5>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Terdapat kesalahan input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('books.update', $book) }}">
            @csrf
            @method('PUT')

            <div class="row g-3">

                {{-- Judul --}}
                <div class="col-md-8">
                    <label class="form-label fw-semibold">
                        Judul Buku <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $book->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">— Pilih Kategori —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Penulis <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="penulis"
                           class="form-control @error('penulis') is-invalid @enderror"
                           value="{{ old('penulis', $book->penulis) }}" required>
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Penerbit <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="penerbit"
                           class="form-control @error('penerbit') is-invalid @enderror"
                           value="{{ old('penerbit', $book->penerbit) }}" required>
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">
                        Tahun Terbit <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="tahun"
                           class="form-control @error('tahun') is-invalid @enderror"
                           value="{{ old('tahun', $book->tahun) }}"
                           min="1900" max="{{ date('Y') }}" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">
                        Stok <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', $book->stok) }}" min="0" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ISBN --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">ISBN</label>
                    <input type="text" name="isbn"
                           class="form-control @error('isbn') is-invalid @enderror"
                           value="{{ old('isbn', $book->isbn) }}"
                           placeholder="978-xxx-xxx-xxx-x">
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror" required>
                        <option value="tersedia"
                            {{ old('status', $book->status) == 'tersedia' ? 'selected' : '' }}>
                            ✅ Tersedia
                        </option>
                        <option value="dipinjam"
                            {{ old('status', $book->status) == 'dipinjam' ? 'selected' : '' }}>
                            🔖 Dipinjam
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="col-12 d-flex gap-2 pt-2 border-top">
                    <button type="submit" class="btn btn-warning px-4">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-info text-white">
                        👁️ Lihat Detail
                    </a>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
