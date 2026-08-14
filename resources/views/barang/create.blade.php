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
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600; border-bottom: 1px solid var(--border-color); padding-bottom: 12px; color: var(--text-main);">
        <i class="fa-solid fa-folder-plus me-1 text-primary"></i> Form Data Master Barang
    </h5>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        
        <!-- Info Banner Kode Barang Otomatis -->
        <div class="p-3 mb-4 rounded-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2" style="background-color: var(--slate-light); border: 1px solid var(--border-color);">
            <div>
                <div class="fw-bold font-outfit" style="font-size: 13.5px; color: var(--navy-primary);">
                    <i class="fa-solid fa-barcode me-1 text-primary"></i> Format Kode Barang Hierarkis:
                </div>
                <div class="text-muted small">Kode barang & QR Code dibuat otomatis berdasarkan <strong>Kategori</strong> & <strong>Golongan</strong> yang dipilih.</div>
            </div>
            <div>
                <span class="badge px-3 py-2" id="preview-kode-badge" style="background-color: var(--navy-primary); color: #ffffff; font-family: monospace; font-size: 13px; letter-spacing: 1px;">
                    [ Pilih Kategori & Golongan ]
                </span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="nama_barang" class="form-label-custom">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Buku Tulis Sinar Dunia / Pulpen Gel 0.5" required>
                @error('nama_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="kategori_id" class="form-label-custom">Kategori Barang <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        @php
                            $namaKat = strtoupper($kat->nama_kategori);
                            $pfx = 'BRG';
                            if (str_contains($namaKat, 'ATK') || str_contains($namaKat, 'TULIS')) $pfx = 'ATK';
                            elseif (str_contains($namaKat, 'KENDARAAN') || str_contains($namaKat, 'MOTOR') || str_contains($namaKat, 'MOBIL')) $pfx = 'KND';
                            elseif (str_contains($namaKat, 'ELEKTRONIK') || str_contains($namaKat, 'LAPTOP') || str_contains($namaKat, 'KOMPUTER')) $pfx = 'ELK';
                            elseif (str_contains($namaKat, 'PERALATAN') || str_contains($namaKat, 'PERKAKAS') || str_contains($namaKat, 'ALAT')) $pfx = 'PRK';
                            elseif (str_contains($namaKat, 'MESS') || str_contains($namaKat, 'KARYAWAN')) $pfx = 'MSS';
                        @endphp
                        <option value="{{ $kat->id }}" data-prefix="{{ $pfx }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }} ({{ $pfx }})
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-3">
                <label for="golongan_id" class="form-label-custom">Golongan / Jenis Barang</label>
                <select class="form-select form-control-custom w-100 @error('golongan_id') is-invalid @enderror" id="golongan_id" name="golongan_id">
                    <option value="">-- Pilih Golongan --</option>
                    @foreach($golongan as $gol)
                        <option value="{{ $gol->id }}" 
                                data-kategori-id="{{ $gol->kategori_id }}"
                                data-kode="{{ $gol->kode_golongan }}"
                                {{ old('golongan_id') == $gol->id ? 'selected' : '' }}>
                            {{ $gol->nama_golongan }} ({{ $gol->kode_golongan }})
                        </option>
                    @endforeach
                </select>
                @error('golongan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text text-muted" style="font-size: 11px;">Pilihan menyesuaikan kategori di samping.</div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
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

            <div class="col-12 col-md-4">
                <label for="merek" class="form-label-custom">Merek Barang (Opsional)</label>
                <input type="text" class="form-control form-control-custom w-100 @error('merek') is-invalid @enderror" id="merek" name="merek" value="{{ old('merek') }}" placeholder="Contoh: Sinar Dunia, Honda, ASUS">
                @error('merek')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="satuan" class="form-label-custom">Satuan Hitung <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan', 'unit') }}" placeholder="Contoh: pcs, buah, unit, box, rim" required>
                @error('satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="kondisi_barang" class="form-label-custom">Kondisi Barang <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100 @error('kondisi_barang') is-invalid @enderror" id="kondisi_barang" name="kondisi_barang" required>
                    <option value="baik" {{ old('kondisi_barang') == 'baik' ? 'selected' : '' }}>Baik / Normal</option>
                    <option value="rusak_ringan" {{ old('kondisi_barang') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ old('kondisi_barang') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="lokasi_penyimpanan" class="form-label-custom">Lokasi Penyimpanan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom w-100 @error('lokasi_penyimpanan') is-invalid @enderror" id="lokasi_penyimpanan" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') }}" placeholder="Contoh: Rak A-01, Gudang Utama" required>
                @error('lokasi_penyimpanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="pic" class="form-label-custom">Penanggung Jawab (PIC)</label>
                <input type="text" class="form-control form-control-custom w-100 @error('pic') is-invalid @enderror" id="pic" name="pic" value="{{ old('pic') }}" placeholder="Contoh: Nurul Faoziah">
                @error('pic')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <label for="tanggal_masuk" class="form-label-custom">Tanggal Registrasi <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-custom w-100 @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="harga_satuan" class="form-label-custom">Estimasi Harga Satuan (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-custom w-100 @error('harga_satuan') is-invalid @enderror" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan', 0) }}" min="0" required>
                @error('harga_satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-4">
                <label for="stok_minimum" class="form-label-custom">Batas Minimum Stok (Alert) <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-custom w-100 @error('stok_minimum') is-invalid @enderror" id="stok_minimum" name="stok_minimum" value="{{ old('stok_minimum', 5) }}" min="0" required>
                @error('stok_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label for="spesifikasi" class="form-label-custom">Spesifikasi Detail</label>
                <textarea class="form-control form-control-custom w-100 @error('spesifikasi') is-invalid @enderror" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Contoh: Warna hitam, ukuran folio, bahan plastik..."></textarea>
                @error('spesifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="keterangan" class="form-label-custom">Catatan Tambahan</label>
                <textarea class="form-control form-control-custom w-100 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Informasi pendukung lainnya..."></textarea>
                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            <a href="{{ route('barang.index') }}" class="btn-custom btn-custom-light">Batal</a>
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data Barang
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.getElementById('kategori_id');
        const golonganSelect = document.getElementById('golongan_id');
        const badgePreview = document.getElementById('preview-kode-badge');

        const allGolonganOptions = Array.from(golonganSelect.querySelectorAll('option[data-kategori-id]'));

        function filterGolongan() {
            const selectedKatId = kategoriSelect.value;
            const currentGolVal = golonganSelect.value;

            // Reset options
            golonganSelect.innerHTML = '<option value="">-- Pilih Golongan / Jenis --</option>';

            if (selectedKatId) {
                const filtered = allGolonganOptions.filter(opt => opt.getAttribute('data-kategori-id') === selectedKatId);
                
                filtered.forEach(opt => {
                    const clone = opt.cloneNode(true);
                    if (clone.value === currentGolVal) {
                        clone.selected = true;
                    }
                    golonganSelect.appendChild(clone);
                });
            }

            updateCodePreview();
        }

        function updateCodePreview() {
            const selectedKatOpt = kategoriSelect.options[kategoriSelect.selectedIndex];
            const selectedGolOpt = golonganSelect.options[golonganSelect.selectedIndex];

            let katPrefix = selectedKatOpt && selectedKatOpt.getAttribute('data-prefix') ? selectedKatOpt.getAttribute('data-prefix') : 'BRG';
            let golPrefix = selectedGolOpt && selectedGolOpt.getAttribute('data-kode') ? '-' + selectedGolOpt.getAttribute('data-kode') : '';

            if (kategoriSelect.value) {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                badgePreview.textContent = `${katPrefix}${golPrefix}-${year}${month}-XXXX`;
            } else {
                badgePreview.textContent = '[ Pilih Kategori & Golongan ]';
            }
        }

        kategoriSelect.addEventListener('change', filterGolongan);
        golonganSelect.addEventListener('change', updateCodePreview);

        // Initial setup
        if (kategoriSelect.value) {
            filterGolongan();
        }
    });
</script>
@endsection
