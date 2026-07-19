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
                        <td class="fw-semibold">{{ $item->kode_kategori }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->barang_count }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        @if(auth()->user()->role == 'administrator')
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-light btn-edit-kategori" 
                                            data-id="{{ $item->id }}" 
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
                        <td colspan="5" class="text-center text-muted py-4">
                            Tidak ada data kategori ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $kategori->links('pagination::bootstrap-5') }}
    </div>
</div>

@if(auth()->user()->role == 'administrator')
<!-- Modal Tambah Kategori -->
<div class="modal fade" id="createKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-header border-bottom">
                <h5 class="modal-title font-outfit" style="font-weight: 600;">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label-custom">Kode Kategori</label>
                        <input type="text" class="form-control form-control-custom w-100" value="[ GENERATE OTOMATIS ]" disabled>
                        <div class="form-text text-muted">Format: KTG-001</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label-custom">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="nama_kategori" name="nama_kategori" placeholder="Contoh: Alat Tulis Kantor" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label-custom">Keterangan</label>
                        <textarea class="form-control form-control-custom w-100" id="keterangan" name="keterangan" rows="3" placeholder="Deskripsi kategori..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-dark"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-header border-bottom">
                <h5 class="modal-title font-outfit" style="font-weight: 600;">Ubah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKategoriForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit_nama_kategori" class="form-label-custom">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom w-100" id="edit_nama_kategori" name="nama_kategori" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label-custom">Keterangan</label>
                        <textarea class="form-control form-control-custom w-100" id="edit_keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-dark"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-body p-4 text-center">
                <i class="fa-solid fa-circle-question text-danger fs-1 mb-3"></i>
                <h5 class="font-outfit mb-2" style="font-weight: 600;">Hapus Kategori?</h5>
                <p class="text-muted" style="font-size: 13.5px;">Apakah Anda yakin ingin menghapus kategori <strong id="deleteKategoriNama"></strong>? Kategori yang masih terikat data barang tidak dapat dihapus.</p>
                
                <form id="deleteKategoriForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <button type="button" class="btn-custom btn-custom-light px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-custom btn-custom-dark bg-danger border-danger px-4">Hapus</button>
                    </div>
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
        const editNama = document.getElementById('edit_nama_kategori');
        const editKeterangan = document.getElementById('edit_keterangan');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const keterangan = this.getAttribute('data-keterangan');

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
