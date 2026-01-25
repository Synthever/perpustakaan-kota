@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="mb-4">
    <h2>Tambah Anggota Baru</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ roleRoute('anggota.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_anggota" class="form-label">Nama Anggota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" 
                               id="nama_anggota" name="nama_anggota" value="{{ old('nama_anggota') }}" required>
                        @error('nama_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                               id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_daftar') is-invalid @enderror" 
                               id="tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar', date('Y-m-d')) }}" required>
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
                            <option value="Aktif" {{ old('status_anggota') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status_anggota') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>

            <h5>Data Login Anggota</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                               id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ roleRoute('anggota.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
