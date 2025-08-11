@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-gradient rounded-circle p-3 me-3">
                    <i class="fas fa-edit text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-1 fw-bold text-warning">Edit Usaha</h2>
                    <p class="text-muted mb-0">Edit data usaha PCM Benowo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold text-warning">
                <i class="fas fa-edit me-2"></i>Form Edit Usaha
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('usaha.update', $usaha->id_usaha) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-store me-1"></i>Nama Usaha
                        </label>
                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" 
                               value="{{ old('nama_usaha', $usaha->nama_usaha) }}" placeholder="Masukkan nama usaha" required>
                        @error('nama_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-tags me-1"></i>Jenis Usaha
                        </label>
                        <select name="jenis_usaha" class="form-select @error('jenis_usaha') is-invalid @enderror" required>
                            <option value="">Pilih jenis usaha</option>
                            <option value="UMKM" {{ old('jenis_usaha', $usaha->jenis_usaha) == 'UMKM' ? 'selected' : '' }}>UMKM</option>
                            <option value="Perusahaan" {{ old('jenis_usaha', $usaha->jenis_usaha) == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                            <option value="Toko" {{ old('jenis_usaha', $usaha->jenis_usaha) == 'Toko' ? 'selected' : '' }}>Toko</option>
                            <option value="Warung" {{ old('jenis_usaha', $usaha->jenis_usaha) == 'Warung' ? 'selected' : '' }}>Warung</option>
                            <option value="Lainnya" {{ old('jenis_usaha', $usaha->jenis_usaha) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-info-circle me-1"></i>Keterangan
                        </label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                                  rows="4" placeholder="Tambahkan keterangan usaha (opsional)">{{ old('keterangan', $usaha->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('usaha.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Update Usaha
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 