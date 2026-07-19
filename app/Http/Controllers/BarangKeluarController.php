<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Http\Requests\StoreBarangKeluarRequest;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    /**
     * Tampilkan riwayat barang keluar.
     */
    public function index(Request $request)
    {
        $query = BarangKeluar::with(['barang.kategori', 'user']);

        // Filter Tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->input('tanggal_mulai'), $request->input('tanggal_selesai')]);
        }

        // Filter Barang
        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->input('barang_id'));
        }

        $barangKeluar = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $barang = Barang::all();

        return view('barang-keluar.index', compact('barangKeluar', 'barang'));
    }

    /**
     * Tampilkan form transaksi barang keluar.
     */
    public function create()
    {
        $barang = Barang::where('jumlah', '>', 0)->get();
        return view('barang-keluar.create', compact('barang'));
    }

    /**
     * Simpan transaksi barang keluar.
     */
    public function store(StoreBarangKeluarRequest $request)
    {
        try {
            $this->barangService->tambahBarangKeluar(
                $request->validated(), 
                auth()->id()
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('barang-keluar.index')->with('success', 'Transaksi Barang Keluar berhasil dicatat. Stok barang telah berkurang.');
    }
}
