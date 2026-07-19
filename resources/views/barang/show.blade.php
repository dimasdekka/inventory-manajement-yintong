@extends('layouts.app')

@section('title', 'Detail Barang')
@section('header_title', 'Informasi Detail Barang')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('barang.index') }}">Data Barang</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Detail: {{ $barang->kode_barang }}</span>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <!-- Panel Kiri: QR Code & Deskripsi Ringkas -->
    <div class="col-12 col-md-4">
        <div class="card-custom text-center py-4">
            <h6 class="font-outfit mb-3" style="font-weight: 600; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px;">Label QR Code</h6>
            
            <div class="mb-3 p-3 bg-light d-inline-block border rounded">
                @if($barang->barcode_path)
                    <img src="{{ asset($barang->barcode_path) }}" alt="QR Code" style="width: 160px; height: 160px;">
                @else
                    <div class="text-muted" style="width: 160px; height: 160px; display: flex; align-items: center; justify-content: center; border: 1px dashed #d5d5d5;">
                        QR Code tidak tersedia
                    </div>
                @endif
            </div>

            <div class="fw-bold mb-1" style="font-family: 'Outfit', sans-serif; font-size: 16px;">{{ $barang->kode_barang }}</div>
            <div class="text-muted small mb-4">{{ $barang->nama_barang }}</div>

            <div class="d-grid gap-2 px-3">
                @if($barang->barcode_path)
                    <a href="{{ asset($barang->barcode_path) }}" download="qrcode_{{ $barang->kode_barang }}.svg" class="btn-custom btn-custom-light justify-content-center">
                        <i class="fa-solid fa-download"></i> Unduh QR Code
                    </a>
                    <button onclick="window.print()" class="btn-custom btn-custom-dark justify-content-center">
                        <i class="fa-solid fa-print"></i> Cetak Label
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Panel Kanan: Atribut Detail -->
    <div class="col-12 col-md-8">
        <div class="card-custom h-100">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">Spesifikasi & Informasi Aset</h5>
                @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn-custom btn-custom-sm btn-custom-light">
                        <i class="fa-solid fa-pen-to-square"></i> Ubah
                    </a>
                @endif
            </div>

            <div class="row g-3" style="font-size: 14px;">
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Merek</span>
                    <strong>{{ $barang->merek ?? '-' }}</strong>
                </div>
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Kategori</span>
                    <strong>{{ $barang->kategori->nama_kategori }}</strong>
                </div>
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Satuan</span>
                    <strong>{{ $barang->satuan }}</strong>
                </div>
                
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Lokasi Penyimpanan</span>
                    <strong>{{ $barang->lokasi_penyimpanan }}</strong>
                </div>
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">PIC / Penanggung Jawab</span>
                    <strong>{{ $barang->pic ?? '-' }}</strong>
                </div>
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Kondisi</span>
                    @if($barang->kondisi_barang == 'baik')
                        <span class="badge-custom badge-success d-inline-block">Baik</span>
                    @elseif($barang->kondisi_barang == 'rusak_ringan')
                        <span class="badge-custom badge-warning d-inline-block">Rusak Ringan</span>
                    @else
                        <span class="badge-custom badge-danger d-inline-block">Rusak Berat</span>
                    @endif
                </div>

                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Stok Saat Ini</span>
                    <strong class="fs-5">{{ $barang->jumlah }} {{ $barang->satuan }}</strong>
                    @if($barang->jumlah <= $barang->stok_minimum)
                        <span class="text-danger d-block small" style="font-size: 11px;"><i class="fa-solid fa-circle-exclamation me-1"></i>Stok di bawah batas minimum (min: {{ $barang->stok_minimum }})</span>
                    @endif
                </div>
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Harga Satuan</span>
                    <strong class="fs-5 text-dark">Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }}</strong>
                </div>
                <div class="col-6 col-md-4">
                    <span class="text-muted d-block small uppercase">Total Nilai Aset</span>
                    <strong class="fs-5 text-dark">Rp {{ number_format($barang->total_nilai_aset, 0, ',', '.') }}</strong>
                </div>

                <div class="col-12 col-md-6">
                    <span class="text-muted d-block small uppercase">Tanggal Pertama Masuk</span>
                    <strong>{{ $barang->tanggal_masuk->format('d F Y') }}</strong>
                </div>
                <div class="col-12 col-md-6">
                    <span class="text-muted d-block small uppercase">Supplier Awal</span>
                    <strong>{{ $barang->supplier->nama_supplier ?? '-' }}</strong>
                </div>

                <div class="col-12">
                    <span class="text-muted d-block small uppercase">Spesifikasi Detail</span>
                    <p class="mt-1 mb-0 text-dark bg-light p-2 rounded" style="white-space: pre-line; min-height: 50px;">{{ $barang->spesifikasi ?? 'Tidak ada spesifikasi khusus.' }}</p>
                </div>
                
                <div class="col-12">
                    <span class="text-muted d-block small uppercase">Keterangan</span>
                    <p class="mt-1 mb-0 text-dark bg-light p-2 rounded" style="white-space: pre-line; min-height: 50px;">{{ $barang->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tab Section Riwayat Transaksi -->
<div class="card-custom">
    <h5 class="font-outfit mb-4" style="font-size: 16px; font-weight: 600;">Riwayat Mutasi & Transaksi Aset</h5>

    <ul class="nav nav-tabs mb-3" id="transactionTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark active" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk-pane" type="button" role="tab" aria-selected="true">Barang Masuk</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar-pane" type="button" role="tab" aria-selected="false">Barang Keluar</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark" id="mutasi-tab" data-bs-toggle="tab" data-bs-target="#mutasi-pane" type="button" role="tab" aria-selected="false">Riwayat Mutasi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark" id="pinjam-tab" data-bs-toggle="tab" data-bs-target="#pinjam-pane" type="button" role="tab" aria-selected="false">Peminjaman</button>
        </li>
    </ul>

    <div class="tab-content" id="transactionTabsContent">
        <!-- Tab 1: Barang Masuk -->
        <div class="tab-pane fade show active" id="masuk-pane" role="tabpanel" tabindex="0">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan saat Transaksi</th>
                            <th>Total Transaksi</th>
                            <th>Keterangan</th>
                            <th>Penerima (Petugas)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang->barangMasuk as $bm)
                            <tr>
                                <td class="fw-semibold">{{ $bm->no_transaksi }}</td>
                                <td>{{ $bm->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $bm->supplier->nama_supplier }}</td>
                                <td>{{ $bm->jumlah }}</td>
                                <td>Rp {{ number_format($bm->harga_satuan, 0, ',', '.') }}</td>
                                <td class="fw-semibold">Rp {{ number_format($bm->jumlah * $bm->harga_satuan, 0, ',', '.') }}</td>
                                <td>{{ $bm->keterangan ?? '-' }}</td>
                                <td>{{ $bm->user->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-3">Tidak ada riwayat barang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 2: Barang Keluar -->
        <div class="tab-pane fade" id="keluar-pane" role="tabpanel" tabindex="0">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Tujuan Penggunaan</th>
                            <th>Keterangan</th>
                            <th>Petugas Pencatat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang->barangKeluar as $bk)
                            <tr>
                                <td class="fw-semibold">{{ $bk->no_transaksi }}</td>
                                <td>{{ $bk->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $bk->jumlah }}</td>
                                <td>{{ $bk->tujuan_penggunaan ?? '-' }}</td>
                                <td>{{ $bk->keterangan ?? '-' }}</td>
                                <td>{{ $bk->user->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Tidak ada riwayat barang keluar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 3: Mutasi -->
        <div class="tab-pane fade" id="mutasi-pane" role="tabpanel" tabindex="0">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Lokasi Asal &rarr; Tujuan</th>
                            <th>PIC Asal &rarr; Tujuan</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang->mutasi as $mut)
                            <tr>
                                <td class="fw-semibold">{{ $mut->no_transaksi }}</td>
                                <td>{{ $mut->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $mut->jumlah }}</td>
                                <td>{{ $mut->lokasi_asal }} &rarr; <strong>{{ $mut->lokasi_tujuan }}</strong></td>
                                <td>{{ $mut->pic_asal ?? '-' }} &rarr; <strong>{{ $mut->pic_tujuan ?? '-' }}</strong></td>
                                <td>{{ $mut->keterangan ?? '-' }}</td>
                                <td>{{ $mut->user->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Tidak ada riwayat mutasi lokasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 4: Peminjaman -->
        <div class="tab-pane fade" id="pinjam-pane" role="tabpanel" tabindex="0">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Rencana Kembali</th>
                            <th>Realisasi Kembali</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang->peminjaman as $pjm)
                            <tr>
                                <td class="fw-semibold">{{ $pjm->no_transaksi }}</td>
                                <td>{{ $pjm->peminjam->nama }}</td>
                                <td>{{ $pjm->jumlah }}</td>
                                <td>{{ $pjm->tanggal_pinjam->format('d-m-Y') }}</td>
                                <td>{{ $pjm->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                                <td>{{ $pjm->pengembalian ? $pjm->pengembalian->tanggal_kembali->format('d-m-Y') : '-' }}</td>
                                <td>
                                    @if($pjm->status == 'dipinjam')
                                        <span class="badge-custom badge-warning">Dipinjam</span>
                                    @elseif($pjm->status == 'dikembalikan')
                                        <span class="badge-custom badge-success">Dikembalikan</span>
                                    @else
                                        <span class="badge-custom badge-danger">Terlambat</span>
                                    @endif
                                </td>
                                <td>{{ $pjm->keterangan ?? '-' }}</td>
                                <td>{{ $pjm->user->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-3">Tidak ada riwayat peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style media="print">
    body * {
        visibility: hidden;
    }
    .main-container, .main-container * {
        visibility: visible;
    }
    .main-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 0;
    }
    .btn-custom, .nav-tabs, .tab-content, .breadcrumb-custom, h5 {
        display: none !important;
    }
</style>
@endsection
