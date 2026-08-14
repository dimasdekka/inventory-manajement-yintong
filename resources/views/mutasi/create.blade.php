@extends('layouts.app')

@section('title', 'Mutasikan Barang')
@section('header_title', 'Transaksi Mutasi Lokasi & PIC')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('mutasi.index') }}">Mutasi Barang</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Catat Mutasi</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">
            <i class="fa-solid fa-arrows-spin me-2 text-success"></i> Form Mutasi Lokasi Penyimpanan & Penanggung Jawab
        </h5>
        <button type="button" class="btn-custom btn-custom-sm btn-custom-light px-3" id="btnScanQR" style="font-size: 12px; font-weight: 600;">
            <i class="fa-solid fa-qrcode text-success"></i> Scan QR Code
        </button>
    </div>

    <form action="{{ route('mutasi.store') }}" method="POST">
        @csrf
        
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-8">
                <label for="barang_id" class="form-label-custom">Pilih Barang yang Dimutasi <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id" required>
                    <option value="">-- Pilih Barang dari Daftar --</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" 
                                data-kode="{{ $item->kode_barang }}" 
                                data-stok="{{ $item->jumlah }}" 
                                data-satuan="{{ $item->satuan }}" 
                                data-lokasi="{{ $item->lokasi_penyimpanan }}" 
                                data-pic="{{ $item->pic }}"
                                {{ (old('barang_id', request('barang_id')) == $item->id) ? 'selected' : '' }}>
                            [{{ $item->kode_barang }}] {{ $item->nama_barang }} (Stok: {{ $item->jumlah }} {{ $item->satuan }} | Lokasi: {{ $item->lokasi_penyimpanan }})
                        </option>
                    @endforeach
                </select>
                @error('barang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="tanggal" class="form-label-custom">Tanggal Mutasi <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Box Informasi Otomatis Data Asal Saat Ini -->
        <div class="p-3 mb-4 rounded-3" style="background-color: var(--slate-light, #F1F5F9); border: 1px solid #CBD5E1;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="fa-solid fa-circle-info" style="color: var(--navy-primary, #0F2942);"></i>
                <strong class="font-outfit" style="font-size: 13px; color: var(--navy-primary, #0F2942);">Informasi Posisi Barang Saat Ini (Otomatis Terdeteksi):</strong>
            </div>
            <div class="row g-3" style="font-size: 13px;">
                <div class="col-12 col-md-4">
                    <label class="form-label-custom mb-1 text-muted" style="font-size: 11.5px;">Lokasi Penyimpanan Asal</label>
                    <input type="text" class="form-control form-control-custom bg-white" id="lokasi_asal_display" readonly placeholder="Pilih barang terlebih dahulu...">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label-custom mb-1 text-muted" style="font-size: 11.5px;">Penanggung Jawab (PIC) Asal</label>
                    <input type="text" class="form-control form-control-custom bg-white" id="pic_asal_display" readonly placeholder="Pilih barang terlebih dahulu...">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label-custom mb-1 text-muted" style="font-size: 11.5px;">Stok Tersedia Saat Ini</label>
                    <input type="text" class="form-control form-control-custom bg-white fw-bold" id="stok_asal_display" readonly placeholder="0">
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="jumlah" class="form-label-custom">Jumlah Unit Dimutasi <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" class="form-control form-control-custom @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required>
                    <span class="input-group-text bg-light text-muted" id="satuan-label" style="font-size: 13px;">satuan</span>
                </div>
                @error('jumlah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                <div class="form-text text-muted" id="stok-info" style="font-size: 11.5px;">Pilih barang untuk melihat stok yang dapat dimutasi.</div>
            </div>

            <div class="col-12 col-md-4">
                <label for="lokasi_tujuan" class="form-label-custom">Lokasi Penyimpanan Baru (Tujuan) <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('lokasi_tujuan') is-invalid @enderror" id="lokasi_tujuan" name="lokasi_tujuan" value="{{ old('lokasi_tujuan') }}" placeholder="Contoh: Gedung B - Ruang IT 2" required>
                @error('lokasi_tujuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text text-muted" style="font-size: 11px;">Data lokasi pada master barang akan otomatis dipindahkan ke lokasi ini.</div>
            </div>

            <div class="col-12 col-md-4">
                <label for="pic_tujuan" class="form-label-custom">PIC Baru (Penanggung Jawab Tujuan) <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('pic_tujuan') is-invalid @enderror" id="pic_tujuan" name="pic_tujuan" value="{{ old('pic_tujuan') }}" placeholder="Contoh: Bpk. Heri Setiawan" required>
                @error('pic_tujuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text text-muted" style="font-size: 11px;">Penanggung jawab master barang akan diperbarui ke nama ini.</div>
            </div>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="form-label-custom">Keterangan / Alasan Mutasi</label>
            <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Pemindahan ruang kerja divisi, pemenuhan kebutuhan operasional, dll..."></textarea>
            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('mutasi.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark" id="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Transaksi Mutasi
            </button>
        </div>
    </form>
</div>

<!-- Modal Scanner QR Code -->
<div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: 1px solid #e5e5e5; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0" id="scannerModalLabel" style="font-size: 15px;">
                    <i class="fa-solid fa-camera me-1"></i> Scan QR Code Barang untuk Mutasi
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseScanner"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="alert alert-info text-start py-2 px-3 mb-3" style="font-size: 12.5px; border-radius: 6px; border-color: #def7ec; background-color: #f3faf7; color: #03543f;">
                    <i class="fa-solid fa-info-circle me-1"></i> Arahkan kamera pada QR Code barang. Barang dan lokasi asal akan terisi otomatis.
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
        const lokasiAsalDisplay = document.getElementById('lokasi_asal_display');
        const picAsalDisplay = document.getElementById('pic_asal_display');
        const stokAsalDisplay = document.getElementById('stok_asal_display');
        const satuanLabel = document.getElementById('satuan-label');
        const stokInfo = document.getElementById('stok-info');
        const btnSubmit = document.getElementById('btn-submit');

        let maxStok = 0;

        function updateBarangDetails() {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            if (selectedOption && selectedOption.value !== "") {
                const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
                const satuan = selectedOption.getAttribute('data-satuan') || 'unit';
                const lokasi = selectedOption.getAttribute('data-lokasi') || '-';
                const pic = selectedOption.getAttribute('data-pic') || '-';
                
                maxStok = stok;
                satuanLabel.textContent = satuan;
                lokasiAsalDisplay.value = lokasi;
                picAsalDisplay.value = pic;
                stokAsalDisplay.value = `${stok} ${satuan}`;
                stokInfo.innerHTML = `Stok tersedia: <strong>${stok} ${satuan}</strong> (Lokasi saat ini: <strong>${lokasi}</strong>).`;
                jumlahInput.max = stok;
                
                validateStok();
            } else {
                maxStok = 0;
                satuanLabel.textContent = "satuan";
                lokasiAsalDisplay.value = "";
                picAsalDisplay.value = "";
                stokAsalDisplay.value = "";
                stokInfo.textContent = "Pilih barang untuk melihat stok yang dapat dimutasi.";
                jumlahInput.removeAttribute('max');
                btnSubmit.disabled = false;
            }
        }

        barangSelect.addEventListener('change', updateBarangDetails);
        jumlahInput.addEventListener('input', validateStok);

        function validateStok() {
            if (barangSelect.value !== "") {
                const val = parseInt(jumlahInput.value) || 0;
                if (val > maxStok) {
                    jumlahInput.classList.add('is-invalid');
                    stokInfo.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> Jumlah melebihi stok yang tersedia (${maxStok})!</span>`;
                    btnSubmit.disabled = true;
                } else if (val <= 0) {
                    jumlahInput.classList.add('is-invalid');
                    stokInfo.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> Jumlah mutasi minimal 1!</span>`;
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
            updateBarangDetails();
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
                scannerResult.textContent = "Kamera aktif. Silakan arahkan pada QR Code.";
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
                if (kode === decodedText || opt.text.includes(decodedText)) {
                    barangSelect.selectedIndex = i;
                    updateBarangDetails();
                    found = true;
                    break;
                }
            }

            if (found) {
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
