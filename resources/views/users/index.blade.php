@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data User</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Anggota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $item)
                <tr>
                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        <span class="badge bg-{{ $item->role == 'admin' ? 'danger' : ($item->role == 'anggota' ? 'info' : 'warning') }}">
                            {{ ucfirst(str_replace('_', ' ', $item->role)) }}
                        </span>
                    </td>
                    <td>{{ $item->anggota ? $item->anggota->nama_anggota : '-' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $item->id_user) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if($item->id_user != auth()->user()->id_user)
                        <form action="{{ route('users.destroy', $item->id_user) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
