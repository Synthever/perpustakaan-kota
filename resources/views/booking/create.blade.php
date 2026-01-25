@extends('layouts.app')

@section('title', 'Buat Booking')

@section('content')
<div class="mb-4">
    <h2>Buat Booking Buku</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('anggota.booking.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_buku" class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                <select class="form-select select2-buku @error('id_buku') is-invalid @enderror" 
                        id="id_buku" name="id_buku" required>
                    <option value="">Pilih Buku</option>
                    @foreach($buku as $b)
                        <option value="{{ $b->id_buku }}" {{ old('id_buku') == $b->id_buku ? 'selected' : '' }}>
                            {{ $b->judul_buku }} - {{ $b->penulis }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
                @error('id_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_booking" class="form-label">Tanggal Booking <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('tanggal_booking') is-invalid @enderror" 
                       id="tanggal_booking" name="tanggal_booking" value="{{ old('tanggal_booking', date('Y-m-d')) }}" required>
                @error('tanggal_booking')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('anggota.booking.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('.select2-buku').select2({
        theme: 'bootstrap-5',
        placeholder: 'Cari buku...',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
@endsection
