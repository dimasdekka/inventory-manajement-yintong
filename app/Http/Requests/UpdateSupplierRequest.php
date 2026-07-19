<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('supplier')->id ?? $this->route('supplier');
        
        return [
            'kode_supplier' => 'required|string|max:20|unique:supplier,kode_supplier,' . $id,
            'nama_supplier' => 'required|string|max:150',
            'kontak_person' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
        ];
    }
}
