# 📚 Penjelasan Sistem Perpustakaan Laravel

## 📋 Daftar Isi
1. [Ringkasan Aplikasi](#ringkasan)
2. [Arsitektur Aplikasi](#arsitektur)
3. [Struktur Database](#database)
4. [Cara Kerja Aplikasi](#cara-kerja)
5. [Flow Data](#flow-data)
6. [Panduan Penggunaan](#panduan)

---

## 🎯 <a name="ringkasan"></a>Ringkasan Aplikasi

**Sistem Perpustakaan** adalah aplikasi web berbasis Laravel yang digunakan untuk mengelola koleksi buku, kategori buku, dan anggota perpustakaan. Aplikasi ini memungkinkan:

- ✅ Melihat daftar semua buku
- ✅ Mencari buku berdasarkan judul atau penulis
- ✅ Filter buku berdasarkan kategori
- ✅ Menambah buku baru
- ✅ Mengedit informasi buku
- ✅ Menghapus buku
- ✅ Melihat status ketersediaan buku (tersedia/dipinjam)

---

## 🏗️ <a name="arsitektur"></a>Arsitektur Aplikasi

Aplikasi ini menggunakan **Laravel Framework** dengan pola **MVC (Model-View-Controller)**:

### Komponen Utama:

```
┌─────────────────────────────────┐
│      ROUTES (web.php)           │  ← User request masuk di sini
└──────────────┬──────────────────┘
               │
               ▼
┌─────────────────────────────────┐
│   CONTROLLER (BookController)   │  ← Logika bisnis & request handling
└──────────────┬──────────────────┘
               │
      ┌────────┴────────┐
      ▼                 ▼
┌──────────────┐  ┌──────────────┐
│ MODEL        │  │ DATABASE     │
│ (Book,       │  │ (MySQL)      │
│  Category)   │  │              │
└──────────────┘  └──────────────┘
      │                 │
      └────────┬────────┘
               ▼
┌─────────────────────────────────┐
│     VIEW (Blade Templates)      │  ← Tampilan di browser
└─────────────────────────────────┘
```

---

## 💾 <a name="database"></a>Struktur Database

Database bernama `db_perpustakaan` memiliki 4 tabel utama:

### 1️⃣ **Tabel: `categories` (Kategori Buku)**

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | BIGINT (PK) | ID unik, auto increment |
| `nama` | VARCHAR(100) | Nama kategori (misal: "Teknologi Informasi") |
| `kode` | VARCHAR(10) | Kode kategori unik (misal: "TI") |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diubah terakhir |

**Data Contoh:**
```sql
┌────┬──────────────────────────┬───────┐
│ id │ nama                     │ kode  │
├────┼──────────────────────────┼───────┤
│ 1  │ Teknologi Informasi      │ TI    │
│ 2  │ Matematika               │ MTK   │
│ 3  │ Bahasa & Sastra          │ BHS   │
│ 4  │ Ilmu Sosial              │ SOS   │
│ 5  │ Sains & Alam             │ SAN   │
└────┴──────────────────────────┴───────┘
```

---

### 2️⃣ **Tabel: `books` (Koleksi Buku)**

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | BIGINT (PK) | ID unik, auto increment |
| `judul` | VARCHAR(255) | Judul buku |
| `penulis` | VARCHAR(150) | Nama penulis |
| `penerbit` | VARCHAR(150) | Nama penerbit |
| `tahun` | YEAR | Tahun penerbitan |
| `stok` | INT | Jumlah buku tersedia |
| `isbn` | VARCHAR(20) | ISBN unik buku |
| `category_id` | BIGINT (FK) | 🔗 Referensi ke tabel `categories` |
| `status` | ENUM | Status: `tersedia` atau `dipinjam` |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diubah terakhir |

**Data Contoh:**
```sql
┌────┬─────────────────────────┬──────────────┬──────────┬──────┬───────┐
│ id │ judul                   │ penulis      │ tahun    │ stok │ status│
├────┼─────────────────────────┼──────────────┼──────────┼──────┼───────┤
│ 1  │ Pemrograman Laravel 10  │ Eko Kurniawan│ 2023     │ 5    │ tersedia
│ 2  │ Belajar MySQL Pemula    │ Budi Raharjo │ 2022     │ 3    │ tersedia
│ 3  │ Algoritma Pemrograman   │ Rinaldi Munir│ 2021     │ 7    │ dipinjam
│ 4  │ Laskar Pelangi          │ Andrea Hirata│ 2005     │ 10   │ tersedia
└────┴─────────────────────────┴──────────────┴──────────┴──────┴───────┘
```

**Relasi:**
- Setiap buku (`books`) **harus** terhubung dengan satu kategori (`categories`)
- Jika kategori dihapus, semua buku di kategori itu juga terhapus (`ON DELETE CASCADE`)

---

### 3️⃣ **Tabel: `members` (Anggota/Peminjam)**

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | BIGINT (PK) | ID unik, auto increment |
| `nama` | VARCHAR(150) | Nama anggota |
| `nim` | VARCHAR(20) | Nomor Identitas Mahasiswa (unik) |
| `email` | VARCHAR(100) | Email (unik) |
| `no_hp` | VARCHAR(15) | Nomor handphone |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diubah terakhir |

**Data Contoh:**
```sql
┌────┬──────────────────┬─────────┬────────────────────┐
│ id │ nama             │ nim     │ email              │
├────┼──────────────────┼─────────┼────────────────────┤
│ 1  │ Ahmad Fauzi      │ 2021001 │ ahmad@example.com  │
│ 2  │ Sari Indah       │ 2021002 │ sari@example.com   │
│ 3  │ Budi Santoso     │ 2021003 │ budi@example.com   │
└────┴──────────────────┴─────────┴────────────────────┘
```

---

### 4️⃣ **Tabel: `users` (Pengguna Sistem)**

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | BIGINT (PK) | ID unik |
| `name` | VARCHAR(255) | Nama pengguna |
| `email` | VARCHAR(255) | Email (unik) |
| `email_verified_at` | TIMESTAMP | Status verifikasi email |
| `password` | VARCHAR(255) | Password ter-hash |
| `remember_token` | VARCHAR(100) | Token untuk "Remember Me" |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diubah terakhir |

---

## 🔄 <a name="cara-kerja"></a>Cara Kerja Aplikasi

### **Alur Kerja Sistem:**

```
1. User membuka browser → http://localhost/books

2. Laravel Router (routes/web.php)
   └─ Route::resource('books', BookController::class)
   
3. BookController dijalankan
   │
   ├─ index() → Tampilkan daftar buku dengan filter
   ├─ create() → Tampilkan form tambah buku
   ├─ store() → Simpan buku baru ke database
   ├─ show() → Tampilkan detail satu buku
   ├─ edit() → Tampilkan form edit buku
   ├─ update() → Update data buku di database
   └─ destroy() → Hapus buku dari database

4. Model (Book.php, Category.php)
   └─ Komunikasi dengan database

5. View (Blade Templates)
   └─ Tampilkan hasil di browser
```

---

## 📊 <a name="flow-data"></a>Flow Data Detail

### **Contoh 1: Melihat Daftar Buku**

```
USER BROWSER
    ↓
GET /books
    ↓
BookController::index()
    ↓
  Query Database:
  - SELECT * FROM books
  - SELECT * FROM categories
    ↓
  Load Model:
  - Book::with('category')
  - Category::all()
    ↓
  Return View:
  - resources/views/books/index.blade.php
    ↓
TAMPILKAN HTML DI BROWSER
```

**Kode di Controller:**
```php
public function index(Request $request)
{
    $query = Book::with('category');  // Include kategori
    
    // Filter search
    if ($request->has('search')) {
        $query->cari($request->search);  // Cari di judul/penulis
    }
    
    // Filter kategori
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    
    $books = $query->orderBy('judul')->paginate(10);  // Sorting & pagination
    $categories = Category::all();  // Ambil semua kategori
    
    return view('books.index', compact('books', 'categories'));
}
```

---

### **Contoh 2: Menambah Buku Baru**

```
USER BROWSER (Form)
    ↓
GET /books/create
    ↓
BookController::create()
    ├─ SELECT * FROM categories
    └─ Show form (create.blade.php)
    ↓
USER ISI FORM & KLIK SUBMIT
    ↓
POST /books
    ↓
BookController::store()
    ├─ Validasi data:
    │  • judul: required, max 255
    │  • penulis: required, max 150
    │  • tahun: required, format YYYY
    │  • stok: required, min 0
    │  • isbn: unique (tidak boleh sama)
    │  • category_id: harus ada di tabel categories
    │
    ├─ INSERT INTO books (...)
    └─ Redirect ke /books
    ↓
BERHASIL DITAMBAHKAN!
```

**Kode di Controller:**
```php
public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'judul'       => 'required|string|max:255',
        'penulis'     => 'required|string|max:150',
        'penerbit'    => 'required|string|max:150',
        'tahun'       => 'required|digits:4|integer',
        'stok'        => 'required|integer|min:0',
        'isbn'        => 'nullable|string|unique:books,isbn',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Buat & simpan data
    Book::create($validated);

    return redirect()->route('books.index')
        ->with('success', 'Buku berhasil ditambahkan!');
}
```

---

### **Contoh 3: Mengedit Buku**

```
USER KLIK EDIT BUKU
    ↓
GET /books/{id}/edit
    ↓
BookController::edit()
    ├─ SELECT * FROM books WHERE id = {id}
    ├─ SELECT * FROM categories
    └─ Show form dengan data buku lama
    ↓
USER UBAH DATA & SUBMIT
    ↓
PUT /books/{id}
    ↓
BookController::update()
    ├─ Validasi ulang data
    ├─ UPDATE books SET ... WHERE id = {id}
    └─ Redirect ke /books
    ↓
PERUBAHAN DISIMPAN!
```

---

### **Contoh 4: Menghapus Buku**

```
USER KLIK HAPUS
    ↓
DELETE /books/{id}
    ↓
BookController::destroy()
    ├─ DELETE FROM books WHERE id = {id}
    └─ Redirect ke /books
    ↓
BUKU TERHAPUS!
```

---

## 🔗 <a name="relasi"></a>Relasi Database

### **One-to-Many Relationship**

```
Categories (1) ──→ (Many) Books

┌─────────────────────┐       ┌──────────────────────┐
│     categories      │       │       books          │
├─────────────────────┤       ├──────────────────────┤
│ id (PK)         ────┼───────┤─ category_id (FK)    │
│ nama            │   │       │ judul                │
│ kode            │   │       │ penulis              │
│ created_at      │   │       │ penerbit             │
│ updated_at      │   │       │ tahun                │
└─────────────────────┘       │ stok                 │
                               │ isbn                 │
                               │ status               │
                               │ created_at           │
                               │ updated_at           │
                               └──────────────────────┘

Contoh:
- Category ID 1 (Teknologi Informasi)
  ├─ Book: Pemrograman Laravel
  ├─ Book: Belajar MySQL
  └─ Book: Python untuk Data Science

- Category ID 2 (Matematika)
  ├─ Book: Algoritma Pemrograman
  └─ Book: Kalkulus Multivariabel
```

**Kode Model - Relasi:**

```php
// Di Model Category
public function books()
{
    return $this->hasMany(Book::class, 'category_id');
}

// Di Model Book
public function category()
{
    return $this->belongsTo(Category::class);
}
```

**Penggunaan di Eloquent:**
```php
// Ambil buku dengan kategorinya
$books = Book::with('category')->get();

// Ambil kategori dengan semua bukunya
$categories = Category::with('books')->get();

// Akses kategori dari buku
$buku = Book::find(1);
echo $buku->category->nama;  // Output: Teknologi Informasi
```

---

## 💡 <a name="panduan"></a>Panduan Penggunaan

### **1. Setup Awal**

```bash
# Clone/download project
cd Sistem_perpustakaan

# Install dependencies
composer install

# Copy .env
cp .env.example .env

# Generate key
php artisan key:generate

# Migrate & seed database
php artisan migrate
php artisan db:seed  # atau import database dump
```

---

### **2. Menjalankan Aplikasi**

```bash
# Start Laravel development server
php artisan serve
# Buka http://127.0.0.1:8000 di browser

# Atau gunakan Laragon (sudah ada di c:\laragon\www\Sistem_perpustakaan)
# Buka http://localhost/Sistem_perpustakaan di browser
```

---

### **3. Fitur-Fitur Utama**

#### 📖 **Melihat Daftar Buku**
- URL: `http://localhost/books`
- Method: GET
- Fitur:
  - Pagination (10 buku per halaman)
  - Filter by kategori
  - Search by judul/penulis
  - Sorting by judul

#### ➕ **Tambah Buku**
- URL: `http://localhost/books/create`
- Method: GET (form), POST (submit)
- Validasi:
  - Semua field required (kecuali ISBN)
  - ISBN harus unique
  - Category harus ada

#### 📝 **Edit Buku**
- URL: `http://localhost/books/{id}/edit`
- Method: GET (form), PUT (submit)
- Bisa ubah semua field

#### ❌ **Hapus Buku**
- URL: `http://localhost/books/{id}`
- Method: DELETE
- Confirmation perlu diklik

---

## 🛡️ Validasi & Keamanan

### **Validasi Input**

```
judul:
  ├─ required (tidak boleh kosong)
  ├─ string (harus text)
  └─ max:255 (max 255 karakter)

penulis:
  ├─ required
  ├─ string
  └─ max:150

tahun:
  ├─ required
  ├─ digits:4 (harus 4 digit, ex: 2023)
  └─ integer

stok:
  ├─ required
  ├─ integer
  └─ min:0 (tidak boleh negatif)

isbn:
  ├─ nullable (boleh kosong)
  ├─ string
  └─ unique:books,isbn (tidak boleh duplikat)

category_id:
  ├─ required
  └─ exists:categories,id (harus ada di tabel categories)

status:
  ├─ required
  └─ in:tersedia,dipinjam (hanya 2 pilihan)
```

---

## 📚 Query Example

### **SQL yang Dijalankan**

**1. Lihat semua buku dengan kategorinya:**
```sql
SELECT books.*, categories.nama as category_name
FROM books
LEFT JOIN categories ON books.category_id = categories.id
ORDER BY books.judul
LIMIT 10;
```

**2. Cari buku dengan keyword:**
```sql
SELECT * FROM books
WHERE judul LIKE '%laravel%'
   OR penulis LIKE '%laravel%';
```

**3. Filter by kategori:**
```sql
SELECT * FROM books
WHERE category_id = 1
ORDER BY judul;
```

**4. Hitung buku tersedia:**
```sql
SELECT COUNT(*) FROM books
WHERE status = 'tersedia';
```

**5. Insert buku baru:**
```sql
INSERT INTO books (judul, penulis, penerbit, tahun, stok, isbn, category_id, status, created_at, updated_at)
VALUES ('Judul Buku', 'Nama Penulis', 'Penerbit', 2023, 5, '123-456', 1, 'tersedia', NOW(), NOW());
```

---

## 🔧 File-File Penting

```
app/
├─ Models/
│  ├─ Book.php              ← Model untuk tabel books
│  ├─ Category.php          ← Model untuk tabel categories
│  └─ User.php              ← Model untuk tabel users
│
├─ Http/Controllers/
│  └─ BookController.php    ← Logika CRUD buku

routes/
├─ web.php                  ← Route untuk web
└─ api.php                  ← Route untuk API

resources/views/
└─ books/
   ├─ index.blade.php       ← List buku
   ├─ create.blade.php      ← Form tambah
   ├─ show.blade.php        ← Detail buku
   └─ edit.blade.php        ← Form edit

database/
├─ migrations/              ← Schema database
├─ seeders/                 ← Data awal (seeding)
└─ dum.sql                  ← Database dump
```

---

## 📞 Kesimpulan

**Sistem Perpustakaan** adalah aplikasi CRUD sederhana dengan:
- ✅ Laravel Framework
- ✅ MySQL Database
- ✅ Model-View-Controller Architecture
- ✅ Eloquent ORM
- ✅ Form Validation
- ✅ Pagination & Filtering

Data mengalir dari **User → Browser → Routes → Controller → Model → Database** dan kembali lagi ke **View → Browser → User**.

---

**Dibuat dengan ❤️ | Last Updated: May 2026**
