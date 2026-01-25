@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Peminjaman</h2>
    @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
    <a href="{{ roleRoute('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Peminjaman
    </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $item)
                <tr>
                    <td>{{ $loop->iteration + ($peminjaman->currentPage() - 1) * $peminjaman->perPage() }}</td>
                    <td>{{ $item->anggota->nama_anggota }}</td>
                    <td>{{ $item->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ roleRoute('peminjaman.show', $item->id_peminjaman) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $peminjaman->links() }}
        </div>
    </div>
</div>
@endsection
