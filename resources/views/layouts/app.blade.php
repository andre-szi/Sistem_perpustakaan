<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f8; }
        .navbar-brand { font-weight: 700; font-size: 1.3rem; }
        .stat-card { border-radius: 10px; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-card h5 { font-size: 2rem; font-weight: 700; margin: 0; }
        .table thead th { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .badge { font-size: 0.75rem; }
        footer { margin-top: 3rem; padding: 1rem 0; border-top: 1px solid #dee2e6; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('books.index') }}">
            📚 Perpustakaan UNIV
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('books.index') }}">
                        📖 Data Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('categories.index') }}">
                        🏷️ Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.create') }}">
                        ➕ Tambah Buku
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Konten Utama --}}
<div class="container my-4">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

{{-- Footer --}}
<footer class="text-center text-muted">
    <div class="container">
        <small>Sistem Manajemen Perpustakaan &copy; {{ date('Y') }} — Implementasi MVC Laravel</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
