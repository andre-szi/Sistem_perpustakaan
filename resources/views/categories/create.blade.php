@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 fw-bold">➕ Tambah Kategori</h3>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">← Kembali</a>
</div>

<div class="card shadow-sm" style="max-width:500px">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Form Tambah Kategori</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}"
                       placeholder="cth: Teknologi Informasi" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Kode <span class="text-danger">*</span></label>
                <input type="text" name="kode"
                       class="form-control @error('kode') is-invalid @enderror"
                       value="{{ old('kode') }}"
                       placeholder="cth: TI" maxlength="10" required>
                @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">💾 Simpan</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
