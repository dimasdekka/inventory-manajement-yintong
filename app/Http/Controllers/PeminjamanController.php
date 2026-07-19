<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use App\Http\Requests\StorePeminjamanRequest;
use App\Services\BarangService;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    /**
     * Update status peminjaman yang terlambat secara otomatis.
     */
    protected function updateOverdueStatus()
    {
        Peminjaman::where('status', 'dipinjam')
            ->where('tanggal_rencana_kembali', '<', now()->toDateString())
            ->update(['status' => 'terlambat']);
    }

    /**
     * Tampilkan riwayat peminjaman.
     */
    public function index(Request $request)
    {
        // Update status terlambat secara real time
        $this->updateOverdueStatus();

        $query = Peminjaman::with(['barang.kategori', 'peminjam', 'user', 'pengembalian']);

        // Filter status ('dipinjam', 'dikembalikan', 'terlambat')
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter Barang
        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->input('barang_id'));
        }

        $peminjaman = $query->orderBy('tanggal_pinjam', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $barang = Barang::all();

        return view('peminjaman.index', compact('peminjaman', 'barang'));
    }

    /**
     * Tampilkan form transaksi peminjaman.
     */
    public function create()
    {
        $barang = Barang::where('jumlah', '>', 0)->get();
        // Hanya user yang berstatus aktif yang bisa meminjam
        $users = User::where('status', 'aktif')->get();
        return view('peminjaman.create', compact('barang', 'users'));
    }

    /**
     * Simpan transaksi peminjaman.
     */
    public function store(StorePeminjamanRequest $request)
    {
        try {
            $this->barangService->tambahPeminjaman(
                $request->validated(), 
                auth()->id()
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi Peminjaman berhasil dicatat. Stok barang telah dikurangi sementara.');
    }
}
