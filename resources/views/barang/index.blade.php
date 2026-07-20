@extends('layouts.app')

@section('title', 'Data Barang')
@section('header_title', 'Master Data Barang')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Data Barang</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <!-- Pencarian & Filter -->
        <form action="{{ route('barang.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div style="min-width: 200px; max-width: 300px;" class="flex-grow-1">
                <input type="text" name="search" class="form-control form-control-custom w-100" placeholder="Cari nama atau kode barang..." value="{{ request('search') }}">
            </div>
            
            <div style="min-width: 150px;">
                <select name="kategori_id" class="form-select form-control-custom w-100">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="min-width: 150px;">
                <select name="lokasi" class="form-select form-control-custom w-100">
                    <option value="">Semua Lokasi</option>
                    @foreach($lokasi as $lok)
                        @if($lok)
                            <option value="{{ $lok }}" {{ request('lok') == $lok ? 'selected' : '' }}>
                                {{ $lok }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>
            
            @if(request()->anyFilled(['search', 'kategori_id', 'lokasi']))
                <a href="{{ route('barang.index') }}" class="btn-custom btn-custom-light">
                    Reset
                </a>
            @endif
        </form>

        <!-- Tambah Barang (Hanya Admin dan Staff) -->
        @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
            <div>
                <a href="{{ route('barang.create') }}" class="btn-custom btn-custom-dark">
                    <i class="fa-solid fa-plus"></i> Tambah Barang
                </a>
            </div>
        @endif
    </div>

    <!-- Tabel Master Barang -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Lokasi Penyimpanan</th>
                    <th>Kondisi</th>
                    <th>Harga Satuan</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>
                            @if($item->jumlah <= $item->stok_minimum)
                                <span class="text-danger fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $item->jumlah }}</span>
                            @else
                                <span class="fw-semibold">{{ $item->jumlah }}</span>
                            @endif
                        </td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->lokasi_penyimpanan }}</td>
                        <td>
                            @if($item->kondisi_barang == 'baik')
                                <span class="badge-custom badge-success">Baik</span>
                            @elseif($item->kondisi_barang == 'rusak_ringan')
                                <span class="badge-custom badge-warning">Rusak Ringan</span>
                            @else
                                <span class="badge-custom badge-danger">Rusak Berat</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('barang.show', $item->id) }}" class="btn-custom btn-custom-sm btn-custom-light" title="Detail / Riwayat">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                
                                @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
                                    <a href="{{ route('barang.edit', $item->id) }}" class="btn-custom btn-custom-sm btn-custom-light" title="Ubah">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endif

                                @if(auth()->user()->role == 'administrator')
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-danger btn-delete-barang" data-id="{{ $item->id }}" data-nama="{{ $item->nama_barang }}" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Tidak ada data barang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $barang->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
@if(auth()->user()->role == 'administrator')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-body p-4 text-center">
                <i class="fa-solid fa-circle-question text-danger fs-1 mb-3"></i>
                <h5 class="font-outfit mb-2" style="font-weight: 600;">Hapus Data Barang?</h5>
                <p class="text-muted" style="font-size: 13.5px;">Apakah Anda yakin ingin menghapus barang <strong id="deleteBarangNama"></strong>? Tindakan ini tidak bisa dibatalkan.</p>
                
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
        const deleteButtons = document.querySelectorAll('.btn-delete-barang');
        if (deleteButtons.length > 0) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteBarangNama = document.getElementById('deleteBarangNama');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    
                    deleteBarangNama.textContent = nama;
                    deleteForm.action = `/barang/${id}`;
                    deleteModal.show();
                });
            });
        }
    });
</script>
@endsection
