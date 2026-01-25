@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2>Dashboard Administrator</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Anggota</h6>
                        <h2 class="mb-0">{{ $total_anggota }}</h2>
                    </div>
                    <i class="bi bi-people" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Buku</h6>
                        <h2 class="mb-0">{{ $total_buku }}</h2>
                    </div>
                    <i class="bi bi-book" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Peminjaman Aktif</h6>
                        <h2 class="mb-0">{{ $total_peminjaman }}</h2>
                    </div>
                    <i class="bi bi-journal-arrow-down" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Denda Belum Dibayar</h6>
                        <h2 class="mb-0">Rp {{ number_format($total_denda_belum_dibayar, 0, ',', '.') }}</h2>
                    </div>
                    <i class="bi bi-cash" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menu Cepat</h5>
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ roleRoute('anggota.create') }}" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-person-plus"></i> Tambah Anggota
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ roleRoute('buku.create') }}" class="btn btn-outline-success w-100 mb-2">
                            <i class="bi bi-book"></i> Tambah Buku
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ roleRoute('peminjaman.create') }}" class="btn btn-outline-warning w-100 mb-2">
                            <i class="bi bi-journal-plus"></i> Buat Peminjaman
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ roleRoute('users.create') }}" class="btn btn-outline-info w-100 mb-2">
                            <i class="bi bi-person-gear"></i> Tambah User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
