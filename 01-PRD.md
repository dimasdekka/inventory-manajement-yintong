# PRODUCT REQUIREMENTS DOCUMENT (PRD)
## Sistem Informasi Inventori Kantor Berbasis Web Menggunakan Metode RAD

---

## 1. Judul Sistem
Pengembangan Sistem Informasi Inventori Kantor Berbasis Web Menggunakan Metode Rapid Application Development (RAD)

## 2. Latar Belakang
Pencatatan inventori kantor yang masih dilakukan secara manual (buku/Excel terpisah) menimbulkan beberapa masalah:
a. Data barang tidak terpusat sehingga sulit dipantau secara real time.
b. Proses pencarian data barang memakan waktu lama.
c. Rawan kehilangan data dan kesalahan pencatatan (human error).
d. Laporan inventori memerlukan waktu lama untuk disusun secara manual.

## 3. Tujuan Sistem
a. Menggantikan pencatatan inventori manual dengan sistem berbasis web.
b. Mengelola seluruh aset perusahaan secara terpusat, cepat, dan akurat.
c. Menghasilkan laporan inventori secara otomatis (PDF/Excel).
d. Mempermudah pelacakan barang masuk, keluar, mutasi, peminjaman, dan pengembalian.
e. Menerapkan identifikasi barang berbasis Barcode/QR Code.

## 4. Metodologi Pengembangan
Sistem dikembangkan menggunakan metode **Rapid Application Development (RAD)**, dengan tahapan:
a. **Requirements Planning** — analisis kebutuhan sistem (dokumen ini).
b. **User Design** — perancangan ERD, struktur database, antarmuka (lihat `03-DATABASE-ERD.md` dan `05-UI-UX-SPEC.md`), dilakukan iteratif bersama calon pengguna (studi kasus).
c. **Construction** — implementasi coding modul per modul (Laravel), dengan iterasi cepat dan prototyping bertahap.
d. **Cutover** — pengujian (Black Box Testing & UAT), instalasi, dan pelatihan pengguna.

## 5. Ruang Lingkup Sistem

### 5.1 Termasuk dalam ruang lingkup
a. Modul Login & manajemen sesi (role: Administrator, Staff Gudang, Pimpinan).
b. Modul Dashboard (statistik real time & grafik).
c. Modul Data Barang (master data barang lengkap dengan Barcode/QR Code).
d. Modul Data Kategori Barang.
e. Modul Data Supplier.
f. Modul Barang Masuk (transaksi penerimaan barang).
g. Modul Barang Keluar (transaksi pengeluaran barang).
h. Modul Mutasi Barang (perpindahan lokasi/kepemilikan barang antar unit).
i. Modul Peminjaman Barang.
j. Modul Pengembalian Barang.
k. Modul Data Pengguna (manajemen user & hak akses).
l. Modul Laporan Inventori (cetak PDF & Excel, filter kategori/lokasi/tanggal).
m. Fitur generate & scan Barcode/QR Code per barang.
n. Fitur pencarian dan filter data.

### 5.2 Tidak termasuk dalam ruang lingkup (batasan sistem)
a. Modul akuntansi/keuangan (depresiasi aset, jurnal akuntansi) — hanya dicatat nilai aset (Harga Satuan × Jumlah) sebagai informasi, bukan modul akuntansi penuh.
b. Integrasi dengan hardware scanner barcode fisik secara real time (sistem hanya men-generate dan menampilkan barcode/QR; scanning dilakukan lewat kamera browser atau input manual kode, sesuai kebutuhan nonfungsional "Scanner Barcode (opsional)").
c. Kategori aset khusus seperti Kendaraan Operasional, Mess Karyawan, Ruko/Kantor, ATK, dan Peralatan Kerja **tidak dibuat sebagai menu/modul terpisah**, melainkan dikelola sebagai nilai pada field Kategori di dalam modul Data Kategori & Data Barang (lihat catatan di `00-INDEX.md`).
d. Notifikasi via email/WhatsApp (hanya notifikasi in-app di dashboard untuk stok minimum).
e. Aplikasi mobile native (sistem bersifat web responsif).

## 6. Data yang Dikelola
Sesuai dokumen kebutuhan, seluruh data berikut tercakup dalam struktur tabel `03-DATABASE-ERD.md`:
Data Barang, Data Kategori Barang, Data Supplier, Data Pengguna, Data Barang Masuk, Data Barang Keluar, Data Mutasi Barang, Data Peminjaman Barang, Data Pengembalian Barang, serta data jenis aset (Kendaraan Operasional, Mess Karyawan, Ruko/Kantor, ATK, Peralatan Kerja, Aset Lainnya) sebagai sub-kategori.

## 7. Struktur Data Barang (Atribut Minimal)
Kode Barang, Nama Barang, Kategori, Merek, Spesifikasi, Jumlah, Satuan, Lokasi Penyimpanan, Kondisi Barang, Tanggal Masuk, Harga Satuan, Total Nilai Aset (dihitung otomatis), PIC (Penanggung Jawab), Keterangan, Barcode/QR Code (di-generate otomatis dari Kode Barang).

## 8. Modul/Menu Sistem
1. Login
2. Dashboard
3. Data Barang
4. Data Kategori
5. Data Supplier
6. Barang Masuk
7. Barang Keluar
8. Mutasi Barang
9. Peminjaman Barang
10. Pengembalian Barang
11. Data Pengguna
12. Laporan Inventori
13. Logout

Rincian fungsi tiap modul: lihat `04-MODULE-SPEC.md`.

## 9. Dashboard — Informasi Real Time
a. Total Barang
b. Total Kategori
c. Total Supplier
d. Barang Masuk (periode berjalan)
e. Barang Keluar (periode berjalan)
f. Barang Dipinjam (belum dikembalikan)
g. Barang Rusak (berdasarkan kondisi barang)
h. Grafik Stok Barang (bar chart per kategori)
i. Grafik Barang Masuk vs Keluar (line chart per bulan)
j. Notifikasi Stok Minimum (list barang dengan jumlah di bawah ambang batas)

## 10. Kebutuhan Fungsional
Sistem harus dapat:
a. Login dan Logout dengan validasi kredensial.
b. Mengelola (CRUD) Data User, Data Barang, Data Kategori, Data Supplier.
c. Mengelola transaksi Barang Masuk dan Barang Keluar (otomatis update stok).
d. Mengelola Mutasi Barang (update lokasi/PIC barang).
e. Mengelola Peminjaman dan Pengembalian Barang (dengan status: Dipinjam/Dikembalikan/Terlambat).
f. Menghasilkan laporan otomatis berdasarkan filter periode.
g. Mencetak laporan dalam format PDF dan Excel.
h. Melakukan pencarian data barang (nama, kode, kategori).
i. Melakukan filter berdasarkan kategori, lokasi, dan rentang tanggal.
j. Men-generate Barcode/QR Code otomatis untuk setiap barang baru.
k. Menampilkan Dashboard dengan data real time.

## 11. Kebutuhan Nonfungsional

### 11.1 Hardware Minimum
Processor Intel Core i3, RAM 4 GB, Harddisk 500 GB, Printer, Scanner Barcode (opsional).

### 11.2 Software
Windows 10/11, **Laragon** (pengganti XAMPP — menyediakan Apache/Nginx, PHP, MySQL dalam satu paket, lebih ringan untuk pengembangan Laravel modern), PHP 8.2+, MySQL 8, Laravel 10/11, Visual Studio Code, Google Chrome/Microsoft Edge.

> Catatan: Dokumen kebutuhan asli menyebut XAMPP. Sesuai instruksi, environment pengembangan diganti ke **Laragon** karena fungsinya setara (Apache/Nginx + PHP + MySQL) namun lebih ramah untuk workflow Laravel (auto-tersedia Composer, Node.js, dan virtual host `*.test`). Perbedaan ini dapat dicantumkan di BAB III sebagai penyesuaian tools implementasi, tidak mengubah spesifikasi fungsional.

### 11.3 Keamanan
a. Password disimpan terenkripsi (bcrypt, bawaan Laravel `Hash::make`).
b. Validasi login dengan rate limiting (Laravel `Throttle`).
c. Session login dikelola oleh Laravel Session/Sanctum.
d. Hak akses berbasis role (Role-Based Access Control) menggunakan Middleware.
e. CSRF protection aktif di semua form (bawaan Laravel).

### 11.4 Performance
a. Waktu respon sistem cepat (< 2 detik untuk operasi CRUD standar).
b. Proses pencarian data < 3 detik (menggunakan index database pada kolom pencarian).
c. Mendukung volume data inventori besar (pagination pada semua listing).

### 11.5 Usability
a. Antarmuka sederhana dan konsisten antar halaman.
b. Mudah dipahami pengguna non-teknis (Staff Gudang).
c. Responsif (desktop, tablet) menggunakan Bootstrap 5 atau Tailwind CSS.

## 12. Hak Akses Pengguna

| Role | Hak Akses |
|------|-----------|
| **Administrator** | Mengelola seluruh data (CRUD penuh semua modul), mengelola pengguna, melihat & mencetak laporan |
| **Staff Gudang** | Input Barang Masuk, Input Barang Keluar, mengelola stok, mengelola Mutasi/Peminjaman/Pengembalian |
| **Pimpinan** | Melihat Dashboard, melihat & mencetak laporan (read-only, tanpa akses CRUD transaksi) |

Detail hak akses per fitur: lihat matriks di `04-MODULE-SPEC.md` bagian 0.

## 13. Perancangan Sistem (Dokumen Pendukung BAB III)
a. Use Case Diagram — dijelaskan per aktor di `04-MODULE-SPEC.md`.
b. Activity Diagram — alur proses per modul di `04-MODULE-SPEC.md`.
c. Sequence Diagram — dapat diturunkan dari alur proses tiap modul.
d. Class Diagram — mengikuti struktur Model Eloquent di `03-DATABASE-ERD.md`.
e. Entity Relationship Diagram (ERD) — `03-DATABASE-ERD.md`.
f. Logical Record Structure (LRS) — `03-DATABASE-ERD.md`.

## 14. Perancangan Antarmuka
Lihat `05-UI-UX-SPEC.md` untuk seluruh halaman: Login, Dashboard, Data Barang, Data Kategori, Data Supplier, Barang Masuk, Barang Keluar, Mutasi Barang, Peminjaman, Pengembalian, Manajemen User, Laporan.

## 15. Teknik Pengujian
Lihat `06-TESTING-PLAN.md`: Black Box Testing, User Acceptance Testing (UAT), Tabel Skenario Pengujian, Hasil Pengujian, Analisis Pengujian.

## 16. Teknologi Implementasi (Ringkasan)
| Layer | Teknologi |
|-------|-----------|
| Backend Framework | Laravel 10/11 (PHP 8.2+) |
| Database | MySQL 8 (via Laragon) |
| Frontend | Blade Template + Bootstrap 5 (atau Tailwind CSS) |
| Barcode/QR | Library `simplesoftwareio/simple-qrcode` atau `picqer/php-barcode-generator` |
| Export Laporan | `barryvdh/laravel-dompdf` (PDF), `maatwebsite/excel` (Excel) |
| Grafik Dashboard | Chart.js |
| Autentikasi | Laravel Breeze/Fortify + Middleware Role |
| Local Dev Server | Laragon |
