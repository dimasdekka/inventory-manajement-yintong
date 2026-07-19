# SPESIFIKASI FUNGSI MODUL
## Sistem Informasi Inventori Kantor

## 0. Matriks Hak Akses per Modul

| Modul | Administrator | Staff Gudang | Pimpinan |
|-------|:---:|:---:|:---:|
| Login/Logout | ✔ | ✔ | ✔ |
| Dashboard | ✔ | ✔ (data operasional) | ✔ (read-only) |
| Data Barang | CRUD | Create, Read, Update | Read |
| Data Kategori | CRUD | Read | Read |
| Data Supplier | CRUD | Read | Read |
| Barang Masuk | CRUD | Create, Read | Read |
| Barang Keluar | CRUD | Create, Read | Read |
| Mutasi Barang | CRUD | Create, Read | Read |
| Peminjaman | CRUD | Create, Read, Update (status) | Read |
| Pengembalian | CRUD | Create, Read | Read |
| Data Pengguna | CRUD | ✘ | ✘ |
| Laporan Inventori | ✔ (lihat & cetak) | ✘ | ✔ (lihat & cetak) |

CRUD = Create, Read, Update, Delete penuh.

---

## 1. Modul Login
**Aktor:** Administrator, Staff Gudang, Pimpinan
**Fungsi:**
a. Form input email & password.
b. Validasi kredensial terhadap tabel `users` (password di-hash bcrypt).
c. Redirect ke Dashboard sesuai role setelah berhasil login.
d. Menampilkan pesan error jika email/password salah atau akun `nonaktif`.
e. Rate limiting: maksimal 5 percobaan gagal dalam 1 menit (Laravel Throttle).

**Activity Diagram (alur):**
```
User buka halaman login → input email & password → submit
   → sistem validasi → [valid?]
       -> Ya: buat session, redirect ke Dashboard sesuai role
       -> Tidak: tampilkan pesan error, kembali ke form login
```

## 2. Modul Logout
a. Menghapus session aktif user.
b. Redirect ke halaman login dengan pesan "Anda telah keluar".

## 3. Modul Dashboard
**Fungsi:**
a. Menampilkan 7 kartu statistik: Total Barang, Total Kategori, Total Supplier, Barang Masuk (bulan berjalan), Barang Keluar (bulan berjalan), Barang Dipinjam (status=dipinjam), Barang Rusak (kondisi≠baik).
b. Grafik batang (bar chart) Stok Barang per Kategori (Chart.js).
c. Grafik garis (line chart) Barang Masuk vs Barang Keluar per bulan (12 bulan terakhir).
d. Panel Notifikasi Stok Minimum: list barang dengan `jumlah <= stok_minimum`, diurutkan dari yang paling kritis.
e. Data di-refresh setiap kali halaman dibuka (query real time dari database, tidak di-cache lama).

## 4. Modul Data Barang
**Fungsi:**
a. List seluruh barang dengan pagination, pencarian (nama/kode barang), filter kategori & lokasi.
b. Tambah barang baru: input semua atribut (kecuali `jumlah` yang dimulai dari 0 dan `kode_barang`/`barcode_path` yang di-generate otomatis oleh sistem).
c. Generate `kode_barang` otomatis format `BRG-YYYYMM-XXXX` saat simpan.
d. Generate Barcode/QR Code otomatis dari `kode_barang`, disimpan sebagai image, ditampilkan di halaman detail barang dan bisa diunduh/cetak.
e. Edit data barang (kecuali `jumlah`, yang hanya berubah lewat transaksi).
f. Hapus barang (soft delete), hanya jika tidak ada transaksi terkait yang masih aktif (validasi di Service).
g. Halaman detail barang: tampilkan seluruh atribut + riwayat transaksi (masuk/keluar/mutasi/peminjaman) barang tersebut + gambar barcode.
h. Export list barang ke Excel/PDF (opsional dari halaman ini, terhubung ke Modul Laporan).

**Validasi:** nama_barang wajib, kategori_id wajib ada di master, harga_satuan ≥ 0, stok_minimum ≥ 0.

## 5. Modul Data Kategori
a. CRUD kategori: kode_kategori (auto/manual), nama_kategori, keterangan.
b. Tidak bisa dihapus jika masih dipakai oleh minimal satu `barang` (validasi FK restrict).
c. List menampilkan jumlah barang per kategori.

## 6. Modul Data Supplier
a. CRUD supplier: kode_supplier, nama_supplier, kontak_person, telepon, email, alamat.
b. Tidak bisa dihapus jika masih terkait `barang` atau `barang_masuk`.
c. Halaman detail supplier menampilkan riwayat barang masuk dari supplier tsb.

## 7. Modul Barang Masuk
**Fungsi:**
a. Form transaksi: pilih barang (dropdown searchable), pilih supplier, jumlah, tanggal, harga_satuan saat transaksi, keterangan.
b. Saat disimpan (dalam DB Transaction):
   - Insert record `barang_masuk`.
   - Update `barang.jumlah += jumlah`.
   - Update `barang.harga_satuan` (jika berbeda, sesuai kebijakan: pakai harga terbaru) dan `barang.total_nilai_aset`.
   - Generate `no_transaksi` otomatis format `IN-YYYYMMDD-XXXX`.
c. List riwayat barang masuk dengan filter tanggal & supplier.
d. Tidak bisa diedit setelah tersimpan lebih dari 1x24 jam (opsional, mencegah manipulasi data — bisa disesuaikan kebijakan).

## 8. Modul Barang Keluar
**Fungsi:**
a. Form transaksi: pilih barang, jumlah, tanggal, tujuan_penggunaan, keterangan.
b. Validasi: jumlah keluar ≤ stok tersedia (`barang.jumlah`), jika tidak tampilkan error "Stok tidak mencukupi".
c. Saat disimpan: Insert `barang_keluar`, update `barang.jumlah -= jumlah`, update `total_nilai_aset`, generate `no_transaksi` format `OUT-YYYYMMDD-XXXX`.
d. List riwayat dengan filter tanggal & barang.

## 9. Modul Mutasi Barang
**Fungsi:**
a. Form: pilih barang, jumlah, lokasi_asal (default = lokasi_penyimpanan barang saat ini), lokasi_tujuan, pic_asal, pic_tujuan, tanggal, keterangan.
b. Saat disimpan: Insert `mutasi_barang`, update `barang.lokasi_penyimpanan = lokasi_tujuan` dan `barang.pic = pic_tujuan` (jumlah total barang tidak berubah, hanya lokasi/PIC).
c. List riwayat mutasi per barang (bisa dilihat di halaman detail barang juga).

## 10. Modul Peminjaman Barang
**Fungsi:**
a. Form: pilih barang, peminjam (user atau nama bebas), jumlah, tanggal_pinjam, tanggal_rencana_kembali, keterangan.
b. Validasi: jumlah pinjam ≤ stok tersedia.
c. Saat disimpan: Insert `peminjaman` dengan status `dipinjam`, `barang.jumlah -= jumlah` (stok tersedia berkurang), generate `no_transaksi` format `PJM-YYYYMMDD-XXXX`.
d. List peminjaman aktif (status=dipinjam) dan histori (status=dikembalikan/terlambat).
e. Job terjadwal harian: cek `tanggal_rencana_kembali < today AND status='dipinjam'` → ubah status jadi `terlambat`, tampil di Dashboard sebagai perhatian (opsional tambahan, bukan wajib dari requirement tapi meningkatkan kualitas sistem).

## 11. Modul Pengembalian Barang
**Fungsi:**
a. Dari list peminjaman aktif, tombol "Kembalikan" membuka form: tanggal_kembali, kondisi_saat_kembali, keterangan.
b. Saat disimpan (DB Transaction):
   - Insert `pengembalian` terhubung ke `peminjaman_id`.
   - Update `peminjaman.status = 'dikembalikan'`.
   - Update `barang.jumlah += jumlah` (kembali ke stok tersedia).
   - Jika `kondisi_saat_kembali != 'baik'`, update `barang.kondisi_barang` mengikuti kondisi terburuk.
   - Generate `no_transaksi` format `KBL-YYYYMMDD-XXXX`.

## 12. Modul Data Pengguna
**Aktor:** Administrator only.
a. CRUD user: nama, email, password, role, foto, status.
b. Tidak bisa menghapus akun sendiri yang sedang login.
c. Reset password oleh admin (generate password baru / kirim link, sesuai kapasitas skripsi bisa cukup reset manual oleh admin).
d. Nonaktifkan user (status=nonaktif) alih-alih hapus permanen, agar histori transaksi (`user_id`) tetap valid.

## 13. Modul Laporan Inventori
**Fungsi:**
a. Filter: rentang tanggal, kategori, lokasi, jenis laporan (Stok Barang / Barang Masuk / Barang Keluar / Mutasi / Peminjaman-Pengembalian).
b. Preview laporan dalam tabel di halaman web sebelum export.
c. Export ke **PDF** (`barryvdh/laravel-dompdf`) dengan header: nama perusahaan, judul laporan, periode, tabel data, footer tanggal cetak & nama pencetak.
d. Export ke **Excel** (`maatwebsite/excel`) dengan format kolom sesuai jenis laporan.
e. Hanya Administrator dan Pimpinan yang bisa mengakses modul ini.

## 14. Fitur Barcode/QR Code
a. Setiap barang baru otomatis mendapat QR Code berisi `kode_barang` (encode string kode barang, bisa di-scan untuk lookup cepat).
b. Halaman detail barang menampilkan gambar QR Code dan tombol "Cetak Label" (ukuran label kecil untuk ditempel di barang fisik).
c. Fitur "Cari via Scan": input manual atau scan lewat kamera browser (library `html5-qrcode` di sisi frontend, opsional jika waktu memungkinkan) untuk langsung membuka detail barang.

## 15. Fitur Pencarian & Filter (Global)
a. Setiap halaman listing (Barang, Barang Masuk, Barang Keluar, Mutasi, Peminjaman) memiliki search box (live search via AJAX atau submit form) dan filter kategori/lokasi/tanggal sesuai konteks modul.
b. Pencarian menggunakan `LIKE` pada kolom relevan + index database pada kolom yang sering dicari (`kode_barang`, `nama_barang`).
