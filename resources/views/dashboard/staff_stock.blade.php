@extends('layouts.app')

@section('title', 'Dashboard Staff Stock')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2>Dashboard Staff Stock</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6 class="card-title">Total Buku</h6>
                <h2 class="mb-0">{{ $total_buku }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Buku dengan Stok Rendah (< 5)</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buku_stok_rendah as $b)
                        <tr>
                            <td>{{ $b->judul_buku }}</td>
                            <td>{{ $b->penulis }}</td>
                            <td><span class="badge bg-danger">{{ $b->stok }}</span></td>
                            <td>
                                <a href="{{ roleRoute('buku.edit', $b->id_buku) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Update Stok
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Semua buku memiliki stok cukup</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
