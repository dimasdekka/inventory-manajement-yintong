@extends('layouts.app')

@section('title', 'Ubah Aset Tetap')
@section('header_title', 'Ubah Data Aset Tetap / Properti')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('aset-tetap.index') }}">Aset Tetap</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Ubah: {{ $asetTetap->kode_aset }}</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-user-pen me-1"></i> Form Ubah Aset Properti Tetap ({{ $asetTetap->kode_aset }})
    </h5>

    <form action="{{ route('aset-tetap.update', $asetTetap->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label class="form-label-custom">Kode Aset</label>
                <input type="text" class="form-control form-control-custom w-100" value="{{ $asetTetap->kode_aset }}" disabled>
            </div>

            <div class="col-12 col-md-5">
                <label for="nama_aset" class="form-label-custom">Nama Aset / Gedung <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('nama_aset') is-invalid @enderror" id="nama_aset" name="nama_aset" value="{{ old('nama_aset', $asetTetap->nama_aset) }}" required>
                @error('nama_aset')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="tipe" class="form-label-custom">Tipe Properti <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                    <option value="ruko" {{ old('tipe', $asetTetap->tipe) == 'ruko' ? 'selected' : '' }}>Ruko</option>
                    <option value="kantor" {{ old('tipe', $asetTetap->tipe) == 'kantor' ? 'selected' : '' }}>Kantor</option>
                    <option value="mess_karyawan" {{ old('tipe', $asetTetap->tipe) == 'mess_karyawan' ? 'selected' : '' }}>Mess Karyawan</option>
                </select>
                @error('tipe')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="alamat" class="form-label-custom">Alamat Lengkap Properti <span class="text-danger">*</span></label>
            <textarea class="form-control form-control-custom w-100 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $asetTetap->alamat) }}</textarea>
            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-3">
                <label for="luas_tanah" class="form-label-custom">Luas Tanah (m²) <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-custom w-100 @error('luas_tanah') is-invalid @enderror" id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah', $asetTetap->luas_tanah) }}" min="1" required>
                @error('luas_tanah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="luas_bangunan" class="form-label-custom">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-custom w-100 @error('luas_bangunan') is-invalid @enderror" id="luas_bangunan" name="luas_bangunan" value="{{ old('luas_bangunan', $asetTetap->luas_bangunan) }}" min="1" required>
                @error('luas_bangunan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="status_kepemilikan" class="form-label-custom">Status Kepemilikan <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('status_kepemilikan') is-invalid @enderror" id="status_kepemilikan" name="status_kepemilikan" required>
                    <option value="milik_sendiri" {{ old('status_kepemilikan', $asetTetap->status_kepemilikan) == 'milik_sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                    <option value="sewa" {{ old('status_kepemilikan', $asetTetap->status_kepemilikan) == 'sewa' ? 'selected' : '' }}>Sewa</option>
                </select>
                @error('status_kepemilikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="kondisi_bangunan" class="form-label-custom">Kondisi Bangunan <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('kondisi_bangunan') is-invalid @enderror" id="kondisi_bangunan" name="kondisi_bangunan" required>
                    <option value="baik" {{ old('kondisi_bangunan', $asetTetap->kondisi_bangunan) == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="perlu_perbaikan" {{ old('kondisi_bangunan', $asetTetap->kondisi_bangunan) == 'perlu_perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    <option value="rusak_berat" {{ old('kondisi_bangunan', $asetTetap->kondisi_bangunan) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi_bangunan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="nilai_perolehan" class="form-label-custom">Nilai Perolehan / Harga Beli (Rp) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control form-control-custom w-100 @error('nilai_perolehan') is-invalid @enderror" id="nilai_perolehan" name="nilai_perolehan" value="{{ old('nilai_perolehan', (int)$asetTetap->nilai_perolehan) }}" required>
                @error('nilai_perolehan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal_perolehan" class="form-label-custom">Tanggal Perolehan <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal_perolehan') is-invalid @enderror" id="tanggal_perolehan" name="tanggal_perolehan" value="{{ old('tanggal_perolehan', $asetTetap->tanggal_perolehan->format('Y-m-d')) }}" required>
                @error('tanggal_perolehan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="pic" class="form-label-custom">Penanggung Jawab (PIC) <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('pic') is-invalid @enderror" id="pic" name="pic" value="{{ old('pic', $asetTetap->pic) }}" required>
                @error('pic')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="form-label-custom">Keterangan Tambahan</label>
            <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $asetTetap->keterangan) }}</textarea>
            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('aset-tetap.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
