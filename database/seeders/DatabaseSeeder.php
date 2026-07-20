<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        User::create([
            'nama' => 'Dimas Admin',
            'email' => 'admin@admin.com',
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

        // 4. Seed Barang
        Barang::create([
            'kode_barang' => 'BRG-202607-0001',
            'nama_barang' => 'Kertas HVS A4 80gr Sinar Dunia',
            'kategori_id' => $atk->id,
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
        ]);

        Barang::create([
            'kode_barang' => 'BRG-202607-0002',
            'nama_barang' => 'Sepeda Motor Honda Vario 160cc',
            'kategori_id' => $kendaraan->id,
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
        ]);

        Barang::create([
            'kode_barang' => 'BRG-202607-0003',
            'nama_barang' => 'Air Conditioner Sharp 1 PK',
            'kategori_id' => $elektronik->id,
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
        ]);

        Barang::create([
            'kode_barang' => 'BRG-202607-0004',
            'nama_barang' => 'Laptop ASUS Vivobook 14',
            'kategori_id' => $elektronik->id,
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
        ]);
    }
}
