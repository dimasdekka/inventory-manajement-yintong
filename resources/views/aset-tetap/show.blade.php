@extends('layouts.app')

@section('title', 'Detail Aset Tetap')
@section('header_title', 'Informasi Detail Aset Properti')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <a href="{{ route('aset-tetap.index') }}">Aset Tetap</a>
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Detail: {{ $asetTetap->kode_aset }}</span>
@endsection

@section('content')
<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
        <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">Data Aset Tetap / Gedung</h5>
        @if(in_array(auth()->user()->role, ['administrator', 'staff_gudang']))
            <a href="{{ route('aset-tetap.edit', $asetTetap->id) }}" class="btn-custom btn-custom-sm btn-custom-light">
                <i class="fa-solid fa-pen-to-square"></i> Ubah
            </a>
        @endif
    </div>

    <div class="row g-3" style="font-size: 14px;">
        <div class="col-12 col-md-4">
            <span class="text-muted d-block small uppercase">Kode Aset</span>
            <strong>{{ $asetTetap->kode_aset }}</strong>
        </div>
        <div class="col-12 col-md-5">
            <span class="text-muted d-block small uppercase">Nama Aset / Properti</span>
            <strong>{{ $asetTetap->nama_aset }}</strong>
        </div>
        <div class="col-12 col-md-3">
            <span class="text-muted d-block small uppercase">Tipe Aset</span>
            <strong>
                @if($asetTetap->tipe == 'ruko')
                    Ruko / Rumah Toko
                @elseif($asetTetap->tipe == 'kantor')
                    Kantor / Gedung Operasional
                @else
                    Mess Karyawan / Pemukiman
                @endif
            </strong>
        </div>
        
        <div class="col-12">
            <span class="text-muted d-block small uppercase">Alamat Lengkap</span>
            <p class="mt-1 mb-0 text-dark bg-light p-2 rounded" style="white-space: pre-line; min-height: 50px;">{{ $asetTetap->alamat }}</p>
        </div>

        <div class="col-6 col-md-3">
            <span class="text-muted d-block small uppercase">Luas Tanah</span>
            <strong>{{ $asetTetap->luas_tanah }} m²</strong>
        </div>
        <div class="col-6 col-md-3">
            <span class="text-muted d-block small uppercase">Luas Bangunan</span>
            <strong>{{ $asetTetap->luas_bangunan }} m²</strong>
        </div>
        <div class="col-6 col-md-3">
            <span class="text-muted d-block small uppercase">Status Kepemilikan</span>
            <strong>
                @if($asetTetap->status_kepemilikan == 'milik_sendiri')
                    Milik Sendiri
                @else
                    Sewa / Kontrak
                @endif
            </strong>
        </div>
        <div class="col-6 col-md-3">
            <span class="text-muted d-block small uppercase">Kondisi Bangunan</span>
            <strong>
                @if($asetTetap->kondisi_bangunan == 'baik')
                    <span class="text-success"><i class="fa-solid fa-circle-check"></i> Baik</span>
                @elseif($asetTetap->kondisi_bangunan == 'perlu_perbaikan')
                    <span class="text-warning"><i class="fa-solid fa-circle-exclamation"></i> Perlu Perbaikan</span>
                @else
                    <span class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Rusak Berat</span>
                @endif
            </strong>
        </div>

        <div class="col-6 col-md-4">
            <span class="text-muted d-block small uppercase">Tanggal Perolehan</span>
            <strong>{{ $asetTetap->tanggal_perolehan->format('d F Y') }}</strong>
        </div>
        <div class="col-6 col-md-4">
            <span class="text-muted d-block small uppercase">Nilai Perolehan / Pembelian</span>
            <strong class="fs-5 text-dark">Rp {{ number_format($asetTetap->nilai_perolehan, 0, ',', '.') }}</strong>
        </div>
        <div class="col-6 col-md-4">
            <span class="text-muted d-block small uppercase">Penanggung Jawab (PIC)</span>
            <strong>{{ $asetTetap->pic }}</strong>
        </div>

        <div class="col-12">
            <span class="text-muted d-block small uppercase">Keterangan / Informasi Legalitas</span>
            <p class="mt-1 mb-0 text-dark bg-light p-2 rounded" style="white-space: pre-line; min-height: 50px;">{{ $asetTetap->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>
        </div>
    </div>
</div>
@endsection
