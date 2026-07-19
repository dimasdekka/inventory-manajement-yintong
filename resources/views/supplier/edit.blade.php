@extends('layouts.app')

@section('title', 'Ubah Supplier')
@section('header_title', 'Ubah Data Supplier')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('supplier.index') }}">Data Supplier</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Ubah Supplier</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-pen-to-square me-1"></i> Form Ubah Supplier ({{ $supplier->kode_supplier }})
    </h5>

    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="kode_supplier" class="form-label-custom">Kode Supplier <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('kode_supplier') is-invalid @enderror" id="kode_supplier" name="kode_supplier" value="{{ old('kode_supplier', $supplier->kode_supplier) }}" required>
                @error('kode_supplier')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-8">
                <label for="nama_supplier" class="form-label-custom">Nama Perusahaan / Supplier <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('nama_supplier') is-invalid @enderror" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required>
                @error('nama_supplier')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="kontak_person" class="form-label-custom">Kontak Person (Sales/PIC)</label>
                <input type="text" class="form-control form-control-custom w-100 @error('kontak_person') is-invalid @enderror" id="kontak_person" name="kontak_person" value="{{ old('kontak_person', $supplier->kontak_person) }}" placeholder="Contoh: Budi Santoso">
                @error('kontak_person')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="telepon" class="form-label-custom">No. Telepon / HP</label>
                <input type="text" class="form-control form-control-custom w-100 @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $supplier->telepon) }}" placeholder="Contoh: 021-1234567">
                @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="email" class="form-label-custom">Alamat Email</label>
                <input type="email" class="form-control form-control-custom w-100 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $supplier->email) }}" placeholder="Contoh: sales@perusahaan.com">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="alamat" class="form-label-custom">Alamat Lengkap Kantor</label>
            <textarea class="form-control form-control-custom w-100 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $supplier->alamat) }}</textarea>
            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('supplier.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
