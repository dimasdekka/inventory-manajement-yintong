<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #111111;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #0F5A37;
            padding-bottom: 10px;
        }
        
        .company-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 5px 0;
            color: #0F5A37;
        }
        
        .report-title {
            font-size: 13px;
            font-weight: bold;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            color: #111827;
        }
        
        .report-period {
            font-size: 11px;
            color: #6B7280;
            margin: 0;
        }

        .filter-summary {
            margin-bottom: 15px;
            font-size: 10px;
            color: #4B5563;
        }
        
        .table-laporan {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        
        .table-laporan th {
            background-color: #E6F4ED;
            color: #0D5230;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
            border: 1px solid #C2E7D3;
            padding: 7px 10px;
            text-align: left;
        }
        
        .table-laporan td {
            padding: 6px 10px;
            border: 1px solid #EAECEF;
            vertical-align: middle;
            font-size: 9.5px;
            color: #111827;
        }

        .badge-status {
            display: inline-block;
            padding: 2px 5px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #9CA3AF;
            border-radius: 3px;
            background-color: #F3F4F6;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 25px;
            font-size: 9px;
            color: #9CA3AF;
            border-top: 1px solid #EAECEF;
            padding-top: 5px;
            text-align: right;
        }
        
        .footer-left {
            float: left;
            text-align: left;
        }

        .signature-section {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            page-break-inside: avoid;
        }

        .signature-space {
            height: 60px;
        }
    </style>
</head>
<body>
    @php
        $colSpan = ($jenisLaporan == 'stok') ? 10 : (($jenisLaporan == 'keluar') ? 8 : 9);
    @endphp

    <!-- Header Instansi -->
    <div class="header">
        <h1 class="company-name">SISTEM INFORMASI INVENTORI KANTOR</h1>
        <h2 class="report-title">{{ $title }}</h2>
        <p class="report-period">
            @if(!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai']))
                Periode: {{ date('d/m/Y', strtotime($filters['tanggal_mulai'])) }} s/d {{ date('d/m/Y', strtotime($filters['tanggal_selesai'])) }}
            @else
                Per Tanggal: {{ date('d/m/Y') }}
            @endif
        </p>
    </div>

    <!-- Parameter Filter yang Digunakan -->
    <div class="filter-summary">
        Dicetak oleh: <strong>{{ auth()->user()?->nama ?? 'Administrator' }} ({{ ucfirst(auth()->user()?->role ?? 'Admin') }})</strong> | Tanggal Cetak: {{ date('d-m-Y H:i') }}
    </div>

    <!-- Tabel Data Laporan -->
    <table class="table-laporan">
        <thead>
            @if($jenisLaporan == 'masuk')
                <tr>
                    <th style="width: 12%;">No. Transaksi</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 10%;">Kode Barang</th>
                    <th style="width: 20%;">Nama Barang</th>
                    <th style="width: 12%;">Supplier</th>
                    <th style="width: 8%;">Jumlah</th>
                    <th style="width: 12%;">Harga Satuan</th>
                    <th style="width: 12%;">Total</th>
                    <th style="width: 10%;">Petugas</th>
                </tr>
            @elseif($jenisLaporan == 'keluar')
                <tr>
                    <th style="width: 15%;">No. Transaksi</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 12%;">Kode Barang</th>
                    <th style="width: 20%;">Nama Barang</th>
                    <th style="width: 8%;">Jumlah</th>
                    <th style="width: 15%;">Tujuan Penggunaan</th>
                    <th style="width: 15%;">Keterangan</th>
                    <th style="width: 10%;">Petugas</th>
                </tr>
            @elseif($jenisLaporan == 'mutasi')
                <tr>
                    <th style="width: 12%;">No. Transaksi</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 10%;">Kode Barang</th>
                    <th style="width: 15%;">Nama Barang</th>
                    <th style="width: 7%;">Jumlah</th>
                    <th style="width: 15%;">Lokasi Asal</th>
                    <th style="width: 15%;">Lokasi Tujuan</th>
                    <th style="width: 10%;">PIC Tujuan</th>
                    <th style="width: 10%;">Petugas</th>
                </tr>
            @elseif($jenisLaporan == 'peminjaman')
                <tr>
                    <th style="width: 12%;">No. Transaksi</th>
                    <th style="width: 15%;">Nama Barang</th>
                    <th style="width: 12%;">Peminjam</th>
                    <th style="width: 7%;">Jumlah</th>
                    <th style="width: 10%;">Tgl Pinjam</th>
                    <th style="width: 10%;">Rencana Kembali</th>
                    <th style="width: 10%;">Realisasi Kembali</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 10%;">Petugas</th>
                </tr>
            @else
                <!-- Default / Stok -->
                <tr>
                    <th style="width: 10%;">Kode Barang</th>
                    <th style="width: 20%;">Nama Barang</th>
                    <th style="width: 10%;">Kategori</th>
                    <th style="width: 10%;">Merek</th>
                    <th style="width: 7%;">Stok</th>
                    <th style="width: 7%;">Satuan</th>
                    <th style="width: 10%;">Lokasi</th>
                    <th style="width: 8%;">Kondisi</th>
                    <th style="width: 10%;">Harga Satuan</th>
                    <th style="width: 12%;">Total Nilai Aset</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($data as $item)
                @if($jenisLaporan == 'masuk')
                    <tr>
                        <td style="font-weight: bold;">{{ $item->no_transaksi }}</td>
                        <td>{{ optional($item->tanggal)->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $item->supplier->nama_supplier ?? '-' }}</td>
                        <td>+{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td style="font-weight: bold;">Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @elseif($jenisLaporan == 'keluar')
                    <tr>
                        <td style="font-weight: bold;">{{ $item->no_transaksi }}</td>
                        <td>{{ optional($item->tanggal)->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>-{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td>{{ $item->tujuan_penggunaan ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @elseif($jenisLaporan == 'mutasi')
                    <tr>
                        <td style="font-weight: bold;">{{ $item->no_transaksi }}</td>
                        <td>{{ optional($item->tanggal)->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td>{{ $item->lokasi_asal }}</td>
                        <td style="font-weight: bold;">{{ $item->lokasi_tujuan }}</td>
                        <td>{{ $item->pic_tujuan ?? '-' }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @elseif($jenisLaporan == 'peminjaman')
                    <tr>
                        <td style="font-weight: bold;">{{ $item->no_transaksi }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $item->peminjam->nama ?? '-' }}</td>
                        <td>{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td>{{ optional($item->tanggal_pinjam)->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ optional($item->tanggal_rencana_kembali)->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $item->pengembalian ? optional($item->pengembalian->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
                        <td><span class="badge-status">{{ $item->status }}</span></td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @else
                    <!-- Default / Stok -->
                    <tr>
                        <td style="font-weight: bold;">{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->merek ?? '-' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->lokasi_penyimpanan }}</td>
                        <td><span class="badge-status">{{ $item->kondisi_barang }}</span></td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td style="font-weight: bold;">Rp {{ number_format($item->total_nilai_aset, 0, ',', '.') }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="{{ $colSpan }}" style="text-align: center; color: #666666; padding: 20px;">
                        Tidak ada data laporan ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan Lapangan -->
    <div class="signature-section">
        <p>Jakarta, {{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <p style="font-weight: bold; margin-bottom: 0;">Pimpinan Kantor</p>
        <div class="signature-space"></div>
        <p style="text-decoration: underline; font-weight: bold; margin: 0;">( Hermawan Kusuma )</p>
        <p style="color: #666666; font-size: 9px; margin: 0;">Pimpinan</p>
    </div>

    <!-- Footer PDF -->
    <div class="footer">
        <div class="footer-left">Yintong Inventory - Sistem Informasi Inventori Kantor</div>
        Halaman 1 / 1
    </div>
</body>
</html>
