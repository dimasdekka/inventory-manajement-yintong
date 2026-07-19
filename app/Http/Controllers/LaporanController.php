<?php

namespace App\Http\Controllers;

use App\Services\LaporanService;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

    /**
     * Tampilkan halaman filter laporan.
     */
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $lokasi = Barang::select('lokasi_penyimpanan')
            ->distinct()
            ->pluck('lokasi_penyimpanan');

        $data = collect();
        $filters = $request->all();

        // Tampilkan preview jika tombol "Tampilkan" atau "Cari" diklik
        if ($request->filled('jenis_laporan')) {
            $data = $this->laporanService->getData($filters);
        }

        return view('laporan.index', compact('kategori', 'lokasi', 'data', 'filters'));
    }

    /**
     * Ekspor laporan ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $filters = $request->all();
        $data = $this->laporanService->getData($filters);
        $jenisLaporan = $request->input('jenis_laporan', 'stok');

        $pdf = $this->laporanService->generatePdf($jenisLaporan, $data, $filters);
        $fileName = 'laporan_' . $jenisLaporan . '_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Ekspor laporan ke Excel.
     */
    public function exportExcel(Request $request)
    {
        $filters = $request->all();
        $data = $this->laporanService->getData($filters);
        $jenisLaporan = $request->input('jenis_laporan', 'stok');

        return $this->laporanService->exportExcel($jenisLaporan, $data);
    }
}
