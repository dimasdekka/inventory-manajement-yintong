# Walkthrough - Yintong Inventory (Metode RAD)

Saya telah berhasil melakukan refaktorisasi besar pada sistem informasi inventori **Yintong Inventory** untuk menghapus modul **Aset Tetap (Properti)** secara keseluruhan sesuai permintaan Anda, serta meng-upgrade dan memverifikasi kompatibilitas kode untuk berjalan penuh di **PHP 8.5**.

---

## Perubahan yang Dilakukan

### 1. Penghapusan Modul Aset Tetap (Properti)
Seluruh file, migrasi database, dan integrasi menu/laporan terkait **Aset Tetap (Properti, Ruko, Mess Karyawan, Kantor)** telah dihapus sepenuhnya dari codebase:
- **File yang Dihapus**:
  - Model: [AsetTetap.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Models/AsetTetap.php)
  - Controller: [AsetTetapController.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Http/Controllers/AsetTetapController.php)
  - Requests: [StoreAsetTetapRequest.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Http/Requests/StoreAsetTetapRequest.php) & [UpdateAsetTetapRequest.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Http/Requests/UpdateAsetTetapRequest.php)
  - Migrasi: `database/migrations/2026_07_19_045918_create_aset_tetaps_table.php`
  - Views: Folder `resources/views/aset-tetap` beserta seluruh isinya (`index`, `create`, `edit`, `show`).
- **Pembersihan Referensi Kode**:
  - Menghapus rute `/aset-tetap` di [web.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/routes/web.php).
  - Menghapus pemanggilan seeder Aset Tetap dari [DatabaseSeeder.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/database/seeders/DatabaseSeeder.php).
  - Menghapus item menu "Aset Tetap (Properti)" dari sidebar layout utama [app.blade.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/resources/views/layouts/app.blade.php).
  - Menghapus fungsionalitas preview dan ekspor Excel/PDF untuk Aset Tetap dari [LaporanService.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/app/Services/LaporanService.php), [index.blade.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/resources/views/laporan/index.blade.php), dan [pdf.blade.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/resources/views/laporan/pdf.blade.php).
  - Menghapus seluruh skenario test Aset Tetap dari [InventoryTest.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/tests/Feature/InventoryTest.php).

### 2. Upgrade Kompatibilitas PHP 8.5
- **Konfigurasi Composer**: Memperbarui requirement PHP di [composer.json](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/composer.json) menjadi `"php": "^8.1|^8.2|^8.3|^8.4|^8.5"` untuk menyatakan dukungan resmi PHP 8.5 secara aman.
- **Konfigurasi php.ini**: Mengaktifkan ekstensi `zip`, `sqlite3`, dan `pdo_sqlite` pada folder instalasi PHP 8.5 Laragon Anda (`C:\laragon\bin\php\php-8.5.8-Win32-vs17-x64\php.ini`) agar fungsi download library excel/zip dan test in-memory berjalan lancar.
- **Pembersihan Deprecations**: Memperbaiki deprecation warning pada konstanta koneksi SSL MySQL di [database.php](file:///c:/Users/Unicodes/Documents/Developments/Project/Sistem-Inventory-Joki%20Skripsi/config/database.php) dengan menggunakan conditional check yang aman bagi PHP 8.5 (`Pdo\Mysql::ATTR_SSL_CA` menggantikan `PDO::MYSQL_ATTR_SSL_CA`).

---

## Verifikasi Pengujian

Seluruh pengujian unit dan fitur telah dieksekusi di lingkungan **PHP 8.5.8** lokal Anda dan lolos dengan hasil sempurna (**10 passed, 19 assertions**):

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

Tests:    10 passed (19 assertions)
Duration: 6.05s
```
Semua perubahan ini juga **telah sukses di-push ke branch `main` di GitHub Anda**.
