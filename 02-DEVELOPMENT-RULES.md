# DEVELOPMENT RULES
## Sistem Informasi Inventori Kantor — Laravel

Dokumen ini adalah aturan teknis pengembangan. Tidak untuk dimasukkan langsung ke skripsi, tapi menjadi acuan konsistensi implementasi di BAB IV.

## 1. Environment
a. Local server: **Laragon** (Nginx/Apache + PHP 8.2+ + MySQL 8), bukan XAMPP.
b. PHP version: 8.2 atau lebih baru.
c. Node.js: v20 LTS (untuk build asset Vite).
d. Package manager PHP: Composer. Package manager JS: npm.
e. Database client: HeidiSQL/TablePlus/DBeaver (bawaan Laragon: HeidiSQL).
f. Virtual host: gunakan fitur Laragon `Auto Virtual Hosts`, akses via `http://inventori-kantor.test`.

## 2. Struktur Folder Laravel (standar, tidak diubah)
```
app/
  Http/
    Controllers/
      Admin/           -> controller khusus admin (opsional grouping)
      AuthController.php
      DashboardController.php
      BarangController.php
      KategoriController.php
      SupplierController.php
      BarangMasukController.php
      BarangKeluarController.php
      MutasiController.php
      PeminjamanController.php
      PengembalianController.php
      UserController.php
      LaporanController.php
    Middleware/
      CheckRole.php
    Requests/
      StoreBarangRequest.php
      UpdateBarangRequest.php
      ... (satu FormRequest per aksi create/update yang punya validasi kompleks)
  Models/
    User.php
    Barang.php
    Kategori.php
    Supplier.php
    BarangMasuk.php
    BarangKeluar.php
    MutasiBarang.php
    Peminjaman.php
    Pengembalian.php
  Services/
    BarangService.php       -> logika kompleks (hitung stok, generate kode barang, dsb) dipisah dari Controller
    LaporanService.php
    BarcodeService.php
database/
  migrations/
  seeders/
    DatabaseSeeder.php
    UserSeeder.php
    KategoriSeeder.php
    ... (seeder untuk data dummy testing)
resources/
  views/
    layouts/
      app.blade.php
      auth.blade.php
    components/            -> Blade component (card, modal, table, alert)
    dashboard/
    barang/
    kategori/
    supplier/
    barang-masuk/
    barang-keluar/
    mutasi/
    peminjaman/
    pengembalian/
    users/
    laporan/
routes/
  web.php
```

## 3. Konvensi Penamaan
a. Nama tabel: **snake_case, plural** (`barangs` → gunakan nama lebih jelas: `items` dihindari, pakai **Bahasa Indonesia** konsisten: `barang`, `kategori`, `supplier`, `barang_masuk`, `barang_keluar`, `mutasi_barang`, `peminjaman`, `pengembalian`, `users`).
b. Nama kolom: snake_case (`kode_barang`, `nama_barang`, `tanggal_masuk`).
c. Model: PascalCase singular (`Barang`, `Kategori`, `BarangMasuk`).
d. Controller: PascalCase + suffix `Controller` (`BarangController`).
e. Route name: kebab-case dengan prefix modul (`barang.index`, `barang.store`, `barang-masuk.index`).
f. Blade view: kebab-case, folder per modul (`resources/views/barang/index.blade.php`).
g. Variabel Blade: camelCase (`$dataBarang`, bukan `$data_barang`).
h. Migration file: urutkan sesuai dependency FK (kategori & supplier dibuat sebelum barang; barang dibuat sebelum barang_masuk/keluar/mutasi/peminjaman).

## 4. Aturan Coding
a. Semua akses data lewat **Eloquent Model**, hindari raw query kecuali untuk laporan kompleks (boleh pakai Query Builder `DB::table()` khusus di `LaporanService`).
b. Validasi input WAJIB pakai **Form Request** (`php artisan make:request`), bukan validasi inline di controller, untuk form dengan >3 field.
c. Logika bisnis (hitung stok, generate kode barang otomatis, generate barcode) diletakkan di **Service class**, bukan di controller — controller hanya orchestrate.
d. Setiap transaksi yang mengubah stok (Barang Masuk, Barang Keluar, Mutasi, Peminjaman, Pengembalian) WAJIB dibungkus **DB Transaction** (`DB::transaction()`), supaya jumlah stok di tabel `barang` selalu konsisten dengan riwayat transaksi.
e. Soft delete (`SoftDeletes` trait) digunakan pada `barang`, `kategori`, `supplier`, `users` — data histori transaksi tidak boleh hilang meski master data dihapus.
f. Semua tabel transaksi (`barang_masuk`, `barang_keluar`, `mutasi_barang`, `peminjaman`, `pengembalian`) menyimpan `user_id` (siapa yang menginput) untuk keperluan audit trail.
g. Gunakan Laravel Policy atau Middleware `role:admin,staff_gudang` untuk membatasi akses route sesuai hak akses di PRD.
h. Gunakan `Str::uuid()` atau auto-increment + prefix untuk `kode_barang` (format: `BRG-YYYYMM-0001`), digenerate di `BarangService::generateKodeBarang()`.
i. Barcode/QR Code disimpan sebagai file image di `storage/app/public/barcodes/` dan path-nya disimpan di kolom `barcode_path` pada tabel `barang`.

## 5. Aturan Migration
a. Satu migration = satu tabel (tidak digabung).
b. Semua foreign key menggunakan `foreignId()->constrained()->onDelete('restrict')` untuk tabel master (kategori, supplier) — mencegah penghapusan master data yang masih dipakai transaksi.
c. Kolom `created_at`, `updated_at` wajib ada (`$table->timestamps()`). Tambahkan `deleted_at` untuk tabel dengan soft delete.
d. Kolom uang/nilai: gunakan `decimal(15,2)`, bukan `float`/`integer`.

## 6. Aturan Blade View
a. Semua halaman listing (index) menggunakan pagination (`->paginate(10)`), bukan `->get()`.
b. Semua form pakai `@csrf` dan validasi error ditampilkan per-field (`@error('field')`).
c. Konfirmasi delete menggunakan modal/JS confirm, bukan langsung hapus dari link.
d. Tabel data tidak berwarna-warni (sesuai preferensi Dimas: format tabel hitam-putih polos, border sederhana).
e. Gunakan Blade component untuk elemen berulang (alert, modal, pagination wrapper).

## 7. Git Workflow (jika dipakai)
a. Branch: `main` (stable), `develop` (integrasi), `feature/nama-modul` per modul.
b. Commit message format: `feat: tambah modul barang masuk`, `fix: perbaiki validasi stok`, `docs: update ERD`.
c. Satu modul = satu feature branch, merge ke `develop` setelah modul selesai & lolos testing manual.

## 8. Urutan Pengerjaan (disarankan, sesuai RAD iteratif)
1. Setup project Laravel + Laragon + database + auth (Login/Logout, role).
2. Modul master: Data Kategori, Data Supplier, Data Pengguna.
3. Modul Data Barang + generate Barcode/QR Code.
4. Modul transaksi: Barang Masuk, Barang Keluar (update stok otomatis).
5. Modul Mutasi Barang, Peminjaman, Pengembalian.
6. Dashboard (statistik & grafik, setelah semua data transaksi ada).
7. Modul Laporan (PDF/Excel, filter).
8. Testing (Black Box + UAT) — lihat `06-TESTING-PLAN.md`.

## 9. Environment Variables Penting (.env)
```
APP_NAME="SI Inventori Kantor"
APP_URL=http://inventori-kantor.test
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventori_kantor
DB_USERNAME=root
DB_PASSWORD=
```
