@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('header_title', 'Tambah Barang Baru')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('barang.index') }}">Data Barang</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Tambah Barang</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-folder-plus me-1"></i> Form Data Master Barang
    </h5>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="row g-3 mb-4">
            <!-- Info Kolom generated otomatis -->
            <div class="col-12 col-md-4">
                <label class="form-label-custom">Kode Barang</label>
                <input type="text" class="form-control form-control-custom w-100" value="[ GENERATE OTOMATIS ]" disabled>
                <div class="form-text text-muted">Format: BRG-YYYYMM-0001</div>
            </div>
            
            <div class="col-12 col-md-4">
                <label class="form-label-custom">Stok Awal</label>
                <input type="number" class="form-control form-control-custom w-100" value="0" disabled>
                <div class="form-text text-muted">Stok bertambah lewat transaksi Barang Masuk.</div>
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label-custom">QR Code / Barcode</label>
                <input type="text" class="form-control form-control-custom w-100" value="[ GENERATE OTOMATIS ]" disabled>
                <div class="form-text text-muted">Dibuat otomatis dari Kode Barang.</div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="nama_barang" class="form-label-custom">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Kertas HVS A4 80gr" required>
                @error('nama_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="kategori_id" class="form-label-custom">Kategori Barang <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="supplier_id" class="form-label-custom">Supplier Awal (Opsional)</label>
                <select class="form-select form-control-custom w-100 @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                    <option value="">-- Tanpa Supplier --</option>
                    @foreach($supplier as $sup)
                        <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                            {{ $sup->nama_supplier }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="merek" class="form-label-custom">Merek Barang (Opsional)</label>
                <input type="text" class="form-control form-control-custom w-100 @error('merek') is-invalid @enderror" id="merek" name="merek" value="{{ old('merek') }}" placeholder="Contoh: Sinar Dunia, Honda">
                @error('merek')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="satuan" class="form-label-custom">Satuan Hitung <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan') }}" placeholder="Contoh: rim, unit, box, pcs" required>
                @error('satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="kondisi_barang" class="form-label-custom">Kondisi Barang <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('kondisi_barang') is-invalid @enderror" id="kondisi_barang" name="kondisi_barang" required>
                    <option value="baik" {{ old('kondisi_barang', 'baik') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak_ringan" {{ old('kondisi_barang') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ old('kondisi_barang') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="lokasi_penyimpanan" class="form-label-custom">Lokasi Penyimpanan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('lokasi_penyimpanan') is-invalid @enderror" id="lokasi_penyimpanan" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}" placeholder="Contoh: Gudang A - Rak 2, Ruang Rapat" required>
                @error('lokasi_penyimpanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="pic" class="form-label-custom">Penanggung Jawab (PIC) (Opsional)</label>
                <input type="text" class="form-control form-control-custom w-100 @error('pic') is-invalid @enderror" id="pic" name="pic" value="{{ old('pic') }}" placeholder="Contoh: Budi Santoso">
                @error('pic')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="harga_satuan" class="form-label-custom">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control form-control-custom w-100 @error('harga_satuan') is-invalid @enderror" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" placeholder="Contoh: 55000" required>
                @error('harga_satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="stok_minimum" class="form-label-custom">Ambang Batas Stok Minimum <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-custom w-100 @error('stok_minimum') is-invalid @enderror" id="stok_minimum" name="stok_minimum" value="{{ old('stok_minimum', 5) }}" required>
                @error('stok_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal_masuk" class="form-label-custom">Tanggal Masuk/Pencatatan <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="spesifikasi" class="form-label-custom">Spesifikasi Barang</label>
                <textarea class="form-control form-control-custom w-100 @error('spesifikasi') is-invalid @enderror" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Deskripsi fisik barang, ukuran, dll...">{{ old('spesifikasi') }}</textarea>
                @error('spesifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="keterangan" class="form-label-custom">Keterangan Tambahan</label>
                <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Informasi tambahan terkait barang...">{{ old('keterangan') }}</textarea>
                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('barang.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Barang
            </button>
        </div>
    </form>
</div>
@endsection
