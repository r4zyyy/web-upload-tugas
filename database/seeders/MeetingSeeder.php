<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetings = [
            [
                'meeting_number' => 1,
                'title' => 'Pengenalan Web & Konfigurasi Lingkungan Kerja',
                'topic' => 'Dasar Internet, HTTP/HTTPS, Web Server, Git, & Code Editor',
                'description' => 'Membuat halaman perkenalan diri sederhana dan dokumentasi instalasi environment development (PHP, Composer, VSCode/Git).',
                'due_date' => Carbon::now()->addDays(7),
            ],
            [
                'meeting_number' => 2,
                'title' => 'Struktur Dokumen HTML5 & Semantik Web',
                'topic' => 'Tag Semantik (header, nav, main, article, section, footer), Form & Tabel',
                'description' => 'Menyusun halaman artikel informatif dengan struktur semantik lengkap beserta form pendaftaran anggota.',
                'due_date' => Carbon::now()->addDays(14),
            ],
            [
                'meeting_number' => 3,
                'title' => 'Styling Modern dengan CSS3 & Box Model',
                'topic' => 'Selector CSS, Margin, Padding, Border, Box Sizing, dan Tipografi',
                'description' => 'Mempercantik dokumen HTML pertemuan 2 menggunakan CSS kustom dengan skema warna yang harmonis.',
                'due_date' => Carbon::now()->addDays(21),
            ],
            [
                'meeting_number' => 4,
                'title' => 'Layouting Modern (Flexbox & CSS Grid)',
                'topic' => 'Display Flex, Align & Justify, CSS Grid Layout, Template Columns',
                'description' => 'Membangun landing page produk dengan tata letak grid kartu katalog dan navigasi flexbox.',
                'due_date' => Carbon::now()->addDays(28),
            ],
            [
                'meeting_number' => 5,
                'title' => 'Desain Responsif & Media Queries',
                'topic' => 'Mobile-First Design, Breakpoints, Viewport, Fluid Layout',
                'description' => 'Mengadaptasi landing page agar tampil sempurna di resolusi mobile (375px), tablet (768px), dan desktop (1200px+).',
                'due_date' => Carbon::now()->addDays(35),
            ],
            [
                'meeting_number' => 6,
                'title' => 'Dasar JavaScript & DOM Manipulation',
                'topic' => 'Variabel, Tipe Data, Fungsi, DOM Selector, querySelector, innerHTML',
                'description' => 'Membuat aplikasi interaktif sederhana seperti Todo List atau Kalkulator dengan manipulasi elemen HTML.',
                'due_date' => Carbon::now()->addDays(42),
            ],
            [
                'meeting_number' => 7,
                'title' => 'Event Handling & Validasi Form Sisi Klien',
                'topic' => 'Event Listeners (click, submit, change), Regular Expressions (Regex), Error State',
                'description' => 'Menerapkan validasi form registrasi interaktif dengan indikator kesalahan realtime sebelum submit.',
                'due_date' => Carbon::now()->addDays(49),
            ],
            [
                'meeting_number' => 8,
                'title' => 'Ujian Tengah Semester (UTS) / Review Proyek 1',
                'topic' => 'Integrasi Frontend: HTML5, CSS3, Responsive Design & JS Interaktif',
                'description' => 'Pengumpulan proyek portofolio web frontend utuh beserta dokumen laporan dan link repositori Git.',
                'due_date' => Carbon::now()->addDays(56),
            ],
            [
                'meeting_number' => 9,
                'title' => 'Pengenalan Backend & Dasar Pemrograman PHP',
                'topic' => 'Sintaks PHP, Struktur Kontrol, Array Asosiatif, Superglobal ($_GET, $_POST)',
                'description' => 'Membangun skrip pemrosesan form kontak dan kalkulator nilai mahasiswa berbasis PHP.',
                'due_date' => Carbon::now()->addDays(63),
            ],
            [
                'meeting_number' => 10,
                'title' => 'Pemrograman Berorientasi Objek (OOP) pada PHP',
                'topic' => 'Class, Object, Properties, Methods, Constructor, Encapsulation, Inheritance',
                'description' => 'Membuat struktur class entitas (misal: Mahasiswa, Dosen, Matakuliah) dengan prinsip OOP.',
                'due_date' => Carbon::now()->addDays(70),
            ],
            [
                'meeting_number' => 11,
                'title' => 'Basis Data Relasional & Perancangan MySQL',
                'topic' => 'ERD, Normalisasi Data, DDL & DML, Primary Key, Foreign Key, Relasi Tabel',
                'description' => 'Menyusun skema database sistem akademik dan menulis query SQL untuk seleksi data bertingkat.',
                'due_date' => Carbon::now()->addDays(77),
            ],
            [
                'meeting_number' => 12,
                'title' => 'Integrasi Backend dengan Database (Operasi CRUD)',
                'topic' => 'Koneksi PDO / MySQLi, Prepared Statements, Create, Read, Update, Delete',
                'description' => 'Membangun modul manajemen data buku/barang lengkap dengan operasi tambah, ubah, dan hapus.',
                'due_date' => Carbon::now()->addDays(84),
            ],
            [
                'meeting_number' => 13,
                'title' => 'Autentikasi Pengguna & Manajemen Sesi',
                'topic' => 'Session, Cookies, Hashing Password (bcrypt), Middleware Hak Akses (RBAC)',
                'description' => 'Menerapkan sistem login multi-user (Admin & Mahasiswa) dengan perlindungan rute halaman privat.',
                'due_date' => Carbon::now()->addDays(91),
            ],
            [
                'meeting_number' => 14,
                'title' => 'Upload File & Pengelolaan Media di Server',
                'topic' => 'Penanganan multipart/form-data, Sanitasi Nama Berkas, Validasi MIME, Storage Public',
                'description' => 'Membuat modul upload lampiran dokumen tugas dan galeri gambar profil dengan batasan ukuran berkas.',
                'due_date' => Carbon::now()->addDays(98),
            ],
            [
                'meeting_number' => 15,
                'title' => 'Pengenalan Web Service & RESTful API',
                'topic' => 'Arsitektur REST, Metode HTTP (GET, POST, PUT, DELETE), JSON Response, Postman',
                'description' => 'Membangun endpoint API penyedia data tugas yang dapat dikonsumsi oleh aplikasi klien luar.',
                'due_date' => Carbon::now()->addDays(105),
            ],
            [
                'meeting_number' => 16,
                'title' => 'Keamanan Web, Pengujian & Optimasi Aplikasi',
                'topic' => 'Pencegahan SQL Injection, XSS, CSRF, Asset Minification, Caching, Unit Testing',
                'description' => 'Melakukan audit keamanan pada modul aplikasi yang telah dibuat dan menulis skenario pengujian fungsional.',
                'due_date' => Carbon::now()->addDays(112),
            ],
            [
                'meeting_number' => 17,
                'title' => 'Ujian Akhir Semester (UAS) / Pengumpulan Proyek Akhir',
                'topic' => 'Presentasi & Finalisasi Aplikasi Web Fullstack Terintegrasi',
                'description' => 'Pengumpulan laporan akhir, source code lengkap (ZIP/Git), dokumentasi instalasi, dan video demonstrasi sistem.',
                'due_date' => Carbon::now()->addDays(119),
            ],
        ];

        foreach ($meetings as $data) {
            Meeting::updateOrCreate(
                ['meeting_number' => $data['meeting_number']],
                $data
            );
        }
    }
}
