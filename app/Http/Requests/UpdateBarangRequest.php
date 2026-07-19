<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategori,id',
            'supplier_id' => 'nullable|exists:supplier,id',
            'merek' => 'nullable|string|max:100',
            'spesifikasi' => 'nullable|string',
            'satuan' => 'required|string|max:20',
            'lokasi_penyimpanan' => 'required|string|max:150',
            'kondisi_barang' => 'required|in:baik,rusak_ringan,rusak_berat',
            'tanggal_masuk' => 'required|date',
            'harga_satuan' => 'required|numeric|min:0',
            'pic' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'stok_minimum' => 'required|integer|min:0',
        ];
    }
}
