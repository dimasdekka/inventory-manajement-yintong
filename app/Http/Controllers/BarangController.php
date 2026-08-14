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
     * Tampilkan daftar barang (katalog).
     */
    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'golongan', 'supplier']);

        // Filter Pencarian (Nama / Kode / Merek)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%")
                  ->orWhere('merek', 'like', "%{$search}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->input('kategori_id'));
        }

        // Filter Kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi_barang', $request->input('kondisi'));
        }

        // Filter Lokasi
        if ($request->filled('lokasi')) {
            $query->where('lokasi_penyimpanan', $request->input('lokasi'));
        }

        // Filter Stok Minimum (Alert)
        if ($request->filled('stok_status') && $request->input('stok_status') === 'menipis') {
            $query->whereColumn('jumlah', '<=', 'stok_minimum');
        }

        $barang = $query->orderBy('nama_barang', 'asc')
            ->paginate(10)
            ->appends($request->query());

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
        $kategori = Kategori::with('golongan')->get();
        $golongan = \App\Models\GolonganBarang::all();
        $supplier = Supplier::all();
        return view('barang.create', compact('kategori', 'golongan', 'supplier'));
    }

    /**
     * Simpan data barang baru.
     */
    public function store(StoreBarangRequest $request)
    {
        $data = $request->validated();
        
        // Generate kode barang berbasis hierarki jenis/kategori dan golongan barang
        $kodeBarang = BarangService::generateKodeBarang($data['kategori_id'] ?? null, $data['golongan_id'] ?? null);
        $data['kode_barang'] = $kodeBarang;

        // Generate QR Code
        $data['barcode_path'] = $this->barcodeService->generateQRCode($kodeBarang);

        // Nilai awal transaksi barang baru
        $data['jumlah'] = 0;
        $data['total_nilai_aset'] = 0.00;

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dengan kode ' . $kodeBarang . '. Silakan lakukan transaksi Barang Masuk untuk mengisi stok.');
    }

    /**
     * Tampilkan detail barang.
     */
    public function show(Barang $barang)
    {
        $barang->load([
            'kategori', 
            'golongan',
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
        $kategori = Kategori::with('golongan')->get();
        $golongan = \App\Models\GolonganBarang::all();
        $supplier = Supplier::all();
        return view('barang.edit', compact('barang', 'kategori', 'golongan', 'supplier'));
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

    /**
     * API Quick Search untuk Live Topbar Search.
     */
    public function quickSearch(Request $request)
    {
        $q = trim($request->input('q', ''));
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $results = [];

        // 1. Cari Barang
        $barangs = Barang::with('kategori')
            ->where('nama_barang', 'like', "%{$q}%")
            ->orWhere('kode_barang', 'like', "%{$q}%")
            ->orWhere('lokasi_penyimpanan', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($barangs as $b) {
            $results[] = [
                'type' => 'Barang',
                'badge' => 'badge-emerald',
                'title' => $b->nama_barang,
                'subtitle' => "[{$b->kode_barang}] Stok: {$b->jumlah} {$b->satuan} • Lokasi: {$b->lokasi_penyimpanan}",
                'url' => route('barang.show', $b->id),
                'icon' => 'fa-boxes-stacked'
            ];
        }

        // 2. Cari Supplier
        $suppliers = Supplier::where('nama_supplier', 'like', "%{$q}%")
            ->orWhere('kontak_person', 'like', "%{$q}%")
            ->limit(3)
            ->get();

        foreach ($suppliers as $s) {
            $results[] = [
                'type' => 'Supplier',
                'badge' => 'badge-info',
                'title' => $s->nama_supplier,
                'subtitle' => "Kontak: " . ($s->kontak_person ?? $s->telepon),
                'url' => route('supplier.show', $s->id),
                'icon' => 'fa-truck-field'
            ];
        }

        // 3. Cari Kategori
        $kategori = Kategori::where('nama_kategori', 'like', "%{$q}%")
            ->limit(3)
            ->get();

        foreach ($kategori as $k) {
            $results[] = [
                'type' => 'Kategori',
                'badge' => 'badge-secondary',
                'title' => $k->nama_kategori,
                'subtitle' => $k->deskripsi ?? 'Kategori Inventori',
                'url' => route('barang.index', ['kategori_id' => $k->id]),
                'icon' => 'fa-tags'
            ];
        }

        return response()->json($results);
    }
}
