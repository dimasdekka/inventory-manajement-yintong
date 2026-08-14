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
            'kode_kategori' => 'nullable|string|max:20|unique:kategori,kode_kategori',
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ], [
            'kode_kategori.unique' => 'Kode kategori ini sudah digunakan.',
        ]);

        $kodeKategori = $request->filled('kode_kategori') 
            ? strtoupper(trim($request->input('kode_kategori'))) 
            : null;

        if (!$kodeKategori) {
            // Generate Kode Kategori otomatis jika dikosongkan: KTG-001
            $lastKategori = Kategori::where('kode_kategori', 'like', 'KTG-%')
                ->orderBy('kode_kategori', 'desc')
                ->first();
                
            if ($lastKategori) {
                $lastNumber = intval(substr($lastKategori->kode_kategori, -3));
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $count = Kategori::count() + 1;
                $newNumber = str_pad($count, 3, '0', STR_PAD_LEFT);
            }
            $kodeKategori = 'KTG-' . $newNumber;
        }

        Kategori::create([
            'kode_kategori' => $kodeKategori,
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori ' . $request->nama_kategori . ' (' . $kodeKategori . ') berhasil ditambahkan.');
    }

    /**
     * Perbarui kategori.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kode_kategori' => [
                'required',
                'string',
                'max:20',
                Rule::unique('kategori', 'kode_kategori')->ignore($kategori->id),
            ],
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ], [
            'kode_kategori.unique' => 'Kode kategori ini sudah digunakan oleh kategori lain.',
        ]);

        $kategori->update([
            'kode_kategori' => strtoupper(trim($request->input('kode_kategori'))),
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
