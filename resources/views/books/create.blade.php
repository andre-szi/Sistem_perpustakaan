@extends('layouts.app')
@section('title', 'Tambah Buku Baru')
@section('icon', 'plus-circle')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-success text-white">
    <h5 class="mb-0">Tambah Buku Baru</h5>
  </div>
  <div class="card-body">

    {{-- Validasi error --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('books.store') }}">
      @csrf
      <div class="row g-3">
        <div class="col-md-8">
          <label>Judul Buku <span class="text-danger">*</span></label>
          <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                 value="{{ old('judul') }}" required>
          @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label>Kategori <span class="text-danger">*</span></label>
          <select name="category_id"
                  class="form-select @error('category_id') is-invalid @enderror">
            <option value="">— Pilih Kategori —</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label>Penulis <span class="text-danger">*</span></label>
          <input type="text" name="penulis" class="form-control"
                 value="{{ old('penulis') }}" required>
        </div>

        <div class="col-md-6">
          <label>Penerbit <span class="text-danger">*</span></label>
          <input type="text" name="penerbit" class="form-control"
                 value="{{ old('penerbit') }}" required>
        </div>

        <div class="col-md-4">
          <label>Tahun Terbit</label>
          <input type="number" name="tahun" class="form-control"
                 value="{{ old('tahun', date('Y')) }}"
                 min="1900" max="{{ date('Y') }}" required>
        </div>

        <div class="col-md-4">
          <label>Stok Awal</label>
          <input type="number" name="stok" class="form-control"
                 value="{{ old('stok', 0) }}" min="0" required>
        </div>

        <div class="col-md-4">
          <label>ISBN (opsional)</label>
          <input type="text" name="isbn" class="form-control"
                 value="{{ old('isbn') }}"
                 placeholder="978-xxx-xxx-xxx-x">
        </div>

        <div class="col-12 d-flex gap-2 mt-2">
          <button type="submit" class="btn btn-success">
            Simpan Buku
          </button>
          <a href="{{ route('books.index') }}" class="btn btn-secondary">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection