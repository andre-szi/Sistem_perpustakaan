@extends('layouts.app')

@section('title', $book->judul)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-0 fw-bold">👁️ Detail Buku</h3>
        <small class="text-muted">Informasi lengkap buku</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">✏️ Edit</a>
        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>
</div>

<div class="row g-4">

    {{-- Info Utama Buku --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📖 Informasi Buku</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="150" class="text-muted">Judul</th>
                        <td><strong class="fs-5">{{ $book->judul }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Penulis</th>
                        <td>{{ $book->penulis }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Penerbit</th>
                        <td>{{ $book->penerbit }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tahun Terbit</th>
                        <td>{{ $book->tahun }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">ISBN</th>
                        <td>{{ $book->isbn ?? '<em class="text-muted">Tidak tersedia</em>' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Stok</th>
                        <td>
                            <span class="fw-bold fs-5 {{ $book->stok == 0 ? 'text-danger' : 'text-success' }}">
                                {{ $book->stok }}
                            </span> eksemplar
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status</th>
                        <td>
                            @if($book->status == 'tersedia')
                                <span class="badge bg-success fs-6">✅ Tersedia</span>
                            @else
                                <span class="badge bg-warning text-dark fs-6">🔖 Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Ditambahkan</th>
                        <td>{{ $book->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Diperbarui</th>
                        <td>{{ $book->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Relasi: Info Kategori --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">🏷️ Relasi Kategori</h6>
                <small class="opacity-75">Data dari tabel categories (belongsTo)</small>
            </div>
            <div class="card-body">
                @if($book->category)
                    <div class="text-center py-2">
                        <span class="badge bg-primary fs-4 px-4 py-2 mb-3">
                            {{ $book->category->kode }}
                        </span>
                        <h5>{{ $book->category->nama }}</h5>
                        <p class="text-muted mb-3">
                            Kategori ini memiliki
                            <strong>{{ $book->category->books->count() }}</strong> buku
                        </p>
                        <a href="{{ route('categories.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            Lihat Semua Kategori
                        </a>
                    </div>
                @else
                    <p class="text-muted text-center py-3">Kategori tidak ditemukan</p>
                @endif
            </div>
        </div>

        {{-- Aksi --}}
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">⚡ Aksi</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                        ✏️ Edit Buku
                    </a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}"
                          onsubmit="return confirm('Yakin hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            🗑️ Hapus Buku
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Relasi: Buku Lain dari Kategori yang Sama --}}
    @if($bukuRelasi->count() > 0)
    <div class="col-12">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0">
                    📚 Buku Lain dalam Kategori "{{ $book->category->nama ?? '' }}"
                    <small class="opacity-75 ms-2">(Relasi hasMany dari Category)</small>
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukuRelasi as $b)
                                <tr>
                                    <td><strong>{{ $b->judul }}</strong></td>
                                    <td>{{ $b->penulis }}</td>
                                    <td>{{ $b->tahun }}</td>
                                    <td>
                                        @if($b->status == 'tersedia')
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('books.show', $b) }}"
                                           class="btn btn-sm btn-info text-white">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection
