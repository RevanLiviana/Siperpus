<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiPerpus - @yield('title', 'Sistem Informasi Perpustakaan')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1a1a2e;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s;
        }
        #sidebar .sidebar-brand {
            padding: 20px;
            background: #16213e;
            text-align: center;
        }
        #sidebar .sidebar-brand h4 {
            color: #e94560;
            font-weight: 700;
            margin: 0;
        }
        #sidebar .sidebar-brand small {
            color: #aaa;
            font-size: 11px;
        }
        #sidebar .nav-link {
            color: #ccc;
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.2s;
            font-size: 14px;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: #e94560;
            color: #fff;
            padding-left: 28px;
        }
        #sidebar .nav-link i {
            margin-right: 10px;
            width: 18px;
        }
        #sidebar .nav-section {
            color: #666;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 5px;
        }
        #sidebar .logout-form button {
            color: #ccc;
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.2s;
            font-size: 14px;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        #sidebar .logout-form button:hover {
            background: #e94560;
            color: #fff;
            padding-left: 28px;
        }
        #sidebar .logout-form button i {
            margin-right: 10px;
            width: 18px;
        }
        #main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        #topbar {
            background: #fff;
            padding: 12px 25px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        #topbar .topbar-title {
            font-weight: 600;
            font-size: 18px;
            color: #1a1a2e;
        }
        #topbar .topbar-user {
            color: #555;
            font-size: 14px;
        }
        .page-content {
            padding: 25px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            padding: 16px 20px;
        }
        .btn-primary {
            background: #e94560;
            border-color: #e94560;
        }
        .btn-primary:hover {
            background: #c73652;
            border-color: #c73652;
        }
        .badge-aktif {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-nonaktif {
            background: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .table thead th {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 13px;
            color: #555;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody td {
            font-size: 14px;
            vertical-align: middle;
        }
    </style>

    @yield('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <div id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-book-half"></i> SiPerpus</h4>
            <small>Sistem Informasi Perpustakaan</small>
        </div>

        <nav class="mt-2">
            <div class="nav-section">Menu Utama</div>
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-section">Data Master</div>
            <a href="{{ route('anggota.index') }}"
               class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Anggota
            </a>
            <a href="{{ route('petugas.index') }}"
               class="nav-link {{ request()->routeIs('petugas.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Petugas
            </a>
            <a href="{{ route('buku.index') }}"
               class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Buku
            </a>

            <div class="nav-section">Akun</div>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main-content">

        <!-- TOPBAR -->
        <div id="topbar">
            <span class="topbar-title">@yield('title', 'Dashboard')</span>
            <span class="topbar-user">
                <i class="bi bi-person-circle me-1"></i>
                {{ Auth::user()->name ?? Auth::user()->nama ?? 'Admin' }}
            </span>
        </div>

        <!-- PAGE CONTENT -->
        <div class="page-content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>