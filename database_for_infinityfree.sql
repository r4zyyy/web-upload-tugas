-- SQL Dump untuk InfinityFree (phpMyAdmin / MySQL)
-- Proyek: Pengembangan Aplikasi Web (17 Pertemuan)
-- Dosen: Muhammad Deden Firdaus, S.T, M.Kom

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `submissions`;
DROP TABLE IF EXISTS `meetings`;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE `meetings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meeting_number` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meetings_meeting_number_unique` (`meeting_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `meetings` (`meeting_number`, `title`, `topic`, `description`) VALUES
(1, 'Pengenalan Web & Konfigurasi Lingkungan Kerja', 'Dasar Internet, HTTP/HTTPS, Web Server, Git, & Code Editor', 'Membuat halaman perkenalan diri sederhana dan dokumentasi instalasi environment development (PHP, Composer, VSCode/Git).'),
(2, 'Struktur Dokumen HTML5 & Semantik Web', 'Tag Semantik (header, nav, main, article, section, footer), Form & Tabel', 'Menyusun halaman artikel informatif dengan struktur semantik lengkap beserta form pendaftaran anggota.'),
(3, 'Styling Modern dengan CSS3 & Box Model', 'Selector CSS, Margin, Padding, Border, Box Sizing, dan Tipografi', 'Mempercantik dokumen HTML pertemuan 2 menggunakan CSS kustom dengan skema warna yang harmonis.'),
(4, 'Layouting Modern (Flexbox & CSS Grid)', 'Display Flex, Align & Justify, CSS Grid Layout, Template Columns', 'Membangun landing page produk dengan tata letak grid kartu katalog dan navigasi flexbox.'),
(5, 'Desain Responsif & Media Queries', 'Mobile-First Design, Breakpoints, Viewport, Fluid Layout', 'Mengadaptasi landing page agar tampil sempurna di resolusi mobile (375px), tablet (768px), dan desktop (1200px+).'),
(6, 'Dasar JavaScript & DOM Manipulation', 'Variabel, Tipe Data, Fungsi, DOM Selector, querySelector, innerHTML', 'Membuat aplikasi interaktif sederhana seperti Todo List atau Kalkulator dengan manipulasi elemen HTML.'),
(7, 'Event Handling & Validasi Form Sisi Klien', 'Event Listeners (click, submit, change), Regular Expressions (Regex), Error State', 'Menerapkan validasi form registrasi interaktif dengan indikator kesalahan realtime sebelum submit.'),
(8, 'Ujian Tengah Semester (UTS) / Review Proyek 1', 'Integrasi Frontend: HTML5, CSS3, Responsive Design & JS Interaktif', 'Pengumpulan proyek portofolio web frontend utuh beserta dokumen laporan dan link repositori Git.'),
(9, 'Pengenalan Backend & Dasar Pemrograman PHP', 'Sintaks PHP, Struktur Kontrol, Array Asosiatif, Superglobal ($_GET, $_POST)', 'Membangun skrip pemrosesan form kontak dan kalkulator nilai mahasiswa berbasis PHP.'),
(10, 'Pemrograman Berorientasi Objek (OOP) pada PHP', 'Class, Object, Properties, Methods, Constructor, Encapsulation, Inheritance', 'Membuat struktur class entitas (misal: Mahasiswa, Dosen, Matakuliah) dengan prinsip OOP.'),
(11, 'Basis Data Relasional & Perancangan MySQL', 'ERD, Normalisasi Data, DDL & DML, Primary Key, Foreign Key, Relasi Tabel', 'Menyusun skema database sistem akademik dan menulis query SQL untuk seleksi data bertingkat.'),
(12, 'Integrasi Backend dengan Database (Operasi CRUD)', 'Koneksi PDO / MySQLi, Prepared Statements, Create, Read, Update, Delete', 'Membangun modul manajemen data buku/barang lengkap dengan operasi tambah, ubah, dan hapus.'),
(13, 'Autentikasi Pengguna & Manajemen Sesi', 'Session, Cookies, Hashing Password (bcrypt), Middleware Hak Akses (RBAC)', 'Menerapkan sistem login multi-user (Admin & Mahasiswa) dengan perlindungan rute halaman privat.'),
(14, 'Upload File & Pengelolaan Media di Server', 'Penanganan multipart/form-data, Sanitasi Nama Berkas, Validasi MIME, Storage Public', 'Membuat modul upload lampiran dokumen tugas dan galeri gambar profil dengan batasan ukuran berkas.'),
(15, 'Pengenalan Web Service & RESTful API', 'Arsitektur REST, Metode HTTP (GET, POST, PUT, DELETE), JSON Response, Postman', 'Membangun endpoint API penyedia data tugas yang dapat dikonsumsi oleh aplikasi klien luar.'),
(16, 'Keamanan Web, Pengujian & Optimasi Aplikasi', 'Pencegahan SQL Injection, XSS, CSRF, Asset Minification, Caching, Unit Testing', 'Melakukan audit keamanan pada modul aplikasi yang telah dibuat dan menulis skenario pengujian fungsional.'),
(17, 'Ujian Akhir Semester (UAS) / Pengumpulan Proyek Akhir', 'Presentasi & Finalisasi Aplikasi Web Fullstack Terintegrasi', 'Pengumpulan laporan akhir, source code lengkap (ZIP/Git), dokumentasi instalasi, dan video demonstrasi sistem.');

CREATE TABLE `submissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint(20) unsigned NOT NULL,
  `student_name` varchar(255) NOT NULL DEFAULT 'Mahasiswa',
  `student_nim` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `file_size` bigint(20) unsigned NOT NULL DEFAULT 0,
  `mime_type` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `submissions_meeting_id_foreign` (`meeting_id`),
  CONSTRAINT `submissions_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
