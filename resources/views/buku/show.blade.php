@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Buku</h2>
    <a href="{{ roleRoute('buku.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="200">Judul Buku</th>
                <td>{{ $buku->judul_buku }}</td>
            </tr>
            <tr>
                <th>Penulis</th>
                <td>{{ $buku->penulis }}</td>
            </tr>
            <tr>
                <th>Penerbit</th>
                <td>{{ $buku->penerbit }}</td>
            </tr>
            <tr>
                <th>Tahun Terbit</th>
                <td>{{ $buku->tahun_terbit }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>
                    <span class="badge bg-{{ $buku->stok > 0 ? 'success' : 'danger' }}">
                        {{ $buku->stok }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="mt-3">
            <a href="{{ roleRoute('buku.edit', $buku->id_buku) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ roleRoute('buku.destroy', $buku->id_buku) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
