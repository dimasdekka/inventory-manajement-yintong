<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Services\BarangService;
use App\Services\BarcodeService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    protected $barcodeService;

    public function __construct(BarcodeService $barcodeService)
    {
        $this->barcodeService = $barcodeService;
    }

    /**
     * Tampilkan daftar barang.
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // Pencarian (nama atau kode)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->input('kategori_id'));
        }

        // Filter Lokasi
        if ($request->filled('lokasi')) {
            $query->where('lokasi_penyimpanan', 'like', "%" . $request->input('lokasi') . "%");
        }

        $barang = $query->paginate(10)->withQueryString();
        $kategori = Kategori::all();
        
        // Ambil daftar lokasi unik untuk filter
        $lokasi = Barang::select('lokasi_penyimpanan')
            ->distinct()
            ->pluck('lokasi_penyimpanan');

        return view('barang.index', compact('barang', 'kategori', 'lokasi'));
    }

    /**
     * Tampilkan form tambah barang.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('barang.create', compact('kategori', 'supplier'));
    }

    /**
     * Simpan data barang baru.
     */
    public function store(StoreBarangRequest $request)
    {
        $data = $request->validated();
        
        // Generate kode barang
        $kodeBarang = BarangService::generateKodeBarang();
        $data['kode_barang'] = $kodeBarang;

        // Generate QR Code
        $data['barcode_path'] = $this->barcodeService->generateQRCode($kodeBarang);

        // Nilai awal transaksi barang baru
        $data['jumlah'] = 0;
        $data['total_nilai_aset'] = 0.00;

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan. Silakan lakukan transaksi Barang Masuk untuk mengisi stok.');
    }

    /**
     * Tampilkan detail barang.
     */
    public function show(Barang $barang)
    {
        $barang->load([
            'kategori', 
            'supplier',
            'barangMasuk' => fn($q) => $q->with(['supplier', 'user'])->orderBy('tanggal', 'desc'),
            'barangKeluar' => fn($q) => $q->with('user')->orderBy('tanggal', 'desc'),
            'mutasi' => fn($q) => $q->with('user')->orderBy('tanggal', 'desc'),
            'peminjaman' => fn($q) => $q->with(['peminjam', 'user', 'pengembalian'])->orderBy('tanggal_pinjam', 'desc')
        ]);

        return view('barang.show', compact('barang'));
    }

    /**
     * Tampilkan form edit barang.
     */
    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('barang.edit', compact('barang', 'kategori', 'supplier'));
    }

    /**
     * Perbarui data barang.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $data = $request->validated();
        
        // Update total nilai aset (karena harga satuan mungkin berubah)
        $data['total_nilai_aset'] = $barang->jumlah * $data['harga_satuan'];

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Hapus barang (soft delete).
     */
    public function destroy(Barang $barang)
    {
        // Validasi: tidak boleh dihapus jika masih ada transaksi terkait
        if ($barang->barangMasuk()->exists() || $barang->barangKeluar()->exists() || $barang->mutasi()->exists() || $barang->peminjaman()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Barang tidak dapat dihapus karena memiliki riwayat transaksi aktif.']);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
