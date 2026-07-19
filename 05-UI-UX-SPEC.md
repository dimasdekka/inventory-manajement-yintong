# PERANCANGAN ANTARMUKA (UI/UX SPEC)
## Sistem Informasi Inventori Kantor

Prinsip desain: sederhana, konsisten, responsif (Bootstrap 5), tabel data hitam-putih polos, sidebar navigasi tetap di semua halaman internal (kecuali Login).

## Layout Umum (Layout Master)
```
┌────────────────────────────────────────────────────┐
│  Topbar: Logo | Nama Sistem        [User] [Logout]  │
├───────────┬──────────────────────────────────────────┤
│ Sidebar   │  Breadcrumb: Beranda > Modul > Aksi       │
│ - Dashboard│  ┌────────────────────────────────────┐ │
│ - Data     │  │        Konten Halaman               │ │
│   Barang   │  │                                      │ │
│ - Kategori │  │                                      │ │
│ - Supplier │  │                                      │ │
│ - Barang   │  │                                      │ │
│   Masuk    │  │                                      │ │
│ - Barang   │  │                                      │ │
│   Keluar   │  │                                      │ │
│ - Mutasi   │  │                                      │ │
│ - Peminjaman│ │                                      │ │
│ - Pengguna │  │                                      │ │
│ - Laporan  │  └────────────────────────────────────┘ │
└───────────┴──────────────────────────────────────────┘
```
Sidebar menampilkan menu sesuai role (menu "Data Pengguna" hanya muncul untuk Administrator).

---

## 1. Halaman Login
a. Form terpusat (card di tengah layar): logo instansi, judul "Sistem Informasi Inventori Kantor".
b. Field: Email, Password (toggle show/hide).
c. Tombol "Masuk".
d. Area pesan error di atas form (alert merah) jika login gagal.
e. Tanpa sidebar/topbar.

## 2. Halaman Dashboard
a. Baris 1: 4 kartu statistik (Total Barang, Total Kategori, Total Supplier, Barang Dipinjam).
b. Baris 2: 3 kartu statistik (Barang Masuk bulan ini, Barang Keluar bulan ini, Barang Rusak).
c. Baris 3: 2 kolom — kiri: bar chart Stok per Kategori; kanan: line chart Barang Masuk vs Keluar per bulan.
d. Baris 4: tabel/panel "Notifikasi Stok Minimum" — daftar barang dengan badge merah "Stok Rendah".

## 3. Halaman Data Barang
### 3.1 Index (List)
a. Search box + filter dropdown Kategori, filter Lokasi, tombol "Tambah Barang" (kanan atas).
b. Tabel kolom: Kode Barang, Nama Barang, Kategori, Jumlah, Satuan, Lokasi, Kondisi, Aksi (Detail/Edit/Hapus).
c. Badge warna netral (bukan warna-warni) untuk status Kondisi — cukup teks "Baik/Rusak Ringan/Rusak Berat".
d. Pagination di bawah tabel.

### 3.2 Form Tambah/Edit Barang
Field urut: Nama Barang, Kategori (dropdown), Supplier (dropdown, opsional), Merek, Spesifikasi (textarea), Satuan, Lokasi Penyimpanan, Kondisi Barang (dropdown), Harga Satuan, PIC, Stok Minimum, Keterangan (textarea).
Catatan: Kode Barang, Jumlah, dan Barcode tidak diinput manual — tampil sebagai info "akan digenerate otomatis" pada form tambah.

### 3.3 Halaman Detail Barang
a. Panel info lengkap barang + gambar QR Code + tombol "Cetak Label".
b. Tab/section riwayat: Barang Masuk, Barang Keluar, Mutasi, Peminjaman — masing-masing tabel ringkas.

## 4. Halaman Data Kategori
a. Tabel: Kode Kategori, Nama Kategori, Jumlah Barang, Aksi.
b. Modal form tambah/edit (tidak perlu halaman terpisah, cukup modal sederhana).

## 5. Halaman Data Supplier
a. Tabel: Kode Supplier, Nama Supplier, Kontak Person, Telepon, Aksi.
b. Halaman detail: info supplier + riwayat barang masuk dari supplier tsb.

## 6. Halaman Barang Masuk
a. List riwayat dengan filter tanggal & supplier. Kolom: No Transaksi, Tanggal, Barang, Supplier, Jumlah, Harga Satuan, User Input.
b. Form tambah: dropdown Barang (searchable/select2), dropdown Supplier, Jumlah, Tanggal, Harga Satuan, Keterangan.

## 7. Halaman Barang Keluar
a. List riwayat dengan filter tanggal. Kolom: No Transaksi, Tanggal, Barang, Jumlah, Tujuan Penggunaan, User Input.
b. Form tambah: dropdown Barang, Jumlah (dengan info "Stok tersedia: X"), Tanggal, Tujuan Penggunaan, Keterangan.

## 8. Halaman Mutasi Barang
a. List riwayat. Kolom: No Transaksi, Tanggal, Barang, Lokasi Asal → Lokasi Tujuan, PIC Tujuan.
b. Form tambah: dropdown Barang (lokasi asal otomatis terisi), Jumlah, Lokasi Tujuan, PIC Tujuan, Tanggal, Keterangan.

## 9. Halaman Peminjaman
a. Tab: "Sedang Dipinjam" dan "Riwayat" (dikembalikan/terlambat).
b. Kolom: No Transaksi, Barang, Peminjam, Tgl Pinjam, Tgl Rencana Kembali, Status (badge teks), Aksi ("Kembalikan" jika status dipinjam).
c. Form tambah: dropdown Barang, Peminjam, Jumlah, Tgl Pinjam, Tgl Rencana Kembali, Keterangan.

## 10. Halaman Pengembalian
a. Diakses dari tombol "Kembalikan" pada list Peminjaman → membuka form modal: Tanggal Kembali, Kondisi Saat Kembali (dropdown), Keterangan.
b. Halaman terpisah "Riwayat Pengembalian" opsional untuk rekap.

## 11. Halaman Data Pengguna (Admin only)
a. Tabel: Nama, Email, Role (badge teks), Status, Aksi.
b. Form tambah/edit: Nama, Email, Password (kosongkan jika tidak diubah saat edit), Role (dropdown), Foto (upload, opsional), Status.

## 12. Halaman Laporan Inventori
a. Panel filter di atas: Jenis Laporan (dropdown: Stok Barang/Barang Masuk/Barang Keluar/Mutasi/Peminjaman), Rentang Tanggal, Kategori, Lokasi, tombol "Tampilkan".
b. Tabel preview hasil filter.
c. Tombol "Export PDF" dan "Export Excel" di atas tabel.

## 13. Komponen UI Bersama
a. **Alert/Notifikasi**: sukses (hijau tipis), error (merah tipis), tanpa animasi berlebihan.
b. **Modal Konfirmasi Hapus**: "Apakah Anda yakin ingin menghapus data ini?" dengan tombol Batal/Hapus.
c. **Pagination**: gaya Bootstrap default, tampil di kanan bawah tabel.
d. **Badge Status**: teks polos dengan border tipis, tanpa warna mencolok (sesuai preferensi format hitam-putih).
