@extends('layouts.app')

@section('title', 'Mutasi Lokasi')
@section('header_title', 'Riwayat Mutasi Lokasi Barang')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Mutasi Barang</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <!-- Pencarian & Filter -->
        <form action="{{ route('mutasi.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div style="min-width: 150px;">
                <input type="date" name="tanggal_mulai" class="form-control form-control-custom w-100" value="{{ request('tanggal_mulai') }}" title="Tanggal Mulai">
            </div>
            
            <div class="d-flex align-items-center text-muted">s/d</div>

            <div style="min-width: 150px;">
                <input type="date" name="tanggal_selesai" class="form-control form-control-custom w-100" value="{{ request('tanggal_selesai') }}" title="Tanggal Selesai">
            </div>
            
            <div style="min-width: 200px;">
                <select name="barang_id" class="form-select form-control-custom w-100">
                    <option value="">Semua Barang</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" {{ request('barang_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->kode_barang }} - {{ $item->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>
            
            @if(request()->anyFilled(['tanggal_mulai', 'tanggal_selesai', 'barang_id']))
                <a href="{{ route('mutasi.index') }}" class="btn-custom btn-custom-light">
                    Reset
                </a>
            @endif
        </form>

        <!-- Catat Mutasi (Admin & Staff) -->
        @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
            <div>
                <a href="{{ route('mutasi.create') }}" class="btn-custom btn-custom-dark">
                    <i class="fa-solid fa-plus"></i> Mutasikan Barang
                </a>
            </div>
        @endif
    </div>

    <!-- Tabel Riwayat Mutasi -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Mutasi</th>
                    <th>Lokasi Asal</th>
                    <th>Lokasi Baru (Tujuan)</th>
                    <th>PIC Asal</th>
                    <th>PIC Baru (Tujuan)</th>
                    <th>Keterangan</th>
                    <th>Petugas Pencatat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mutasi as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                        <td>{{ $item->barang->kode_barang }}</td>
                        <td>
                            <a href="{{ route('barang.show', $item->barang_id) }}" class="text-dark fw-semibold" style="text-decoration: none;">
                                {{ $item->barang->nama_barang }}
                            </a>
                        </td>
                        <td>{{ $item->jumlah }} {{ $item->barang->satuan }}</td>
                        <td>{{ $item->lokasi_asal }}</td>
                        <td class="fw-bold">{{ $item->lokasi_tujuan }}</td>
                        <td>{{ $item->pic_asal ?? '-' }}</td>
                        <td class="fw-bold">{{ $item->pic_tujuan ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->nama }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            Tidak ada riwayat transaksi mutasi lokasi barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $mutasi->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
