@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Anggota</h2>
    <a href="{{ roleRoute('anggota.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="200">Nama Anggota</th>
                <td>{{ $anggotum->nama_anggota }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $anggotum->alamat }}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td>{{ $anggotum->no_telp }}</td>
            </tr>
            <tr>
                <th>Tanggal Daftar</th>
                <td>{{ $anggotum->tanggal_daftar->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-{{ $anggotum->status_anggota == 'Aktif' ? 'success' : 'danger' }}">
                        {{ $anggotum->status_anggota }}
                    </span>
                </td>
            </tr>
            @if($anggotum->user)
            <tr>
                <th>Username</th>
                <td>{{ $anggotum->user->username }}</td>
            </tr>
            @endif
        </table>

        <div class="mt-3">
            <a href="{{ roleRoute('anggota.edit', $anggotum->id_anggota) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ roleRoute('anggota.destroy', $anggotum->id_anggota) }}" method="POST" class="d-inline"
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
