<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard utama.
     */
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // 7 Kartu Statistik
        $totalBarang = Barang::sum('jumlah');
        $totalKategori = Kategori::count();
        $totalSupplier = Supplier::count();
        $barangMasukBulanIni = BarangMasuk::whereMonth('tanggal', $currentMonth)
            ->whereYear('tanggal', $currentYear)
            ->sum('jumlah') ?? 0;
        $barangKeluarBulanIni = BarangKeluar::whereMonth('tanggal', $currentMonth)
            ->whereYear('tanggal', $currentYear)
            ->sum('jumlah') ?? 0;
        $barangDipinjam = Peminjaman::where('status', 'dipinjam')->sum('jumlah') ?? 0;
        $barangRusak = Barang::where('kondisi_barang', '!=', 'baik')->sum('jumlah') ?? 0;

        // Notifikasi Stok Minimum (stok <= stok_minimum)
        $stokMinimum = Barang::with('kategori')
            ->whereColumn('jumlah', '<=', 'stok_minimum')
            ->orderByRaw('(stok_minimum - jumlah) DESC')
            ->get();

        // Grafik Stok Barang per Kategori
        $kategoriStok = Kategori::withSum('barang as total_stok', 'jumlah')->get();
        $categoriesLabels = $kategoriStok->pluck('nama_kategori')->toArray();
        $categoriesStokData = $kategoriStok->pluck('total_stok')->map(function($val) {
            return $val ?? 0;
        })->toArray();

        // Grafik Barang Masuk vs Keluar per bulan (12 bulan terakhir)
        $monthsLabels = [];
        $masukData = [];
        $keluarData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;

            $monthsLabels[] = $date->translatedFormat('F Y');

            $masukData[] = BarangMasuk::whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->sum('jumlah') ?? 0;

            $keluarData[] = BarangKeluar::whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->sum('jumlah') ?? 0;
        }

        return view('dashboard.index', compact(
            'totalBarang',
            'totalKategori',
            'totalSupplier',
            'barangMasukBulanIni',
            'barangKeluarBulanIni',
            'barangDipinjam',
            'barangRusak',
            'stokMinimum',
            'categoriesLabels',
            'categoriesStokData',
            'monthsLabels',
            'masukData',
            'keluarData'
        ));
    }
}
