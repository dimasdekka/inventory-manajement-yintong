<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MutasiBarang;
use App\Http\Requests\StoreMutasiRequest;
use App\Services\BarangService;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    /**
     * Tampilkan riwayat mutasi barang.
     */
    public function index(Request $request)
    {
        $query = MutasiBarang::with(['barang.kategori', 'user']);

        // Filter Tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->input('tanggal_mulai'), $request->input('tanggal_selesai')]);
        }

        // Filter Barang
        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->input('barang_id'));
        }

        $mutasi = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $barang = Barang::all();

        return view('mutasi.index', compact('mutasi', 'barang'));
    }

    /**
     * Tampilkan form mutasi barang.
     */
    public function create()
    {
        $barang = Barang::all();
        return view('mutasi.create', compact('barang'));
    }

    /**
     * Simpan transaksi mutasi barang.
     */
    public function store(StoreMutasiRequest $request)
    {
        try {
            $this->barangService->tambahMutasi(
                $request->validated(), 
                auth()->id()
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('mutasi.index')->with('success', 'Transaksi Mutasi Barang berhasil dicatat. Lokasi dan PIC barang telah diperbarui.');
    }
}
