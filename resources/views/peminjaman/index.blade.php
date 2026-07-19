@extends('layouts.app')

@section('title', 'Peminjaman Barang')
@section('header_title', 'Transaksi Peminjaman & Pengembalian')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Peminjaman Barang</span>
@endsection

@section('content')
<!-- Filter Status Quick Links -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-2">
        <a href="{{ route('peminjaman.index') }}" class="btn-custom {{ !request('status') ? 'btn-custom-dark' : 'btn-custom-light' }}">
            Semua Data
        </a>
        <a href="{{ route('peminjaman.index', ['status' => 'dipinjam']) }}" class="btn-custom {{ request('status') == 'dipinjam' ? 'btn-custom-dark' : 'btn-custom-light' }}">
            Sedang Dipinjam
        </a>
        <a href="{{ route('peminjaman.index', ['status' => 'terlambat']) }}" class="btn-custom {{ request('status') == 'terlambat' ? 'btn-custom-dark' : 'btn-custom-light' }}">
            Terlambat Kembali
        </a>
        <a href="{{ route('peminjaman.index', ['status' => 'dikembalikan']) }}" class="btn-custom {{ request('status') == 'dikembalikan' ? 'btn-custom-dark' : 'btn-custom-light' }}">
            Dikembalikan
        </a>
    </div>

    @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
        <a href="{{ route('peminjaman.create') }}" class="btn-custom btn-custom-dark">
            <i class="fa-solid fa-plus"></i> Catat Peminjaman
        </a>
    @endif
</div>

<div class="card-custom">
    <!-- Tabel Peminjaman -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Peminjam</th>
                    <th>Jumlah Pinjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Rencana Kembali</th>
                    <th>Status</th>
                    <th>Realisasi Kembali</th>
                    <th>Petugas Pencatat</th>
                    @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                        <td>
                            <a href="{{ route('barang.show', $item->barang_id) }}" class="text-dark fw-semibold" style="text-decoration: none;">
                                {{ $item->barang->nama_barang }}
                            </a>
                        </td>
                        <td>{{ $item->peminjam->nama }}</td>
                        <td>{{ $item->jumlah }} {{ $item->barang->satuan }}</td>
                        <td>{{ $item->tanggal_pinjam->format('d-m-Y') }}</td>
                        <td>{{ $item->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                        <td>
                            @if($item->status == 'dipinjam')
                                <span class="badge-custom badge-warning">Dipinjam</span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="badge-custom badge-success">Dikembalikan</span>
                            @else
                                <span class="badge-custom badge-danger">Terlambat</span>
                            @endif
                        </td>
                        <td>
                            {{ $item->pengembalian ? $item->pengembalian->tanggal_kembali->format('d-m-Y') : '-' }}
                        </td>
                        <td>{{ $item->user->nama }}</td>
                        @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
                            <td class="text-center">
                                @if(in_array($item->status, ['dipinjam', 'terlambat']))
                                    <button type="button" class="btn-custom btn-custom-sm btn-custom-dark btn-kembalikan-barang" 
                                            data-id="{{ $item->id }}" 
                                            data-no="{{ $item->no_transaksi }}"
                                            data-barang="{{ $item->barang->nama_barang }}"
                                            data-peminjam="{{ $item->peminjam->nama }}"
                                            data-jumlah="{{ $item->jumlah }}"
                                            data-satuan="{{ $item->barang->satuan }}"
                                            data-tgl-pinjam="{{ $item->tanggal_pinjam->format('Y-m-d') }}">
                                        <i class="fa-solid fa-rotate-left"></i> Kembalikan
                                    </button>
                                @else
                                    <span class="text-muted small"><i class="fa-solid fa-circle-check text-success"></i> Selesai</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">
                            Tidak ada transaksi peminjaman ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $peminjaman->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal Form Pengembalian (Kembalikan) -->
@if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
<div class="modal fade" id="kembaliModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; border: 1px solid #e5e5e5; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="modal-header border-bottom">
                <h5 class="modal-title font-outfit" style="font-weight: 600;">Form Pengembalian Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pengembalian.store') }}" method="POST">
                @csrf
                <input type="hidden" id="modal_peminjaman_id" name="peminjaman_id">
                <input type="hidden" id="modal_tanggal_pinjam_raw" name="tanggal_pinjam_raw">

                <div class="modal-body p-4" style="font-size: 14px;">
                    <!-- Ringkasan Transaksi Peminjaman -->
                    <div class="bg-light p-3 rounded mb-4 border">
                        <div class="row g-2">
                            <div class="col-6">
                                <span class="text-muted d-block small">No. Transaksi</span>
                                <strong id="summary_no_transaksi"></strong>
                            </div>
                            <div class="col-6">
                                <span class="text-muted d-block small">Peminjam</span>
                                <strong id="summary_peminjam"></strong>
                            </div>
                            <div class="col-6">
                                <span class="text-muted d-block small">Barang</span>
                                <strong id="summary_barang"></strong>
                            </div>
                            <div class="col-6">
                                <span class="text-muted d-block small">Jumlah Dipinjam</span>
                                <strong id="summary_jumlah"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label-custom">Tanggal Pengembalian <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-custom w-100" id="tanggal_kembali" name="tanggal_kembali" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kondisi_saat_kembali" class="form-label-custom">Kondisi Barang saat Kembali <span class="text-danger">*</span></label>
                        <select class="form-select form-control-custom w-100" id="kondisi_saat_kembali" name="kondisi_saat_kembali" required>
                            <option value="baik" selected>Baik</option>
                            <option value="rusak_ringan">Rusak Ringan</option>
                            <option value="rusak_berat">Rusak Berat</option>
                        </select>
                        <div class="form-text text-muted">Bila kondisi rusak, status kondisi barang master akan terupdate otomatis.</div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label-custom">Keterangan / Catatan Kembali</label>
                        <textarea class="form-control form-control-custom w-100" id="keterangan" name="keterangan" rows="2" placeholder="Catatan opsional..."></textarea>
                    </div>
                </div>
                
                <div class="modal-footer border-top">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-dark"><i class="fa-solid fa-floppy-disk"></i> Simpan Pengembalian</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
@if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kembaliButtons = document.querySelectorAll('.btn-kembalikan-barang');
        const kembaliModal = new bootstrap.Modal(document.getElementById('kembaliModal'));
        
        const modalPeminjamanId = document.getElementById('modal_peminjaman_id');
        const modalTanggalPinjamRaw = document.getElementById('modal_tanggal_pinjam_raw');
        
        const summaryNo = document.getElementById('summary_no_transaksi');
        const summaryPeminjam = document.getElementById('summary_peminjam');
        const summaryBarang = document.getElementById('summary_barang');
        const summaryJumlah = document.getElementById('summary_jumlah');

        kembaliButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const no = this.getAttribute('data-no');
                const barang = this.getAttribute('data-barang');
                const peminjam = this.getAttribute('data-peminjam');
                const jumlah = this.getAttribute('data-jumlah');
                const satuan = this.getAttribute('data-satuan');
                const tglPinjam = this.getAttribute('data-tgl-pinjam');

                modalPeminjamanId.value = id;
                modalTanggalPinjamRaw.value = tglPinjam;
                
                summaryNo.textContent = no;
                summaryPeminjam.textContent = peminjam;
                summaryBarang.textContent = barang;
                summaryJumlah.textContent = `${jumlah} ${satuan}`;

                // Set default tanggal kembali to today
                document.getElementById('tanggal_kembali').value = new Date().toISOString().split('T')[0];

                kembaliModal.show();
            });
        });
    });
</script>
@endif
@endsection
