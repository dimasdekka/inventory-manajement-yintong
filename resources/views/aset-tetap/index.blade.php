@extends('layouts.app')

@section('title', 'Aset Tetap (Properti)')
@section('header_title', 'Master Aset Tetap & Properti')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Aset Tetap</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <!-- Pencarian & Filter -->
        <form action="{{ route('aset-tetap.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div style="min-width: 200px; max-width: 300px;" class="flex-grow-1">
                <input type="text" name="search" class="form-control form-control-custom w-100" placeholder="Cari nama, kode, atau PIC..." value="{{ request('search') }}">
            </div>
            
            <div style="min-width: 150px;">
                <select name="tipe" class="form-select form-control-custom w-100">
                    <option value="">-- Semua Tipe --</option>
                    <option value="ruko" {{ request('tipe') == 'ruko' ? 'selected' : '' }}>Ruko</option>
                    <option value="kantor" {{ request('tipe') == 'kantor' ? 'selected' : '' }}>Kantor</option>
                    <option value="mess_karyawan" {{ request('tipe') == 'mess_karyawan' ? 'selected' : '' }}>Mess Karyawan</option>
                </select>
            </div>

            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>
            
            @if(request()->anyFilled(['search', 'tipe']))
                <a href="{{ route('aset-tetap.index') }}" class="btn-custom btn-custom-light">
                    Reset
                </a>
            @endif
        </form>

        <!-- Tambah Aset Tetap (Hanya Admin dan Staff) -->
        @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
            <div>
                <a href="{{ route('aset-tetap.create') }}" class="btn-custom btn-custom-dark">
                    <i class="fa-solid fa-plus"></i> Tambah Aset Tetap
                </a>
            </div>
        @endif
    </div>

    <!-- Tabel Master Aset Tetap -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Nama Aset / Properti</th>
                    <th>Tipe</th>
                    <th>Alamat</th>
                    <th>Luas Tanah / Bangunan</th>
                    <th>Tanggal Perolehan</th>
                    <th>Nilai Perolehan</th>
                    <th>Status Kepemilikan</th>
                    <th>Kondisi Bangunan</th>
                    <th>PIC</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asetTetap as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->kode_aset }}</td>
                        <td>{{ $item->nama_aset }}</td>
                        <td>
                            @if($item->tipe == 'ruko')
                                <span class="badge-custom">Ruko</span>
                            @elseif($item->tipe == 'kantor')
                                <span class="badge-custom badge-dark">Kantor</span>
                            @else
                                <span class="badge-custom badge-warning">Mess Karyawan</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->alamat, 40) }}</td>
                        <td>{{ $item->luas_tanah }} m² / {{ $item->luas_bangunan }} m²</td>
                        <td>{{ $item->tanggal_perolehan->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                        <td>
                            @if($item->status_kepemilikan == 'milik_sendiri')
                                <span class="badge-custom badge-success">Milik Sendiri</span>
                            @else
                                <span class="badge-custom badge-warning">Sewa</span>
                            @endif
                        </td>
                        <td>
                            @if($item->kondisi_bangunan == 'baik')
                                <span class="badge-custom badge-success">Baik</span>
                            @elseif($item->kondisi_bangunan == 'perlu_perbaikan')
                                <span class="badge-custom badge-warning">Perlu Perbaikan</span>
                            @else
                                <span class="badge-custom badge-danger">Rusak Berat</span>
                            @endif
                        </td>
                        <td>{{ $item->pic }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('aset-tetap.show', $item->id) }}" class="btn-custom btn-custom-sm btn-custom-light" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                
                                @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
                                    <a href="{{ route('aset-tetap.edit', $item->id) }}" class="btn-custom btn-custom-sm btn-custom-light" title="Ubah">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endif

                                @if(auth()->user()->role == 'administrator')
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-danger btn-delete-aset" data-id="{{ $item->id }}" data-nama="{{ $item->nama_aset }}" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            Tidak ada data aset tetap ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $asetTetap->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
@if(auth()->user()->role == 'administrator')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-body p-4 text-center">
                <i class="fa-solid fa-circle-question text-danger fs-1 mb-3"></i>
                <h5 class="font-outfit mb-2" style="font-weight: 600;">Hapus Aset Tetap?</h5>
                <p class="text-muted" style="font-size: 13.5px;">Apakah Anda yakin ingin menghapus properti <strong id="deleteAsetNama"></strong>? Tindakan ini tidak bisa dibatalkan.</p>
                
                <form id="deleteForm" method="POST">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-aset');
        if (deleteButtons.length > 0) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteAsetNama = document.getElementById('deleteAsetNama');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    
                    deleteAsetNama.textContent = nama;
                    deleteForm.action = `/aset-tetap/${id}`;
                    deleteModal.show();
                });
            });
        }
    });
</script>
@endsection
