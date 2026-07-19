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
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="barang_id" class="form-label-custom mb-0">Pilih Barang <span class="text-danger">*</span></label>
                    <button type="button" class="btn-custom btn-custom-sm btn-custom-light px-2 py-1" id="btnScanQR" style="font-size: 11px; font-weight: 600;">
                        <i class="fa-solid fa-qrcode"></i> Scan QR
                    </button>
                </div>
                <select class="form-select form-control-custom w-100 @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" data-stok="{{ $item->jumlah }}" data-satuan="{{ $item->satuan }}" data-kode="{{ $item->kode_barang }}" {{ old('barang_id') == $item->id ? 'selected' : '' }}>
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

<!-- Modal Scanner QR -->
<div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: 1px solid #e5e5e5; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0" id="scannerModalLabel" style="font-size: 15px;">
                    <i class="fa-solid fa-camera me-1"></i> Scan QR Code Barang
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseScanner"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="alert alert-info text-start py-2 px-3 mb-3" style="font-size: 12.5px; border-radius: 6px; border-color: #def7ec; background-color: #f3faf7; color: #03543f;">
                    <i class="fa-solid fa-info-circle me-1"></i> Arahkan kamera perangkat Anda pada QR Code yang tercetak di label barang.
                </div>
                <div id="reader" style="width: 100%; max-width: 320px; margin: 0 auto; border-radius: 8px; overflow: hidden; border: 1px solid #e5e5e5; background-color: #fafafa;"></div>
                <div id="scanner-result" class="mt-3 text-muted small" style="font-size: 13px;">Menunggu deteksi QR Code...</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
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

        // Scanner QR Logic
        let html5QrcodeScanner;
        const btnScan = document.getElementById('btnScanQR');
        const scannerModalEl = document.getElementById('scannerModal');
        const scannerModal = new bootstrap.Modal(scannerModalEl);
        const scannerResult = document.getElementById('scanner-result');

        btnScan.addEventListener('click', function () {
            scannerModal.show();
        });

        scannerModalEl.addEventListener('shown.bs.modal', function () {
            scannerResult.textContent = "Mengaktifkan kamera...";
            html5QrcodeScanner = new Html5Qrcode("reader");
            
            const config = { fps: 10, qrbox: { width: 220, height: 220 } };
            
            html5QrcodeScanner.start(
                { facingMode: "environment" },
                config,
                onScanSuccess,
                onScanFailure
            ).then(() => {
                scannerResult.textContent = "Kamera aktif. Silakan scan QR Code.";
            }).catch(err => {
                scannerResult.innerHTML = `<span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Gagal mengakses kamera: ${err}</span>`;
            });
        });

        scannerModalEl.addEventListener('hidden.bs.modal', function () {
            stopScanner();
        });

        function onScanSuccess(decodedText, decodedResult) {
            scannerResult.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Terdeteksi: ${decodedText}</span>`;
            
            let found = false;
            for (let i = 0; i < barangSelect.options.length; i++) {
                const opt = barangSelect.options[i];
                const kode = opt.getAttribute('data-kode');
                if (kode === decodedText || opt.text.startsWith(decodedText)) {
                    barangSelect.selectedIndex = i;
                    barangSelect.dispatchEvent(new Event('change'));
                    found = true;
                    break;
                }
            }

            if (found) {
                // Beep audio feedback
                try {
                    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    const osc = audioCtx.createOscillator();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(800, audioCtx.currentTime);
                    osc.connect(audioCtx.destination);
                    osc.start();
                    osc.stop(audioCtx.currentTime + 0.1);
                } catch(e) {}
                
                setTimeout(() => {
                    scannerModal.hide();
                }, 500);
            } else {
                scannerResult.innerHTML = `<span class="text-warning"><i class="fa-solid fa-circle-exclamation"></i> Barang dengan kode "${decodedText}" tidak ditemukan.</span>`;
            }
        }

        function onScanFailure(error) {
            // Quiet mode
        }

        function stopScanner() {
            if (html5QrcodeScanner && html5QrcodeScanner.isScanning) {
                html5QrcodeScanner.stop().then(() => {
                    html5QrcodeScanner.clear();
                }).catch(err => console.error("Gagal menghentikan scanner: ", err));
            }
        }
    });
</script>
@endsection
