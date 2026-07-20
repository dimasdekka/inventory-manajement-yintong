@extends('layouts.app')

@section('title', 'Barang Masuk')
@section('header_title', 'Riwayat Transaksi Barang Masuk')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Barang Masuk</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <!-- Pencarian & Filter -->
        <form action="{{ route('barang-masuk.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div style="min-width: 150px;">
                <input type="date" name="tanggal_mulai" class="form-control form-control-custom w-100" value="{{ request('tanggal_mulai') }}" title="Tanggal Mulai">
            </div>
            
            <div class="d-flex align-items-center text-muted">s/d</div>

            <div style="min-width: 150px;">
                <input type="date" name="tanggal_selesai" class="form-control form-control-custom w-100" value="{{ request('tanggal_selesai') }}" title="Tanggal Selesai">
            </div>
            
            <div style="min-width: 200px;">
                <select name="supplier_id" class="form-select form-control-custom w-100">
                    <option value="">Semua Supplier</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}" {{ request('supplier_id') == $sup->id ? 'selected' : '' }}>
                            {{ $sup->nama_supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>
            
            @if(request()->anyFilled(['tanggal_mulai', 'tanggal_selesai', 'supplier_id']))
                <a href="{{ route('barang-masuk.index') }}" class="btn-custom btn-custom-light">
                    Reset
                </a>
            @endif
        </form>

        <!-- Catat Barang Masuk (Admin & Staff) -->
        @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
            <div>
                <a href="{{ route('barang-masuk.create') }}" class="btn-custom btn-custom-dark">
                    <i class="fa-solid fa-plus"></i> Catat Barang Masuk
                </a>
            </div>
        @endif
    </div>

    <!-- Tabel Riwayat Barang Masuk -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Supplier / Pemasok</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Total Pembelian</th>
                    <th>Keterangan</th>
                    <th>Petugas Penerima</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangMasuk as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                        <td>{{ $item->barang->kode_barang }}</td>
                        <td>
                            <a href="{{ route('barang.show', $item->barang_id) }}" class="text-dark fw-semibold" style="text-decoration: none;">
                                {{ $item->barang->nama_barang }}
                            </a>
                        </td>
                        <td>{{ $item->barang->kategori->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('supplier.show', $item->supplier_id) }}" class="text-dark fw-semibold" style="text-decoration: none;">
                                {{ $item->supplier->nama_supplier }}
                            </a>
                        </td>
                        <td class="fw-semibold text-success">+{{ $item->jumlah }}</td>
                        <td>{{ $item->barang->satuan }}</td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="fw-semibold">Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->nama }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted py-4">
                            Tidak ada riwayat transaksi barang masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $barangMasuk->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
