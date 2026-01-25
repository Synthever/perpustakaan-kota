@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="mb-4">
    <h2>Edit Buku</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ roleRoute('buku.update', $buku->id_buku) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" 
                       id="judul_buku" name="judul_buku" value="{{ old('judul_buku', $buku->judul_buku) }}" required>
                @error('judul_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                               id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                               id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
                        @error('penerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                               id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
                        @error('tahun_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                               id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ roleRoute('buku.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
