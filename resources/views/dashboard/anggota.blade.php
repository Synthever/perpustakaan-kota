@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2>Dashboard Anggota</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Peminjaman Aktif</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Buku</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman_aktif as $p)
                        <tr>
                            <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $p->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                            <td>
                                @foreach($p->detailPeminjaman as $detail)
                                    - {{ $detail->buku->judul_buku }} ({{ $detail->jumlah }})<br>
                                @endforeach
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada peminjaman aktif</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Booking Menunggu</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($booking as $b)
                        <tr>
                            <td>{{ $b->buku->judul_buku }}</td>
                            <td><span class="badge bg-warning">{{ $b->status_booking }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada booking</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Denda Belum Dibayar</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Peminjaman</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($denda as $d)
                        <tr>
                            <td>{{ $d->peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td class="text-danger fw-bold">Rp {{ number_format($d->jumlah_denda, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada denda</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
