# 📚 Sistem Perpustakaan - Documentation Index

**Selamat datang di Sistem Perpustakaan!** 📖

Dokumentasi lengkap untuk memahami dan menggunakan aplikasi ini.

---

## 📑 Dokumentasi Tersedia

### 🚀 **1. QUICK_START.md - Mulai Dalam 5 Menit**
**Status:** ⭐ BACA INI DULU!

Panduan singkat dengan 4 scenario:
- Setup lokal di komputer sendiri
- Access dari network share
- Download dari USB/Cloud
- Clone dari GitHub

👉 **Gunakan file ini jika ingin langsung setup tanpa banyak teori**

---

### 📘 **2. PENJELASAN_APLIKASI.md - Dokumentasi Lengkap**

Penjelasan detail tentang:
- ✅ Apa itu Sistem Perpustakaan
- ✅ Arsitektur aplikasi (MVC)
- ✅ Struktur database (4 tabel)
- ✅ Cara kerja aplikasi (alur request)
- ✅ Flow data (contoh kasus)
- ✅ Relasi database
- ✅ Validasi input
- ✅ Query SQL examples

👉 **Gunakan jika ingin memahami cara kerja aplikasi secara mendalam**

---

### 🔧 **3. SETUP_DATABASE_LOKAL.md - Setup & Sharing Database**

Panduan untuk:
- ✅ Setup database lokal
- ✅ Import database
- ✅ Konfigurasi MySQL untuk network access
- ✅ Membuat user remote
- ✅ Firewall configuration
- ✅ Troubleshooting koneksi database

👉 **Gunakan jika ingin share database ke orang lain di jaringan yang sama**

---

### 📦 **4. PANDUAN_SHARING_PROJECT.md - 5 Metode Sharing**

5 cara untuk share project:

1. **Network Sharing** (LAN) - ⚡ Paling Cepat
   - Untuk tim di kantor
   - Database terpusat

2. **USB / External Drive** - 💾 Portable
   - Untuk personal transfer
   - Offline sharing

3. **Cloud Storage** (Google Drive, Dropbox) - ☁️ Internet-based
   - Untuk share via internet
   - File lebih kecil

4. **GitHub** - 🐙 Best Practice
   - Untuk team development
   - Version control

5. **ZIP File** - 📦 Simple
   - One-time sharing
   - Tidak perlu setup rumit

👉 **Gunakan jika ingin share project ke multiple orang dengan metode berbeda**

---

## 🎯 Pilih File Berdasarkan Kebutuhan Anda

### **Saya ingin...**

**...setup aplikasi di komputer saya**
→ Baca: [QUICK_START.md](QUICK_START.md) (Scenario A)

**...memahami cara kerja aplikasi**
→ Baca: [PENJELASAN_APLIKASI.md](PENJELASAN_APLIKASI.md)

**...setup database dan share ke orang lain**
→ Baca: [SETUP_DATABASE_LOKAL.md](SETUP_DATABASE_LOKAL.md)

**...share project ke rekan kerja via network**
→ Baca: [QUICK_START.md](QUICK_START.md) (Scenario B) + [PANDUAN_SHARING_PROJECT.md](PANDUAN_SHARING_PROJECT.md) (Metode 1)

**...share project ke teman via USB/Cloud**
→ Baca: [QUICK_START.md](QUICK_START.md) (Scenario C) + [PANDUAN_SHARING_PROJECT.md](PANDUAN_SHARING_PROJECT.md) (Metode 2 & 3)

**...setup team development di GitHub**
→ Baca: [PANDUAN_SHARING_PROJECT.md](PANDUAN_SHARING_PROJECT.md) (Metode 4) + [QUICK_START.md](QUICK_START.md) (Scenario D)

---

## 📊 Struktur Folder Project

```
Sistem_perpustakaan/
│
├─ 📄 QUICK_START.md                    ← Baca ini dulu!
├─ 📄 PENJELASAN_APLIKASI.md            ← Dokumentasi lengkap
├─ 📄 SETUP_DATABASE_LOKAL.md           ← Setup database
├─ 📄 PANDUAN_SHARING_PROJECT.md        ← Cara share ke orang lain
├─ 📄 INDEX.md                          ← File ini
│
├─ 📄 dump_perpustakaan.sql             ← Database dump
├─ 📄 composer.json                     ← PHP dependencies
├─ 📄 package.json                      ← JavaScript dependencies
├─ 📄 .env                              ← Configuration (jangan push ke git!)
│
├─ 📁 app/
│  ├─ 📁 Models/
│  │  ├─ Book.php                       ← Model buku
│  │  ├─ Category.php                   ← Model kategori
│  │  └─ User.php                       ← Model user
│  │
│  ├─ 📁 Http/Controllers/
│  │  └─ BookController.php             ← Controller untuk CRUD buku
│  │
│  └─ 📁 Exceptions/
│
├─ 📁 routes/
│  ├─ web.php                           ← Route untuk web (CRUD buku)
│  └─ api.php                           ← Route untuk API
│
├─ 📁 resources/views/
│  └─ 📁 books/
│     ├─ index.blade.php                ← Tampil list buku
│     ├─ create.blade.php               ← Form tambah buku
│     ├─ show.blade.php                 ← Detail buku
│     └─ edit.blade.php                 ← Form edit buku
│
├─ 📁 database/
│  ├─ 📁 migrations/                    ← Schema database
│  ├─ 📁 seeders/                       ← Data awal
│  └─ dum.sql                           ← Database dump
│
├─ 📁 storage/                          ← Cache, logs, files
├─ 📁 bootstrap/                        ← Laravel bootstrap
├─ 📁 config/                           ← Konfigurasi aplikasi
└─ 📁 vendor/                           ← PHP packages (jangan edit)
```

---

## 🚀 Workflow Cepat

### **Setup Pertama Kali (New User)**
```
1. Baca QUICK_START.md
2. Pilih scenario yang sesuai
3. Ikuti langkah-langkah
4. Aplikasi siap digunakan
```

### **Sharing ke Orang Lain**
```
1. Baca SETUP_DATABASE_LOKAL.md (konfigurasi database)
2. Baca PANDUAN_SHARING_PROJECT.md (pilih metode)
3. Follow instruksi untuk metode pilihan
4. Share credentials/link ke orang lain
```

### **Troubleshooting**
```
1. Buka QUICK_START.md bagian Troubleshooting
2. Cari error Anda
3. Ikuti solusinya
4. Jika tidak ketemu, baca dokumentasi lengkap
```

---

## 📊 Database Schema

```
Database: db_perpustakaan

├─ categories (Kategori Buku)
│  ├─ id (BIGINT, PK, AUTO_INCREMENT)
│  ├─ nama (VARCHAR 100)
│  └─ kode (VARCHAR 10, UNIQUE)
│
├─ books (Koleksi Buku)
│  ├─ id (BIGINT, PK, AUTO_INCREMENT)
│  ├─ judul (VARCHAR 255)
│  ├─ penulis (VARCHAR 150)
│  ├─ penerbit (VARCHAR 150)
│  ├─ tahun (YEAR)
│  ├─ stok (INT)
│  ├─ isbn (VARCHAR 20, UNIQUE)
│  ├─ category_id (BIGINT, FK → categories.id)
│  ├─ status (ENUM: tersedia/dipinjam)
│  ├─ created_at (TIMESTAMP)
│  └─ updated_at (TIMESTAMP)
│
├─ members (Anggota Perpustakaan)
│  ├─ id (BIGINT, PK, AUTO_INCREMENT)
│  ├─ nama (VARCHAR 150)
│  ├─ nim (VARCHAR 20, UNIQUE)
│  ├─ email (VARCHAR 100, UNIQUE)
│  ├─ no_hp (VARCHAR 15)
│  ├─ created_at (TIMESTAMP)
│  └─ updated_at (TIMESTAMP)
│
└─ users (Pengguna Sistem)
   ├─ id (BIGINT, PK, AUTO_INCREMENT)
   ├─ name (VARCHAR 255)
   ├─ email (VARCHAR 255, UNIQUE)
   ├─ password (VARCHAR 255)
   ├─ email_verified_at (TIMESTAMP)
   ├─ remember_token (VARCHAR 100)
   ├─ created_at (TIMESTAMP)
   └─ updated_at (TIMESTAMP)
```

---

## 🔗 Relasi Database

```
One-to-Many Relationship:

categories (1) ──────→ (Many) books
   │
   ├─ Kategori ID 1 (Teknologi Informasi)
   │  ├─ Pemrograman Laravel 10
   │  ├─ Belajar MySQL untuk Pemula
   │  └─ Python untuk Data Science
   │
   ├─ Kategori ID 2 (Matematika)
   │  ├─ Algoritma dan Pemrograman
   │  └─ Kalkulus Multivariabel
   │
   └─ ... (kategori lainnya)
```

---

## 🎯 Fitur Utama

| Fitur | URL | Method | Deskripsi |
|-------|-----|--------|-----------|
| **List Buku** | `/books` | GET | Tampilkan semua buku + filter |
| **Detail Buku** | `/books/{id}` | GET | Tampilkan detail satu buku |
| **Form Tambah** | `/books/create` | GET | Tampilkan form tambah |
| **Tambah Buku** | `/books` | POST | Simpan buku baru |
| **Form Edit** | `/books/{id}/edit` | GET | Tampilkan form edit |
| **Edit Buku** | `/books/{id}` | PUT | Update buku |
| **Hapus Buku** | `/books/{id}` | DELETE | Hapus buku |

---

## 🛠️ Tech Stack

```
Backend:
- PHP 8.x
- Laravel 10.x
- MySQL 8.0

Frontend:
- Blade Templates
- HTML/CSS/JavaScript
- Bootstrap (optional)

Tools:
- Composer (PHP package manager)
- NPM (JavaScript package manager)
- Laragon (Development environment)
```

---

## ✅ Setup Checklist

### **Komputer Pertama**
- [ ] Laragon installed
- [ ] Database imported
- [ ] .env configured
- [ ] `php artisan serve` running
- [ ] Browser akses http://localhost:8000

### **Share ke Orang Lain (Network)**
- [ ] MySQL bind-address = 0.0.0.0
- [ ] Remote user created
- [ ] Firewall allow MySQL
- [ ] IP address diketahui
- [ ] Orang lain bisa ping IP
- [ ] Orang lain bisa connect MySQL
- [ ] Orang lain setup .env
- [ ] Orang lain run php artisan serve

### **Share ke Orang Lain (Non-Network)**
- [ ] Database exported (SQL)
- [ ] Project compressed (ZIP)
- [ ] Upload ke USB/Cloud
- [ ] Orang lain download
- [ ] Orang lain extract
- [ ] Dependencies installed
- [ ] Database imported
- [ ] .env configured
- [ ] `php artisan serve` running

---

## 📞 Quick Commands Reference

```bash
# Setup
composer install              # Install PHP dependencies
npm install                   # Install JS dependencies
php artisan key:generate     # Generate app key

# Database
mysql -u root -p db_perpustakaan    # Access database
mysqldump -u root db_perpustakaan > backup.sql   # Backup

# Server
php artisan serve            # Run development server
php artisan serve --host=0.0.0.0  # Run accessible from network

# Cache
php artisan cache:clear      # Clear cache
php artisan config:clear     # Clear config cache

# Database (Laravel)
php artisan migrate          # Run migrations
php artisan db:seed          # Seed database
```

---

## 🔐 Security Reminder

```
⚠️ IMPORTANT:
- Jangan share .env file via public
- Jangan push .env ke GitHub
- Jangan gunakan password sederhana
- Jangan expose database ke internet public
- Backup database regularly
- Update dependencies regularly
```

---

## 🤝 Contributing

Jika ingin contribute atau report issue:
1. Fork repository (jika di GitHub)
2. Create feature branch
3. Commit changes
4. Push ke branch
5. Create Pull Request

---

## 📞 Support & Contact

Jika ada pertanyaan atau masalah:
1. Baca dokumentasi yang tersedia
2. Check FAQ di QUICK_START.md
3. Cek troubleshooting section
4. Hubungi project owner

---

## 📅 Version & Updates

- **Current Version:** 1.0
- **Last Updated:** May 14, 2026
- **Status:** Production Ready (for local/team use)

---

## 📜 License

Project ini licensed under the MIT License. Lihat file LICENSE untuk detail.

---

## 🎉 Selamat Menggunakan!

Terima kasih telah menggunakan **Sistem Perpustakaan** 📚

Jika ada feedback atau saran, silakan hubungi project owner.

**Happy coding!** 💻

---

**Dibuat dengan ❤️ | Last Updated: May 2026**

---

## 📋 File Summary

| File | Purpose | Read Time | Priority |
|------|---------|-----------|----------|
| QUICK_START.md | Panduan singkat setup (4 scenario) | 5 min | ⭐⭐⭐ BACA DULU |
| PENJELASAN_APLIKASI.md | Dokumentasi lengkap cara kerja | 15 min | ⭐⭐ Baca untuk paham detail |
| SETUP_DATABASE_LOKAL.md | Setup database & network sharing | 10 min | ⭐⭐ Baca jika perlu share |
| PANDUAN_SHARING_PROJECT.md | 5 metode sharing project | 10 min | ⭐⭐ Baca untuk pilih metode |
| INDEX.md | File ini - ringkasan semua docs | 5 min | ⭐ Reference saja |

---

**Selamat datang di Sistem Perpustakaan! 📚**
