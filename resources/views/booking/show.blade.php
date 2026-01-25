@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Booking</h2>
    <a href="{{ roleRoute('booking.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="200">ID Booking</th>
                <td>#{{ $booking->id_booking }}</td>
            </tr>
            <tr>
                <th>Anggota</th>
                <td>{{ $booking->anggota->nama_anggota }}</td>
            </tr>
            <tr>
                <th>Buku</th>
                <td>{{ $booking->buku->judul_buku }}</td>
            </tr>
            <tr>
                <th>Penulis</th>
                <td>{{ $booking->buku->penulis }}</td>
            </tr>
            <tr>
                <th>Tanggal Booking</th>
                <td>{{ $booking->tanggal_booking->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-{{ $booking->status_booking == 'Menunggu' ? 'warning' : ($booking->status_booking == 'Disetujui' ? 'success' : 'danger') }}">
                        {{ $booking->status_booking }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
