@extends('layouts.app')

@section('title', 'Pengembalian Buku')

@section('content')
<div class="mb-4">
    <h2>Proses Pengembalian Buku</h2>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Detail Peminjaman</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">Anggota</th>
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
            <tr>
                <th>Buku yang Dipinjam</th>
                <td>
                    <ul class="mb-0">
                        @foreach($peminjaman->detailPeminjaman as $detail)
                            <li>{{ $detail->buku->judul_buku }} ({{ $detail->jumlah }} buku)</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ roleRoute('peminjaman.kembali', $peminjaman->id_peminjaman) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" 
                       id="tanggal_kembali" name="tanggal_kembali" value="{{ date('Y-m-d') }}" required>
                @error('tanggal_kembali')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> 
                Jika terlambat, sistem akan otomatis menghitung denda (Rp 1.000/hari)
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Proses Pengembalian
                </button>
                <a href="{{ roleRoute('peminjaman.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
