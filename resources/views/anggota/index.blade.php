@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Anggota</h2>
    <a href="{{ roleRoute('anggota.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Anggota
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $item)
                <tr>
                    <td>{{ $loop->iteration + ($anggota->currentPage() - 1) * $anggota->perPage() }}</td>
                    <td>{{ $item->nama_anggota }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->tanggal_daftar->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status_anggota == 'Aktif' ? 'success' : 'danger' }}">
                            {{ $item->status_anggota }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ roleRoute('anggota.show', $item->id_anggota) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ roleRoute('anggota.edit', $item->id_anggota) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ roleRoute('anggota.destroy', $item->id_anggota) }}" method="POST" class="d-inline" 
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
            {{ $anggota->links() }}
        </div>
    </div>
</div>
@endsection
