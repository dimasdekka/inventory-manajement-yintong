# INDEX DOKUMEN PROYEK
## Sistem Informasi Inventori Kantor Berbasis Web (Metode RAD)

Dokumen ini adalah pintu masuk untuk seluruh paket dokumentasi proyek skripsi:

**Pengembangan Sistem Informasi Inventori Kantor Berbasis Web Menggunakan Metode Rapid Application Development (RAD)**

## Daftar Dokumen

| No | File | Isi | Dipakai untuk |
|----|------|-----|----------------|
| 1 | `01-PRD.md` | Product Requirements Document: tujuan, ruang lingkup, modul, kebutuhan fungsional & nonfungsional, hak akses | BAB I & BAB III (Analisis Kebutuhan) |
| 2 | `02-DEVELOPMENT-RULES.md` | Aturan coding, struktur folder Laravel, konvensi penamaan, alur Git | Panduan implementasi teknis, tidak masuk skripsi langsung |
| 3 | `03-DATABASE-ERD.md` | ERD, struktur tabel lengkap, relasi antar tabel, LRS | BAB III (Perancangan Basis Data) |
| 4 | `04-MODULE-SPEC.md` | Fungsi setiap menu, alur proses (activity), aturan validasi, hak akses per fitur | BAB III (Perancangan Sistem) & BAB IV (Implementasi) |
| 5 | `05-UI-UX-SPEC.md` | Rancangan antarmuka tiap halaman, komponen, wireframe deskriptif | BAB III (Perancangan Antarmuka) |
| 6 | `06-TESTING-PLAN.md` | Skenario Black Box Testing & UAT, tabel pengujian | BAB IV (Implementasi dan Pengujian) |
| 7 | `07-AI-AGENT-SKILL.md` | Instruksi ringkas untuk AI coding agent (Claude Code/Antigravity) saat generate kode proyek ini | Dipakai sebagai `RULES.md`/system context saat coding, bukan untuk skripsi |

## Cara Pakai
1. Baca `01-PRD.md` dulu untuk gambaran umum sistem.
2. Gunakan `03-DATABASE-ERD.md` untuk bikin migration Laravel.
3. Gunakan `04-MODULE-SPEC.md` sebagai acuan bikin Controller, Model, dan business logic tiap modul.
4. Gunakan `05-UI-UX-SPEC.md` sebagai acuan bikin Blade View / komponen.
5. `07-AI-AGENT-SKILL.md` bisa langsung ditaruh sebagai file `CLAUDE.md`/`RULES.md` di root project Laravel supaya AI agent konsisten saat generate kode.
6. `06-TESTING-PLAN.md` dipakai setelah aplikasi jadi, untuk BAB IV.

## Catatan Penting Penyesuaian dari Dokumen Kebutuhan Awal
Beberapa entitas pada bagian "Data yang Dikelola" di dokumen kebutuhan (Kendaraan Operasional, Mess Karyawan, Ruko/Kantor, ATK, Peralatan Kerja, Aset Perusahaan Lainnya) **tidak** dijadikan modul/menu terpisah, karena daftar 13 menu utama tidak mencantumkannya secara eksplisit. Entitas-entitas tersebut diperlakukan sebagai **jenis/kategori aset** di dalam modul **Data Kategori** dan **Data Barang**, dengan field `kategori` yang bisa diisi salah satu dari jenis tersebut. Ini konsisten dengan prinsip RAD (fokus ke modul inti dulu) dan tetap memenuhi seluruh cakupan data yang diminta tanpa menambah menu di luar spesifikasi. Keputusan ini didokumentasikan di `01-PRD.md` bagian Ruang Lingkup agar bisa dijelaskan di BAB III (batasan sistem).
