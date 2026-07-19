@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('header_title', 'Manajemen Pengguna Sistem')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Manajemen Pengguna</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <!-- Pencarian -->
        <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width: 400px;">
            <input type="text" name="search" class="form-control form-control-custom w-100" placeholder="Cari nama atau email..." value="{{ request('search') }}">
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('users.index') }}" class="btn-custom btn-custom-light">Reset</a>
            @endif
        </form>

        <!-- Tambah User -->
        <div>
            <a href="{{ route('users.create') }}" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-user-plus"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 70px;">Foto</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Hak Akses (Role)</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            @if($user->foto)
                                <img src="{{ asset($user->foto) }}" alt="Avatar" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e5e5;">
                            @else
                                <div style="width: 38px; height: 38px; border-radius: 50%; background-color: #eeeeee; border: 1px solid #e5e5e5; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 13px; color: #666666;">
                                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'administrator')
                                <span class="badge-custom badge-dark">Administrator</span>
                            @elseif($user->role == 'staff_gudang')
                                <span class="badge-custom badge-warning">Staff Gudang</span>
                            @else
                                <span class="badge-custom">Pimpinan</span>
                            @endif
                        </td>
                        <td>
                            @if($user->status == 'aktif')
                                <span class="badge-custom badge-success">Aktif</span>
                            @else
                                <span class="badge-custom badge-danger">Non-Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn-custom btn-custom-sm btn-custom-light">
                                    <i class="fa-solid fa-user-pen"></i> Ubah
                                </a>
                                @if($user->id !== auth()->id())
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-danger btn-delete-user" 
                                            data-id="{{ $user->id }}" 
                                            data-nama="{{ $user->nama }}">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                @else
                                    <span class="badge-custom small bg-light text-muted">Sedang Login</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Tidak ada data pengguna ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-body p-4 text-center">
                <i class="fa-solid fa-circle-question text-danger fs-1 mb-3"></i>
                <h5 class="font-outfit mb-2" style="font-weight: 600;">Hapus Pengguna?</h5>
                <p class="text-muted" style="font-size: 13.5px;">Apakah Anda yakin ingin menghapus akun pengguna <strong id="deleteUserNama"></strong>? Anda tidak dapat menghapus akun Anda sendiri.</p>
                
                <form id="deleteUserForm" method="POST">
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
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-user');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
        const deleteForm = document.getElementById('deleteUserForm');
        const deleteNama = document.getElementById('deleteUserNama');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                deleteNama.textContent = nama;
                deleteForm.action = `/users/${id}`;
                deleteModal.show();
            });
        });
    });
</script>
@endsection
