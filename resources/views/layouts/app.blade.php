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
        :root {
            --bg-app: #F4F5F7;
            --sidebar-bg: #FFFFFF;
            --emerald-primary: #0F5A37;
            --emerald-hover: #0A4328;
            --mint-light: #E6F4ED;
            --mint-text: #0D5230;
            --text-main: #111827;
            --text-muted: #6B7280;
            --card-radius: 20px;
            --border-color: #EAECEF;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            margin: 0;
            padding: 16px;
            min-height: 100vh;
        }
        
        /* App Outer Frame */
        .app-container {
            display: flex;
            width: 100%;
            min-height: calc(100vh - 32px);
            gap: 20px;
        }
        
        /* Sidebar Layout */
        #sidebar {
            width: 260px;
            min-width: 260px;
            background-color: var(--sidebar-bg);
            border-radius: var(--card-radius);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            transition: all 0.3s;
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px 20px 12px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .brand-logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--emerald-primary) 0%, #168050 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(15, 90, 55, 0.25);
        }
        
        .brand-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        ul.sidebar-menu {
            padding: 16px 0;
            margin: 0;
            list-style: none;
        }
        
        .menu-category-title {
            padding: 14px 14px 6px 14px;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #A0AEC0;
        }
        
        ul.sidebar-menu li a {
            padding: 11px 16px;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }
        
        ul.sidebar-menu li a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }
        
        ul.sidebar-menu li a:hover {
            color: var(--emerald-primary);
            background-color: var(--mint-light);
        }
        
        ul.sidebar-menu li.active > a {
            color: #ffffff;
            background-color: var(--emerald-primary);
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(15, 90, 55, 0.25);
        }

        /* Sidebar Bottom Widget */
        .sidebar-bottom-card {
            background: linear-gradient(135deg, #0F5A37 0%, #063821 100%);
            border-radius: 16px;
            padding: 18px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            margin-top: auto;
        }
        .sidebar-bottom-card::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            top: -30px;
            right: -30px;
        }
        .sidebar-bottom-title {
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .sidebar-bottom-desc {
            font-size: 11px;
            color: rgba(255,255,255,0.75);
            margin-bottom: 12px;
            line-height: 1.4;
        }
        .btn-sidebar-widget {
            background-color: rgba(255,255,255,0.2);
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.3);
            font-size: 11px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-sidebar-widget:hover {
            background-color: #ffffff;
            color: var(--emerald-primary);
        }
        
        /* Main Workspace Content Area */
        #content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        
        /* Top Navigation Header */
        .topbar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--sidebar-bg);
            border-radius: var(--card-radius);
            border: 1px solid var(--border-color);
            padding: 12px 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        
        .header-search-box {
            position: relative;
            width: 360px;
        }
        .header-search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
        }
        .header-search-box input {
            width: 100%;
            background-color: var(--bg-app);
            border: 1px solid transparent;
            border-radius: 30px;
            padding: 9px 40px 9px 42px;
            font-size: 13px;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s;
        }
        .header-search-box input:focus {
            background-color: #ffffff;
            border-color: var(--emerald-primary);
            box-shadow: 0 0 0 3px rgba(15, 90, 55, 0.1);
        }
        .header-search-box .kbd-shortcut {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 10.5px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-circle-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--bg-app);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            text-decoration: none;
            transition: all 0.2s;
        }
        .icon-circle-btn:hover {
            background-color: var(--mint-light);
            color: var(--emerald-primary);
        }

        .user-profile-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 14px 4px 6px;
            background-color: var(--bg-app);
            border-radius: 30px;
            border: 1px solid var(--border-color);
        }
        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background-color: var(--emerald-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13.5px;
            overflow: hidden;
            object-fit: cover;
        }
        
        /* Main Container Cards */
        .main-container {
            flex: 1;
        }
        
        .card-custom {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--card-radius);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.02);
            margin-bottom: 24px;
            padding: 24px;
        }

        /* Stat Cards - Donezo Pattern */
        .stat-card-donezo {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--card-radius);
            padding: 22px;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .stat-card-donezo:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
        }

        /* Emerald Featured Stat Card */
        .stat-card-donezo.featured-emerald {
            background: linear-gradient(135deg, #0F5A37 0%, #083E25 100%);
            color: #ffffff;
            border: none;
            box-shadow: 0 8px 25px rgba(15, 90, 55, 0.2);
        }
        .stat-card-donezo.featured-emerald .stat-title {
            color: rgba(255,255,255,0.85);
        }
        .stat-card-donezo.featured-emerald .stat-number {
            color: #ffffff;
        }
        .stat-card-donezo.featured-emerald .arrow-btn-circle {
            background-color: rgba(255,255,255,0.2);
            color: #ffffff;
            border: none;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .stat-title {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-muted);
        }
        .arrow-btn-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background-color: var(--bg-app);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            font-size: 13px;
        }
        .stat-number {
            font-family: 'Outfit', sans-serif;
            font-size: 34px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.1;
            margin-bottom: 10px;
        }
        .stat-footnote {
            font-size: 11.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Clean Table Styles */
        .table-custom {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--text-main);
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-custom th {
            background-color: var(--bg-app);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-color);
            padding: 12px 18px;
            text-align: left;
        }
        .table-custom th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }
        .table-custom th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .table-custom td {
            padding: 14px 18px;
            font-size: 13.5px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }
        .table-custom tr:hover td {
            background-color: #FAFAFA;
        }
        
        /* Modern Rounded Badges */
        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 20px;
            background-color: var(--bg-app);
            color: var(--text-muted);
        }
        .badge-custom.badge-success {
            background-color: var(--mint-light);
            color: var(--mint-text);
        }
        .badge-custom.badge-danger {
            background-color: #FDF2F2;
            color: #9B1C1C;
        }
        .badge-custom.badge-warning {
            background-color: #FEF3C7;
            color: #92400E;
        }
        .badge-custom.badge-dark {
            background-color: var(--emerald-primary);
            color: #ffffff;
        }

        /* Modern Rounded Action Buttons */
        .btn-custom {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 13px;
            padding: 9px 18px;
            border-radius: 30px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-custom-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 20px;
        }
        .btn-custom-dark {
            background-color: var(--emerald-primary);
            color: #ffffff;
            border: 1px solid var(--emerald-primary);
            box-shadow: 0 4px 12px rgba(15, 90, 55, 0.2);
        }
        .btn-custom-dark:hover {
            background-color: var(--emerald-hover);
            border-color: var(--emerald-hover);
            color: #ffffff;
        }
        .btn-custom-light {
            background-color: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }
        .btn-custom-light:hover {
            background-color: var(--bg-app);
            color: var(--text-main);
        }
        .btn-custom-danger {
            background-color: #ffffff;
            color: #DC2626;
            border: 1px solid #FCA5A5;
        }
        .btn-custom-danger:hover {
            background-color: #FDF2F2;
        }
        
        /* Form Inputs */
        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
        }
        .form-control-custom {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 13.5px;
            background-color: #ffffff;
            color: var(--text-main);
            transition: all 0.2s;
        }
        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: var(--emerald-primary);
            box-shadow: 0 0 0 3px rgba(15, 90, 55, 0.1);
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }
        .breadcrumb-custom a {
            color: var(--text-muted);
            text-decoration: none;
        }
        .breadcrumb-custom a:hover {
            color: var(--emerald-primary);
        }
        .breadcrumb-custom .active {
            color: var(--text-main);
            font-weight: 600;
        }

        /* Pagination overrides */
        .pagination {
            margin-top: 15px;
            margin-bottom: 0;
            gap: 5px;
        }
        .page-item .page-link {
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .page-item.active .page-link {
            background-color: var(--emerald-primary);
            border-color: var(--emerald-primary);
            color: #ffffff;
        }
        .page-item .page-link:hover {
            background-color: var(--mint-light);
            color: var(--emerald-primary);
        }

        /* Alert Box */
        .alert-custom-box {
            border-radius: 14px;
            padding: 12px 18px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }
        .alert-custom-box-success {
            background-color: var(--mint-light);
            color: var(--mint-text);
            border-color: #DEF7EC;
            border-left-color: var(--emerald-primary);
        }
        .alert-custom-box-danger {
            background-color: #FDF2F2;
            color: #9B1C1C;
            border-color: #F5C2C2;
            border-left-color: #F05252;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Donezo-style Left Sidebar -->
        <nav id="sidebar">
            <div>
                <div class="sidebar-brand">
                    <div class="brand-logo-icon" style="background: transparent; border: none;">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Yintong" style="height: 38px; width: 38px; object-fit: contain;">
                    </div>
                    <span class="brand-text">Yintong</span>
                </div>

                <ul class="sidebar-menu">
                    <div class="menu-category-title">Utama</div>
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                    </li>
                    
                    <div class="menu-category-title">Data Master</div>
                    <li class="{{ Request::is('barang*') ? 'active' : '' }}">
                        <a href="{{ route('barang.index') }}"><i class="fa-solid fa-box-archive"></i> Data Barang</a>
                    </li>
                    <li class="{{ Request::is('kategori*') ? 'active' : '' }}">
                        <a href="{{ route('kategori.index') }}"><i class="fa-solid fa-tags"></i> Kategori Barang</a>
                    </li>
                    <li class="{{ Request::is('supplier*') ? 'active' : '' }}">
                        <a href="{{ route('supplier.index') }}"><i class="fa-solid fa-truck-field"></i> Supplier / Pemasok</a>
                    </li>
                    
                    <div class="menu-category-title">Transaksi</div>
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

                    @if(auth()->user()->role === 'administrator')
                        <div class="menu-category-title">Sistem</div>
                        <li class="{{ Request::is('users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}"><i class="fa-solid fa-users-gear"></i> Manajemen User</a>
                        </li>
                    @endif

                    @if(in_array(auth()->user()->role, ['administrator', 'pimpinan']))
                        <div class="menu-category-title">Laporan</div>
                        <li class="{{ Request::is('laporan*') ? 'active' : '' }}">
                            <a href="{{ route('laporan.index') }}"><i class="fa-solid fa-file-invoice"></i> Laporan Inventori</a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Sidebar Bottom Info Widget -->
            <div class="sidebar-bottom-card">
                <div class="sidebar-bottom-title">Inventori Kantor</div>
                <div class="sidebar-bottom-desc">Sistem Pengelolaan Stok & Aset Berbasis Web</div>
                <a href="{{ route('dashboard') }}" class="btn-sidebar-widget">Overview</a>
            </div>
        </nav>

        <!-- Main Content Section -->
        <div id="content">
            <!-- Donezo Topbar Header -->
            <header class="topbar-header">
                <!-- Search input bar -->
                <div class="header-search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari data barang, supplier, transaksi..." id="globalSearchInput">
                    <span class="kbd-shortcut">⌘F</span>
                </div>
                
                <!-- Actions & User Profile Pill -->
                <div class="header-actions">
                    <a href="{{ route('laporan.index') }}" class="icon-circle-btn" title="Laporan & Ringkasan">
                        <i class="fa-regular fa-bell"></i>
                    </a>
                    
                    <div class="user-profile-pill">
                        @if(auth()->user()->foto)
                            <img src="{{ asset(auth()->user()->foto) }}" class="user-avatar" alt="Avatar">
                        @else
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                            </div>
                        @endif
                        
                        <div class="d-flex flex-column me-2">
                            <span style="font-size: 13px; color: var(--text-main); font-weight: 600; line-height: 1.2;">{{ auth()->user()->nama }}</span>
                            <span class="text-muted text-uppercase" style="font-size: 10px; font-weight: 600; letter-spacing: 0.5px;">{{ auth()->user()->role }}</span>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-muted p-0 ms-1" title="Logout" style="font-size: 15px;">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="main-container">
                <!-- Breadcrumbs -->
                <div class="breadcrumb-custom">
                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> Beranda</a>
                    @yield('breadcrumbs')
                </div>

                <!-- Global Alerts -->
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

