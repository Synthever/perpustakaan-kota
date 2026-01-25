@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0"><i class="bi bi-people-fill me-2"></i>Data Anggota</h2>
    <a href="{{ roleRoute('anggota.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Anggota
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Tanggal Daftar</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 150px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($anggota->currentPage() - 1) * $anggota->perPage() }}</td>
                        <td><strong>{{ $item->nama_anggota }}</strong></td>
                        <td>{{ Str::limit($item->alamat, 40) }}</td>
                        <td><i class="bi bi-telephone me-1"></i>{{ $item->no_telp }}</td>
                        <td>{{ $item->tanggal_daftar->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status_anggota == 'Aktif' ? 'success' : 'danger' }}">
                                {{ $item->status_anggota }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ roleRoute('anggota.show', $item->id_anggota) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ roleRoute('anggota.edit', $item->id_anggota) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ roleRoute('anggota.destroy', $item->id_anggota) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada data anggota</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($anggota->hasPages())
        <div class="d-flex justify-content-between align-items-center p-3 border-top">
            <div class="text-muted small">
                Menampilkan {{ $anggota->firstItem() }} - {{ $anggota->lastItem() }} dari {{ $anggota->total() }} data
            </div>
            <div>
                {{ $anggota->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
