@extends('layouts.app')

@section('title', 'Catat Barang Masuk')
@section('header_title', 'Transaksi Barang Masuk Baru')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('barang-masuk.index') }}">Barang Masuk</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Catat Transaksi</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-file-invoice me-1"></i> Form Catat Transaksi Barang Masuk
    </h5>

    <form action="{{ route('barang-masuk.store') }}" method="POST">
        @csrf
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="barang_id" class="form-label-custom">Pilih Barang <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" data-harga="{{ $item->harga_satuan }}" data-satuan="{{ $item->satuan }}" {{ old('barang_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->kode_barang }} - {{ $item->nama_barang }} (Stok saat ini: {{ $item->jumlah }} {{ $item->satuan }})
                        </option>
                    @endforeach
                </select>
                @error('barang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="supplier_id" class="form-label-custom">Supplier / Pemasok <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                            {{ $sup->kode_supplier }} - {{ $sup->nama_supplier }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="jumlah" class="form-label-custom">Jumlah Masuk <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" class="form-control form-control-custom @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required>
                    <span class="input-group-text bg-light text-muted" id="satuan-label" style="font-size: 13.5px; border: 1px solid #d5d5d5;">satuan</span>
                </div>
                @error('jumlah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="harga_satuan" class="form-label-custom">Harga Satuan Beli (Rp) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control form-control-custom w-100 @error('harga_satuan') is-invalid @enderror" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" placeholder="Auto fill jika barang dipilih" required>
                @error('harga_satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text text-muted">Akan memperbarui harga beli master barang.</div>
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal" class="form-label-custom">Tanggal Penerimaan <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="form-label-custom">Keterangan Transaksi</label>
            <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Informasi tambahan terkait pengiriman barang masuk..."></textarea>
            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('barang-masuk.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-floppy-disk"></i> Catat Transaksi
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const barangSelect = document.getElementById('barang_id');
        const hargaInput = document.getElementById('harga_satuan');
        const satuanLabel = document.getElementById('satuan-label');

        barangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value !== "") {
                const harga = selectedOption.getAttribute('data-harga');
                const satuan = selectedOption.getAttribute('data-satuan');
                
                hargaInput.value = Math.round(harga);
                satuanLabel.textContent = satuan;
            } else {
                hargaInput.value = "";
                satuanLabel.textContent = "satuan";
            }
        });

        // Trigger change event if pre-selected
        if (barangSelect.value !== "") {
            barangSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection
