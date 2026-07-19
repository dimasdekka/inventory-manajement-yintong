<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMutasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'lokasi_tujuan' => 'required|string|max:150',
            'pic_tujuan' => 'nullable|string|max:100',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ];
    }
}
