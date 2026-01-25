@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Peminjaman</h2>
    <a href="{{ roleRoute('peminjaman.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Informasi Peminjaman</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">ID Peminjaman</th>
                <td>#{{ $peminjaman->id_peminjaman }}</td>
            </tr>
            <tr>
                <th>Anggota</th>
                <td>{{ $peminjaman->anggota->nama_anggota }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ $peminjaman->tanggal_pinjam->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tanggal Jatuh Tempo</th>
                <td>{{ $peminjaman->tanggal_jatuh_tempo->format('d F Y') }}</td>
            </tr>
        </table>

        <h5 class="card-title mt-4">Buku yang Dipinjam</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman->detailPeminjaman as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->buku->judul_buku }}</td>
                    <td>{{ $detail->buku->penulis }}</td>
                    <td>{{ $detail->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($peminjaman->denda)
        <h5 class="card-title mt-4">Informasi Denda</h5>
        <div class="alert alert-danger">
            <h6>Denda: Rp {{ number_format($peminjaman->denda->jumlah_denda, 0, ',', '.') }}</h6>
            <p>Status: <strong>{{ $peminjaman->denda->status_pembayaran }}</strong></p>
        </div>
        @endif
    </div>
</div>
@endsection
