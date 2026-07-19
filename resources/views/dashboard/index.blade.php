@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard Ringkasan')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Dashboard</span>
@endsection

@section('content')
<style>
    /* Premium Minimalist Stats Cards */
    .stat-card {
        background-color: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s;
    }
    .stat-card:hover {
        border-color: #111111;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .stat-card:hover .stat-icon {
        background-color: #111111;
        color: #ffffff;
        border-color: #111111;
    }
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .stat-title {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #888888;
    }
    .stat-icon {
        font-size: 18px;
        color: #111111;
        background-color: #fafafa;
        width: 34px;
        height: 34px;
        border-radius: 6px;
        border: 1px solid #e5e5e5;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .stat-value {
        font-family: 'Outfit', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #111111;
        line-height: 1;
    }
</style>

<!-- Baris 1: 4 Kartu Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Barang</span>
                <div class="stat-icon"><i class="fa-solid fa-box"></i></div>
            </div>
            <div class="stat-value">{{ number_format($totalBarang) }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Kategori Barang</span>
                <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
            </div>
            <div class="stat-value">{{ $totalKategori }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Supplier / Pemasok</span>
                <div class="stat-icon"><i class="fa-solid fa-truck-field"></i></div>
            </div>
            <div class="stat-value">{{ $totalSupplier }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Barang Dipinjam</span>
                <div class="stat-icon"><i class="fa-solid fa-handshake"></i></div>
            </div>
            <div class="stat-value">{{ number_format($barangDipinjam) }}</div>
        </div>
    </div>
</div>

<!-- Baris 2: 3 Kartu Statistik Operasional -->
<div class="row g-4 mb-4">
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Barang Masuk (Bulan Ini)</span>
                <div class="stat-icon"><i class="fa-solid fa-arrow-down-long"></i></div>
            </div>
            <div class="stat-value">{{ number_format($barangMasukBulanIni) }}</div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Barang Keluar (Bulan Ini)</span>
                <div class="stat-icon"><i class="fa-solid fa-arrow-up-long"></i></div>
            </div>
            <div class="stat-value">{{ number_format($barangKeluarBulanIni) }}</div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="stat-card" style="border-left: 3px solid #e02424;">
            <div class="stat-header">
                <span class="stat-title" style="color: #9b1c1c;">Aset Kondisi Rusak</span>
                <div class="stat-icon" style="color: #e02424; background-color: #fdf2f2;"><i class="fa-solid fa-circle-exclamation"></i></div>
            </div>
            <div class="stat-value" style="color: #9b1c1c;">{{ number_format($barangRusak) }}</div>
        </div>
    </div>
</div>

<!-- Baris 3: 2 Kolom Grafik -->
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-6">
        <div class="card-custom">
            <h5 class="font-outfit mb-3" style="font-size: 16px; font-weight: 600;">Stok Barang per Kategori</h5>
            <div style="position: relative; height: 300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card-custom">
            <h5 class="font-outfit mb-3" style="font-size: 16px; font-weight: 600;">Transaksi Barang Masuk vs Keluar</h5>
            <div style="position: relative; height: 300px;">
                <canvas id="transactionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Baris 4: Notifikasi Stok Minimum -->
<div class="card-custom">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="font-outfit m-0" style="font-size: 16px; font-weight: 600;">Notifikasi Stok Minimum</h5>
        <span class="badge-custom badge-danger-pulse"><i class="fa-solid fa-circle-exclamation me-1"></i> Perlu Re-Stock</span>
    </div>
    
    @if($stokMinimum->count() > 0)
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok Saat Ini</th>
                        <th>Batas Minimum</th>
                        <th>Selisih Kekurangan</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stokMinimum as $item)
                        <tr>
                            <td>
                                <a href="{{ route('barang.show', $item->id) }}" class="text-dark fw-semibold" style="text-decoration: none;">
                                    {{ $item->kode_barang }}
                                </a>
                            </td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>
                                <span class="badge-custom badge-danger-pulse fw-bold">
                                    {{ $item->jumlah }} {{ $item->satuan }}
                                </span>
                            </td>
                            <td>{{ $item->stok_minimum }} {{ $item->satuan }}</td>
                            <td class="text-danger fw-bold">-{{ $item->stok_minimum - $item->jumlah }}</td>
                            <td>{{ $item->lokasi_penyimpanan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4 text-muted" style="font-size: 13.5px;">
            <i class="fa-solid fa-circle-check text-success fs-3 mb-2 d-block"></i>
            Stok seluruh barang aman. Tidak ada barang di bawah ambang batas minimum.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Grafik Kategori (Bar Chart)
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoriesLabels) !!},
                datasets: [{
                    label: 'Stok Barang',
                    data: {!! json_encode($categoriesStokData) !!},
                    backgroundColor: '#111111',
                    borderColor: '#111111',
                    borderWidth: 0,
                    borderRadius: 4,
                    hoverBackgroundColor: '#000000'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#111111',
                        titleFont: { family: 'Inter', size: 12, weight: 'bold' },
                        bodyFont: { family: 'Inter', size: 12 },
                        padding: 10,
                        cornerRadius: 4,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: '#f5f5f5'
                        },
                        ticks: {
                            color: '#888888',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#444444',
                            font: { family: 'Inter', size: 11, weight: '550' }
                        }
                    }
                }
            }
        });

        // 2. Grafik Transaksi Masuk vs Keluar (Line Chart)
        const ctxTransaction = document.getElementById('transactionChart').getContext('2d');
        new Chart(ctxTransaction, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthsLabels) !!},
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: {!! json_encode($masukData) !!},
                        borderColor: '#111111',
                        backgroundColor: 'rgba(17, 17, 17, 0.03)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#111111',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#111111',
                        pointHoverBorderColor: '#ffffff'
                    },
                    {
                        label: 'Barang Keluar',
                        data: {!! json_encode($keluarData) !!},
                        borderColor: '#888888',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#888888',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#888888',
                        pointHoverBorderColor: '#ffffff'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { family: 'Inter', size: 11, weight: '550' },
                            color: '#555555',
                            boxWidth: 12,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111111',
                        titleFont: { family: 'Inter', size: 12, weight: 'bold' },
                        bodyFont: { family: 'Inter', size: 12 },
                        padding: 10,
                        cornerRadius: 4
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f5f5f5'
                        },
                        ticks: {
                            color: '#888888',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#888888',
                            font: { family: 'Inter', size: 11 }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
