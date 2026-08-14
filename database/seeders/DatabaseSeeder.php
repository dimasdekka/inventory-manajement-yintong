<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\GolonganBarang;
use App\Models\Supplier;
use App\Models\Barang;
use App\Services\BarcodeService;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $barcodeService = app(BarcodeService::class);

        // 1. Seed Users (Revisi: Admin utama adalah Nurul Faoziah)
        User::create([
            'nama' => 'Nurul Faoziah',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'administrator',
            'status' => 'aktif',
        ]);

        User::create([
            'nama' => 'Nurul Faoziah (Akun Personal)',
            'email' => 'nurul@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'administrator',
            'status' => 'aktif',
        ]);

        User::create([
            'nama' => 'Staff Gudang Rani',
            'email' => 'staff@staff.com',
            'password' => Hash::make('staff123'),
            'role' => 'staff_gudang',
            'status' => 'aktif',
        ]);

        User::create([
            'nama' => 'Pak Pimpinan Hermawan',
            'email' => 'pimpinan@pimpinan.com',
            'password' => Hash::make('pimpinan123'),
            'role' => 'pimpinan',
            'status' => 'aktif',
        ]);

        User::create([
            'nama' => 'User Non-Aktif',
            'email' => 'nonaktif@test.com',
            'password' => Hash::make('test1234'),
            'role' => 'staff_gudang',
            'status' => 'nonaktif',
        ]);

        // 2. Seed Kategori
        $atk = Kategori::create([
            'kode_kategori' => 'KTG-001',
            'nama_kategori' => 'ATK',
            'keterangan' => 'Alat Tulis Kantor',
        ]);

        $kendaraan = Kategori::create([
            'kode_kategori' => 'KTG-002',
            'nama_kategori' => 'Kendaraan Operasional',
            'keterangan' => 'Mobil & Sepeda Motor Inventaris Kantor',
        ]);

        $mess = Kategori::create([
            'kode_kategori' => 'KTG-003',
            'nama_kategori' => 'Mess Karyawan',
            'keterangan' => 'Peralatan & Perlengkapan di Mess Karyawan',
        ]);

        $perkakas = Kategori::create([
            'kode_kategori' => 'KTG-004',
            'nama_kategori' => 'Peralatan Kerja',
            'keterangan' => 'Obeng, Tang, Tangga, dan Alat Perkakas Lainnya',
        ]);

        $elektronik = Kategori::create([
            'kode_kategori' => 'KTG-005',
            'nama_kategori' => 'Elektronik',
            'keterangan' => 'Laptop, Printer, AC, Proyektor, dll',
        ]);

        // 2.1 Seed Golongan / Jenis Barang per Kategori (Mapping Kode Standar)
        // ATK
        $golBuku = GolonganBarang::create([
            'kategori_id' => $atk->id,
            'kode_golongan' => 'BKU',
            'nama_golongan' => 'Buku & Agenda Catatan',
            'keterangan' => 'Buku folio, buku tulis, agenda kerja, memo kantor',
        ]);

        $golPulpen = GolonganBarang::create([
            'kategori_id' => $atk->id,
            'kode_golongan' => 'PLP',
            'nama_golongan' => 'Pulpen & Alat Tulis',
            'keterangan' => 'Pulpen gel, pensil, spidol whiteboard, correction tape',
        ]);

        $golKertas = GolonganBarang::create([
            'kategori_id' => $atk->id,
            'kode_golongan' => 'KTS',
            'nama_golongan' => 'Kertas & Form',
            'keterangan' => 'Kertas HVS A4/F4, continuous form, amplop surat',
        ]);

        $golMap = GolonganBarang::create([
            'kategori_id' => $atk->id,
            'kode_golongan' => 'MAP',
            'nama_golongan' => 'Map & Ordner Arsip',
            'keterangan' => 'Map snelhecter, ordner binder, dokumen sleeve',
        ]);

        // Elektronik
        $golLaptop = GolonganBarang::create([
            'kategori_id' => $elektronik->id,
            'kode_golongan' => 'LPT',
            'nama_golongan' => 'Laptop & Notebook',
            'keterangan' => 'Laptop inventaris karyawan dan staff',
        ]);

        $golAC = GolonganBarang::create([
            'kategori_id' => $elektronik->id,
            'kode_golongan' => 'AC',
            'nama_golongan' => 'Air Conditioner & Pendingin',
            'keterangan' => 'AC split ruangan kantor dan ruang rapat',
        ]);

        $golPrinter = GolonganBarang::create([
            'kategori_id' => $elektronik->id,
            'kode_golongan' => 'PRN',
            'nama_golongan' => 'Printer & Scanner',
            'keterangan' => 'Printer multifungsi dan alat pemindai dokumen',
        ]);

        $golProyektor = GolonganBarang::create([
            'kategori_id' => $elektronik->id,
            'kode_golongan' => 'PRJ',
            'nama_golongan' => 'Proyektor & Presentasi',
            'keterangan' => 'Proyektor ruang meeting dan layar proyektor',
        ]);

        // Kendaraan
        $golMotor = GolonganBarang::create([
            'kategori_id' => $kendaraan->id,
            'kode_golongan' => 'MTR',
            'nama_golongan' => 'Sepeda Motor Dinas',
            'keterangan' => 'Sepeda motor kurir dan operasional lapangan',
        ]);

        $golMobil = GolonganBarang::create([
            'kategori_id' => $kendaraan->id,
            'kode_golongan' => 'MBL',
            'nama_golongan' => 'Mobil Operasional',
            'keterangan' => 'Mobil inventaris pimpinan dan divisi kantor',
        ]);

        // Peralatan Kerja
        $golPerkakas = GolonganBarang::create([
            'kategori_id' => $perkakas->id,
            'kode_golongan' => 'TNG',
            'nama_golongan' => 'Perkakas Tangan & Toolset',
            'keterangan' => 'Obeng set, tang, kunci pas, bor tangan listrik',
        ]);

        $golSafety = GolonganBarang::create([
            'kategori_id' => $perkakas->id,
            'kode_golongan' => 'SFT',
            'nama_golongan' => 'Perlengkapan K3 & Safety',
            'keterangan' => 'Helm proyek, rompi, sepatu safety, sarung tangan',
        ]);

        // Mess Karyawan
        $golKasur = GolonganBarang::create([
            'kategori_id' => $mess->id,
            'kode_golongan' => 'KSR',
            'nama_golongan' => 'Kasur & Tempat Tidur',
            'keterangan' => 'Tempat tidur mess, kasur busa, sprei bantal',
        ]);

        $golLemari = GolonganBarang::create([
            'kategori_id' => $mess->id,
            'kode_golongan' => 'LMR',
            'nama_golongan' => 'Lemari & Locker Mess',
            'keterangan' => 'Lemari pakaian 2 pintu dan loker personal',
        ]);

        // 3. Seed Supplier
        $spl1 = Supplier::create([
            'kode_supplier' => 'SPL-001',
            'nama_supplier' => 'PT. Gramedia Asri Media',
            'kontak_person' => 'Budi Santoso',
            'telepon' => '021-567890',
            'email' => 'sales@gramedia.com',
            'alamat' => 'Jl. Palmerah Barat No. 29, Jakarta Barat',
        ]);

        $spl2 = Supplier::create([
            'kode_supplier' => 'SPL-002',
            'nama_supplier' => 'PT. Astra International',
            'kontak_person' => 'Agus Wijaya',
            'telepon' => '021-654321',
            'email' => 'info@astra.co.id',
            'alamat' => 'Jl. Gaya Motor Raya No. 8, Jakarta Utara',
        ]);

        $spl3 = Supplier::create([
            'kode_supplier' => 'SPL-003',
            'nama_supplier' => 'CV. Perkakas Jaya',
            'kontak_person' => 'Joko Susilo',
            'telepon' => '031-778899',
            'email' => 'sales@perkakasjaya.com',
            'alamat' => 'Jl. Margomulyo No. 4, Surabaya',
        ]);

        $spl4 = Supplier::create([
            'kode_supplier' => 'SPL-004',
            'nama_supplier' => 'PT. Elektronik Sentral',
            'kontak_person' => 'Merry Anastasia',
            'telepon' => '021-334455',
            'email' => 'cs@elektroniksentral.com',
            'alamat' => 'Mangga Dua Mall Lt. 3, Jakarta Pusat',
        ]);

        // 4. Seed Barang dengan Kode Hierarkis [KAT]-[GOL]-[YYYYMM]-XXXX & Barcode/QR Code Masing-Masing
        $kodeBarang1 = 'ATK-KTS-202607-0001';
        $qr1 = $barcodeService->generateQRCode($kodeBarang1);
        Barang::create([
            'kode_barang' => $kodeBarang1,
            'nama_barang' => 'Kertas HVS A4 80gr Sinar Dunia',
            'kategori_id' => $atk->id,
            'golongan_id' => $golKertas->id,
            'supplier_id' => $spl1->id,
            'merek' => 'Sinar Dunia',
            'spesifikasi' => 'Ukuran A4, ketebalan 80 gram, isi 500 lembar per rim.',
            'jumlah' => 50,
            'satuan' => 'rim',
            'lokasi_penyimpanan' => 'Gudang Utama - Rak A1',
            'kondisi_barang' => 'baik',
            'tanggal_masuk' => '2026-07-10',
            'harga_satuan' => 55000.00,
            'total_nilai_aset' => 50 * 55000.00,
            'pic' => 'Rian Hidayat',
            'keterangan' => 'Persediaan rutin untuk operasional administrasi.',
            'stok_minimum' => 10,
            'barcode_path' => $qr1,
        ]);

        $kodeBarang2 = 'ATK-BKU-202607-0001';
        $qr2 = $barcodeService->generateQRCode($kodeBarang2);
        Barang::create([
            'kode_barang' => $kodeBarang2,
            'nama_barang' => 'Buku Agenda Hardcover Eksekutif',
            'kategori_id' => $atk->id,
            'golongan_id' => $golBuku->id,
            'supplier_id' => $spl1->id,
            'merek' => 'PaperOne',
            'spesifikasi' => 'Ukuran B5, 200 halaman bergaris, cover kulit sintetis.',
            'jumlah' => 25,
            'satuan' => 'buah',
            'lokasi_penyimpanan' => 'Gudang Utama - Rak A2',
            'kondisi_barang' => 'baik',
            'tanggal_masuk' => '2026-07-12',
            'harga_satuan' => 45000.00,
            'total_nilai_aset' => 25 * 45000.00,
            'pic' => 'Rian Hidayat',
            'keterangan' => 'Buku catatan resmi untuk staff divisi.',
            'stok_minimum' => 5,
            'barcode_path' => $qr2,
        ]);

        $kodeBarang3 = 'ATK-PLP-202607-0001';
        $qr3 = $barcodeService->generateQRCode($kodeBarang3);
        Barang::create([
            'kode_barang' => $kodeBarang3,
            'nama_barang' => 'Pulpen Gel Pilot G-2 0.5 Black',
            'kategori_id' => $atk->id,
            'golongan_id' => $golPulpen->id,
            'supplier_id' => $spl1->id,
            'merek' => 'Pilot',
            'spesifikasi' => 'Tinta gel hitam 0.5mm, box isi 12 pcs.',
            'jumlah' => 30,
            'satuan' => 'box',
            'lokasi_penyimpanan' => 'Gudang Utama - Rak A1',
            'kondisi_barang' => 'baik',
            'tanggal_masuk' => '2026-07-12',
            'harga_satuan' => 120000.00,
            'total_nilai_aset' => 30 * 120000.00,
            'pic' => 'Rian Hidayat',
            'keterangan' => 'Alat tulis pulpen kantor.',
            'stok_minimum' => 5,
            'barcode_path' => $qr3,
        ]);

        $kodeBarang4 = 'KND-MTR-202607-0001';
        $qr4 = $barcodeService->generateQRCode($kodeBarang4);
        Barang::create([
            'kode_barang' => $kodeBarang4,
            'nama_barang' => 'Sepeda Motor Honda Vario 160cc',
            'kategori_id' => $kendaraan->id,
            'golongan_id' => $golMotor->id,
            'supplier_id' => $spl2->id,
            'merek' => 'Honda',
            'spesifikasi' => 'Honda Vario 160 CBS, warna hitam, plat nomor B 1234 ABC.',
            'jumlah' => 2,
            'satuan' => 'unit',
            'lokasi_penyimpanan' => 'Parkiran Dalam Kantor',
            'kondisi_barang' => 'baik',
            'tanggal_masuk' => '2026-07-05',
            'harga_satuan' => 26500000.00,
            'total_nilai_aset' => 2 * 26500000.00,
            'pic' => 'Ahmad Kurdi',
            'keterangan' => 'Digunakan oleh divisi kurir dan umum.',
            'stok_minimum' => 1,
            'barcode_path' => $qr4,
        ]);

        $kodeBarang5 = 'ELK-AC-202607-0001';
        $qr5 = $barcodeService->generateQRCode($kodeBarang5);
        Barang::create([
            'kode_barang' => $kodeBarang5,
            'nama_barang' => 'Air Conditioner Sharp 1 PK',
            'kategori_id' => $elektronik->id,
            'golongan_id' => $golAC->id,
            'supplier_id' => $spl4->id,
            'merek' => 'Sharp',
            'spesifikasi' => 'Sharp Split AH-A9UCY 1 PK Standard Turbo Cool.',
            'jumlah' => 4,
            'satuan' => 'unit',
            'lokasi_penyimpanan' => 'Ruang Rapat Utama (2) & Ruang Kerja (2)',
            'kondisi_barang' => 'baik',
            'tanggal_masuk' => '2026-07-08',
            'harga_satuan' => 3200000.00,
            'total_nilai_aset' => 4 * 3200000.00,
            'pic' => 'Doni Irawan',
            'keterangan' => 'Pemeliharaan AC dilakukan berkala setiap 3 bulan.',
            'stok_minimum' => 1,
            'barcode_path' => $qr5,
        ]);

        $kodeBarang6 = 'ELK-LPT-202607-0001';
        $qr6 = $barcodeService->generateQRCode($kodeBarang6);
        Barang::create([
            'kode_barang' => $kodeBarang6,
            'nama_barang' => 'Laptop ASUS Vivobook 14',
            'kategori_id' => $elektronik->id,
            'golongan_id' => $golLaptop->id,
            'supplier_id' => $spl4->id,
            'merek' => 'ASUS',
            'spesifikasi' => 'Core i5 Gen 12, RAM 8GB, SSD 512GB, Windows 11 Home.',
            'jumlah' => 5,
            'satuan' => 'unit',
            'lokasi_penyimpanan' => 'Ruang Kerja IT',
            'kondisi_barang' => 'baik',
            'tanggal_masuk' => '2026-07-01',
            'harga_satuan' => 9500000.00,
            'total_nilai_aset' => 5 * 9500000.00,
            'pic' => 'Hendra Saputra',
            'keterangan' => 'Aset inventaris untuk staff operasional baru.',
            'stok_minimum' => 2,
            'barcode_path' => $qr6,
        ]);
    }
}
