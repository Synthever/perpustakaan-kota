<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Kota')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        :root {
            --sidebar-width: 260px;
            --navbar-height: 60px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            height: calc(100vh - var(--navbar-height));
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 4px 10px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }
        .sidebar .nav-link i {
            width: 24px;
            font-size: 18px;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            min-height: calc(100vh - var(--navbar-height));
            padding: 30px;
        }
        .navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            height: var(--navbar-height);
            background: linear-gradient(90deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1001;
        }
        .navbar-brand {
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-brand i {
            font-size: 1.5rem;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        .card-header {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            padding: 15px 20px;
        }
        .btn {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
            border-radius: 6px;
        }
        .btn-group .btn {
            border-radius: 0;
        }
        .btn-group .btn:first-child {
            border-radius: 6px 0 0 6px;
        }
        .btn-group .btn:last-child {
            border-radius: 0 6px 6px 0;
        }
        .btn-group .btn:only-child {
            border-radius: 6px;
        }
        .btn-primary {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            border: none;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background: #eff6ff;
            color: #1e40af;
            font-weight: 600;
            border: none;
            padding: 15px;
        }
        .table tbody tr {
            transition: all 0.3s;
        }
        .table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }
        .alert {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
        }
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        .page-title {
            color: #1e40af;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3b82f6;
            display: inline-block;
        }
        
        /* Pagination Styling */
        .pagination {
            margin: 0;
        }
        .pagination .page-link {
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #dee2e6;
            color: #2563eb;
            font-weight: 500;
            padding: 8px 14px;
            transition: all 0.3s;
        }
        .pagination .page-link:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
            transform: translateY(-2px);
        }
        .pagination .page-item.active .page-link {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            border-color: #3b82f6;
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }
        .pagination .page-item.disabled .page-link {
            background: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }
        
        /* Table Responsive */
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isStaff() ? route('staff.dashboard') : (auth()->user()->isStaffStock() ? route('staff-stock.dashboard') : route('anggota.dashboard')))) : '#' }}">
                <i class="bi bi-book-fill"></i> Perpustakaan Kota
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
                                <div class="d-flex flex-column align-items-start">
                                    <small class="text-white-50" style="font-size: 0.75rem;">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</small>
                                    <span>{{ auth()->user()->username }}</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    @auth
    <div class="sidebar">
        <div class="py-3">
            <div class="px-3 mb-3">
                <small class="text-white-50 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Menu</small>
            </div>
            <nav class="nav flex-column">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ roleRoute('anggota.index') }}" class="nav-link {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill me-2"></i> Anggota
                    </a>
                    <a href="{{ roleRoute('buku.index') }}" class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                        <i class="bi bi-book-fill me-2"></i> Buku
                    </a>
                    <a href="{{ roleRoute('peminjaman.index') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-arrow-down me-2"></i> Peminjaman
                    </a>
                    <a href="{{ roleRoute('booking.index') }}" class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check-fill me-2"></i> Booking
                    </a>
                    <a href="{{ roleRoute('denda.index') }}" class="nav-link {{ request()->routeIs('admin.denda.*') ? 'active' : '' }}">
                        <i class="bi bi-cash-coin me-2"></i> Denda
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-person-gear me-2"></i> Users
                    </a>
                @elseif(auth()->user()->isStaff())
                    <a href="{{ route('staff.dashboard') }}" class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ roleRoute('anggota.index') }}" class="nav-link {{ request()->routeIs('staff.anggota.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill me-2"></i> Anggota
                    </a>
                    <a href="{{ roleRoute('peminjaman.index') }}" class="nav-link {{ request()->routeIs('staff.peminjaman.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-arrow-down me-2"></i> Peminjaman
                    </a>
                    <a href="{{ roleRoute('denda.index') }}" class="nav-link {{ request()->routeIs('staff.denda.*') ? 'active' : '' }}">
                        <i class="bi bi-cash-coin me-2"></i> Denda
                    </a>
                @elseif(auth()->user()->isStaffStock())
                    <a href="{{ route('staff-stock.dashboard') }}" class="nav-link {{ request()->routeIs('staff-stock.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ roleRoute('buku.index') }}" class="nav-link {{ request()->routeIs('staff-stock.buku.*') ? 'active' : '' }}">
                        <i class="bi bi-book-fill me-2"></i> Buku
                    </a>
                @else
                    <a href="{{ route('anggota.dashboard') }}" class="nav-link {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('anggota.booking.index') }}" class="nav-link {{ request()->routeIs('anggota.booking.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check-fill me-2"></i> Booking
                    </a>
                    <a href="{{ route('anggota.peminjaman.index') }}" class="nav-link {{ request()->routeIs('anggota.peminjaman.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-arrow-down me-2"></i> Riwayat Peminjaman
                    </a>
                    <a href="{{ route('anggota.denda.index') }}" class="nav-link {{ request()->routeIs('anggota.denda.*') ? 'active' : '' }}">
                        <i class="bi bi-cash-coin me-2"></i> Denda
                    </a>
                @endif
            </nav>
        </div>
    </div>
    @endauth

    <!-- Main Content -->
    <div class="main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')
</body>
</html>
