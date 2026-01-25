@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2>Dashboard Staff</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6 class="card-title">Peminjaman Aktif</h6>
                <h2 class="mb-0">{{ $total_peminjaman }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h6 class="card-title">Denda Belum Dibayar</h6>
                <h2 class="mb-0">{{ $total_denda }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Peminjaman Terbaru</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Anggota</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman_terbaru as $p)
                        <tr>
                            <td>{{ $p->anggota->nama_anggota }}</td>
                            <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $p->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
