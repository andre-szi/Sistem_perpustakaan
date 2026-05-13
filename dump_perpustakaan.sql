-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_perpustakaan
DROP DATABASE IF EXISTS `db_perpustakaan`;
CREATE DATABASE IF NOT EXISTS `db_perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_perpustakaan`;

-- Dumping structure for table db_perpustakaan.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(150) NOT NULL,
  `penerbit` varchar(150) NOT NULL,
  `tahun` year NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `isbn` varchar(20) DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `status` enum('tersedia','dipinjam') DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_perpustakaan.books: ~8 rows (approximately)
DELETE FROM `books`;
INSERT INTO `books` (`id`, `judul`, `penulis`, `penerbit`, `tahun`, `stok`, `isbn`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Pemrograman Laravel 10', 'Eko Kurniawan', 'Informatika', '2023', 5, '978-602-7297-00-1', 1, 'tersedia', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(2, 'Belajar MySQL untuk Pemula', 'Budi Raharjo', 'Informatika', '2022', 3, '978-602-7297-01-8', 1, 'tersedia', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(3, 'Algoritma dan Pemrograman', 'Rinaldi Munir', 'Informatika', '2021', 7, '978-602-7297-02-5', 2, 'dipinjam', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(4, 'Kalkulus Multivariabel', 'Purcell Varberg', 'Erlangga', '2020', 4, '978-602-7297-03-2', 2, 'tersedia', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(5, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang', '2005', 10, '978-602-7297-04-9', 3, 'tersedia', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(6, 'Sosiologi Pendidikan', 'Nasution', 'Bumi Aksara', '2019', 2, '978-602-7297-05-6', 4, 'dipinjam', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(7, 'Fisika Universitas', 'Hugh D. Young', 'Erlangga', '2021', 6, '978-602-7297-06-3', 5, 'tersedia', '2026-05-12 11:20:43', '2026-05-12 11:20:43'),
	(8, 'Python untuk Data Science', 'Wes McKinney', 'O_Reilly', '2022', 4, '978-602-7297-07-0', 1, 'tersedia', '2026-05-12 11:20:43', '2026-05-12 11:20:43');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_perpustakaan.categories: ~5 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
	(1, 'Teknologi Informasi', 'TI', '2026-05-12 11:19:54', '2026-05-12 11:19:54'),
	(2, 'Matematika', 'MTK', '2026-05-12 11:19:54', '2026-05-12 11:19:54'),
	(3, 'Bahasa & Sastra', 'BHS', '2026-05-12 11:19:54', '2026-05-12 11:19:54'),
	(4, 'Ilmu Sosial', 'SOS', '2026-05-12 11:19:54', '2026-05-12 11:19:54'),
	(5, 'Sains & Alam', 'SAN', '2026-05-12 11:19:54', '2026-05-12 11:19:54');

-- Dumping structure for table db_perpustakaan.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_perpustakaan.members: ~5 rows (approximately)
DELETE FROM `members`;
INSERT INTO `members` (`id`, `nama`, `nim`, `email`, `no_hp`, `created_at`, `updated_at`) VALUES
	(1, 'Ahmad Fauzi', '2021001', 'ahmad@example.com', '08123456789', '2026-05-12 11:21:39', '2026-05-12 11:21:39'),
	(2, 'Sari Indah', '2021002', 'sari@example.com', '08234567890', '2026-05-12 11:21:39', '2026-05-12 11:21:39'),
	(3, 'Budi Santoso', '2021003', 'budi@example.com', '08345678901', '2026-05-12 11:21:39', '2026-05-12 11:21:39'),
	(4, 'Dewi Anggraini', '2021004', 'dewi@example.com', '08456789012', '2026-05-12 11:21:39', '2026-05-12 11:21:39'),
	(5, 'Rizky Pratama', '2021005', 'rizky@example.com', '08567890123', '2026-05-12 11:21:39', '2026-05-12 11:21:39');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
