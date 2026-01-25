@extends('layouts.app')

@section('title', 'Data Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Booking</h2>
    @if(auth()->user()->isAnggota())
    <a href="{{ route('anggota.booking.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Booking
    </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    @if(!auth()->user()->isAnggota())
                    <th>Anggota</th>
                    @endif
                    <th>Buku</th>
                    <th>Tanggal Booking</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($booking as $item)
                <tr>
                    <td>{{ $loop->iteration + ($booking->currentPage() - 1) * $booking->perPage() }}</td>
                    @if(!auth()->user()->isAnggota())
                    <td>{{ $item->anggota->nama_anggota }}</td>
                    @endif
                    <td>{{ $item->buku->judul_buku }}</td>
                    <td>{{ $item->tanggal_booking->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status_booking == 'Menunggu' ? 'warning' : ($item->status_booking == 'Disetujui' ? 'success' : 'danger') }}">
                            {{ $item->status_booking }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ roleRoute('booking.show', $item->id_booking) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        @if(!auth()->user()->isAnggota() && $item->status_booking == 'Menunggu')
                            <form action="{{ roleRoute('booking.updateStatus', $item->id_booking) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status_booking" value="Disetujui">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-check"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ roleRoute('booking.updateStatus', $item->id_booking) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status_booking" value="Ditolak">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-x"></i> Tolak
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isAnggota() ? '5' : '6' }}" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $booking->links() }}
        </div>
    </div>
</div>
@endsection
