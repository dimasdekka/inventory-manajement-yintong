<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\MutasiBarang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BarangService
{
    /**
     * Generate Kode Barang otomatis.
     * Format: BRG-YYYYMM-0001
     */
    public static function generateKodeBarang(): string
    {
        $prefix = 'BRG-' . now()->format('Ym') . '-';
        
        $lastBarang = Barang::where('kode_barang', 'like', $prefix . '%')
            ->orderBy('kode_barang', 'desc')
            ->first();

        if ($lastBarang) {
            $lastNumber = intval(substr($lastBarang->kode_barang, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $newNumber;
    }

    /**
     * Generate No Transaksi otomatis.
     * Format: [PREFIX]-YYYYMMDD-0001
     */
    public static function generateNoTransaksi(string $prefix, string $table): string
    {
        $dateStr = now()->format('Ymd');
        $fullPrefix = $prefix . '-' . $dateStr . '-';

        $lastRecord = DB::table($table)
            ->where('no_transaksi', 'like', $fullPrefix . '%')
            ->orderBy('no_transaksi', 'desc')
            ->first();

        if ($lastRecord) {
            $lastNumber = intval(substr($lastRecord->no_transaksi, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $fullPrefix . $newNumber;
    }

    /**
     * Transaksi Barang Masuk.
     */
    public function tambahBarangMasuk(array $data, int $userId): BarangMasuk
    {
        return DB::transaction(function () use ($data, $userId) {
            $barang = Barang::findOrFail($data['barang_id']);

            $noTransaksi = self::generateNoTransaksi('IN', 'barang_masuk');

            // Tambahkan record barang masuk
            $barangMasuk = BarangMasuk::create([
                'no_transaksi' => $noTransaksi,
                'barang_id' => $data['barang_id'],
                'supplier_id' => $data['supplier_id'],
                'jumlah' => $data['jumlah'],
                'tanggal' => $data['tanggal'],
                'harga_satuan' => $data['harga_satuan'],
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $userId,
            ]);

            // Update stok barang dan total aset
            // Gunakan harga_satuan terbaru dari barang masuk
            $barang->jumlah += $data['jumlah'];
            $barang->harga_satuan = $data['harga_satuan'];
            $barang->total_nilai_aset = $barang->jumlah * $barang->harga_satuan;
            $barang->save();

            return $barangMasuk;
        });
    }

    /**
     * Transaksi Barang Keluar.
     */
    public function tambahBarangKeluar(array $data, int $userId): BarangKeluar
    {
        return DB::transaction(function () use ($data, $userId) {
            $barang = Barang::findOrFail($data['barang_id']);

            // Validasi stok mencukupi
            if ($barang->jumlah < $data['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Stok tidak mencukupi. Stok saat ini: ' . $barang->jumlah . ' ' . $barang->satuan,
                ]);
            }

            $noTransaksi = self::generateNoTransaksi('OUT', 'barang_keluar');

            // Tambahkan record barang keluar
            $barangKeluar = BarangKeluar::create([
                'no_transaksi' => $noTransaksi,
                'barang_id' => $data['barang_id'],
                'jumlah' => $data['jumlah'],
                'tanggal' => $data['tanggal'],
                'tujuan_penggunaan' => $data['tujuan_penggunaan'] ?? null,
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $userId,
            ]);

            // Update stok barang
            $barang->jumlah -= $data['jumlah'];
            $barang->total_nilai_aset = $barang->jumlah * $barang->harga_satuan;
            $barang->save();

            return $barangKeluar;
        });
    }

    /**
     * Transaksi Mutasi Barang.
     */
    public function tambahMutasi(array $data, int $userId): MutasiBarang
    {
        return DB::transaction(function () use ($data, $userId) {
            $barang = Barang::findOrFail($data['barang_id']);

            // Validasi stok mencukupi untuk dimutasi
            if ($barang->jumlah < $data['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah barang yang dimutasi melebihi stok yang tersedia. Stok saat ini: ' . $barang->jumlah,
                ]);
            }

            $noTransaksi = self::generateNoTransaksi('MUT', 'mutasi_barang');

            // Tambahkan record mutasi
            $mutasi = MutasiBarang::create([
                'no_transaksi' => $noTransaksi,
                'barang_id' => $data['barang_id'],
                'jumlah' => $data['jumlah'],
                'lokasi_asal' => $barang->lokasi_penyimpanan,
                'lokasi_tujuan' => $data['lokasi_tujuan'],
                'pic_asal' => $barang->pic,
                'pic_tujuan' => $data['pic_tujuan'],
                'tanggal' => $data['tanggal'],
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $userId,
            ]);

            // Update lokasi & PIC di master barang
            $barang->lokasi_penyimpanan = $data['lokasi_tujuan'];
            $barang->pic = $data['pic_tujuan'];
            $barang->save();

            return $mutasi;
        });
    }

    /**
     * Transaksi Peminjaman Barang.
     */
    public function tambahPeminjaman(array $data, int $userId): Peminjaman
    {
        return DB::transaction(function () use ($data, $userId) {
            $barang = Barang::findOrFail($data['barang_id']);

            // Validasi stok mencukupi
            if ($barang->jumlah < $data['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Stok tidak mencukupi untuk dipinjam. Stok saat ini: ' . $barang->jumlah,
                ]);
            }

            $noTransaksi = self::generateNoTransaksi('PJM', 'peminjaman');

            // Tambahkan record peminjaman
            $peminjaman = Peminjaman::create([
                'no_transaksi' => $noTransaksi,
                'barang_id' => $data['barang_id'],
                'peminjam_id' => $data['peminjam_id'],
                'jumlah' => $data['jumlah'],
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'tanggal_rencana_kembali' => $data['tanggal_rencana_kembali'],
                'status' => 'dipinjam',
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $userId,
            ]);

            // Kurangi stok barang
            $barang->jumlah -= $data['jumlah'];
            $barang->total_nilai_aset = $barang->jumlah * $barang->harga_satuan;
            $barang->save();

            return $peminjaman;
        });
    }

    /**
     * Transaksi Pengembalian Barang.
     */
    public function tambahPengembalian(array $data, int $userId): Pengembalian
    {
        return DB::transaction(function () use ($data, $userId) {
            $peminjaman = Peminjaman::findOrFail($data['peminjaman_id']);

            if ($peminjaman->status === 'dikembalikan') {
                throw ValidationException::withMessages([
                    'peminjaman_id' => 'Transaksi peminjaman ini sudah dikembalikan sebelumnya.',
                ]);
            }

            $barang = Barang::findOrFail($peminjaman->barang_id);
            $noTransaksi = self::generateNoTransaksi('KBL', 'pengembalian');

            // Tambahkan record pengembalian
            $pengembalian = Pengembalian::create([
                'no_transaksi' => $noTransaksi,
                'peminjaman_id' => $data['peminjaman_id'],
                'tanggal_kembali' => $data['tanggal_kembali'],
                'kondisi_saat_kembali' => $data['kondisi_saat_kembali'],
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $userId,
            ]);

            // Update status peminjaman
            $peminjaman->status = 'dikembalikan';
            $peminjaman->save();

            // Kembalikan stok barang
            $barang->jumlah += $peminjaman->jumlah;

            // Jika kondisi barang rusak, perbarui status kondisi barang master ke kondisi terburuk
            if ($data['kondisi_saat_kembali'] === 'rusak_berat') {
                $barang->kondisi_barang = 'rusak_berat';
            } elseif ($data['kondisi_saat_kembali'] === 'rusak_ringan' && $barang->kondisi_barang !== 'rusak_berat') {
                $barang->kondisi_barang = 'rusak_ringan';
            }

            $barang->total_nilai_aset = $barang->jumlah * $barang->harga_satuan;
            $barang->save();

            return $pengembalian;
        });
    }
}
