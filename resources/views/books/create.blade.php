@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-0 fw-bold">➕ Tambah Buku Baru</h3>
        <small class="text-muted">Isi form di bawah untuk menambahkan buku</small>
    </div>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
        ← Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Form Tambah Buku</h5>
    </div>
    <div class="card-body">

        {{-- Tampilkan semua error validasi --}}
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

        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div class="row g-3">

                {{-- Judul --}}
                <div class="col-md-8">
                    <label class="form-label fw-semibold">
                        Judul Buku <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul buku..." required>
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
                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                           value="{{ old('penulis') }}"
                           placeholder="Nama penulis..." required>
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
                           value="{{ old('penerbit') }}"
                           placeholder="Nama penerbit..." required>
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Tahun Terbit <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="tahun"
                           class="form-control @error('tahun') is-invalid @enderror"
                           value="{{ old('tahun', date('Y')) }}"
                           min="1900" max="{{ date('Y') }}" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Stok Awal <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', 0) }}"
                           min="0" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ISBN --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        ISBN <small class="text-muted">(opsional)</small>
                    </label>
                    <input type="text" name="isbn"
                           class="form-control @error('isbn') is-invalid @enderror"
                           value="{{ old('isbn') }}"
                           placeholder="978-xxx-xxx-xxx-x">
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="col-12 d-flex gap-2 pt-2 border-top">
                    <button type="submit" class="btn btn-success px-4">
                        💾 Simpan Buku
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
