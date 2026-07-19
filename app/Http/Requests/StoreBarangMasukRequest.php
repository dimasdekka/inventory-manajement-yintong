<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangMasukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_id' => 'required|exists:barang,id',
            'supplier_id' => 'required|exists:supplier,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ];
    }
}
