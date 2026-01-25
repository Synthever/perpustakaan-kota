@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<div class="mb-4">
    <h2>Edit Anggota</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ roleRoute('anggota.update', $anggotum->id_anggota) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_anggota" class="form-label">Nama Anggota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" 
                               id="nama_anggota" name="nama_anggota" value="{{ old('nama_anggota', $anggotum->nama_anggota) }}" required>
                        @error('nama_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                               id="no_telp" name="no_telp" value="{{ old('no_telp', $anggotum->no_telp) }}" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" name="alamat" rows="3" required>{{ old('alamat', $anggotum->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_daftar') is-invalid @enderror" 
                               id="tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar', $anggotum->tanggal_daftar->format('Y-m-d')) }}" required>
                        @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status_anggota" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status_anggota') is-invalid @enderror" 
                                id="status_anggota" name="status_anggota" required>
                            <option value="Aktif" {{ old('status_anggota', $anggotum->status_anggota) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status_anggota', $anggotum->status_anggota) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ roleRoute('anggota.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
