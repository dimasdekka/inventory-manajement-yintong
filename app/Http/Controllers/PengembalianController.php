<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Services\BarangService;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    /**
     * Simpan transaksi pengembalian.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam_raw',
            'kondisi_saat_kembali' => 'required|in:baik,rusak_ringan,rusak_berat',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $this->barangService->tambahPengembalian(
                $data,
                auth()->id()
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil dikembalikan. Stok barang telah terupdate.');
    }
}
