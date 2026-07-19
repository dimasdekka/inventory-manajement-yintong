@extends('layouts.app')

@section('title', 'Detail Supplier')
@section('header_title', 'Informasi Detail Supplier')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('supplier.index') }}">Data Supplier</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Detail: {{ $supplier->kode_supplier }}</span>
@endsection

@section('content')
<div class="card-custom mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
        <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">Data Supplier / Rekanan</h5>
        @if(auth()->user()->role == 'administrator')
            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn-custom btn-custom-sm btn-custom-light">
                <i class="fa-solid fa-pen-to-square"></i> Ubah
            </a>
        @endif
    </div>

    <div class="row g-3" style="font-size: 14px;">
        <div class="col-12 col-md-4">
            <span class="text-muted d-block small uppercase">Kode Supplier</span>
            <strong>{{ $supplier->kode_supplier }}</strong>
        </div>
        <div class="col-12 col-md-8">
            <span class="text-muted d-block small uppercase">Nama Perusahaan / Supplier</span>
            <strong>{{ $supplier->nama_supplier }}</strong>
        </div>
        
        <div class="col-12 col-md-4">
            <span class="text-muted d-block small uppercase">Kontak Person (Sales/PIC)</span>
            <strong>{{ $supplier->kontak_person ?? '-' }}</strong>
        </div>
        <div class="col-6 col-md-4">
            <span class="text-muted d-block small uppercase">No. Telepon / HP</span>
            <strong>{{ $supplier->telepon ?? '-' }}</strong>
        </div>
        <div class="col-6 col-md-4">
            <span class="text-muted d-block small uppercase">Alamat Email</span>
            <strong>{{ $supplier->email ?? '-' }}</strong>
        </div>
        
        <div class="col-12">
            <span class="text-muted d-block small uppercase">Alamat Kantor</span>
            <p class="mt-1 mb-0 text-dark bg-light p-2 rounded" style="white-space: pre-line; min-height: 50px;">{{ $supplier->alamat ?? 'Tidak ada alamat kantor tercantum.' }}</p>
        </div>
    </div>
</div>

<!-- Riwayat Barang Masuk dari Supplier ini -->
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600;">Riwayat Pengiriman Barang Masuk</h5>
    
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Harga Satuan saat Transaksi</th>
                    <th>Total Nilai Transaksi</th>
                    <th>Keterangan</th>
                    <th>Penerima (Petugas)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($supplier->barangMasuk as $bm)
                    <tr>
                        <td class="fw-semibold">{{ $bm->no_transaksi }}</td>
                        <td>{{ $bm->tanggal->format('d-m-Y') }}</td>
                        <td>{{ $bm->barang->kode_barang }}</td>
                        <td>
                            <a href="{{ route('barang.show', $bm->barang_id) }}" class="text-dark fw-semibold" style="text-decoration: none;">
                                {{ $bm->barang->nama_barang }}
                            </a>
                        </td>
                        <td>{{ $bm->jumlah }} {{ $bm->barang->satuan }}</td>
                        <td>Rp {{ number_format($bm->harga_satuan, 0, ',', '.') }}</td>
                        <td class="fw-semibold">Rp {{ number_format($bm->jumlah * $bm->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $bm->keterangan ?? '-' }}</td>
                        <td>{{ $bm->user->nama }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-3">
                            Tidak ada riwayat pengiriman barang masuk dari supplier ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
