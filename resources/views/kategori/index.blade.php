@extends('layouts.app')

@section('title', 'Kategori Barang')
@section('header_title', 'Data Kategori Barang')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Kategori Barang</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">Daftar Kategori</h5>
        @if(auth()->user()->role == 'administrator')
            <button type="button" class="btn-custom btn-custom-dark" data-bs-toggle="modal" data-bs-target="#createKategoriModal">
                <i class="fa-solid fa-plus"></i> Tambah Kategori
            </button>
        @endif
    </div>

    <!-- Tabel Kategori -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Jenis Barang</th>
                    <th>Keterangan</th>
                    @if(auth()->user()->role == 'administrator')
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $item)
                    <tr>
                        <td class="fw-bold">
                            <span class="badge px-2 py-1" style="background-color: var(--navy-primary); color: #ffffff; font-family: monospace; font-size: 12px; letter-spacing: 0.5px;">
                                {{ $item->kode_kategori }}
                            </span>
                        </td>
                        <td class="fw-semibold">{{ $item->nama_kategori }}</td>
                        <td>
                            <span class="badge-custom badge-light">
                                {{ $item->barang_count }} barang
                            </span>
                        </td>
                        <td class="text-muted" style="font-size: 13px;">{{ $item->keterangan ?? '-' }}</td>
                        @if(auth()->user()->role == 'administrator')
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-light btn-edit-kategori" 
                                            data-id="{{ $item->id }}" 
                                            data-kode="{{ $item->kode_kategori }}"
                                            data-nama="{{ $item->nama_kategori }}" 
                                            data-keterangan="{{ $item->keterangan }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Ubah
                                    </button>
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-danger btn-delete-kategori" 
                                            data-id="{{ $item->id }}" 
                                            data-nama="{{ $item->nama_kategori }}">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'administrator' ? 5 : 4 }}" class="text-center text-muted py-4">
                            Belum ada data kategori yang tersimpan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $kategori->links('pagination::bootstrap-5') }}
    </div>
</div>

@if(auth()->user()->role == 'administrator')
<!-- Modal Tambah Kategori -->
<div class="modal fade" id="createKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0" style="font-size: 15px;">
                    <i class="fa-solid fa-folder-plus me-1 text-primary"></i> Tambah Kategori Baru
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="kode_kategori" class="form-label-custom">Kode Kategori (Dapat Dicustom / Diubah)</label>
                        <input type="text" class="form-control form-control-custom w-100" id="kode_kategori" name="kode_kategori" placeholder="Contoh: ATK, ELK, KND, PRK, KTG-001" style="text-transform: uppercase;" maxlength="20">
                        <div class="form-text text-muted" style="font-size: 11.5px;">Bisa diisi kode kustom (misal: <strong>ATK</strong>, <strong>ELK</strong>, <strong>KND</strong>) atau <em>kosongkan</em> jika ingin otomatis dibuatkan <strong>KTG-001</strong>.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label-custom">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="nama_kategori" name="nama_kategori" placeholder="Contoh: Alat Tulis Kantor" required>
                    </div>

                    <div class="mb-2">
                        <label for="keterangan" class="form-label-custom">Keterangan (Opsional)</label>
                        <textarea class="form-control form-control-custom w-100" id="keterangan" name="keterangan" rows="3" placeholder="Deskripsi kategori..."></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color); padding: 12px 20px;">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-dark">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0" style="font-size: 15px;">
                    <i class="fa-solid fa-pen-to-square me-1 text-primary"></i> Ubah Kategori
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKategoriForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit_kode_kategori" class="form-label-custom">Kode Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="edit_kode_kategori" name="kode_kategori" placeholder="Contoh: ATK, ELK, KTG-001" style="text-transform: uppercase;" maxlength="20" required>
                        <div class="form-text text-muted" style="font-size: 11.5px;">Anda bebas mengubah format kode kategori ini sesuai keinginan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama_kategori" class="form-label-custom">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="edit_nama_kategori" name="nama_kategori" required>
                    </div>

                    <div class="mb-2">
                        <label for="edit_keterangan" class="form-label-custom">Keterangan</label>
                        <textarea class="form-control form-control-custom w-100" id="edit_keterangan" name="keterangan" rows="3"></textarea>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 16px 20px;">
                <h6 class="modal-title font-outfit fw-bold m-0 text-danger" style="font-size: 15px;">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Hapus Kategori?
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="text-muted mb-2" style="font-size: 13.5px;">Apakah Anda yakin ingin menghapus kategori <strong id="deleteKategoriNama" class="text-dark"></strong>?</p>
                <div class="alert alert-warning text-start p-2 mb-0" style="font-size: 11.5px; border-radius: 8px;">
                    <i class="fa-solid fa-circle-info me-1"></i> Kategori yang masih terikat data barang tidak dapat dihapus.
                </div>
            </div>
            <div class="modal-footer justify-content-center" style="border-top: 1px solid var(--border-color); padding: 12px 20px;">
                <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                <form id="deleteKategoriForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-custom btn-custom-danger">
                        <i class="fa-solid fa-trash-can"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
@if(auth()->user()->role == 'administrator')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Modal Trigger Setup
        const editButtons = document.querySelectorAll('.btn-edit-kategori');
        const editModal = new bootstrap.Modal(document.getElementById('editKategoriModal'));
        const editForm = document.getElementById('editKategoriForm');
        const editKode = document.getElementById('edit_kode_kategori');
        const editNama = document.getElementById('edit_nama_kategori');
        const editKeterangan = document.getElementById('edit_keterangan');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const kode = this.getAttribute('data-kode');
                const nama = this.getAttribute('data-nama');
                const keterangan = this.getAttribute('data-keterangan');

                editKode.value = kode || '';
                editNama.value = nama;
                editKeterangan.value = keterangan || '';
                editForm.action = `/kategori/${id}`;
                editModal.show();
            });
        });

        // Delete Modal Trigger Setup
        const deleteButtons = document.querySelectorAll('.btn-delete-kategori');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteKategoriModal'));
        const deleteForm = document.getElementById('deleteKategoriForm');
        const deleteNama = document.getElementById('deleteKategoriNama');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                deleteNama.textContent = nama;
                deleteForm.action = `/kategori/${id}`;
                deleteModal.show();
            });
        });
    });
</script>
@endif
@endsection
