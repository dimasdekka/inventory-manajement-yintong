<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: a4 landscape;
            margin: 10mm 12mm 12mm 12mm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #111827;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 12px;
            border-bottom: 2px solid #0F5A37;
            padding-bottom: 6px;
        }
        
        .company-name {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 3px 0;
            color: #0F5A37;
        }
        
        .report-title {
            font-size: 11pt;
            font-weight: bold;
            margin: 0 0 3px 0;
            text-transform: uppercase;
            color: #111827;
        }
        
        .report-period {
            font-size: 9pt;
            color: #4B5563;
            margin: 0;
        }

        .filter-summary {
            margin-bottom: 10px;
            font-size: 8.5pt;
            color: #4B5563;
        }
        
        .table-laporan {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .table-laporan th {
            background-color: #E6F4ED;
            color: #0D5230;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 7.5pt;
            border: 1px solid #B8E2CB;
            padding: 6px 5px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .table-laporan td {
            padding: 5px 5px;
            border: 1px solid #EAECEF;
            vertical-align: middle;
            font-size: 8pt;
            color: #111827;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .table-laporan tr:nth-child(even) td {
            background-color: #F9FAFB;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        .nowrap { white-space: nowrap; }

        .badge-status {
            display: inline-block;
            padding: 1px 4px;
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #9CA3AF;
            border-radius: 3px;
            background-color: #F3F4F6;
        }

        .footer {
            margin-top: 25px;
            font-size: 8pt;
            color: #6B7280;
            border-top: 1px solid #EAECEF;
            padding-top: 6px;
        }
        
        .footer-left {
            float: left;
            text-align: left;
        }

        .footer-right {
            float: right;
            text-align: right;
        }

        .signature-section {
            margin-top: 20px;
            margin-bottom: 20px;
            float: right;
            width: 220px;
            text-align: center;
            font-size: 8.5pt;
        }

        .signature-space {
            height: 40px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
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
                    <th style="width: 14%;">No. Transaksi</th>
                    <th style="width: 8%;" class="text-center">Tanggal</th>
                    <th style="width: 11%;">Kode Barang</th>
                    <th style="width: 20%;">Nama Barang</th>
                    <th style="width: 14%;">Supplier</th>
                    <th style="width: 7%;" class="text-center">Jumlah</th>
                    <th style="width: 11%;" class="text-right">Harga Satuan</th>
                    <th style="width: 11%;" class="text-right">Total</th>
                    <th style="width: 8%;">Petugas</th>
                </tr>
            @elseif($jenisLaporan == 'keluar')
                <tr>
                    <th style="width: 14%;">No. Transaksi</th>
                    <th style="width: 9%;" class="text-center">Tanggal</th>
                    <th style="width: 12%;">Kode Barang</th>
                    <th style="width: 22%;">Nama Barang</th>
                    <th style="width: 8%;" class="text-center">Jumlah</th>
                    <th style="width: 15%;">Tujuan Penggunaan</th>
                    <th style="width: 12%;">Keterangan</th>
                    <th style="width: 8%;">Petugas</th>
                </tr>
            @elseif($jenisLaporan == 'mutasi')
                <tr>
                    <th style="width: 14%;">No. Transaksi</th>
                    <th style="width: 8%;" class="text-center">Tanggal</th>
                    <th style="width: 11%;">Kode Barang</th>
                    <th style="width: 19%;">Nama Barang</th>
                    <th style="width: 7%;" class="text-center">Jumlah</th>
                    <th style="width: 14%;">Lokasi Asal</th>
                    <th style="width: 14%;">Lokasi Tujuan</th>
                    <th style="width: 7%;">PIC Tujuan</th>
                    <th style="width: 6%;">Petugas</th>
                </tr>
            @elseif($jenisLaporan == 'peminjaman')
                <tr>
                    <th style="width: 13%;">No. Transaksi</th>
                    <th style="width: 19%;">Nama Barang</th>
                    <th style="width: 12%;">Peminjam</th>
                    <th style="width: 6%;" class="text-center">Jumlah</th>
                    <th style="width: 9%;" class="text-center">Tgl Pinjam</th>
                    <th style="width: 9%;" class="text-center">Rencana Kembali</th>
                    <th style="width: 9%;" class="text-center">Realisasi Kembali</th>
                    <th style="width: 8%;" class="text-center">Status</th>
                    <th style="width: 10%;">Petugas</th>
                </tr>
            @else
                <!-- Default / Stok -->
                <tr>
                    <th style="width: 12%;">Kode Barang</th>
                    <th style="width: 20%;">Nama Barang</th>
                    <th style="width: 10%;">Kategori</th>
                    <th style="width: 8%;">Merek</th>
                    <th style="width: 5%;" class="text-center">Stok</th>
                    <th style="width: 5%;" class="text-center">Satuan</th>
                    <th style="width: 14%;">Lokasi</th>
                    <th style="width: 7%;" class="text-center">Kondisi</th>
                    <th style="width: 9.5%;" class="text-right">Harga Satuan</th>
                    <th style="width: 9.5%;" class="text-right">Total Nilai</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($data as $item)
                @if($jenisLaporan == 'masuk')
                    <tr>
                        <td class="text-bold nowrap">{{ $item->no_transaksi }}</td>
                        <td class="text-center nowrap">{{ optional($item->tanggal)->format('d/m/Y') ?? '-' }}</td>
                        <td class="nowrap">{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $item->supplier->nama_supplier ?? '-' }}</td>
                        <td class="text-center">+{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td class="text-right nowrap">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-right text-bold nowrap">Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @elseif($jenisLaporan == 'keluar')
                    <tr>
                        <td class="text-bold nowrap">{{ $item->no_transaksi }}</td>
                        <td class="text-center nowrap">{{ optional($item->tanggal)->format('d/m/Y') ?? '-' }}</td>
                        <td class="nowrap">{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="text-center">-{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td>{{ $item->tujuan_penggunaan ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @elseif($jenisLaporan == 'mutasi')
                    <tr>
                        <td class="text-bold nowrap">{{ $item->no_transaksi }}</td>
                        <td class="text-center nowrap">{{ optional($item->tanggal)->format('d/m/Y') ?? '-' }}</td>
                        <td class="nowrap">{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="text-center">{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td>{{ $item->lokasi_asal }}</td>
                        <td class="text-bold">{{ $item->lokasi_tujuan }}</td>
                        <td>{{ $item->pic_tujuan ?? '-' }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @elseif($jenisLaporan == 'peminjaman')
                    <tr>
                        <td class="text-bold nowrap">{{ $item->no_transaksi }}</td>
                        <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $item->peminjam->nama ?? '-' }}</td>
                        <td class="text-center">{{ $item->jumlah }} {{ $item->barang->satuan ?? '' }}</td>
                        <td class="text-center nowrap">{{ optional($item->tanggal_pinjam)->format('d/m/Y') ?? '-' }}</td>
                        <td class="text-center nowrap">{{ optional($item->tanggal_rencana_kembali)->format('d/m/Y') ?? '-' }}</td>
                        <td class="text-center nowrap">{{ $item->pengembalian ? optional($item->pengembalian->tanggal_kembali)->format('d/m/Y') : '-' }}</td>
                        <td class="text-center"><span class="badge-status">{{ $item->status }}</span></td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                    </tr>
                @else
                    <!-- Default / Stok -->
                    <tr>
                        <td class="text-bold nowrap">{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->merek ?? '-' }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-center">{{ $item->satuan }}</td>
                        <td>{{ $item->lokasi_penyimpanan }}</td>
                        <td class="text-center"><span class="badge-status">{{ $item->kondisi_barang }}</span></td>
                        <td class="text-right nowrap">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-right text-bold nowrap">Rp {{ number_format($item->total_nilai_aset, 0, ',', '.') }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="{{ $colSpan }}" class="text-center" style="color: #6B7280; padding: 15px;">
                        Tidak ada data laporan ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="clearfix">
        <!-- Tanda Tangan Lapangan -->
        <div class="signature-section">
            <p style="margin: 0 0 4px 0;">Jakarta, {{ date('d F Y') }}</p>
            <p style="margin: 0 0 4px 0;">Mengetahui,</p>
            <p style="font-weight: bold; margin: 0;">Pimpinan Kantor</p>
            <div class="signature-space"></div>
            <p style="text-decoration: underline; font-weight: bold; margin: 0;">( Hermawan Kusuma )</p>
            <p style="color: #6B7280; font-size: 8pt; margin: 0;">Pimpinan</p>
        </div>
    </div>

    <!-- Footer PDF -->
    <div class="footer">
        <div class="footer-left">Yintong Inventory - Sistem Informasi Inventori Kantor</div>
        <div class="footer-right">Metode RAD</div>
    </div>
</body>
</html>
