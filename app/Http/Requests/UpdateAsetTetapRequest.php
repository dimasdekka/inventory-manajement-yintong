<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsetTetapRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_aset' => 'required|string|max:255',
            'tipe' => 'required|in:ruko,kantor,mess_karyawan',
            'alamat' => 'required|string',
            'luas_tanah' => 'required|integer|min:1',
            'luas_bangunan' => 'required|integer|min:1',
            'tanggal_perolehan' => 'required|date',
            'nilai_perolehan' => 'required|numeric|min:0',
            'status_kepemilikan' => 'required|in:milik_sendiri,sewa',
            'kondisi_bangunan' => 'required|in:baik,perlu_perbaikan,rusak_berat',
            'pic' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ];
    }
}
