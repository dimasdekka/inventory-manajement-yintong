@extends('layouts.app')

@section('title', 'Data Supplier')
@section('header_title', 'Master Data Supplier')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Data Supplier</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <!-- Pencarian -->
        <form action="{{ route('supplier.index') }}" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width: 400px;">
            <input type="text" name="search" class="form-control form-control-custom w-100" placeholder="Cari kode, nama, atau kontak..." value="{{ request('search') }}">
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('supplier.index') }}" class="btn-custom btn-custom-light">Reset</a>
            @endif
        </form>

        <!-- Tambah Supplier (Admin only) -->
        @if(auth()->user()->role == 'administrator')
            <div>
                <a href="{{ route('supplier.create') }}" class="btn-custom btn-custom-dark">
                    <i class="fa-solid fa-plus"></i> Tambah Supplier
                </a>
            </div>
        @endif
    </div>

    <!-- Tabel Supplier -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Kontak Person</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($supplier as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->kode_supplier }}</td>
                        <td>{{ $item->nama_supplier }}</td>
                        <td>{{ $item->kontak_person ?? '-' }}</td>
                        <td>{{ $item->telepon ?? '-' }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('supplier.show', $item->id) }}" class="btn-custom btn-custom-sm btn-custom-light" title="Detail & Riwayat Transaksi">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if(auth()->user()->role == 'administrator')
                                    <a href="{{ route('supplier.edit', $item->id) }}" class="btn-custom btn-custom-sm btn-custom-light" title="Ubah">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-danger btn-delete-supplier" 
                                            data-id="{{ $item->id }}" 
                                            data-nama="{{ $item->nama_supplier }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Tidak ada data supplier ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $supplier->links('pagination::bootstrap-5') }}
    </div>
</div>

@if(auth()->user()->role == 'administrator')
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-body p-4 text-center">
                <i class="fa-solid fa-circle-question text-danger fs-1 mb-3"></i>
                <h5 class="font-outfit mb-2" style="font-weight: 600;">Hapus Supplier?</h5>
                <p class="text-muted" style="font-size: 13.5px;">Apakah Anda yakin ingin menghapus supplier <strong id="deleteSupplierNama"></strong>? Supplier yang masih terikat transaksi aktif tidak dapat dihapus.</p>
                
                <form id="deleteSupplierForm" method="POST">
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
        const deleteButtons = document.querySelectorAll('.btn-delete-supplier');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteSupplierModal'));
        const deleteForm = document.getElementById('deleteSupplierForm');
        const deleteNama = document.getElementById('deleteSupplierNama');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                deleteNama.textContent = nama;
                deleteForm.action = `/supplier/${id}`;
                deleteModal.show();
            });
        });
    });
</script>
@endif
@endsection
