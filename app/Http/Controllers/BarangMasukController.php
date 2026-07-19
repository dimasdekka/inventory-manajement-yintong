<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Http\Requests\StoreBarangMasukRequest;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    /**
     * Tampilkan riwayat barang masuk.
     */
    public function index(Request $request)
    {
        $query = BarangMasuk::with(['barang.kategori', 'supplier', 'user']);

        // Filter Tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->input('tanggal_mulai'), $request->input('tanggal_selesai')]);
        }

        // Filter Supplier
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->input('supplier_id'));
        }

        $barangMasuk = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $suppliers = Supplier::all();

        return view('barang-masuk.index', compact('barangMasuk', 'suppliers'));
    }

    /**
     * Tampilkan form transaksi barang masuk.
     */
    public function create()
    {
        $barang = Barang::all();
        $suppliers = Supplier::all();
        return view('barang-masuk.create', compact('barang', 'suppliers'));
    }

    /**
     * Simpan transaksi barang masuk.
     */
    public function store(StoreBarangMasukRequest $request)
    {
        $this->barangService->tambahBarangMasuk(
            $request->validated(), 
            auth()->id()
        );

        return redirect()->route('barang-masuk.index')->with('success', 'Transaksi Barang Masuk berhasil dicatat. Stok barang telah terupdate.');
    }
}
