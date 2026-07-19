# AI AGENT RULES — Proyek SI Inventori Kantor (Laravel)

> Taruh file ini sebagai `CLAUDE.md` / `RULES.md` di root project Laravel supaya AI coding agent (Claude Code, Antigravity, dll) konsisten mengikuti spesifikasi proyek ini.

## Konteks Proyek
Proyek skripsi: **Pengembangan Sistem Informasi Inventori Kantor Berbasis Web Menggunakan Metode RAD**.
Dokumen acuan wajib dibaca sebelum coding modul apapun:
- `01-PRD.md` — kebutuhan fungsional & nonfungsional
- `02-DEVELOPMENT-RULES.md` — konvensi teknis
- `03-DATABASE-ERD.md` — struktur tabel & relasi (SUMBER KEBENARAN untuk migration)
- `04-MODULE-SPEC.md` — logika bisnis tiap modul (SUMBER KEBENARAN untuk controller/service)
- `05-UI-UX-SPEC.md` — struktur halaman & komponen (SUMBER KEBENARAN untuk Blade view)
- `06-TESTING-PLAN.md` — skenario pengujian setelah fitur selesai

## Stack Wajib
Laravel 10/11, PHP 8.2+, MySQL 8, Laragon (bukan XAMPP), Bootstrap 5, Chart.js, `barryvdh/laravel-dompdf`, `maatwebsite/excel`, `simplesoftwareio/simple-qrcode`.

## Aturan Kerja AI Agent
1. **Jangan mengubah struktur tabel** yang sudah didefinisikan di `03-DATABASE-ERD.md` tanpa konfirmasi eksplisit dari user — ERD ini yang dipakai di BAB III skripsi, perubahan struktur harus sinkron dengan dokumen.
2. **Ikuti penamaan Bahasa Indonesia** untuk tabel, kolom, dan label UI sesuai dokumen (`barang`, `kategori`, `supplier`, dst) — jangan diterjemahkan ke Inggris.
3. Setiap membuat modul baru, urutan kerja:
   a. Migration sesuai `03-DATABASE-ERD.md`.
   b. Model + relasi Eloquent.
   c. Form Request untuk validasi.
   d. Service class untuk logika bisnis (terutama update stok).
   e. Controller (thin, delegasikan ke Service).
   f. Route + Middleware role.
   g. Blade view sesuai `05-UI-UX-SPEC.md`.
4. **Transaksi stok wajib pakai `DB::transaction()`** — lihat aturan di `02-DEVELOPMENT-RULES.md` §4.d.
5. Setelah membuat/mengubah fitur, sertakan ringkasan singkat: file apa saja yang dibuat/diubah, dan apakah ada penyesuaian dari spesifikasi asli (jika ada, sebutkan alasannya).
6. Jangan menambahkan modul/menu di luar 13 menu yang didefinisikan di `01-PRD.md` §8 kecuali diminta eksplisit oleh user.
7. Semua output kode harus bisa langsung dijalankan di Laragon (path, `.env`, virtual host `*.test`) — jangan asumsikan XAMPP.
8. Jika ada bagian spesifikasi yang ambigu atau kurang jelas, tanyakan ke user alih-alih menebak, khususnya untuk BAB III/BAB IV yang harus akurat dengan implementasi nyata.
9. Untuk kebutuhan seeder/dummy data testing, jelaskan secara eksplisit ke user bahwa data tersebut adalah **data uji pengembangan**, bukan data untuk dilaporkan sebagai hasil riset/survei di skripsi.

## Definition of Done per Modul
Sebuah modul dianggap selesai jika:
- [ ] Migration & model sudah sesuai ERD
- [ ] CRUD berjalan sesuai hak akses role (lihat matriks `04-MODULE-SPEC.md` §0)
- [ ] Validasi input sudah sesuai aturan bisnis
- [ ] View sudah sesuai `05-UI-UX-SPEC.md` dan konsisten dengan layout master
- [ ] Minimal skenario Black Box relevan dari `06-TESTING-PLAN.md` sudah dicoba manual
