@extends('layouts.app')

@section('title', 'Laporan Inventori')
@section('header_title', 'Laporan Inventori & Transaksi')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Laporan Inventori</span>
@endsection

@section('content')
<!-- Panel Filter Laporan -->
<div class="card-custom mb-4">
    <h5 class="font-outfit mb-3" style="font-size: 15px; font-weight: 600;"><i class="fa-solid fa-filter me-1"></i> Filter Parameter Laporan</h5>
    
    <form action="{{ route('laporan.index') }}" method="GET" id="reportFilterForm">
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <label for="jenis_laporan" class="form-label-custom">Jenis Laporan <span class="text-danger">*</span></label>
                <select class="form-select form-control-custom w-100" id="jenis_laporan" name="jenis_laporan" required>
                    <option value="stok" {{ request('jenis_laporan', 'stok') == 'stok' ? 'selected' : '' }}>Stok Barang / Aset</option>
                    <option value="aset_tetap" {{ request('jenis_laporan') == 'aset_tetap' ? 'selected' : '' }}>Aset Tetap / Properti</option>
                    <option value="masuk" {{ request('jenis_laporan') == 'masuk' ? 'selected' : '' }}>Transaksi Barang Masuk</option>
                    <option value="keluar" {{ request('jenis_laporan') == 'keluar' ? 'selected' : '' }}>Transaksi Barang Keluar</option>
                    <option value="mutasi" {{ request('jenis_laporan') == 'mutasi' ? 'selected' : '' }}>Riwayat Mutasi Lokasi</option>
                    <option value="peminjaman" {{ request('jenis_laporan') == 'peminjaman' ? 'selected' : '' }}>Laporan Peminjaman-Pengembalian</option>
                </select>
            </div>

            <div class="col-12 col-md-4" id="date-range-group">
                <label class="form-label-custom">Rentang Tanggal</label>
                <div class="input-group">
                    <input type="date" class="form-control form-control-custom" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    <span class="input-group-text bg-light border" style="font-size: 12px; border-color: #d5d5d5;">s/d</span>
                    <input type="date" class="form-control form-control-custom" id="tanggal_selesai" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                </div>
            </div>

            <div class="col-12 col-md-2" id="kategori-group">
                <label for="kategori_id" class="form-label-custom">Kategori</label>
                <select class="form-select form-control-custom w-100" id="kategori_id" name="kategori_id">
                    <option value="">-- Semua --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-2" id="lokasi-group">
                <label for="lokasi_penyimpanan" class="form-label-custom">Lokasi</label>
                <select class="form-select form-control-custom w-100" id="lokasi_penyimpanan" name="lokasi_penyimpanan">
                    <option value="">-- Semua --</option>
                    @foreach($lokasi as $lok)
                        @if($lok)
                            <option value="{{ $lok }}" {{ request('lokasi_penyimpanan') == $lok ? 'selected' : '' }}>
                                {{ $lok }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end border-top pt-3">
            @if(request()->filled('jenis_laporan'))
                <a href="{{ route('laporan.index') }}" class="btn-custom btn-custom-light">Reset</a>
            @endif
            <button type="submit" class="btn-custom btn-custom-dark">
                <i class="fa-solid fa-circle-play"></i> Tampilkan Preview
            </button>
        </div>
    </form>
</div>

<!-- Preview Laporan -->
@if(request()->filled('jenis_laporan'))
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">
                Preview Laporan: 
                <span class="text-uppercase text-decoration-underline fw-bold">
                    @if(request('jenis_laporan') == 'stok')
                        Stok Barang & Aset
                    @elseif(request('jenis_laporan') == 'aset_tetap')
                        Aset Tetap / Properti
                    @elseif(request('jenis_laporan') == 'masuk')
                        Transaksi Barang Masuk
                    @elseif(request('jenis_laporan') == 'keluar')
                        Transaksi Barang Keluar
                    @elseif(request('jenis_laporan') == 'mutasi')
                        Mutasi Lokasi Barang
                    @else
                        Peminjaman & Pengembalian Barang
                    @endif
                </span>
            </h5>
            
            @if($data->count() > 0)
                <div class="d-flex gap-2">
                    <a href="{{ route('laporan.pdf', request()->all()) }}" class="btn-custom btn-custom-light">
                        <i class="fa-solid fa-file-pdf text-danger"></i> Export PDF
                    </a>
                    <a href="{{ route('laporan.excel', request()->all()) }}" class="btn-custom btn-custom-dark">
                        <i class="fa-solid fa-file-excel text-success"></i> Export Excel
                    </a>
                </div>
            @endif
        </div>

        @if($data->count() > 0)
            <div class="table-responsive">
                <!-- Preview Tabel Sesuai Jenis Laporan -->
                @if(request('jenis_laporan') == 'stok')
                    <!-- Stok Barang -->
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Merek</th>
                                <th>Jumlah Stok</th>
                                <th>Satuan</th>
                                <th>Lokasi</th>
                                <th>Kondisi</th>
                                <th>Harga Satuan</th>
                                <th>Total Nilai Aset</th>
                                <th>PIC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{ $item->merek ?? '-' }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->lokasi_penyimpanan }}</td>
                                    <td>
                                        <span class="badge-custom {{ $item->kondisi_barang == 'baik' ? 'badge-success' : ($item->kondisi_barang == 'rusak_ringan' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ $item->kondisi_barang }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="fw-semibold">Rp {{ number_format($item->total_nilai_aset, 0, ',', '.') }}</td>
                                    <td>{{ $item->pic ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @elseif(request('jenis_laporan') == 'masuk')
                    <!-- Barang Masuk -->
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Penerima (Petugas)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                                    <td>{{ $item->barang->kode_barang }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->barang->kategori->nama_kategori }}</td>
                                    <td>{{ $item->supplier->nama_supplier }}</td>
                                    <td class="fw-semibold text-success">+{{ $item->jumlah }} {{ $item->barang->satuan }}</td>
                                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="fw-semibold">Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @elseif(request('jenis_laporan') == 'keluar')
                    <!-- Barang Keluar -->
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah Keluar</th>
                                <th>Tujuan Penggunaan</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                                    <td>{{ $item->barang->kode_barang }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->barang->kategori->nama_kategori }}</td>
                                    <td class="fw-semibold text-danger">-{{ $item->jumlah }} {{ $item->barang->satuan }}</td>
                                    <td>{{ $item->tujuan_penggunaan ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @elseif(request('jenis_laporan') == 'mutasi')
                    <!-- Mutasi -->
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Lokasi Asal &rarr; Baru</th>
                                <th>PIC Asal &rarr; Baru</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                                    <td>{{ $item->barang->kode_barang }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->jumlah }} {{ $item->barang->satuan }}</td>
                                    <td>{{ $item->lokasi_asal }} &rarr; <strong>{{ $item->lokasi_tujuan }}</strong></td>
                                    <td>{{ $item->pic_asal ?? '-' }} &rarr; <strong>{{ $item->pic_tujuan ?? '-' }}</strong></td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @elseif(request('jenis_laporan') == 'peminjaman')
                    <!-- Peminjaman -->
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Nama Barang</th>
                                <th>Peminjam</th>
                                <th>Jumlah</th>
                                <th>Tgl Pinjam</th>
                                <th>Rencana Kembali</th>
                                <th>Realisasi Kembali</th>
                                <th>Status</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->peminjam->nama }}</td>
                                    <td>{{ $item->jumlah }} {{ $item->barang->satuan }}</td>
                                    <td>{{ $item->tanggal_pinjam->format('d-m-Y') }}</td>
                                    <td>{{ $item->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                                    <td>{{ $item->pengembalian ? $item->pengembalian->tanggal_kembali->format('d-m-Y') : '-' }}</td>
                                    <td>
                                        @if($item->status == 'dipinjam')
                                            <span class="badge-custom badge-warning">Dipinjam</span>
                                        @elseif($item->status == 'dikembalikan')
                                            <span class="badge-custom badge-success">Dikembalikan</span>
                                        @else
                                            <span class="badge-custom badge-danger">Terlambat</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->user->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif(request('jenis_laporan') == 'aset_tetap')
                    <!-- Aset Tetap -->
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Kode Aset</th>
                                <th>Nama Aset / Properti</th>
                                <th>Tipe</th>
                                <th>Alamat</th>
                                <th>Luas Tanah / Bangunan</th>
                                <th>Tgl Perolehan</th>
                                <th>Nilai Perolehan</th>
                                <th>Kepemilikan</th>
                                <th>Kondisi Bangunan</th>
                                <th>PIC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
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
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->luas_tanah }} m² / {{ $item->luas_bangunan }} m²</td>
                                    <td>{{ $item->tanggal_perolehan->format('d-m-Y') }}</td>
                                    <td>Rp {{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_kepemilikan == 'milik_sendiri' ? 'Milik Sendiri' : 'Sewa' }}</td>
                                    <td>
                                        <span class="badge-custom {{ $item->kondisi_bangunan == 'baik' ? 'badge-success' : ($item->kondisi_bangunan == 'perlu_perbaikan' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ $item->kondisi_bangunan }}
                                        </span>
                                    </td>
                                    <td>{{ $item->pic }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @else
            <div class="text-center py-5 text-muted" style="font-size: 13.5px;">
                <i class="fa-solid fa-triangle-exclamation fs-3 mb-2 d-block"></i>
                Tidak ada data ditemukan untuk parameter filter yang ditentukan.
            </div>
        @endif
    </div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reportTypeSelect = document.getElementById('jenis_laporan');
        const dateRangeGroup = document.getElementById('date-range-group');
        const categoryGroup = document.getElementById('kategori-group');
        const locationGroup = document.getElementById('lokasi-group');

        function toggleFilterInputs() {
            const reportType = reportTypeSelect.value;
            
            if (reportType === 'stok') {
                dateRangeGroup.style.display = 'none';
                categoryGroup.style.display = 'block';
                locationGroup.style.display = 'block';
                // Remove required status from date fields
                document.getElementById('tanggal_mulai').removeAttribute('required');
                document.getElementById('tanggal_selesai').removeAttribute('required');
            } else if (reportType === 'aset_tetap') {
                dateRangeGroup.style.display = 'block';
                categoryGroup.style.display = 'none';
                locationGroup.style.display = 'none';
                // Remove required status from date fields
                document.getElementById('tanggal_mulai').removeAttribute('required');
                document.getElementById('tanggal_selesai').removeAttribute('required');
            } else {
                dateRangeGroup.style.display = 'block';
                categoryGroup.style.display = 'block';
                locationGroup.style.display = 'none'; // Location filter is on item level, not on transaction level
                // Set required status for date fields in transaction reports
                document.getElementById('tanggal_mulai').setAttribute('required', 'required');
                document.getElementById('tanggal_selesai').setAttribute('required', 'required');
            }
        }

        reportTypeSelect.addEventListener('change', toggleFilterInputs);
        toggleFilterInputs(); // Run once on page load
    });
</script>
@endsection
