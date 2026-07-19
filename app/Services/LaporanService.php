<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\MutasiBarang;
use App\Models\Peminjaman;
use App\Exports\LaporanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class LaporanService
{
    /**
     * Get data based on report type and filters.
     */
    public function getData(array $filters): Collection
    {
        $jenisLaporan = $filters['jenis_laporan'] ?? 'stok';

        switch ($jenisLaporan) {
            case 'masuk':
                $query = BarangMasuk::with(['barang.kategori', 'supplier', 'user']);
                if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
                    $query->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
                }
                if (!empty($filters['kategori_id'])) {
                    $query->whereHas('barang', function ($q) use ($filters) {
                        $q->where('kategori_id', $filters['kategori_id']);
                    });
                }
                return $query->orderBy('tanggal', 'desc')->get();

            case 'keluar':
                $query = BarangKeluar::with(['barang.kategori', 'user']);
                if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
                    $query->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
                }
                if (!empty($filters['kategori_id'])) {
                    $query->whereHas('barang', function ($q) use ($filters) {
                        $q->where('kategori_id', $filters['kategori_id']);
                    });
                }
                return $query->orderBy('tanggal', 'desc')->get();

            case 'mutasi':
                $query = MutasiBarang::with(['barang.kategori', 'user']);
                if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
                    $query->whereBetween('tanggal', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
                }
                if (!empty($filters['kategori_id'])) {
                    $query->whereHas('barang', function ($q) use ($filters) {
                        $q->where('kategori_id', $filters['kategori_id']);
                    });
                }
                return $query->orderBy('tanggal', 'desc')->get();

            case 'peminjaman':
                $query = Peminjaman::with(['barang.kategori', 'peminjam', 'user', 'pengembalian.user']);
                if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
                    $query->whereBetween('tanggal_pinjam', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
                }
                if (!empty($filters['kategori_id'])) {
                    $query->whereHas('barang', function ($q) use ($filters) {
                        $q->where('kategori_id', $filters['kategori_id']);
                    });
                }
                return $query->orderBy('tanggal_pinjam', 'desc')->get();

            case 'aset_tetap':
                $query = \App\Models\AsetTetap::query();
                if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
                    $query->whereBetween('tanggal_perolehan', [$filters['tanggal_mulai'], $filters['tanggal_selesai']]);
                }
                return $query->orderBy('kode_aset', 'asc')->get();

            case 'stok':
            default:
                $query = Barang::with(['kategori', 'supplier']);
                if (!empty($filters['kategori_id'])) {
                    $query->where('kategori_id', $filters['kategori_id']);
                }
                if (!empty($filters['lokasi_penyimpanan'])) {
                    $query->where('lokasi_penyimpanan', $filters['lokasi_penyimpanan']);
                }
                return $query->orderBy('kode_barang', 'asc')->get();
        }
    }

    /**
     * Map data for Excel export and return headings.
     */
    public function getExportDataAndHeadings(string $jenisLaporan, Collection $data): array
    {
        $exportData = collect();
        $headings = [];

        switch ($jenisLaporan) {
            case 'masuk':
                $headings = ['No. Transaksi', 'Tanggal', 'Kode Barang', 'Nama Barang', 'Kategori', 'Supplier', 'Jumlah', 'Satuan', 'Harga Satuan', 'Total', 'Keterangan', 'Petugas'];
                foreach ($data as $item) {
                    $exportData->push([
                        $item->no_transaksi,
                        $item->tanggal->format('d-m-Y'),
                        $item->barang->kode_barang,
                        $item->barang->nama_barang,
                        $item->barang->kategori->nama_kategori,
                        $item->supplier->nama_supplier,
                        $item->jumlah,
                        $item->barang->satuan,
                        $item->harga_satuan,
                        $item->jumlah * $item->harga_satuan,
                        $item->keterangan,
                        $item->user->nama,
                    ]);
                }
                break;

            case 'keluar':
                $headings = ['No. Transaksi', 'Tanggal', 'Kode Barang', 'Nama Barang', 'Kategori', 'Jumlah', 'Satuan', 'Tujuan Penggunaan', 'Keterangan', 'Petugas'];
                foreach ($data as $item) {
                    $exportData->push([
                        $item->no_transaksi,
                        $item->tanggal->format('d-m-Y'),
                        $item->barang->kode_barang,
                        $item->barang->nama_barang,
                        $item->barang->kategori->nama_kategori,
                        $item->jumlah,
                        $item->barang->satuan,
                        $item->tujuan_penggunaan,
                        $item->keterangan,
                        $item->user->nama,
                    ]);
                }
                break;

            case 'mutasi':
                $headings = ['No. Transaksi', 'Tanggal', 'Kode Barang', 'Nama Barang', 'Kategori', 'Jumlah', 'Satuan', 'Lokasi Asal', 'Lokasi Tujuan', 'PIC Asal', 'PIC Tujuan', 'Keterangan', 'Petugas'];
                foreach ($data as $item) {
                    $exportData->push([
                        $item->no_transaksi,
                        $item->tanggal->format('d-m-Y'),
                        $item->barang->kode_barang,
                        $item->barang->nama_barang,
                        $item->barang->kategori->nama_kategori,
                        $item->jumlah,
                        $item->barang->satuan,
                        $item->lokasi_asal,
                        $item->lokasi_tujuan,
                        $item->pic_asal,
                        $item->pic_tujuan,
                        $item->keterangan,
                        $item->user->nama,
                    ]);
                }
                break;

            case 'peminjaman':
                $headings = ['No. Transaksi', 'Nama Barang', 'Peminjam', 'Jumlah', 'Tgl Pinjam', 'Tgl Rencana Kembali', 'Tgl Kembali', 'Kondisi Kembali', 'Status', 'Petugas'];
                foreach ($data as $item) {
                    $exportData->push([
                        $item->no_transaksi,
                        $item->barang->nama_barang,
                        $item->peminjam->nama,
                        $item->jumlah,
                        $item->tanggal_pinjam->format('d-m-Y'),
                        $item->tanggal_rencana_kembali->format('d-m-Y'),
                        $item->pengembalian ? $item->pengembalian->tanggal_kembali->format('d-m-Y') : '-',
                        $item->pengembalian ? strtoupper(str_replace('_', ' ', $item->pengembalian->kondisi_saat_kembali)) : '-',
                        strtoupper($item->status),
                        $item->user->nama,
                    ]);
                }
                break;

            case 'stok':
            default:
                $headings = ['Kode Barang', 'Nama Barang', 'Kategori', 'Merek', 'Jumlah', 'Satuan', 'Lokasi Penyimpanan', 'Kondisi', 'Harga Satuan', 'Total Nilai Aset', 'PIC'];
                foreach ($data as $item) {
                    $exportData->push([
                        $item->kode_barang,
                        $item->nama_barang,
                        $item->kategori->nama_kategori,
                        $item->merek ?? '-',
                        $item->jumlah,
                        $item->satuan,
                        $item->lokasi_penyimpanan,
                        strtoupper($item->kondisi_barang),
                        $item->harga_satuan,
                        $item->total_nilai_aset,
                        $item->pic ?? '-',
                    ]);
                }
                break;

            case 'aset_tetap':
                $headings = ['Kode Aset', 'Nama Aset', 'Tipe', 'Alamat', 'Luas Tanah', 'Luas Bangunan', 'Tgl Perolehan', 'Nilai Perolehan', 'Kepemilikan', 'Kondisi Bangunan', 'PIC', 'Keterangan'];
                foreach ($data as $item) {
                    $exportData->push([
                        $item->kode_aset,
                        $item->nama_aset,
                        strtoupper($item->tipe),
                        $item->alamat,
                        $item->luas_tanah . ' m²',
                        $item->luas_bangunan . ' m²',
                        $item->tanggal_perolehan->format('d-m-Y'),
                        $item->nilai_perolehan,
                        strtoupper($item->status_kepemilikan),
                        strtoupper($item->kondisi_bangunan),
                        $item->pic,
                        $item->keterangan,
                    ]);
                }
                break;
        }

        return [$exportData, $headings];
    }

    /**
     * Export to Excel file.
     */
    public function exportExcel(string $jenisLaporan, Collection $data)
    {
        list($exportData, $headings) = $this->getExportDataAndHeadings($jenisLaporan, $data);
        $fileName = 'laporan_' . $jenisLaporan . '_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new LaporanExport($exportData, $headings), $fileName);
    }

    /**
     * Generate PDF output using DomPDF.
     */
    public function generatePdf(string $jenisLaporan, Collection $data, array $filters)
    {
        $title = 'LAPORAN ' . strtoupper($jenisLaporan == 'stok' ? 'stok barang' : 'transaksi barang ' . $jenisLaporan);
        if ($jenisLaporan == 'peminjaman') {
            $title = 'LAPORAN PEMINJAMAN DAN PENGEMBALIAN BARANG';
        } elseif ($jenisLaporan == 'aset_tetap') {
            $title = 'LAPORAN DATA ASET TETAP / PROPERTI';
        }

        $pdf = Pdf::loadView('laporan.pdf', compact('data', 'jenisLaporan', 'filters', 'title'))
            ->setPaper('a4', 'landscape');

        return $pdf;
    }
}
