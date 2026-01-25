@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="mb-4">
    <h2>Buat Peminjaman Baru</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ roleRoute('peminjaman.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="id_anggota" class="form-label">Anggota <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_anggota') is-invalid @enderror" 
                                id="id_anggota" name="id_anggota" required>
                            <option value="">Pilih Anggota</option>
                            @foreach($anggota as $a)
                                <option value="{{ $a->id_anggota }}" {{ old('id_anggota') == $a->id_anggota ? 'selected' : '' }}>
                                    {{ $a->nama_anggota }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" 
                               id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                        @error('tanggal_pinjam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tanggal_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror" 
                               id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="{{ old('tanggal_jatuh_tempo', date('Y-m-d', strtotime('+7 days'))) }}" required>
                        @error('tanggal_jatuh_tempo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>

            <h5>Buku yang Dipinjam</h5>
            <div id="bukuContainer">
                <div class="row mb-3 buku-item">
                    <div class="col-md-8">
                        <label class="form-label">Buku <span class="text-danger">*</span></label>
                        <select class="form-select" name="buku[0][id_buku]" required>
                            <option value="">Pilih Buku</option>
                            @foreach($buku as $b)
                                <option value="{{ $b->id_buku }}">
                                    {{ $b->judul_buku }} (Stok: {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="buku[0][jumlah]" value="1" min="1" required>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-danger w-100 remove-buku" disabled>
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-sm btn-secondary mb-3" id="addBuku">
                <i class="bi bi-plus"></i> Tambah Buku
            </button>

            @error('buku')
                <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ roleRoute('peminjaman.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let bukuIndex = 1;

document.getElementById('addBuku').addEventListener('click', function() {
    const container = document.getElementById('bukuContainer');
    const bukuOptions = `@foreach($buku as $b)<option value="{{ $b->id_buku }}">{{ $b->judul_buku }} (Stok: {{ $b->stok }})</option>@endforeach`;
    
    const newRow = `
        <div class="row mb-3 buku-item">
            <div class="col-md-8">
                <select class="form-select" name="buku[${bukuIndex}][id_buku]" required>
                    <option value="">Pilih Buku</option>
                    ${bukuOptions}
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="buku[${bukuIndex}][jumlah]" value="1" min="1" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger w-100 remove-buku">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', newRow);
    bukuIndex++;
    updateRemoveButtons();
});

document.getElementById('bukuContainer').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-buku') || e.target.parentElement.classList.contains('remove-buku')) {
        const bukuItem = e.target.closest('.buku-item');
        bukuItem.remove();
        updateRemoveButtons();
    }
});

function updateRemoveButtons() {
    const items = document.querySelectorAll('.buku-item');
    items.forEach((item, index) => {
        const removeBtn = item.querySelector('.remove-buku');
        removeBtn.disabled = items.length === 1;
    });
}
</script>
@endpush
@endsection
