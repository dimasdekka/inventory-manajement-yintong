# Walkthrough - Sistem Informasi Inventori & Aset Tetap Kantor (Metode RAD)

Saya telah berhasil menyelesaikan seluruh fase pengembangan sistem informasi inventori dan pengelolaan aset tetap kantor berbasis web menggunakan **Laravel 10**, PHP 8.1.10, dan MySQL 8 sesuai dengan spesifikasi revisi yang disetujui.

---

## Perubahan yang Dilakukan (Revisi Modul Aset Tetap)

Untuk mendukung pemisahan properti tidak bergerak (Ruko, Kantor, Mess Karyawan) dengan inventori barang habis pakai/bergerak, kami telah menerapkan revisi arsitektur berikut:

### 1. Database & Migrasi Baru
- **Tabel `aset_tetaps`**: Ditambahkan lewat berkas migrasi [2026_07_19_045918_create_aset_tetaps_table.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/database/migrations/2026_07_19_045918_create_aset_tetaps_table.php) untuk menampung spesifikasi properti:
  - Kode Aset (Auto-generated `AST-PROP-0001`)
  - Nama Aset & Tipe Properti (`ruko`, `kantor`, `mess_karyawan`)
  - Alamat Lengkap & Luas (Tanah & Bangunan dalam m²)
  - Tanggal Perolehan & Nilai Perolehan (Harga beli aset)
  - Status Kepemilikan (`milik_sendiri`, `sewa`)
  - Kondisi Bangunan (`baik`, `perlu_perbaikan`, `rusak_berat`)
  - PIC (Penanggung Jawab Properti)
- **Model & Request Validation**: Mengimplementasikan Model [AsetTetap.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Models/AsetTetap.php) dengan fitur `SoftDeletes` dan Form Request [StoreAsetTetapRequest.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Http/Requests/StoreAsetTetapRequest.php) / [UpdateAsetTetapRequest.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Http/Requests/UpdateAsetTetapRequest.php).

### 2. Seeder & Integrasi Laporan
- **DatabaseSeeder**: Menambahkan data seeder default:
  1. *Ruko Kantor Pusat Mangga Dua* (Kantor, Milik Sendiri, Rp 2,5 Miliar)
  2. *Mess Karyawan Palmerah* (Mess, Milik Sendiri, Rp 1,2 Miliar)
  3. *Ruko Gudang Tambahan BSD* (Ruko, Sewa, Rp 120 Juta/tahun)
- **Laporan Properti**: Diintegrasikan ke halaman filter Laporan utama. Anda dapat menyaring data perolehan properti berdasarkan rentang tanggal, melihat pratinjau di tabel, serta mengekspornya ke format **PDF (landscape DomPDF)** dan **Excel**.

### 3. Modul Views & Sidebar Navigation
- **Sidebar Menu**: Menambahkan link **"Aset Tetap (Properti)"** di kelompok **DATA MASTER** pada layout [app.blade.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/resources/views/layouts/app.blade.php).
- **CRUD Pages**:
  - `index.blade.php`: Listing properti minimalis grayscale dengan fitur pencarian dan modal hapus.
  - `create.blade.php`: Form registrasi properti baru (dilengkapi perhitungan otomatis kode aset).
  - `edit.blade.php`: Form ubah data properti.
  - `show.blade.php`: Tampilan informasi detail properti (luas, nilai perolehan, legalitas, kondisi, dll).

---

## Verifikasi Hasil

### Pengujian Otomatis (Automated Tests)
Saya telah memperbarui pengujian fitur otomatis pada berkas [InventoryTest.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/tests/Feature/InventoryTest.php) untuk memverifikasi hak akses CRUD Aset Tetap. Hasil pengujian berjalan sukses tanpa galat:

```bash
php artisan test
```

**Hasil Pengujian Baru (14 passed, 26 assertions):**
```text
PASS  Tests\Unit\ExampleTest
✓ that true is true

PASS  Tests\Feature\ExampleTest
✓ the application returns a successful response

PASS  Tests\Feature\InventoryTest
✓ guest can see login page
✓ user can login with correct credentials
✓ user cannot login with incorrect credentials
✓ nonactive user cannot login
✓ admin can access users page
✓ staff cannot access users page
✓ pimpinan cannot access users page
✓ pimpinan cannot record transactions
✓ admin and staff can access aset tetap list
✓ pimpinan can view aset tetap list
✓ pimpinan cannot access aset tetap creation form
✓ admin can create aset tetap

Tests:    14 passed (26 assertions)
Duration: 6.61s
```

### Panduan Verifikasi Manual oleh Pengguna
1. Pastikan server lokal Anda aktif (misalnya `php artisan serve` di `http://127.0.0.1:8000`).
2. Login sebagai **Administrator** (`admin@admin.com` / `admin123`).
3. Pilih menu baru **Aset Tetap (Properti)** di sidebar.
4. Anda akan melihat 3 properti bawaan seeder (Ruko Kantor, Mess Karyawan, Ruko Gudang).
5. Cobalah membuat Aset Tetap baru, mengubah data, atau menghapusnya.
6. Masuk ke menu **Laporan Inventori**, pilih jenis laporan **Aset Tetap / Properti**, lalu klik **Tampilkan Preview**. Cetak dalam format PDF dan Excel untuk memverifikasi fungsionalitas ekspor laporan.
7. Login sebagai **Pimpinan** (`pimpinan@pimpinan.com` / `pimpinan123`) untuk memverifikasi bahwa akun Pimpinan hanya bisa melihat daftar dan detail properti, serta ditolak (HTTP 403) jika mencoba menambah/mengubah aset tetap tersebut.
