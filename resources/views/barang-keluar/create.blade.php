@extends('layouts.app')

@section('title', 'Catat Barang Keluar')
@section('header_title', 'Transaksi Barang Keluar Baru')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('barang-keluar.index') }}">Barang Keluar</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Catat Transaksi</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-file-invoice me-1"></i> Form Catat Transaksi Barang Keluar
    </h5>

    <form action="{{ route('barang-keluar.store') }}" method="POST">
        @csrf
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-8">
                <label for="barang_id" class="form-label-custom">Pilih Barang <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" data-stok="{{ $item->jumlah }}" data-satuan="{{ $item->satuan }}" {{ old('barang_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->kode_barang }} - {{ $item->nama_barang }} (Tersedia: {{ $item->jumlah }} {{ $item->satuan }})
                        </option>
                    @endforeach
                </select>
                @error('barang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal" class="form-label-custom">Tanggal Pengeluaran <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="jumlah" class="form-label-custom">Jumlah Keluar <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" class="form-control form-control-custom @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required>
                    <span class="input-group-text bg-light text-muted" id="satuan-label" style="font-size: 13.5px; border: 1px solid #d5d5d5;">satuan</span>
                </div>
                @error('jumlah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                <div class="form-text text-muted" id="stok-info">Pilih barang untuk melihat batas stok tersedia.</div>
            </div>

            <div class="col-12 col-md-8">
                <label for="tujuan_penggunaan" class="form-label-custom">Tujuan Penggunaan / Alokasi Unit <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('tujuan_penggunaan') is-invalid @enderror" id="tujuan_penggunaan" name="tujuan_penggunaan" value="{{ old('tujuan_penggunaan') }}" placeholder="Contoh: Divisi Kepegawaian, Mess Karyawan Kamar 3" required>
                @error('tujuan_penggunaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="form-label-custom">Keterangan Transaksi</label>
            <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Informasi tambahan terkait pengeluaran barang..."></textarea>
            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('barang-keluar.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark" id="btn-submit">
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
        const jumlahInput = document.getElementById('jumlah');
        const satuanLabel = document.getElementById('satuan-label');
        const stokInfo = document.getElementById('stok-info');
        const btnSubmit = document.getElementById('btn-submit');

        let maxStok = 0;

        barangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value !== "") {
                const stok = parseInt(selectedOption.getAttribute('data-stok'));
                const satuan = selectedOption.getAttribute('data-satuan');
                
                maxStok = stok;
                satuanLabel.textContent = satuan;
                stokInfo.innerHTML = `Stok tersedia: <strong>${stok} ${satuan}</strong>.`;
                jumlahInput.max = stok;
                
                validateStok();
            } else {
                maxStok = 0;
                satuanLabel.textContent = "satuan";
                stokInfo.textContent = "Pilih barang untuk melihat batas stok tersedia.";
                jumlahInput.removeAttribute('max');
                btnSubmit.disabled = false;
            }
        });

        jumlahInput.addEventListener('input', validateStok);

        function validateStok() {
            if (barangSelect.value !== "") {
                const val = parseInt(jumlahInput.value);
                if (val > maxStok) {
                    jumlahInput.classList.add('is-invalid');
                    stokInfo.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> Stok tidak mencukupi! Tersedia hanya: ${maxStok}</span>`;
                    btnSubmit.disabled = true;
                } else {
                    jumlahInput.classList.remove('is-invalid');
                    stokInfo.innerHTML = `Stok tersedia: <strong>${maxStok}</strong>.`;
                    btnSubmit.disabled = false;
                }
            }
        }

        // Trigger change event if pre-selected
        if (barangSelect.value !== "") {
            barangSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection
