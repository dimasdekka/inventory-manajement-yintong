# PERANCANGAN BASIS DATA
## ERD, Struktur Tabel, Relasi Antar Tabel, dan LRS

---

## 1. Daftar Entitas (Tabel)

| No | Nama Tabel | Deskripsi |
|----|-----------|-----------|
| 1 | `users` | Data pengguna sistem (Administrator, Staff Gudang, Pimpinan) |
| 2 | `kategori` | Master data kategori/jenis barang (termasuk jenis aset: ATK, Kendaraan, dll) |
| 3 | `supplier` | Master data supplier/pemasok |
| 4 | `barang` | Master data barang/aset (stok berjalan) |
| 5 | `barang_masuk` | Transaksi penerimaan barang |
| 6 | `barang_keluar` | Transaksi pengeluaran barang |
| 7 | `mutasi_barang` | Transaksi perpindahan lokasi/PIC barang |
| 8 | `peminjaman` | Transaksi peminjaman barang |
| 9 | `pengembalian` | Transaksi pengembalian barang pinjaman |

---

## 2. Entity Relationship Diagram (ERD) — Notasi Chen (deskriptif)

```
[users] 1───────< N [barang_masuk]
[users] 1───────< N [barang_keluar]
[users] 1───────< N [mutasi_barang]
[users] 1───────< N [peminjaman]        (sebagai pencatat)
[users] 1───────< N [peminjaman]        (sebagai peminjam, FK terpisah)
[users] 1───────< N [pengembalian]

[kategori] 1───────< N [barang]

[supplier] 1───────< N [barang]
[supplier] 1───────< N [barang_masuk]

[barang] 1───────< N [barang_masuk]
[barang] 1───────< N [barang_keluar]
[barang] 1───────< N [mutasi_barang]
[barang] 1───────< N [peminjaman]

[peminjaman] 1───────< 1 [pengembalian]   (satu peminjaman punya satu pengembalian, nullable selama belum dikembalikan)
```

### Kardinalitas (ringkas)
a. Satu **Kategori** memiliki banyak **Barang** (1:N).
b. Satu **Supplier** memasok banyak **Barang** dan banyak transaksi **Barang Masuk** (1:N).
c. Satu **Barang** memiliki banyak riwayat **Barang Masuk**, **Barang Keluar**, **Mutasi**, dan **Peminjaman** (1:N).
d. Satu **User** dapat menginput banyak transaksi di semua modul transaksi (1:N, sebagai audit trail `created_by`).
e. Satu **Peminjaman** memiliki maksimal satu **Pengembalian** (1:1, opsional selama barang belum dikembalikan).

---

## 3. Struktur Tabel Detail

### 3.1 Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK, auto_increment | |
| nama | varchar(100) | |
| email | varchar(100), unique | dipakai untuk login |
| password | varchar(255) | terenkripsi bcrypt |
| role | enum('administrator','staff_gudang','pimpinan') | |
| foto | varchar(255), nullable | |
| status | enum('aktif','nonaktif') default 'aktif' | |
| created_at, updated_at, deleted_at | timestamp | soft delete |

### 3.2 Tabel `kategori`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| kode_kategori | varchar(20), unique | contoh: KTG-001 |
| nama_kategori | varchar(100) | contoh: "ATK", "Kendaraan Operasional", "Peralatan Kerja", "Elektronik", dst |
| keterangan | text, nullable | |
| created_at, updated_at, deleted_at | timestamp | |

### 3.3 Tabel `supplier`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| kode_supplier | varchar(20), unique | |
| nama_supplier | varchar(150) | |
| kontak_person | varchar(100), nullable | |
| telepon | varchar(20), nullable | |
| email | varchar(100), nullable | |
| alamat | text, nullable | |
| created_at, updated_at, deleted_at | timestamp | |

### 3.4 Tabel `barang`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| kode_barang | varchar(30), unique | format BRG-YYYYMM-0001, auto-generate |
| nama_barang | varchar(150) | |
| kategori_id | bigint, FK → kategori.id | |
| supplier_id | bigint, FK → supplier.id, nullable | supplier awal/utama |
| merek | varchar(100), nullable | |
| spesifikasi | text, nullable | |
| jumlah | int, default 0 | stok berjalan (hasil kalkulasi masuk-keluar) |
| satuan | varchar(20) | pcs, unit, box, dll |
| lokasi_penyimpanan | varchar(150) | |
| kondisi_barang | enum('baik','rusak_ringan','rusak_berat') default 'baik' | |
| tanggal_masuk | date | tanggal pertama kali dicatat |
| harga_satuan | decimal(15,2) | |
| total_nilai_aset | decimal(18,2) | computed: jumlah × harga_satuan (disimpan & di-update tiap transaksi) |
| pic | varchar(100), nullable | penanggung jawab |
| keterangan | text, nullable | |
| stok_minimum | int, default 5 | ambang batas notifikasi dashboard |
| barcode_path | varchar(255), nullable | path file image barcode/QR |
| created_at, updated_at, deleted_at | timestamp | |

### 3.5 Tabel `barang_masuk`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| no_transaksi | varchar(30), unique | format IN-YYYYMMDD-0001 |
| barang_id | bigint, FK → barang.id | |
| supplier_id | bigint, FK → supplier.id | |
| jumlah | int | jumlah barang masuk |
| tanggal | date | |
| harga_satuan | decimal(15,2) | harga saat transaksi ini (bisa beda dari harga master) |
| keterangan | text, nullable | |
| user_id | bigint, FK → users.id | siapa yang input |
| created_at, updated_at | timestamp | |

### 3.6 Tabel `barang_keluar`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| no_transaksi | varchar(30), unique | format OUT-YYYYMMDD-0001 |
| barang_id | bigint, FK → barang.id | |
| jumlah | int | |
| tanggal | date | |
| tujuan_penggunaan | varchar(150), nullable | contoh: "Divisi Marketing" |
| keterangan | text, nullable | |
| user_id | bigint, FK → users.id | |
| created_at, updated_at | timestamp | |

### 3.7 Tabel `mutasi_barang`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| no_transaksi | varchar(30), unique | format MUT-YYYYMMDD-0001 |
| barang_id | bigint, FK → barang.id | |
| jumlah | int | jumlah unit yang dimutasi |
| lokasi_asal | varchar(150) | |
| lokasi_tujuan | varchar(150) | |
| pic_asal | varchar(100), nullable | |
| pic_tujuan | varchar(100), nullable | |
| tanggal | date | |
| keterangan | text, nullable | |
| user_id | bigint, FK → users.id | |
| created_at, updated_at | timestamp | |

### 3.8 Tabel `peminjaman`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| no_transaksi | varchar(30), unique | format PJM-YYYYMMDD-0001 |
| barang_id | bigint, FK → barang.id | |
| peminjam_id | bigint, FK → users.id | user yang meminjam (atau boleh field varchar `nama_peminjam` bila peminjam bukan user sistem) |
| jumlah | int | |
| tanggal_pinjam | date | |
| tanggal_rencana_kembali | date | |
| status | enum('dipinjam','dikembalikan','terlambat') default 'dipinjam' | |
| keterangan | text, nullable | |
| user_id | bigint, FK → users.id | pencatat transaksi |
| created_at, updated_at | timestamp | |

### 3.9 Tabel `pengembalian`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint, PK | |
| no_transaksi | varchar(30), unique | format KBL-YYYYMMDD-0001 |
| peminjaman_id | bigint, FK → peminjaman.id, unique | 1:1 dengan peminjaman |
| tanggal_kembali | date | |
| kondisi_saat_kembali | enum('baik','rusak_ringan','rusak_berat') | |
| keterangan | text, nullable | |
| user_id | bigint, FK → users.id | |
| created_at, updated_at | timestamp | |

---

## 4. Logical Record Structure (LRS)

```
users (id*, nama, email, password, role, foto, status)
kategori (id*, kode_kategori, nama_kategori, keterangan)
supplier (id*, kode_supplier, nama_supplier, kontak_person, telepon, email, alamat)

barang (id*, kode_barang, nama_barang, kategori_id**, supplier_id**, merek,
        spesifikasi, jumlah, satuan, lokasi_penyimpanan, kondisi_barang,
        tanggal_masuk, harga_satuan, total_nilai_aset, pic, keterangan,
        stok_minimum, barcode_path)
   FK kategori_id  -> kategori.id
   FK supplier_id  -> supplier.id

barang_masuk (id*, no_transaksi, barang_id**, supplier_id**, jumlah, tanggal,
              harga_satuan, keterangan, user_id**)
   FK barang_id   -> barang.id
   FK supplier_id -> supplier.id
   FK user_id     -> users.id

barang_keluar (id*, no_transaksi, barang_id**, jumlah, tanggal,
               tujuan_penggunaan, keterangan, user_id**)
   FK barang_id -> barang.id
   FK user_id   -> users.id

mutasi_barang (id*, no_transaksi, barang_id**, jumlah, lokasi_asal, lokasi_tujuan,
               pic_asal, pic_tujuan, tanggal, keterangan, user_id**)
   FK barang_id -> barang.id
   FK user_id   -> users.id

peminjaman (id*, no_transaksi, barang_id**, peminjam_id**, jumlah, tanggal_pinjam,
            tanggal_rencana_kembali, status, keterangan, user_id**)
   FK barang_id    -> barang.id
   FK peminjam_id  -> users.id
   FK user_id      -> users.id

pengembalian (id*, no_transaksi, peminjaman_id**, tanggal_kembali,
              kondisi_saat_kembali, keterangan, user_id**)
   FK peminjaman_id -> peminjaman.id (unique)
   FK user_id       -> users.id
```
`*` = Primary Key, `**` = Foreign Key

---

## 5. Business Rule Konsistensi Stok
a. `barang.jumlah` adalah **nilai hasil kalkulasi**, bukan diinput manual saat edit barang. Nilai ini di-update oleh:
   - `+jumlah` saat transaksi `barang_masuk` disimpan.
   - `-jumlah` saat transaksi `barang_keluar` disimpan.
   - `-jumlah` saat `peminjaman` berstatus "dipinjam" dibuat (stok tersedia berkurang sementara), `+jumlah` saat `pengembalian` dicatat.
b. `barang.total_nilai_aset` dihitung ulang otomatis setiap `barang.jumlah` atau `barang.harga_satuan` berubah: `total_nilai_aset = jumlah * harga_satuan`.
c. Validasi: `barang_keluar.jumlah` dan `peminjaman.jumlah` tidak boleh melebihi `barang.jumlah` yang tersedia saat itu (dicek di `BarangService`).
d. Field `status` pada `peminjaman` diubah otomatis menjadi `terlambat` oleh scheduled job/cron harian jika `tanggal_rencana_kembali` < hari ini dan belum ada `pengembalian`.

## 6. Migration Order (urutan pembuatan tabel Laravel)
1. `users` (bawaan Laravel, tambah kolom role, foto, status)
2. `kategori`
3. `supplier`
4. `barang` (FK ke kategori, supplier)
5. `barang_masuk` (FK ke barang, supplier, users)
6. `barang_keluar` (FK ke barang, users)
7. `mutasi_barang` (FK ke barang, users)
8. `peminjaman` (FK ke barang, users x2)
9. `pengembalian` (FK ke peminjaman, users)
