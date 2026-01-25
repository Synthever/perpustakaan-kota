@extends('layouts.app')

@section('title', 'Data Denda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0"><i class="bi bi-cash-coin me-2"></i>Data Denda</h2>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        @if(!auth()->user()->isAnggota())
                        <th>Anggota</th>
                        @endif
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah Denda</th>
                        <th style="width: 130px;">Status</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($denda as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($denda->currentPage() - 1) * $denda->perPage() }}</td>
                        @if(!auth()->user()->isAnggota())
                        <td><strong>{{ $item->peminjaman->anggota->nama_anggota }}</strong></td>
                        @endif
                        <td><i class="bi bi-calendar3 me-1"></i>{{ $item->peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td><i class="bi bi-calendar-x me-1"></i>{{ $item->peminjaman->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                        <td class="text-danger fw-bold">Rp {{ number_format($item->jumlah_denda, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status_pembayaran == 'Belum Dibayar' ? 'danger' : 'success' }}">
                            {{ $item->status_pembayaran }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ roleRoute('denda.show', $item->id_denda) }}" class="btn btn-sm btn-info" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($item->status_pembayaran == 'Belum Dibayar' && !auth()->user()->isAnggota())
                                <form action="{{ roleRoute('denda.bayar', $item->id_denda) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Konfirmasi pembayaran denda?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Bayar">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isAnggota() ? '6' : '7' }}" class="text-center py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="text-muted mt-2 mb-0">Tidak ada data denda</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        
        @if($denda->hasPages())
        <div class="d-flex justify-content-between align-items-center p-3 border-top">
            <div class="text-muted small">
                Menampilkan {{ $denda->firstItem() }} - {{ $denda->lastItem() }} dari {{ $denda->total() }} data
            </div>
            <div>
                {{ $denda->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
