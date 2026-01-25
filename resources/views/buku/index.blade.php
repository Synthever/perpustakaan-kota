@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Buku</h2>
    <a href="{{ roleRoute('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Buku
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $item)
                <tr>
                    <td>{{ $loop->iteration + ($buku->currentPage() - 1) * $buku->perPage() }}</td>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>
                        <span class="badge bg-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                            {{ $item->stok }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ roleRoute('buku.show', $item->id_buku) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ roleRoute('buku.edit', $item->id_buku) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ roleRoute('buku.destroy', $item->id_buku) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $buku->links() }}
        </div>
    </div>
</div>
@endsection
