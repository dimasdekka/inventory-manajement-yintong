@extends('layouts.app')

@section('title', 'Catat Peminjaman')
@section('header_title', 'Transaksi Peminjaman Baru')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('peminjaman.index') }}">Peminjaman Barang</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Catat Transaksi</span>
@endsection

@section('content')
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid #e5e5e5; padding-bottom: 12px;">
        <i class="fa-solid fa-file-invoice me-1"></i> Form Catat Transaksi Peminjaman
    </h5>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="barang_id" class="form-label-custom">Pilih Barang yang Dipinjam <span class="text-danger">*</span></label>
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

            <div class="col-12 col-md-6">
                <label for="peminjam_id" class="form-label-custom">Peminjam (Pegawai) <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('peminjam_id') is-invalid @enderror" id="peminjam_id" name="peminjam_id" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('peminjam_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->nama }} ({{ ucfirst($user->role) }})
                        </option>
                    @endforeach
                </select>
                @error('peminjam_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="jumlah" class="form-label-custom">Jumlah Peminjaman <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" class="form-control form-control-custom @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required>
                    <span class="input-group-text bg-light text-muted" id="satuan-label" style="font-size: 13.5px; border: 1px solid #d5d5d5;">satuan</span>
                </div>
                @error('jumlah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                <div class="form-text text-muted" id="stok-info">Pilih barang untuk melihat batas stok tersedia.</div>
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal_pinjam" class="form-label-custom">Tanggal Peminjaman <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                @error('tanggal_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal_rencana_kembali" class="form-label-custom">Rencana Tanggal Kembali <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal_rencana_kembali') is-invalid @enderror" id="tanggal_rencana_kembali" name="tanggal_rencana_kembali" value="{{ old('tanggal_rencana_kembali') }}" required>
                @error('tanggal_rencana_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="form-label-custom">Keterangan / Keperluan Pinjam</label>
            <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Digunakan untuk presentasi rapat kerja selama 3 hari..."></textarea>
            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('peminjaman.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark" id="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> Catat Peminjaman
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

        // Auto set Rencana Kembali to +3 days from today
        const tglPinjam = document.getElementById('tanggal_pinjam');
        const tglRencanaKembali = document.getElementById('tanggal_rencana_kembali');
        
        tglPinjam.addEventListener('change', function () {
            if (tglPinjam.value) {
                const date = new Date(tglPinjam.value);
                date.setDate(date.getDate() + 3); // Default 3 days
                tglRencanaKembali.value = date.toISOString().split('T')[0];
                tglRencanaKembali.min = tglPinjam.value;
            }
        });

        // Trigger change for default date
        tglPinjam.dispatchEvent(new Event('change'));

        if (barangSelect.value !== "") {
            barangSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection
