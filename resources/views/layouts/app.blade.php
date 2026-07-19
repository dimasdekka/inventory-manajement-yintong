<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Yintong Inventory') }}</title>
    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfcfc;
            color: #111111;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Sidebar Layout */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }
        
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #ffffff;
            color: #111111;
            border-right: 1px solid #e5e5e5;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e5e5e5;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        ul.components {
            padding: 15px 0;
        }
        
        ul.components li {
            list-style: none;
        }
        
        ul.components li a {
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #555555;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        ul.components li a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }
        
        ul.components li a:hover {
            color: #111111;
            background-color: #f7f7f7;
        }
        
        ul.components li.active > a {
            color: #111111;
            background-color: #fafafa;
            border-left-color: #111111;
            font-weight: 600;
        }
        
        .menu-category {
            padding: 10px 24px 5px 24px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999999;
        }

        /* Topbar / Navbar */
        #content {
            width: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }
        
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            padding: 15px 30px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .navbar-brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #111111;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 550;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #eeeeee;
            border: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: #666666;
            overflow: hidden;
            object-fit: cover;
        }
        
        /* Main content container */
        .main-container {
            padding: 35px 30px;
            flex: 1;
        }
        
        /* Breadcrumbs */
        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #888888;
            margin-bottom: 25px;
        }
        .breadcrumb-custom a {
            color: #888888;
            text-decoration: none;
            transition: color 0.2s;
        }
        .breadcrumb-custom a:hover {
            color: #111111;
        }
        .breadcrumb-custom .active {
            color: #111111;
            font-weight: 500;
        }
        
        /* Cards */
        .card-custom {
            background-color: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.01);
            margin-bottom: 25px;
            padding: 24px;
        }
        
        /* Grayscale table styles (Dimas preference) */
        .table-custom {
            width: 100%;
            margin-bottom: 1rem;
            color: #111111;
            border-collapse: collapse;
        }
        .table-custom th {
            background-color: #fafafa;
            color: #111111;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e5e5e5;
            border-top: 1px solid #e5e5e5;
            padding: 12px 16px;
            text-align: left;
        }
        .table-custom td {
            padding: 14px 16px;
            font-size: 13.5px;
            border-bottom: 1px solid #e5e5e5;
            vertical-align: middle;
            color: #333333;
        }
        .table-custom tr:hover td {
            background-color: #fafafa;
        }
        
        /* Clean Grayscale Badges */
        .badge-custom {
            display: inline-block;
            padding: 4px 8px;
            font-size: 10.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 4px;
            border: 1px solid #e5e5e5;
            background-color: #ffffff;
            color: #555555;
        }
        .badge-custom.badge-dark {
            background-color: #111111;
            color: #ffffff;
            border-color: #111111;
        }
        .badge-custom.badge-success {
            background-color: #f3faf7;
            color: #03543f;
            border-color: #def7ec;
        }
        .badge-custom.badge-danger {
            background-color: #fdf2f2;
            color: #9b1c1c;
            border-color: #f5c2c2;
        }
        @keyframes pulse-danger {
            0% {
                box-shadow: 0 0 0 0 rgba(240, 82, 82, 0.4);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(240, 82, 82, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(240, 82, 82, 0);
            }
        }
        .badge-custom.badge-danger-pulse {
            background-color: #fdf2f2;
            color: #9b1c1c;
            border-color: #f5c2c2;
            animation: pulse-danger 2s infinite;
        }
        .badge-custom.badge-warning {
            background-color: #fdf8e2;
            color: #723b11;
            border-color: #fdf2cc;
        }
        
        /* Modern Buttons */
        .btn-custom {
            font-family: 'Outfit', sans-serif;
            font-weight: 550;
            font-size: 13.5px;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-custom-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-custom-dark {
            background-color: #111111;
            color: #ffffff;
            border: 1px solid #111111;
        }
        .btn-custom-dark:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
        }
        .btn-custom-light {
            background-color: #ffffff;
            color: #111111;
            border: 1px solid #d5d5d5;
        }
        .btn-custom-light:hover {
            background-color: #fafafa;
            border-color: #111111;
        }
        .btn-custom-danger {
            background-color: #ffffff;
            color: #e02424;
            border: 1px solid #f5c2c2;
        }
        .btn-custom-danger:hover {
            background-color: #fdf2f2;
            border-color: #e02424;
        }
        
        /* Form Inputs */
        .form-label-custom {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #444444;
            margin-bottom: 6px;
        }
        .form-control-custom {
            border: 1px solid #d5d5d5;
            border-radius: 6px;
            padding: 9px 12px;
            font-size: 13.5px;
            background-color: #fafafa;
            color: #111111;
            transition: all 0.2s;
        }
        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: #111111;
            box-shadow: none;
            color: #111111;
        }
        
        /* Pagination overrides */
        .pagination {
            margin-top: 15px;
            margin-bottom: 0;
            gap: 5px;
        }
        .page-item .page-link {
            color: #555555;
            border: 1px solid #e5e5e5;
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 4px;
            transition: all 0.2s;
        }
        .page-item.active .page-link {
            background-color: #111111;
            border-color: #111111;
            color: #ffffff;
        }
        .page-item .page-link:hover {
            background-color: #f5f5f5;
            color: #111111;
            border-color: #d5d5d5;
        }

        /* Notifikasi in-app */
        .alert-custom-box {
            border-radius: 6px;
            padding: 12px 18px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }
        .alert-custom-box-success {
            background-color: #f3faf7;
            color: #03543f;
            border-color: #def7ec;
            border-left-color: #0e9f6e;
        }
        .alert-custom-box-danger {
            background-color: #fdf2f2;
            color: #9b1c1c;
            border-color: #f5c2c2;
            border-left-color: #f05252;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>YINTONG INVENTORY</span>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                </li>
                
                <div class="menu-category">Data Master</div>
                <li class="{{ Request::is('barang*') ? 'active' : '' }}">
                    <a href="{{ route('barang.index') }}"><i class="fa-solid fa-box"></i> Data Barang</a>
                </li>
                <li class="{{ Request::is('kategori*') ? 'active' : '' }}">
                    <a href="{{ route('kategori.index') }}"><i class="fa-solid fa-tags"></i> Kategori Barang</a>
                </li>
                <li class="{{ Request::is('supplier*') ? 'active' : '' }}">
                    <a href="{{ route('supplier.index') }}"><i class="fa-solid fa-truck-field"></i> Supplier / Pemasok</a>
                </li>
                <li class="{{ Request::is('aset-tetap*') ? 'active' : '' }}">
                    <a href="{{ route('aset-tetap.index') }}"><i class="fa-solid fa-building"></i> Aset Tetap (Properti)</a>
                </li>
                
                <div class="menu-category">Transaksi</div>
                <li class="{{ Request::is('barang-masuk*') ? 'active' : '' }}">
                    <a href="{{ route('barang-masuk.index') }}"><i class="fa-solid fa-arrow-down-long"></i> Barang Masuk</a>
                </li>
                <li class="{{ Request::is('barang-keluar*') ? 'active' : '' }}">
                    <a href="{{ route('barang-keluar.index') }}"><i class="fa-solid fa-arrow-up-long"></i> Barang Keluar</a>
                </li>
                <li class="{{ Request::is('mutasi*') ? 'active' : '' }}">
                    <a href="{{ route('mutasi.index') }}"><i class="fa-solid fa-arrows-spin"></i> Mutasi Barang</a>
                </li>
                <li class="{{ Request::is('peminjaman*') ? 'active' : '' }}">
                    <a href="{{ route('peminjaman.index') }}"><i class="fa-solid fa-handshake"></i> Peminjaman Barang</a>
                </li>

                <!-- Sesuai Role Matrix -->
                @if(auth()->user()->role === 'administrator')
                    <div class="menu-category">Sistem</div>
                    <li class="{{ Request::is('users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}"><i class="fa-solid fa-users-gear"></i> Manajemen User</a>
                    </li>
                @endif

                @if(in_array(auth()->user()->role, ['administrator', 'pimpinan']))
                    <div class="menu-category">Laporan</div>
                    <li class="{{ Request::is('laporan*') ? 'active' : '' }}">
                        <a href="{{ route('laporan.index') }}"><i class="fa-solid fa-file-invoice"></i> Laporan Inventori</a>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Main Content Section -->
        <div id="content">
            <!-- Topbar -->
            <header class="navbar-custom">
                <div class="navbar-brand-title">
                    @yield('header_title', 'Sistem Informasi Inventori')
                </div>
                
                <div class="user-profile">
                    <div class="d-flex flex-column align-items-end me-1">
                        <span style="font-size: 13.5px; color: #111111; font-weight: 600;">{{ auth()->user()->nama }}</span>
                        <span class="text-muted text-uppercase" style="font-size: 10px; font-weight: 600; letter-spacing: 0.5px;">{{ auth()->user()->role }}</span>
                    </div>
                    
                    @if(auth()->user()->foto)
                        <img src="{{ asset(auth()->user()->foto) }}" class="user-avatar" alt="Avatar">
                    @else
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                        </div>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-link text-dark p-0" title="Logout" style="font-size: 16px;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="main-container">
                <!-- Breadcrumbs -->
                <div class="breadcrumb-custom">
                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> Beranda</a>
                    @yield('breadcrumbs')
                </div>

                <!-- Global Alert -->
                @if(session('success'))
                    <div class="alert-custom-box alert-custom-box-success">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-custom-box alert-custom-box-danger">
                        <i class="fa-solid fa-circle-exclamation me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
