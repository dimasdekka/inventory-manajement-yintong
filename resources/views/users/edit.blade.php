@extends('layouts.app')

@section('title', 'Ubah Pengguna')
@section('header_title', 'Ubah Data Pengguna')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('users.index') }}">Manajemen Pengguna</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Ubah Pengguna</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-user-pen me-1"></i> Form Ubah Akun Pengguna ({{ $user->nama }})
    </h5>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="nama" class="form-label-custom">Nama Lengkap Pengguna <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="email" class="form-label-custom">Alamat Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-custom w-100 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="password" class="form-label-custom">Kata Sandi Login (Kosongkan jika tidak diubah)</label>
                <input type="password" class="form-control form-control-custom w-100 @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="role" class="form-label-custom">Hak Akses (Role) <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>Administrator</option>
                    <option value="staff_gudang" {{ old('role', $user->role) == 'staff_gudang' ? 'selected' : '' }}>Staff Gudang</option>
                    <option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                </select>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="status" class="form-label-custom">Status Keaktifan <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4 align-items-center">
            <div class="col-12 col-md-2 text-center">
                @if($user->foto)
                    <img src="{{ asset($user->foto) }}" alt="Avatar" class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                @else
                    <div class="img-thumbnail rounded-circle bg-light text-muted d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-weight: bold; font-size: 24px;">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                @endif
            </div>
            
            <div class="col-12 col-md-10">
                <label for="foto" class="form-label-custom">Ganti Foto Profil (Opsional)</label>
                <input type="file" class="form-control form-control-custom w-100 @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text text-muted">Format gambar: JPG, PNG, GIF. Maksimum 2MB.</div>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('users.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
