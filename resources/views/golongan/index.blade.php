@extends('layouts.app')

@section('title', 'Golongan / Jenis Barang')
@section('header_title', 'Master Golongan & Mapping Kode Barang')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Golongan Barang</span>
@endsection

@section('content')
<div class="card-custom">
    <!-- Header Controls & Filters -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <form action="{{ route('golongan.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div style="min-width: 220px;">
                <select name="kategori_id" class="form-select form-control-custom w-100" onchange="this.form.submit()">
                    <option value="">-- Semua Kategori Induk --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }} ({{ $kat->kode_kategori }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="min-width: 220px;">
                <input type="text" name="search" class="form-control form-control-custom w-100" placeholder="Cari golongan / kode..." value="{{ request('search') }}">
            </div>

            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>

            @if(request()->anyFilled(['kategori_id', 'search']))
                <a href="{{ route('golongan.index') }}" class="btn-custom btn-custom-light">
                    Reset
                </a>
            @endif
        </form>

        @if(auth()->user()->role == 'administrator')
            <div>
                <button type="button" class="btn-custom btn-custom-dark text-nowrap" data-bs-toggle="modal" data-bs-target="#createGolonganModal">
                    <i class="fa-solid fa-plus"></i> Tambah Golongan Barang
                </button>
            </div>
        @endif
    </div>

    <!-- Tabel Data Golongan -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Kategori Induk</th>
                    <th>Kode Golongan (Prefix)</th>
                    <th>Nama Golongan / Jenis Barang</th>
                    <th>Contoh Format Kode</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                    @if(auth()->user()->role == 'administrator')
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($golongan as $index => $item)
                    @php
                        $katPrefix = 'BRG';
                        if ($item->kategori) {
                            $namaKat = strtoupper($item->kategori->nama_kategori);
                            if (str_contains($namaKat, 'ATK') || str_contains($namaKat, 'TULIS')) $katPrefix = 'ATK';
                            elseif (str_contains($namaKat, 'KENDARAAN') || str_contains($namaKat, 'MOTOR') || str_contains($namaKat, 'MOBIL')) $katPrefix = 'KND';
                            elseif (str_contains($namaKat, 'ELEKTRONIK') || str_contains($namaKat, 'LAPTOP') || str_contains($namaKat, 'KOMPUTER')) $katPrefix = 'ELK';
                            elseif (str_contains($namaKat, 'PERALATAN') || str_contains($namaKat, 'PERKAKAS') || str_contains($namaKat, 'ALAT')) $katPrefix = 'PRK';
                            elseif (str_contains($namaKat, 'MESS') || str_contains($namaKat, 'KARYAWAN')) $katPrefix = 'MSS';
                            else {
                                $clean = preg_replace('/[^A-Z]/', '', $namaKat);
                                $katPrefix = (strlen($clean) >= 3) ? substr($clean, 0, 3) : 'BRG';
                            }
                        }
                        $sampleCode = $katPrefix . '-' . $item->kode_golongan . '-' . date('Ym') . '-0001';
                    @endphp
                    <tr>
                        <td class="text-muted">{{ $golongan->firstItem() + $index }}</td>
                        <td>
                            <span class="badge-custom badge-success fw-semibold">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-custom" style="background-color: var(--navy-primary); color: #ffffff; font-family: monospace; font-size: 12px; letter-spacing: 1px;">
                                {{ $item->kode_golongan }}
                            </span>
                        </td>
                        <td class="fw-bold" style="color: var(--text-main);">{{ $item->nama_golongan }}</td>
                        <td>
                            <code class="px-2 py-1 rounded" style="background-color: var(--slate-light); color: var(--navy-primary); font-size: 11.5px; border: 1px solid var(--border-color);">
                                {{ $sampleCode }}
                            </code>
                        </td>
                        <td>
                            <span class="badge-custom badge-light">
                                {{ $item->barang->count() }} unit barang
                            </span>
                        </td>
                        <td class="text-muted" style="font-size: 12.5px;">{{ $item->keterangan ?? '-' }}</td>
                        @if(auth()->user()->role == 'administrator')
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-light btn-edit-golongan" 
                                            data-id="{{ $item->id }}" 
                                            data-kategori-id="{{ $item->kategori_id }}"
                                            data-kode="{{ $item->kode_golongan }}"
                                            data-nama="{{ $item->nama_golongan }}" 
                                            data-keterangan="{{ $item->keterangan }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Ubah
                                    </button>
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-danger btn-delete-golongan" 
                                            data-id="{{ $item->id }}" 
                                            data-nama="{{ $item->nama_golongan }}">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'administrator' ? 8 : 7 }}" class="text-center text-muted py-4">
                            Belum ada data golongan barang yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $golongan->links('pagination::bootstrap-5') }}
    </div>
</div>

@if(auth()->user()->role == 'administrator')
<!-- Modal Tambah Golongan -->
<div class="modal fade" id="createGolonganModal" tabindex="-1" aria-labelledby="createGolonganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0" id="createGolonganModalLabel">
                    <i class="fa-solid fa-layer-group me-1 text-primary"></i> Tambah Golongan / Jenis Barang
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('golongan.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="kategori_id_create" class="form-label-custom">Kategori Induk <span class="text-danger">*</span></label>
                        <select class="form-select form-control-custom w-100" id="kategori_id_create" name="kategori_id" required>
                            <option value="">-- Pilih Kategori Induk --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }} ({{ $kat->kode_kategori }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kode_golongan_create" class="form-label-custom">Kode Golongan (Singkatan Prefix) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="kode_golongan_create" name="kode_golongan" value="{{ old('kode_golongan') }}" placeholder="Contoh: BKU, PLP, KTS, LPT, AC, MTR" style="text-transform: uppercase;" maxlength="10" required>
                        <div class="form-text text-muted" style="font-size: 11.5px;">Gunakan 2 - 4 huruf kapital (tanpa spasi/simbol) untuk prefix kode barang.</div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_golongan_create" class="form-label-custom">Nama Golongan / Jenis Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="nama_golongan_create" name="nama_golongan" value="{{ old('nama_golongan') }}" placeholder="Contoh: Buku & Agenda, Pulpen Gel, Laptop" required>
                    </div>

                    <div class="mb-2">
                        <label for="keterangan_create" class="form-label-custom">Keterangan (Opsional)</label>
                        <textarea class="form-control form-control-custom w-100" id="keterangan_create" name="keterangan" rows="2" placeholder="Deskripsi jenis/golongan barang ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color); padding: 12px 20px;">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-dark">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Golongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Golongan -->
<div class="modal fade" id="editGolonganModal" tabindex="-1" aria-labelledby="editGolonganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0" id="editGolonganModalLabel">
                    <i class="fa-solid fa-pen-to-square me-1 text-primary"></i> Ubah Golongan Barang
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditGolongan" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="kategori_id_edit" class="form-label-custom">Kategori Induk <span class="text-danger">*</span></label>
                        <select class="form-select form-control-custom w-100" id="kategori_id_edit" name="kategori_id" required>
                            <option value="">-- Pilih Kategori Induk --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }} ({{ $kat->kode_kategori }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kode_golongan_edit" class="form-label-custom">Kode Golongan (Singkatan Prefix) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="kode_golongan_edit" name="kode_golongan" style="text-transform: uppercase;" maxlength="10" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_golongan_edit" class="form-label-custom">Nama Golongan / Jenis Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="nama_golongan_edit" name="nama_golongan" required>
                    </div>

                    <div class="mb-2">
                        <label for="keterangan_edit" class="form-label-custom">Keterangan (Opsional)</label>
                        <textarea class="form-control form-control-custom w-100" id="keterangan_edit" name="keterangan" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color); padding: 12px 20px;">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-dark">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Golongan -->
<div class="modal fade" id="deleteGolonganModal" tabindex="-1" aria-labelledby="deleteGolonganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0 text-danger" id="deleteGolonganModalLabel">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Konfirmasi Hapus Golongan
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDeleteGolongan" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body p-4 text-center">
                    <p class="mb-2" style="font-size: 14px;">Apakah Anda yakin ingin menghapus golongan barang ini?</p>
                    <strong class="font-outfit fs-5 text-dark d-block mb-3" id="deleteGolonganName"></strong>
                    <div class="alert alert-warning text-start p-2 mb-0" style="font-size: 12px; border-radius: 8px;">
                        <i class="fa-solid fa-circle-info me-1"></i> Golongan yang sudah memiliki relasi data barang aktif tidak dapat dihapus.
                    </div>
                </div>
                <div class="modal-footer justify-content-center" style="border-top: 1px solid var(--border-color); padding: 12px 20px;">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-danger">
                        <i class="fa-solid fa-trash-can"></i> Ya, Hapus Golongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Golongan Modal Handler
        const editButtons = document.querySelectorAll('.btn-edit-golongan');
        const formEdit = document.getElementById('formEditGolongan');
        const kategoriEdit = document.getElementById('kategori_id_edit');
        const kodeEdit = document.getElementById('kode_golongan_edit');
        const namaEdit = document.getElementById('nama_golongan_edit');
        const keteranganEdit = document.getElementById('keterangan_edit');
        const editModal = new bootstrap.Modal(document.getElementById('editGolonganModal'));

        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const katId = this.getAttribute('data-kategori-id');
                const kode = this.getAttribute('data-kode');
                const nama = this.getAttribute('data-nama');
                const ket = this.getAttribute('data-keterangan');

                formEdit.action = `/golongan/${id}`;
                kategoriEdit.value = katId;
                kodeEdit.value = kode;
                namaEdit.value = nama;
                keteranganEdit.value = ket || '';

                editModal.show();
            });
        });

        // Delete Golongan Modal Handler
        const deleteButtons = document.querySelectorAll('.btn-delete-golongan');
        const formDelete = document.getElementById('formDeleteGolongan');
        const deleteGolonganName = document.getElementById('deleteGolonganName');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteGolonganModal'));

        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                formDelete.action = `/golongan/${id}`;
                deleteGolonganName.textContent = nama;

                deleteModal.show();
            });
        });
    });
</script>
@endsection
