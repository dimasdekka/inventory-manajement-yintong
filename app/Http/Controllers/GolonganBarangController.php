<?php

namespace App\Http\Controllers;

use App\Models\GolonganBarang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GolonganBarangController extends Controller
{
    /**
     * Tampilkan daftar master golongan barang.
     */
    public function index(Request $request)
    {
        $query = GolonganBarang::with(['kategori', 'barang']);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->input('kategori_id'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_golongan', 'like', "%{$search}%")
                  ->orWhere('kode_golongan', 'like', "%{$search}%");
            });
        }

        $golongan = $query->orderBy('kategori_id', 'asc')
            ->orderBy('kode_golongan', 'asc')
            ->paginate(15)
            ->appends($request->query());

        $kategoris = Kategori::all();

        return view('golongan.index', compact('golongan', 'kategoris'));
    }

    /**
     * Simpan data golongan barang baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode_golongan' => [
                'required',
                'string',
                'max:10',
                'regex:/^[A-Z0-9]+$/',
                Rule::unique('golongan_barang')->where(function ($query) use ($request) {
                    return $query->where('kategori_id', $request->kategori_id);
                }),
            ],
            'nama_golongan' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ], [
            'kode_golongan.regex' => 'Kode golongan hanya boleh berisi huruf kapital dan angka tanpa spasi (contoh: BKU, PLP, LPT).',
            'kode_golongan.unique' => 'Kode golongan ini sudah digunakan dalam kategori tersebut.',
        ]);

        $validated['kode_golongan'] = strtoupper(trim($validated['kode_golongan']));

        GolonganBarang::create($validated);

        return redirect()->route('golongan.index')->with('success', 'Golongan / Jenis barang ' . $validated['nama_golongan'] . ' berhasil ditambahkan.');
    }

    /**
     * Update data golongan barang.
     */
    public function update(Request $request, GolonganBarang $golongan)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode_golongan' => [
                'required',
                'string',
                'max:10',
                'regex:/^[A-Z0-9]+$/',
                Rule::unique('golongan_barang')->where(function ($query) use ($request, $golongan) {
                    return $query->where('kategori_id', $request->kategori_id)
                                 ->where('id', '!=', $golongan->id);
                }),
            ],
            'nama_golongan' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ], [
            'kode_golongan.regex' => 'Kode golongan hanya boleh berisi huruf kapital dan angka tanpa spasi.',
            'kode_golongan.unique' => 'Kode golongan ini sudah digunakan dalam kategori tersebut.',
        ]);

        $validated['kode_golongan'] = strtoupper(trim($validated['kode_golongan']));

        $golongan->update($validated);

        return redirect()->route('golongan.index')->with('success', 'Golongan barang berhasil diperbarui.');
    }

    /**
     * Hapus data golongan barang.
     */
    public function destroy(GolonganBarang $golongan)
    {
        if ($golongan->barang()->count() > 0) {
            return redirect()->route('golongan.index')->with('error', 'Golongan barang tidak dapat dihapus karena masih digunakan oleh data barang aktif.');
        }

        $golongan->delete();

        return redirect()->route('golongan.index')->with('success', 'Golongan barang berhasil dihapus.');
    }

    /**
     * API: Ambil daftar golongan berdasarkan kategori_id untuk dropdown dinamis.
     */
    public function byKategori($kategoriId)
    {
        $golongans = GolonganBarang::where('kategori_id', $kategoriId)
            ->orderBy('nama_golongan', 'asc')
            ->get(['id', 'kode_golongan', 'nama_golongan']);

        return response()->json($golongans);
    }
}
