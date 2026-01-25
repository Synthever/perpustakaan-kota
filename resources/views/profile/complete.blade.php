@extends('layouts.app')

@section('title', 'Lengkapi Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-person-badge me-2"></i>
                    Lengkapi Profil Anda
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Perhatian!</strong> Untuk dapat melakukan peminjaman dan booking buku, Anda harus melengkapi profil terlebih dahulu.
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.complete.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_anggota" class="form-label fw-semibold">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nama_anggota') is-invalid @enderror" 
                                       id="nama_anggota" 
                                       name="nama_anggota" 
                                       value="{{ old('nama_anggota', $anggota->nama_anggota ?? '') }}"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('nama_anggota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_telp" class="form-label fw-semibold">
                                    No. Telepon <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('no_telp') is-invalid @enderror" 
                                       id="no_telp" 
                                       name="no_telp" 
                                       value="{{ old('no_telp', $anggota->no_telp ?? '') }}"
                                       placeholder="Contoh: 081234567890"
                                       required>
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">
                            Alamat Lengkap <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                  id="alamat" 
                                  name="alamat" 
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap"
                                  required>{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pekerjaan" class="form-label fw-semibold">
                            Pekerjaan <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('pekerjaan') is-invalid @enderror" 
                               id="pekerjaan" 
                               name="pekerjaan" 
                               value="{{ old('pekerjaan', $anggota->pekerjaan ?? '') }}"
                               placeholder="Contoh: Mahasiswa, Karyawan Swasta, dll"
                               required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Informasi pekerjaan membantu kami memahami kebutuhan literasi Anda</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Simpan Profil
                        </button>
                        <a href="{{ route('anggota.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Nanti Saja
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-shield-check me-2 text-primary"></i>
                    Mengapa Kami Meminta Informasi Ini?
                </h6>
                <ul class="mb-0">
                    <li class="mb-2"><strong>Nama:</strong> Untuk identifikasi dan keperluan administrasi peminjaman</li>
                    <li class="mb-2"><strong>No. Telepon:</strong> Untuk menghubungi Anda terkait peminjaman, denda, atau informasi penting</li>
                    <li class="mb-2"><strong>Alamat:</strong> Untuk keperluan administrasi dan pengiriman notifikasi</li>
                    <li><strong>Pekerjaan:</strong> Untuk statistik dan pemahaman kebutuhan literasi anggota</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
