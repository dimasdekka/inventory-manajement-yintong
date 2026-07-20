# DOKUMENTASI SISTEM INFORMASI INVENTORI KANTOR

## **YINTONG INVENTORY SYSTEM**

---

> [!NOTE]
> Dokumentasi ini disusun secara otomatis berdasarkan hasil pengujian langsung (_live inspection_) pada seluruh modul aplikasi **Yintong Inventory**. Setiap modul dilengkapi dengan penjelas fitur, alur kerja, data awal (_seeded data_), dan tangkapan layar visual (_screenshot_).

---

## 1. Ringkasan Arsitektur & Teknologi Sistem

- **Framework Core**: Laravel 10 (PHP 8.3 / PHP 8.5 Compatible)
- **Database Engine**: MySQL 8.0 / MariaDB
- **Desain UI/UX**: Donezo Modern Layout Pattern (Deep Emerald `#0F5A37`, _rounded cards 14px-16px_, _compact padding_, Google Fonts Outfit & Inter)
- **Modul Keamanan**: Role-based Access Control (Administrator, Staff Gudang, Pimpinan) dengan perlindungan Anti-CSRF & Rate Limiting Login.
- **Modul Laporan**: DomPDF Export Landscape 1-Halaman & Maatwebsite Excel Integration.

---

## 2. Akun Akses Pengujian (_Credentials_)

| Role User         | Email Access            | Default Password | Hak Akses Utama                                                           |
| :---------------- | :---------------------- | :--------------- | :------------------------------------------------------------------------ |
| **Administrator** | `admin@admin.com`       | `admin123`       | **Full Access**: Kelola Barang, Transaksi, User, Laporan, & System Config |
| **Staff Gudang**  | `staff@staff.com`       | `staff123`       | **Operasional**: Input Barang Masuk, Keluar, Mutasi, & Peminjaman         |
| **Pimpinan**      | `pimpinan@pimpinan.com` | `pimpinan123`    | **Monitoring**: View Dashboard, Laporan Inventori, & Download PDF/Excel   |

---

## 3. Dokumentasi Visual & Penjelasan Modul

### 🔑 Modul 1: Halaman Authentifikasi (Login)

Halaman autentikasi sistem yang responsif dan aman, dilengkapi proteksi rate-limiting 5x percobaan per menit, fitur _Remember Me_, serta validasi status akun aktif.

![Halaman Login Yintong Inventory](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/login_page_1784537475831.png)

- **Fungsi Utama**: Autentikasi credential pengguna.
- **Elemen UI**: Form input email, password, checkbox remember me, serta logo resmi Yintong (daun hijau emerald).

---

### 📊 Modul 2: Dashboard Overview & Analytics

Pusat kendali utama sistem dengan susunan _Bespoke Stat Cards_ (tanpa garis AI kaku), notifikasi stok kritis, serta grafik analitik interaktif.

![Dashboard Ringkasan Utama](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/dashboard_page_1784537497114.png)

![Grafik Analytics Dashboard](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/dashboard_charts_1784537500806.png)

- **Fitur Utama**:
    - **4 Stat Cards Utama**: Total Unit Barang (Featured Dark Emerald), Kategori Barang, Supplier / Pemasok, dan Barang Dipinjam.
    - **3 Ringkasan Operasional**: Barang Masuk (Bulan Ini), Barang Keluar (Bulan Ini), dan Aset Kondisi Rusak (_Maintenance Alert_).
    - **2 Grafik Analytics (Chart.js)**: Distibusi Stok per Kategori (Bar Chart) dan Tren Transaksi Masuk vs Keluar (Line Chart).
    - **Tabel Peringatan Stok Minimum**: Menampilkan daftar barang yang menyentuh batas minimum secara real-time.

---

### 📦 Modul 3: Data Master - Katalog Barang

Pusat pengelolaan master data barang inventori kantor lengkap dengan kode otomatis, filter kategori, filter lokasi, serta pencarian instan.

![Katalog Data Barang](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/data_barang_page_1784537514357.png)

- **Informasi yang Ditampilkan**: Kode Barang (`BRG-YYYYMM-XXXX`), Nama Barang, Kategori, Stok & Satuan, Lokasi Penyimpanan, Kondisi, Harga Satuan, serta Total Nilai Aset.
- **Aksi Tersedia**:
    - **Tambah Barang Baru**: Form input barang lengkap dengan perhitungan nilai aset otomatis.
    - **Detail / Riwayat**: Membuka halaman profil barang & histori transaksi barang.
    - **Ubah & Hapus**: Edit spesifikasi atau hapus aset terdaftar.

---

### 🏷️ Modul 4: Data Master - Kategori Barang

Modul pengelompokan klasifikasi jenis inventori kantor.

![Kategori Barang](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/kategori_barang_page_1784537558299.png)

- **Informasi yang Ditampilkan**: Kode Kategori, Nama Kategori, Jumlah Jenis Barang yang Terdaftar, Keterangan, dan Tombol Aksi (Ubah / Hapus).
- **Data Awal**: ATK, Kendaraan Operasional, Mess Karyawan, Peralatan Kerja, dan Elektronik.

---

### 🚚 Modul 5: Data Master - Supplier / Pemasok

Pusat pendataan mitra kerja, distributor, dan vendor pengadaan barang inventori.

![Data Supplier / Pemasok](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/data_supplier_page_1784537621765.png)

- **Informasi yang Ditampilkan**: Kode Supplier (`SPL-XXX`), Nama Perusahaan / Supplier, Person in Charge (PIC), Telepon, Email, Alamat Lengkap, serta Riwayat Pengadaan.

---

### 📥 Modul 6: Transaksi - Barang Masuk

Modul pencatatan penerimaan barang inventori dari supplier untuk menambah stok gudang secara otomatis.

![Riwayat Barang Masuk](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/barang_masuk_page_1784537661509.png)

- **Fitur Utama**:
    - Pencatatan barang masuk dari supplier terdaftar.
    - Opsi filter berdasarkan rentang Tanggal Mulai s/d Tanggal Selesai dan Filter Supplier.
    - Pembaruan jumlah stok & total nilai aset barang secara otomatis (_database transaction atomic_).

---

### 📤 Modul 7: Transaksi - Barang Keluar

Modul pencatatan pengeluaran barang untuk kebutuhan operasional kantor atau pemakaian rutin.

![Riwayat Barang Keluar](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/barang_keluar_page_1784537673633.png)

- **Fitur Utama**:
    - Pengurangan stok barang dengan validasi stok mencukupi (mencegah stok minus).
    - Pencatatan peruntukan/penerima barang keluar.

---

### 🔄 Modul 8: Transaksi - Mutasi Lokasi

Modul perpindahan lokasi penyimpanan barang antar ruangan atau gudang.

![Riwayat Mutasi Lokasi](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/mutasi_lokasi_page_1784537687749.png)

- **Fitur Utama**:
    - Mengubah lokasi penyimpanan barang (misal: dari _Gudang Utama_ ke _Ruang IT_).
    - Melacak histori riwayat pemindahan barang beserta tanggal dan petugas pelaksana.

---

### 🤝 Modul 9: Transaksi - Peminjaman Barang

Modul pengelolaan pinjam-meminjam aset kantor yang bersifat sementara (seperti Laptop, Sepeda Motor, Proyektor, AC Portabel).

![Peminjaman Barang](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/peminjaman_barang_page_1784537701288.png)

- **Fitur Utama**:
    - Pencatatan data peminjam, jumlah unit dipinjam, tanggal pinjam, dan estimasi tanggal kembali.
    - Filter status: _Dipinjam_ (Aktif) vs _Dikembalikan_.
    - Tombol aksi **Proses Pengembalian** yang mengembalikan stok barang ke gudang secara otomatis.

---

### 👥 Modul 10: Sistem - Manajemen User & Hak Akses

Modul pengolahan akun pengguna aplikasi yang hanya dapat diakses oleh role **Administrator**.

![Manajemen User](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/manajemen_user_page_1784537714551.png)

- **Fitur Utama**:
    - Tambah pengguna baru, ubah role (_Administrator, Staff Gudang, Pimpinan_), serta ubah status (_Aktif / Non-Aktif_).
    - Proteksi akun admin utama dari penghapusan mandiri (_self-delete protection_).

---

### 📄 Modul 11: Laporan Inventori & Export Presisi

Pusat pembuatan laporan inventori kantor lengkap dengan filter fleksibel, pratinjau tabel (_live preview_), cetak PDF presisi 1-halaman landscape, dan export Excel.

![Filter & Parameter Laporan](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/laporan_page_filters_1784537733222.png)

![Live Preview Laporan Stok Barang](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/laporan_preview_stok_1_1784537742319.png)

- **Pilihan Jenis Laporan**:
    1. Laporan Stok Barang (Lengkap dengan total nilai aset)
    2. Laporan Barang Masuk
    3. Laporan Barang Keluar
    4. Laporan Mutasi Lokasi
    5. Laporan Peminjaman Barang
- **Format Export**:
    - **Cetak PDF**: Dioptimalkan menggunakan DomPDF dengan layout A4 Landscape presisi 1 halaman (tanpa pembengkakan halaman).
    - **Export Excel**: Format spreadsheet `.xlsx` yang siap diolah kembali.

---

## 4. Rekaman Video Walkthrough Pengujian Aplikasi

Berikut adalah rekaman sesi pengujian interaktif _walkthrough_ navigasi seluruh modul sistem:

![Rekaman Session Walkthrough System](file:///C:/Users/Unicodes/.gemini/antigravity-ide/brain/7e8e95e4-086e-4fb9-b0f6-b90e2fe69975/system_features_walkthrough_1784537423494.webp)

---

> [!TIP]
> Seluruh tangkapan layar di atas diambil secara langsung dari sistem aplikasi yang aktif dan dapat diverifikasi kapan saja.
