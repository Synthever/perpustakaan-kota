@extends('layouts.app')

@section('title', 'Detail Denda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Denda</h2>
    <a href="{{ roleRoute('denda.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Informasi Denda</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">ID Denda</th>
                <td>#{{ $denda->id_denda }}</td>
            </tr>
            <tr>
                <th>Anggota</th>
                <td>{{ $denda->peminjaman->anggota->nama_anggota }}</td>
            </tr>
            <tr>
                <th>Jumlah Denda</th>
                <td class="text-danger fw-bold fs-4">Rp {{ number_format($denda->jumlah_denda, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>
                    <span class="badge bg-{{ $denda->status_pembayaran == 'Belum Dibayar' ? 'danger' : 'success' }}">
                        {{ $denda->status_pembayaran }}
                    </span>
                </td>
            </tr>
        </table>

        <h5 class="card-title mt-4">Detail Peminjaman</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">Tanggal Pinjam</th>
                <td>{{ $denda->peminjaman->tanggal_pinjam->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tanggal Jatuh Tempo</th>
                <td>{{ $denda->peminjaman->tanggal_jatuh_tempo->format('d F Y') }}</td>
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
                @foreach($denda->peminjaman->detailPeminjaman as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->buku->judul_buku }}</td>
                    <td>{{ $detail->buku->penulis }}</td>
                    <td>{{ $detail->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($denda->status_pembayaran == 'Belum Dibayar' && !auth()->user()->isAnggota())
        <form action="{{ roleRoute('denda.bayar', $denda->id_denda) }}" method="POST" class="mt-3"
              onsubmit="return confirm('Konfirmasi pembayaran denda?')">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Konfirmasi Pembayaran
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
