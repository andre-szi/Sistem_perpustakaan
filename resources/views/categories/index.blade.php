@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-0 fw-bold">🏷️ Daftar Kategori</h3>
        <small class="text-muted">Manajemen kategori buku</small>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-success">
        ➕ Tambah Kategori
    </a>
</div>

<div class="row g-3">
    @forelse($categories as $cat)
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary fs-6 px-3">{{ $cat->kode }}</span>
                        <small class="text-muted">
                            {{ $cat->books_count }} buku
                            {{-- books_count dari Eloquent withCount('books') --}}
                        </small>
                    </div>
                    <h5 class="card-title fw-bold">{{ $cat->nama }}</h5>

                    {{-- Relasi: tampilkan 3 buku terbaru dalam kategori ini --}}
                    @if($cat->books->count() > 0)
                        <small class="text-muted d-block mb-2">Buku terbaru:</small>
                        <ul class="list-unstyled mb-3">
                            @foreach($cat->books->take(3) as $book)
                                <li class="text-truncate">
                                    <small>📖
                                        <a href="{{ route('books.show', $book) }}">
                                            {{ $book->judul }}
                                        </a>
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted small">Belum ada buku.</p>
                    @endif

                    <div class="d-flex gap-2">
                        <a href="{{ route('categories.edit', $cat) }}"
                           class="btn btn-sm btn-warning flex-fill">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $cat) }}"
                              onsubmit="return confirm('Hapus kategori ini? Semua buku di kategori ini ikut terhapus!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada kategori.
                <a href="{{ route('categories.create') }}">Tambah kategori pertama</a>
            </div>
        </div>
    @endforelse
</div>

@endsection
