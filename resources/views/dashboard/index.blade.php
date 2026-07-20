@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard Ringkasan')

@section('breadcrumbs')
    <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
    <span class="active">Dashboard</span>
@endsection

@section('content')
<!-- Header: Title + Subtitle + Action Buttons -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
    <div>
        <h2 class="font-outfit fw-bold mb-1" style="font-size: 22px; color: var(--text-main);">Dashboard</h2>
        <p class="text-muted m-0" style="font-size: 12.5px;">Kelola, pantau, dan alokasikan stok inventori kantor secara real-time.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('barang-masuk.create') }}" class="btn-custom btn-custom-dark btn-custom-sm">
            <i class="fa-solid fa-plus"></i> Catat Barang Masuk
        </a>
        <a href="{{ route('barang.index') }}" class="btn-custom btn-custom-light btn-custom-sm">
            <i class="fa-solid fa-boxes-stacked"></i> Kelola Barang
        </a>
    </div>
</div>

<!-- Baris 1: 4 Kartu Statistik Utama -->
<div class="row g-3 mb-3">
    <!-- Featured Emerald Stat Card -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-custom stat-card-featured">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label text-white-50">Total Unit Barang</span>
                <a href="{{ route('barang.index') }}" class="stat-card-link-pill text-white" title="Lihat Katalog">
                    Detail <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="stat-card-value text-white">{{ number_format($totalBarang) }}</div>
            <div class="stat-card-subtext text-white-50">
                <i class="fa-solid fa-circle-check me-1"></i> Terdata dalam katalog inventori
            </div>
        </div>
    </div>

    <!-- Stat Card 2: Kategori -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label">Kategori Barang</span>
                <span class="badge-custom badge-success">Aktif</span>
            </div>
            <div class="stat-card-value">{{ $totalKategori }}</div>
            <div class="stat-card-subtext text-muted">
                <i class="fa-solid fa-tags text-success me-1"></i> Klasifikasi barang
            </div>
        </div>
    </div>

    <!-- Stat Card 3: Supplier -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label">Supplier / Pemasok</span>
                <span class="badge-custom badge-secondary">Mitra</span>
            </div>
            <div class="stat-card-value">{{ $totalSupplier }}</div>
            <div class="stat-card-subtext text-muted">
                <i class="fa-solid fa-truck-field text-primary me-1"></i> Terdaftar dalam sistem
            </div>
        </div>
    </div>

    <!-- Stat Card 4: Dipinjam -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label">Barang Dipinjam</span>
                <span class="badge-custom badge-warning">Aktif</span>
            </div>
            <div class="stat-card-value">{{ number_format($barangDipinjam) }}</div>
            <div class="stat-card-subtext text-muted">
                <i class="fa-solid fa-clock text-warning me-1"></i> Unit sedang dipinjam
            </div>
        </div>
    </div>
</div>

<!-- Baris 2: 3 Kartu Ringkasan Operasional Bulanan -->
<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
        <div class="stat-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label">Barang Masuk (Bulan Ini)</span>
                <span class="badge-custom badge-success"><i class="fa-solid fa-arrow-down me-1"></i> Inflow</span>
            </div>
            <div class="stat-card-value text-success">+{{ number_format($barangMasukBulanIni) }}</div>
            <div class="stat-card-subtext text-muted">Stok masuk bulan {{ date('F Y') }}</div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="stat-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label">Barang Keluar (Bulan Ini)</span>
                <span class="badge-custom badge-danger"><i class="fa-solid fa-arrow-up me-1"></i> Outflow</span>
            </div>
            <div class="stat-card-value text-dark">-{{ number_format($barangKeluarBulanIni) }}</div>
            <div class="stat-card-subtext text-muted">Pengeluaran unit bulan {{ date('F Y') }}</div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="stat-card-custom stat-card-warning-alert">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="stat-card-label text-danger">Aset Kondisi Rusak</span>
                <span class="badge-custom badge-danger">Maintenance</span>
            </div>
            <div class="stat-card-value text-danger">{{ number_format($barangRusak) }}</div>
            <div class="stat-card-subtext text-danger">Memerlukan pemeliharaan / replacement</div>
        </div>
    </div>
</div>

<!-- Baris 3: 2 Kolom Grafik Analytics -->
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="font-outfit m-0" style="font-size: 15px; font-weight: 600;">Stok Barang per Kategori</h5>
                <span class="badge-custom"><i class="fa-solid fa-chart-column"></i> Analytics</span>
            </div>
            <div style="position: relative; height: 220px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="font-outfit m-0" style="font-size: 15px; font-weight: 600;">Transaksi Barang Masuk vs Keluar</h5>
                <span class="badge-custom"><i class="fa-solid fa-chart-line"></i> Tren Bulanan</span>
            </div>
            <div style="position: relative; height: 220px;">
                <canvas id="transactionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Baris 4: Notifikasi Stok Minimum -->
<div class="card-custom">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <div>
            <h5 class="font-outfit m-0 mb-1" style="font-size: 15px; font-weight: 600;">Notifikasi Stok Minimum</h5>
            <p class="text-muted m-0" style="font-size: 12px;">Daftar barang yang mencapai atau di bawah batas minimum stok.</p>
        </div>
        <span class="badge-custom badge-danger"><i class="fa-solid fa-bell"></i> Perlu Restock</span>
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
                            <td class="fw-medium">{{ $item->nama_barang }}</td>
                            <td><span class="badge-custom">{{ $item->kategori->nama_kategori }}</span></td>
                            <td>
                                <span class="badge-custom badge-danger fw-bold">
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
        // 1. Grafik Kategori (Bar Chart Emerald)
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoriesLabels) !!},
                datasets: [{
                    label: 'Stok Barang',
                    data: {!! json_encode($categoriesStokData) !!},
                    backgroundColor: '#0F5A37',
                    borderColor: '#0F5A37',
                    borderWidth: 0,
                    borderRadius: 8,
                    hoverBackgroundColor: '#0A4328'
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
                        backgroundColor: '#0F5A37',
                        titleFont: { family: 'Inter', size: 12, weight: 'bold' },
                        bodyFont: { family: 'Inter', size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: '#EAECEF'
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#111827',
                            font: { family: 'Inter', size: 11, weight: '600' }
                        }
                    }
                }
            }
        });

        // 2. Grafik Transaksi Masuk vs Keluar (Line Chart Emerald & Mint)
        const ctxTransaction = document.getElementById('transactionChart').getContext('2d');
        new Chart(ctxTransaction, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthsLabels) !!},
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: {!! json_encode($masukData) !!},
                        borderColor: '#0F5A37',
                        backgroundColor: 'rgba(15, 90, 55, 0.08)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0F5A37',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#0F5A37',
                        pointHoverBorderColor: '#ffffff'
                    },
                    {
                        label: 'Barang Keluar',
                        data: {!! json_encode($keluarData) !!},
                        borderColor: '#6B7280',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#6B7280',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#6B7280',
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
                            font: { family: 'Inter', size: 11, weight: '600' },
                            color: '#4B5563',
                            boxWidth: 10,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0F5A37',
                        titleFont: { family: 'Inter', size: 12, weight: 'bold' },
                        bodyFont: { family: 'Inter', size: 12 },
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#EAECEF'
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { family: 'Inter', size: 11 }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

