# 📐 DOKUMENTASI LENGKAP DIAGRAM UML (USE CASE, ACTIVITY, DAN SEQUENCE)
## SISTEM INFORMASI MANAJEMEN INVENTORI & ASET BARANG - PT YINTONG

Dokumen ini disusun untuk keperluan **Laporan Skripsi / Tugas Akhir / Dokumentasi Sistem**. 
Diagram disajikan menggunakan standar **UML (Unified Modeling Language)** dengan notasi **Mermaid**.

---

# 1. 🌐 USE CASE DIAGRAM SISTEM

Use Case Diagram menggambarkan fungsionalitas sistem dari sudut pandang interaksi antara 3 Aktor utama:
1. **Administrator (Nurul Faoziah)**: Memiliki hak akses penuh (Master Data, Transaksi, Laporan, Manajemen User).
2. **Staff Gudang (Rani)**: Bertugas mengelola operasional gudang (Master Data, Transaksi Masuk/Keluar/Mutasi/Pinjam).
3. **Pimpinan (Pak Hermawan)**: Memiliki hak akses monitoring dashboard dan verifikasi laporan inventori.

```mermaid
flowchart LR
    %% Actors
    Admin(["👤 Administrator<br>(Nurul Faoziah)"])
    Staff(["👤 Staff Gudang<br>(Rani)"])
    Pimpinan(["👤 Pimpinan<br>(Pak Hermawan)"])

    subgraph Sistem_Inventori_Yintong ["🏢 SISTEM INFORMASI INVENTORI PT YINTONG"]
        UC1(["🔐 Login & Autentikasi Multi-Role"])
        UC2(["📊 Monitoring Dashboard & Alert Stok Kritis"])
        
        %% Master Data
        UC3(["📦 Kelola Data Master Barang"])
        UC4(["🏷️ Kelola Kategori & Custom Kode"])
        UC5(["🗂️ Kelola Golongan / Jenis Barang & Mapping"])
        UC6(["🏭 Kelola Data Supplier"])
        
        %% Transaksi
        UC7(["📥 Catat Transaksi Barang Masuk"])
        UC8(["📤 Catat Transaksi Barang Keluar"])
        UC9(["🔄 Catat Mutasi Lokasi & PIC (Scan QR)"])
        UC10(["🤝 Catat Peminjaman Barang"])
        UC11(["↩️ Catat Pengembalian Barang"])
        
        %% Laporan & User
        UC12(["📄 Cetak Laporan (PDF & Excel)"])
        UC13(["👥 Manajemen User & Reset Password"])
        UC14(["📷 Scan QR Code Barang"])
    end

    %% Admin Connections
    Admin --> UC1
    Admin --> UC2
    Admin --> UC3
    Admin --> UC4
    Admin --> UC5
    Admin --> UC6
    Admin --> UC7
    Admin --> UC8
    Admin --> UC9
    Admin --> UC10
    Admin --> UC11
    Admin --> UC12
    Admin --> UC13
    Admin --> UC14

    %% Staff Connections
    Staff --> UC1
    Staff --> UC2
    Staff --> UC3
    Staff --> UC7
    Staff --> UC8
    Staff --> UC9
    Staff --> UC10
    Staff --> UC11
    Staff --> UC14

    %% Pimpinan Connections
    Pimpinan --> UC1
    Pimpinan --> UC2
    Pimpinan --> UC12
```

---

# 2. 🔄 5 ACTIVITY DIAGRAM (SISI USER / NON-TEKNIS)
> *Dirancang dengan bahasa bisnis yang mudah dipahami oleh dosen penguji, user awam, dan manajemen.*

---

### 🔹 Activity Diagram 1: Alur Autentikasi & Hak Akses (Login ke Sistem)
Menggambarkan tahapan saat pengguna mengakses sistem inventori sesuai peran masing-masing.

```mermaid
flowchart TD
    Start((● Mulai)) --> A1[Pengguna membuka halaman Login]
    A1 --> A2[Pengguna memasukkan Email & Password]
    A2 --> A3[Pengguna menekan tombol 'Masuk']
    A3 --> A4{Sistem Memeriksa Akun?}
    
    A4 -- "Email/Password Salah / Akun Nonaktif" --> A5[Sistem menampilkan pesan peringatan 'Email atau password salah']
    A5 --> A2

    A4 -- "Data Benar & Status Aktif" --> A6{Pemeriksaan Peran / Role Pengguna}
    
    A6 -- "Administrator" --> A7[Buka Dashboard Admin: Akses Penuh Master Data, Transaksi, Laporan, & Manajemen User]
    A6 -- "Staff Gudang" --> A8[Buka Dashboard Staff: Akses Operasional Barang & Transaksi]
    A6 -- "Pimpinan" --> A9[Buka Dashboard Pimpinan: Akses Grafik Eksekutif & Unduh Laporan]
    
    A7 --> End((◎ Selesai))
    A8 --> End
    A9 --> End
```

---

### 🔹 Activity Diagram 2: Alur Pendaftaran Barang Baru & Pemetaan Golongan
Menggambarkan proses user menambahkan barang baru hingga terbentuk kode unik dan QR Code otomatis.

```mermaid
flowchart TD
    Start((● Mulai)) --> B1[Pengguna membuka menu 'Data Barang' dan klik 'Tambah Barang']
    B1 --> B2[Pengguna mengisi Nama Barang, Satuan, Lokasi, dan Harga]
    B2 --> B3[Pengguna memilih 'Kategori Barang' contoh: ATK]
    B3 --> B4[Sistem otomatis memfilter dan menampilkan daftar 'Golongan Barang' yang sesuai contoh: Buku/Pulpen/Kertas]
    B4 --> B5[Pengguna memilih 'Golongan Barang']
    B5 --> B6[Sistem menampilkan Live Preview Kode Barang contoh: ATK-BKU-202609-0001]
    B6 --> B7[Pengguna menekan tombol 'Simpan Data Barang']
    B7 --> B8{Sistem Memvalidasi Input?}
    
    B8 -- "Ada data kosong / tidak valid" --> B9[Sistem menampilkan tanda peringatan merah pada kolom terkait]
    B9 --> B2

    B8 -- "Valid" --> B10[Sistem menyimpan data barang, mencetak QR Code unik, dan menampilkan pesan sukses]
    B10 --> B11[Barang baru muncul di daftar katalog siap ditransaksikan]
    B11 --> End((◎ Selesai))
```

---

### 🔹 Activity Diagram 3: Alur Mutasi Lokasi & PIC Barang (Auto-fill & Scan QR)
Menggambarkan alur perpindahan barang dari satu ruangan/penanggung jawab ke tempat baru secara otomatis tanpa ketik ulang.

```mermaid
flowchart TD
    Start((● Mulai)) --> C1[Pengguna membuka menu 'Mutasi Barang' dan klik 'Mutasikan Barang']
    C1 --> C2{Cara Memilih Barang?}
    
    C2 -- "Pilih Dropdown" --> C3[Pengguna memilih barang dari daftar pilihan]
    C2 -- "Scan Kamera" --> C4[Pengguna klik tombol 'Scan QR Code' dan mengarahkan kamera ke barcode barang]
    C4 --> C5[Sistem mendeteksi QR Code dan memilih barang otomatis]
    
    C3 --> C6[Sistem OTOMATIS mengisi Lokasi Asal, PIC Asal, Stok Tersedia, dan Draft Catatan Mutasi]
    C5 --> C6
    
    C6 --> C7[Pengguna memasukkan Jumlah Unit yang dimutasi dan Lokasi Tujuan Baru]
    C7 --> C8[Pengguna menekan tombol 'Simpan Transaksi Mutasi']
    C8 --> C9{Sistem Memeriksa Stok?}
    
    C9 -- "Jumlah melebihi stok barang" --> C10[Sistem menolak dan menampilkan peringatan stok tidak mencukupi]
    C10 --> C7

    C9 -- "Stok Cukup" --> C11[Sistem mencatat riwayat mutasi dan otomatis memperbarui Lokasi & PIC pada data master barang]
    C11 --> C12[Sistem menampilkan riwayat mutasi terbaru]
    C12 --> End((◎ Selesai))
```

---

### 🔹 Activity Diagram 4: Alur Peminjaman & Pengembalian Barang Inventaris
Menggambarkan siklus peminjaman aset kantor oleh karyawan hingga barang dikembalikan.

```mermaid
flowchart TD
    Start((● Mulai)) --> D1[Pengguna membuka menu 'Peminjaman Barang']
    D1 --> D2{Pilih Aktivitas}
    
    %% Cabang Peminjaman
    D2 -- "Pinjam Barang Baru" --> D3[Pengguna klik 'Catat Peminjaman']
    D3 --> D4[Pengguna memilih Barang, Nama Peminjam, Jumlah, dan Tanggal Rencana Kembali]
    D4 --> D5[Pengguna klik 'Simpan Peminjaman']
    D5 --> D6{Stok Tersedia?}
    D6 -- "Tidak Cukup" --> D7[Sistem menampilkan pesan stok tidak tersedia]
    D7 --> D4
    D6 -- "Cukup" --> D8[Sistem memotong stok barang, mencatat status 'Dipinjam', dan membuat nomor transaksi PIN-...]
    D8 --> D9[Barang diserahkan ke peminjam]

    %% Cabang Pengembalian
    D2 -- "Kembalikan Barang" --> D10[Pengguna mencari data peminjam pada daftar peminjaman aktif]
    D10 --> D11[Pengguna klik tombol 'Kembalikan Barang']
    D11 --> D12[Pengguna mengisi Tanggal Kembali & Kondisi Barang saat diterima Baik/Rusak]
    D12 --> D13[Pengguna klik 'Simpan Pengembalian']
    D13 --> D14[Sistem mengembalikan stok barang ke master data dan mengubah status transaksi menjadi 'Dikembalikan']
    
    D9 --> End((◎ Selesai))
    D14 --> End
```

---

### 🔹 Activity Diagram 5: Alur Monitoring Stok & Cetak Laporan Inventori
Menggambarkan alur pimpinan atau administrator memantau status inventori dan mencetak laporan resmi.

```mermaid
flowchart TD
    Start((● Mulai)) --> E1[Pengguna membuka menu 'Laporan Inventori']
    E1 --> E2[Pengguna memilih Jenis Laporan: Stok Barang / Barang Masuk / Barang Keluar / Mutasi / Peminjaman]
    E2 --> E3[Pengguna mengatur Filter: Periode Tanggal, Kategori, atau Lokasi Penyimpanan]
    E3 --> E4[Pengguna klik tombol 'Tampilkan / Filter']
    E4 --> E5[Sistem memproses dan menyajikan tabel pratinjau data laporan di layar]
    E5 --> E6{Pilih Format Ekspor}
    
    E6 -- "Ekspor PDF" --> E7[Pengguna klik tombol 'Cetak PDF']
    E7 --> E8[Sistem menyusun dokumen PDF ber-kop surat resmi PT Yintong dengan format tema Navy]
    E8 --> E9[File PDF otomatis terunduh ke perangkat pengguna]

    E6 -- "Ekspor Excel" --> E10[Pengguna klik tombol 'Ekspor Excel']
    E10 --> E11[Sistem membentuk file spreadsheet .xlsx]
    E11 --> E12[File Excel otomatis terunduh untuk rekapitulasi data]

    E9 --> End((◎ Selesai))
    E12 --> End
```

---

# 3. ⚙️ 5 SEQUENCE DIAGRAM (SISI TEKNIS & ARSITEKTUR)
> *Menggambarkan interaksi antar-lapisan kode: View (UI Blade), Form Request, Controller, Service Layer, Model/ORM Eloquent, dan Database.*

---

### 🔸 Sequence Diagram 1: Autentikasi Pengguna (Login Sequence)

```mermaid
sequenceDiagram
    autonumber
    actor User as 👤 Pengguna
    participant View as 🖥️ View: auth/login.blade.php
    participant Ctrl as 🎮 AuthController
    participant Limiter as ⏱️ RateLimiter
    participant AuthFacade as 🔐 Auth Facade / Guard
    participant UserModel as 🗄️ Model: User
    participant DB as 💾 Database

    User->>View: 1. Masukkan Email & Password, Submit
    View->>Ctrl: 2. POST /login (email, password)
    
    Ctrl->>Limiter: 3. tooManyAttempts(throttleKey, 5)
    alt Rate Limit Terlampaui (>= 5x gagal)
        Limiter-->>Ctrl: true
        Ctrl-->>View: 4a. Throw ValidationException (Throttle Error)
        View-->>User: 5a. Tampilkan 'Terlalu banyak percobaan login...'
    else Rate Limit Aman
        Limiter-->>Ctrl: false
        Ctrl->>AuthFacade: 6. attempt(credentials, remember)
        AuthFacade->>UserModel: 7. where('email', email)->first()
        UserModel->>DB: 8. SELECT * FROM users WHERE email = ?
        DB-->>UserModel: 9. Record User Data & Hash Password
        UserModel-->>AuthFacade: 10. User Object
        
        alt Kredensial Salah
            AuthFacade-->>Ctrl: false
            Ctrl->>Limiter: 11a. hit(throttleKey, 60s)
            Ctrl-->>View: 12a. Redirect back with Error 'Email atau password salah'
            View-->>User: 13a. Tampilkan alert merah
        else Kredensial Benar
            AuthFacade-->>Ctrl: true (Authenticated User)
            
            alt Status Non-Aktif
                Ctrl->>AuthFacade: 14a. logout()
                Ctrl-->>View: 15a. Error 'Akun tidak aktif'
            else Status Aktif
                Ctrl->>Limiter: 14b. clear(throttleKey)
                Ctrl->>Ctrl: 15b. session()->regenerate()
                Ctrl-->>View: 16b. Redirect to /dashboard
                View-->>User: 17b. Render Dashboard Layout sesuai Role
            end
        end
    end
```

---

### 🔸 Sequence Diagram 2: Pendaftaran Barang Baru & Generate Barcode/QR (Store Barang)

```mermaid
sequenceDiagram
    autonumber
    actor Admin as 👤 Administrator / Staff
    participant View as 🖥️ View: barang/create.blade.php
    participant Req as 🛡️ StoreBarangRequest
    participant Ctrl as 🎮 BarangController
    participant SvcBarang as ⚙️ BarangService
    participant SvcBarcode as ⚙️ BarcodeService
    participant ModelBarang as 🗄️ Model: Barang
    participant DB as 💾 Database

    Admin->>View: 1. Input Data Barang (Kategori_id, Golongan_id, Nama, Harga, dll)
    View->>Req: 2. POST /barang (Form Data)
    Req->>Req: 3. Validasi Rules & Authorization
    Req-->>Ctrl: 4. validated() Form Data

    Ctrl->>SvcBarang: 5. generateKodeBarang(kategoriId, golonganId)
    SvcBarang->>DB: 6. SELECT kode_barang FROM barang WHERE kode LIKE 'ATK-BKU-%' ORDER BY kode DESC LIMIT 1
    DB-->>SvcBarang: 7. Last Kode (contoh: ATK-BKU-202609-0001)
    SvcBarang-->>Ctrl: 8. Generated New Kode (contoh: ATK-BKU-202609-0002)

    Ctrl->>SvcBarcode: 9. generateQRCode(kodeBarang)
    SvcBarcode->>SvcBarcode: 10. Render SVG QR Code & Save to storage/app/public/barcodes/
    SvcBarcode-->>Ctrl: 11. barcode_path ('barcodes/qrcode_ATK-BKU-202609-0002.svg')

    Ctrl->>ModelBarang: 12. create(data + kode_barang + barcode_path + initial_stok=0)
    ModelBarang->>DB: 13. INSERT INTO barang (...) VALUES (...)
    DB-->>ModelBarang: 14. Inserted Record ID
    ModelBarang-->>Ctrl: 15. Barang Instance
    
    Ctrl-->>View: 16. Redirect to route('barang.index') with Success Flash Message
    View-->>Admin: 17. Tampilkan Katalog Barang dengan Badge Golongan & QR Code
```

---

### 🔸 Sequence Diagram 3: Mutasi Lokasi & PIC Barang (Store Mutasi Sequence)

```mermaid
sequenceDiagram
    autonumber
    actor User as 👤 Staff Gudang / Admin
    participant View as 🖥️ View: mutasi/create.blade.php
    participant Req as 🛡️ StoreMutasiRequest
    participant Ctrl as 🎮 MutasiController
    participant Svc as ⚙️ BarangService
    participant ModelBarang as 🗄️ Model: Barang
    participant ModelMutasi as 🗄️ Model: MutasiBarang
    participant DB as 💾 Database

    User->>View: 1. Scan QR / Pilih Barang, Isi Lokasi Tujuan & PIC Baru
    View->>Req: 2. POST /mutasi (barang_id, jumlah, lokasi_tujuan, pic_tujuan, tanggal, keterangan)
    Req->>Req: 3. Validasi Form
    Req-->>Ctrl: 4. validated() Data

    Ctrl->>Svc: 5. tambahMutasi(data, auth_user_id)
    
    activate Svc
    Svc->>DB: 6. DB::beginTransaction()
    Svc->>ModelBarang: 7. findOrFail(barang_id)
    ModelBarang->>DB: 8. SELECT * FROM barang WHERE id = ?
    DB-->>ModelBarang: 9. Data Barang (lokasi_penyimpanan, pic, jumlah)
    ModelBarang-->>Svc: 10. Barang Object

    alt Jumlah Mutasi > Stok Tersedia
        Svc-->>Ctrl: 11a. Throw ValidationException ('Stok tidak mencukupi')
        Svc->>DB: 12a. DB::rollBack()
        Ctrl-->>View: 13a. Redirect back with Errors
        View-->>User: 14a. Munculkan peringatan merah di form
    else Stok Cukup
        Svc->>Svc: 11b. generateNoTransaksi('MUT', 'mutasi_barang')
        Svc->>ModelMutasi: 12b. create(no_transaksi, lokasi_asal, lokasi_tujuan, pic_asal, pic_tujuan, ...)
        ModelMutasi->>DB: 13b. INSERT INTO mutasi_barang (...) VALUES (...)
        
        Svc->>ModelBarang: 14b. Update Lokasi & PIC baru (barang->lokasi = lokasi_tujuan, barang->pic = pic_tujuan)
        ModelBarang->>DB: 15b. UPDATE barang SET lokasi_penyimpanan = ?, pic = ? WHERE id = ?
        
        Svc->>DB: 16b. DB::commit()
        deactivate Svc
        Svc-->>Ctrl: 17b. MutasiBarang Instance
        Ctrl-->>View: 18b. Redirect to route('mutasi.index') with Success Message
        View-->>User: 19b. Tampilkan tabel riwayat mutasi terbaru
    end
```

---

### 🔸 Sequence Diagram 4: Siklus Peminjaman & Pengembalian Barang

```mermaid
sequenceDiagram
    autonumber
    actor User as 👤 Staff Gudang / Admin
    participant ViewPinjam as 🖥️ View: peminjaman/index.blade.php
    participant CtrlPinjam as 🎮 PeminjamanController
    participant CtrlKembali as 🎮 PengembalianController
    participant Svc as ⚙️ BarangService
    participant ModelPinjam as 🗄️ Model: Peminjaman
    participant ModelKembali as 🗄️ Model: Pengembalian
    participant ModelBarang as 🗄️ Model: Barang
    participant DB as 💾 Database

    %% Tahap Peminjaman
    Note over User, DB: SIKLUS 1: PROSES PEMINJAMAN BARANG
    User->>CtrlPinjam: 1. POST /peminjaman (barang_id, peminjam_id, jumlah, tanggal_rencana_kembali)
    CtrlPinjam->>Svc: 2. tambahPeminjaman(data, auth_user_id)
    Svc->>DB: 3. DB::transaction()
    Svc->>ModelBarang: 4. findOrFail(barang_id) & Cek Stok
    Svc->>ModelPinjam: 5. create(no_peminjaman, status='dipinjam', ...)
    ModelPinjam->>DB: 6. INSERT INTO peminjaman
    Svc->>ModelBarang: 7. Kurangi Stok (barang->jumlah -= jumlah)
    ModelBarang->>DB: 8. UPDATE barang SET jumlah = ?
    Svc-->>CtrlPinjam: 9. Peminjaman Object
    CtrlPinjam-->>ViewPinjam: 10. Refresh Daftar Status 'Dipinjam'

    %% Tahap Pengembalian
    Note over User, DB: SIKLUS 2: PROSES PENGEMBALIAN BARANG
    User->>CtrlKembali: 11. POST /pengembalian (peminjaman_id, tanggal_kembali, kondisi_kembali)
    CtrlKembali->>Svc: 12. tambahPengembalian(data, auth_user_id)
    Svc->>DB: 13. DB::transaction()
    Svc->>ModelKembali: 14. create(no_pengembalian, tanggal_kembali, kondisi_kembali, ...)
    ModelKembali->>DB: 15. INSERT INTO pengembalian
    Svc->>ModelPinjam: 16. Update Status (peminjaman->status = 'dikembalikan')
    ModelPinjam->>DB: 17. UPDATE peminjaman SET status = 'dikembalikan'
    Svc->>ModelBarang: 18. Tambah Stok Kembali (barang->jumlah += jumlah)
    ModelBarang->>DB: 19. UPDATE barang SET jumlah = ?
    Svc-->>CtrlKembali: 20. Pengembalian Object
    CtrlKembali-->>ViewPinjam: 21. Refresh View: Status Peminjaman menjadi 'Dikembalikan'
    ViewPinjam-->>User: 22. Tampilkan badge hijau 'Dikembalikan' & stok bertambah kembali
```

---

### 🔸 Sequence Diagram 5: Ekspor Laporan Inventori (PDF & Excel)

```mermaid
sequenceDiagram
    autonumber
    actor Pimpinan as 👤 Pimpinan / Admin
    participant View as 🖥️ View: laporan/index.blade.php
    participant Ctrl as 🎮 LaporanController
    participant Svc as ⚙️ LaporanService
    participant DomPDF as 📄 Barryvdh\DomPDF\PDF
    participant DB as 💾 Database

    Pimpinan->>View: 1. Pilih Jenis Laporan ('stok' / 'mutasi' / 'barang_masuk') & Filter Tanggal
    Pimpinan->>View: 2. Klik tombol 'Cetak PDF'
    View->>Ctrl: 3. GET /laporan/export-pdf (jenis_laporan, filters...)

    Ctrl->>Svc: 4. getData(filters)
    activate Svc
    Svc->>DB: 5. Query Builder: SELECT barang.*, kategori.nama_kategori, golongan.nama_golongan FROM barang ...
    DB-->>Svc: 6. Collection Data Aset & Riwayat
    Svc-->>Ctrl: 7. Filtered Collection Data
    deactivate Svc

    Ctrl->>Svc: 8. generatePdf(jenisLaporan, data, filters)
    activate Svc
    Svc->>DomPDF: 9. Pdf::loadView('laporan.pdf', compact('data', 'filters', 'summary'))
    DomPDF->>DomPDF: 10. Render Blade HTML dengan CSS Tema Navy, Format Kop Surat & Tanda Tangan
    DomPDF->>DomPDF: 11. Convert HTML DOM to PDF Stream Paper A4 / Landscape
    DomPDF-->>Svc: 12. PDF Binary Object
    Svc-->>Ctrl: 13. PDF Instance
    deactivate Svc

    Ctrl-->>View: 14. return $pdf->download('laporan_stok_20260910.pdf')
    View-->>Pimpinan: 15. Browser mengunduh file PDF resmi Laporan Inventori
```

---

## 📌 Ringkasan Pemetaan Diagram

| No | Modul / Kasus Penggunaan (Use Case) | Activity Diagram (Sisi Bisnis / User) | Sequence Diagram (Sisi Teknis & Arsitektur) |
|---|---|---|---|
| **1** | Autentikasi & Hak Akses | Alur login 3 role (Admin, Staff, Pimpinan) | Validasi, Throttling RateLimit, Auth Guard, Session |
| **2** | Master Barang & Golongan | Pendaftaran barang baru, pemetaan golongan & live preview | StoreBarangRequest, BarangService, BarcodeService QR SVG, DB |
| **3** | Mutasi Lokasi & PIC | Auto-fill lokasi/PIC dan scan kamera QR code | DB Transaction, validasi stok, update lokasi master barang |
| **4** | Peminjaman & Pengembalian | Alur peminjaman aset kantor hingga barang dikembalikan | Siklus ganda Peminjaman & Pengembalian, potong/tambah stok |
| **5** | Monitoring & Laporan | Filter kriteria laporan dan unduh PDF/Excel | Query Builder, LaporanService, DomPDF render CSS Navy |

---
*Dokumen ini dibuat otomatis dan terintegrasi langsung dengan struktur kode sumber Sistem Informasi Inventori PT Yintong.*
