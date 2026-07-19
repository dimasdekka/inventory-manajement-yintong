<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('user')->id ?? $this->route('user');

        return [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:administrator,staff_gudang,pimpinan',
            'foto' => 'nullable|image|max:2048', // max 2MB
            'status' => 'required|in:aktif,nonaktif',
        ];
    }
}
