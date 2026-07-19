# RENCANA PENGUJIAN
## Black Box Testing & User Acceptance Testing (UAT)

## 1. Metode Pengujian
a. **Black Box Testing** — menguji fungsionalitas sistem tanpa melihat struktur kode, fokus pada input-output sesuai kebutuhan fungsional.
b. **User Acceptance Testing (UAT)** — pengujian oleh calon pengguna (Administrator, Staff Gudang, Pimpinan) untuk memastikan sistem sesuai kebutuhan operasional nyata.

## 2. Tabel Skenario Pengujian (Black Box)

| No | Modul | Skenario Pengujian | Data Uji | Hasil yang Diharapkan | Hasil Aktual | Status |
|----|-------|---------------------|----------|------------------------|--------------|--------|
| 1 | Login | Login dengan email & password benar | email: admin valid, password valid | Masuk ke Dashboard | | |
| 2 | Login | Login dengan password salah | password salah | Muncul pesan "Email atau password salah" | | |
| 3 | Login | Login dengan akun berstatus nonaktif | akun nonaktif | Muncul pesan "Akun tidak aktif" | | |
| 4 | Login | Percobaan login gagal >5x dalam 1 menit | 6x salah berturut-turut | Sistem membatasi (throttle) sementara | | |
| 5 | Dashboard | Menampilkan data statistik real time | - | Angka statistik sesuai jumlah data aktual di database | | |
| 6 | Data Barang | Tambah barang baru dengan data lengkap valid | semua field wajib terisi | Data tersimpan, kode barang & QR Code otomatis terbentuk | | |
| 7 | Data Barang | Tambah barang tanpa mengisi field wajib | nama_barang kosong | Muncul pesan validasi error | | |
| 8 | Data Barang | Edit data barang | ubah nama_barang | Data berubah, riwayat tetap ada | | |
| 9 | Data Barang | Hapus barang yang masih punya transaksi aktif | barang dengan riwayat masuk | Sistem menolak hapus / soft delete tanpa hilang riwayat | | |
| 10 | Data Barang | Pencarian barang berdasarkan nama/kode | keyword sebagian nama | Hasil pencarian sesuai keyword, waktu respon < 3 detik | | |
| 11 | Data Kategori | Hapus kategori yang masih dipakai barang | kategori aktif | Sistem menolak dengan pesan error | | |
| 12 | Data Supplier | Tambah supplier baru | data lengkap | Data tersimpan dan tampil di dropdown modul Barang Masuk | | |
| 13 | Barang Masuk | Input barang masuk | barang X, jumlah 10 | Stok barang X bertambah 10, riwayat tercatat | | |
| 14 | Barang Keluar | Input barang keluar melebihi stok tersedia | jumlah > stok | Sistem menolak, muncul pesan "Stok tidak mencukupi" | | |
| 15 | Barang Keluar | Input barang keluar sesuai stok tersedia | jumlah ≤ stok | Stok berkurang sesuai jumlah, riwayat tercatat | | |
| 16 | Mutasi Barang | Mutasi barang ke lokasi baru | lokasi tujuan diisi | Lokasi & PIC barang terupdate, jumlah total tidak berubah | | |
| 17 | Peminjaman | Pinjam barang dengan jumlah tersedia | jumlah ≤ stok | Status "dipinjam", stok tersedia berkurang | | |
| 18 | Peminjaman | Pinjam barang melebihi stok tersedia | jumlah > stok | Sistem menolak transaksi | | |
| 19 | Pengembalian | Kembalikan barang yang dipinjam | pilih transaksi dipinjam | Status jadi "dikembalikan", stok bertambah kembali | | |
| 20 | Data Pengguna | Tambah user baru dengan role tertentu | role: staff_gudang | User baru bisa login sesuai hak akses role | | |
| 21 | Data Pengguna | Staff Gudang mencoba akses menu Data Pengguna | login sbg staff_gudang | Akses ditolak (403) atau menu tidak tampil | | |
| 22 | Laporan | Generate laporan stok dengan filter kategori & tanggal | filter tertentu | Data laporan sesuai filter | | |
| 23 | Laporan | Export laporan ke PDF | klik Export PDF | File PDF terunduh dengan data sesuai preview | | |
| 24 | Laporan | Export laporan ke Excel | klik Export Excel | File Excel terunduh dengan data sesuai preview | | |
| 25 | Barcode | Generate QR Code saat tambah barang baru | barang baru disimpan | QR Code tergenerate dan bisa diunduh/dicetak | | |
| 26 | Keamanan | Password tersimpan terenkripsi di database | cek kolom password | Nilai berupa hash bcrypt, bukan plain text | | |
| 27 | Logout | Logout dari sistem | klik tombol logout | Session berakhir, redirect ke halaman login | | |

> Kolom "Hasil Aktual" dan "Status" (Sesuai/Tidak Sesuai) diisi saat pengujian benar-benar dilakukan terhadap aplikasi yang sudah jadi, untuk dilampirkan di BAB IV.

## 3. Skenario User Acceptance Testing (UAT)

| No | Responden (Role) | Aspek yang Dinilai | Metode | Skala Penilaian |
|----|--------------------|---------------------|--------|------------------|
| 1 | Administrator | Kemudahan mengelola master data (barang, kategori, supplier, pengguna) | Kuesioner + observasi langsung | Skala Likert 1–5 |
| 2 | Staff Gudang | Kemudahan input transaksi barang masuk/keluar/mutasi/peminjaman | Kuesioner + observasi langsung | Skala Likert 1–5 |
| 3 | Pimpinan | Kejelasan dashboard dan kemudahan mencetak laporan | Kuesioner + observasi langsung | Skala Likert 1–5 |
| 4 | Semua Role | Kecepatan respon sistem (pencarian < 3 detik) | Pengukuran waktu langsung | Waktu (detik) |
| 5 | Semua Role | Tampilan antarmuka mudah dipahami | Kuesioner | Skala Likert 1–5 |

### Contoh Pertanyaan Kuesioner UAT (Skala Likert 1–5: Sangat Tidak Setuju – Sangat Setuju)
a. Sistem mudah digunakan tanpa pelatihan khusus.
b. Proses input data barang masuk/keluar terasa cepat dan efisien.
c. Dashboard membantu memantau kondisi inventori secara real time.
d. Laporan yang dihasilkan sesuai kebutuhan dan mudah dicetak.
e. Fitur Barcode/QR Code membantu identifikasi barang dengan cepat.

## 4. Format Analisis Hasil Pengujian (untuk BAB IV)
a. **Analisis Black Box**: rekap jumlah skenario "Sesuai" vs "Tidak Sesuai", persentase keberhasilan = (jumlah sesuai / total skenario) × 100%.
b. **Analisis UAT**: hitung rata-rata skor Likert per pertanyaan dan per responden, interpretasikan menggunakan skala interval (misal: 1.00–1.79 Sangat Tidak Baik, ..., 4.20–5.00 Sangat Baik).
c. Kesimpulan: apakah sistem sudah memenuhi seluruh kebutuhan fungsional dan nonfungsional yang didefinisikan di `01-PRD.md`.
