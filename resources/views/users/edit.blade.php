@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="mb-4">
    <h2>Edit User</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                <select class="form-select @error('role') is-invalid @enderror" 
                        id="role" name="role" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="staff_stock" {{ old('role', $user->role) == 'staff_stock' ? 'selected' : '' }}>Staff Stock</option>
                    <option value="anggota" {{ old('role', $user->role) == 'anggota' ? 'selected' : '' }}>Anggota</option>
                </select>
                @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
