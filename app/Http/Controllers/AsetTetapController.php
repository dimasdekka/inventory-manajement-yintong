<?php

namespace App\Http\Controllers;

use App\Models\AsetTetap;
use App\Http\Requests\StoreAsetTetapRequest;
use App\Http\Requests\UpdateAsetTetapRequest;
use Illuminate\Http\Request;

class AsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AsetTetap::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('kode_aset', 'like', "%{$search}%")
                  ->orWhere('nama_aset', 'like', "%{$search}%")
                  ->orWhere('pic', 'like', "%{$search}%");
            });
        }

        // Tipe filter
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->input('tipe'));
        }

        $asetTetap = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('aset-tetap.index', compact('asetTetap'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate next code AST-PROP-0001
        $lastAset = AsetTetap::withTrashed()->orderBy('id', 'desc')->first();
        $nextId = $lastAset ? $lastAset->id + 1 : 1;
        $nextKode = 'AST-PROP-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('aset-tetap.create', compact('nextKode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsetTetapRequest $request)
    {
        $data = $request->validated();
        
        // Generate next code AST-PROP-0001 to prevent race condition/tampering
        $lastAset = AsetTetap::withTrashed()->orderBy('id', 'desc')->first();
        $nextId = $lastAset ? $lastAset->id + 1 : 1;
        $data['kode_aset'] = 'AST-PROP-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        AsetTetap::create($data);

        return redirect()->route('aset-tetap.index')
            ->with('success', 'Aset Tetap baru berhasil didaftarkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AsetTetap $asetTetap)
    {
        return view('aset-tetap.show', compact('asetTetap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsetTetap $asetTetap)
    {
        return view('aset-tetap.edit', compact('asetTetap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsetTetapRequest $request, AsetTetap $asetTetap)
    {
        $asetTetap->update($request->validated());

        return redirect()->route('aset-tetap.index')
            ->with('success', 'Aset Tetap berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsetTetap $asetTetap)
    {
        $asetTetap->delete();

        return redirect()->route('aset-tetap.index')
            ->with('success', 'Aset Tetap berhasil dihapus.');
    }
}
