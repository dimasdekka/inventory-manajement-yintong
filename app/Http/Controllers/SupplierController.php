<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Tampilkan daftar supplier.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_supplier', 'like', "%{$search}%")
                  ->orWhere('kode_supplier', 'like', "%{$search}%")
                  ->orWhere('kontak_person', 'like', "%{$search}%");
            });
        }

        $supplier = $query->paginate(10)->withQueryString();
        return view('supplier.index', compact('supplier'));
    }

    /**
     * Tampilkan form tambah supplier.
     */
    public function create()
    {
        // Cari kode supplier berikutnya
        $lastSupplier = Supplier::orderBy('kode_supplier', 'desc')->first();
        if ($lastSupplier) {
            $lastNumber = intval(substr($lastSupplier->kode_supplier, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        $nextKode = 'SPL-' . $newNumber;

        return view('supplier.create', compact('nextKode'));
    }

    /**
     * Simpan supplier baru.
     */
    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail supplier + riwayat barang masuk.
     */
    public function show(Supplier $supplier)
    {
        $supplier->load(['barangMasuk' => function($q) {
            $q->with(['barang.kategori', 'user'])->orderBy('tanggal', 'desc');
        }]);

        return view('supplier.show', compact('supplier'));
    }

    /**
     * Tampilkan form edit supplier.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Perbarui data supplier.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil diperbarui.');
    }

    /**
     * Hapus supplier (soft delete).
     */
    public function destroy(Supplier $supplier)
    {
        // Validasi: tidak boleh dihapus jika masih terkait barang atau barang_masuk
        if ($supplier->barang()->exists() || $supplier->barangMasuk()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Supplier tidak dapat dihapus karena memiliki riwayat transaksi/barang terkait.']);
        }

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
