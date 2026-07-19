<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori.
     */
    public function index()
    {
        // Ambil kategori dengan hitungan jumlah barang terkait
        $kategori = Kategori::withCount('barang')->paginate(10);
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        // Generate Kode Kategori otomatis: KTG-001
        $lastKategori = Kategori::orderBy('kode_kategori', 'desc')->first();
        if ($lastKategori) {
            $lastNumber = intval(substr($lastKategori->kode_kategori, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        $kodeKategori = 'KTG-' . $newNumber;

        Kategori::create([
            'kode_kategori' => $kodeKategori,
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Perbarui kategori.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori (soft delete).
     */
    public function destroy(Kategori $kategori)
    {
        // Validasi: tidak boleh dihapus jika masih digunakan oleh barang
        if ($kategori->barang()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Kategori tidak dapat dihapus karena masih digunakan oleh data barang.']);
        }

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
