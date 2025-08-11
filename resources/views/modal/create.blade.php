@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-gradient rounded-circle p-3 me-3">
                    <i class="fas fa-plus text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-1 fw-bold text-warning">Tambah Modal Baru</h2>
                    <p class="text-muted mb-0">Tambah data modal PCM Benowo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold text-warning">
                <i class="fas fa-edit me-2"></i>Form Tambah Modal
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('modal.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-hand-holding-usd me-1"></i>Sumber Modal
                        </label>
                        <input type="text" name="sumber_modal" class="form-control @error('sumber_modal') is-invalid @enderror" 
                               value="{{ old('sumber_modal') }}" placeholder="Masukkan sumber modal" required>
                        @error('sumber_modal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-money-bill-wave me-1"></i>Jumlah
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" 
                                   value="{{ old('jumlah') }}" placeholder="0" step="0.01" min="0" required>
                        </div>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-calendar me-1"></i>Tanggal Terima
                        </label>
                        <input type="date" name="tanggal_terima" class="form-control @error('tanggal_terima') is-invalid @enderror" 
                               value="{{ old('tanggal_terima') }}" required>
                        @error('tanggal_terima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-info-circle me-1"></i>Keterangan
                        </label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                                  rows="3" placeholder="Tambahkan keterangan (opsional)">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('modal.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Simpan Modal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 