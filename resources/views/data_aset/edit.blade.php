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
                    <h2 class="mb-1 fw-bold text-warning">Edit Aset</h2>
                    <p class="text-muted mb-0">Edit data aset PCM Benowo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold text-warning">
                <i class="fas fa-edit me-2"></i>Form Edit Aset
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('data_aset.update', $aset->id_aset) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-box me-1"></i>Nama Aset
                        </label>
                        <input type="text" name="nama_aset" class="form-control @error('nama_aset') is-invalid @enderror" 
                               value="{{ old('nama_aset', $aset->nama_aset) }}" placeholder="Masukkan nama aset" required>
                        @error('nama_aset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-tags me-1"></i>Jenis Aset
                        </label>
                        <select name="jenis_aset" class="form-select @error('jenis_aset') is-invalid @enderror" required>
                            <option value="">Pilih jenis aset</option>
                            <option value="Tanah" {{ old('jenis_aset', $aset->jenis_aset) == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                            <option value="Bangunan" {{ old('jenis_aset', $aset->jenis_aset) == 'Bangunan' ? 'selected' : '' }}>Bangunan</option>
                            <option value="Kendaraan" {{ old('jenis_aset', $aset->jenis_aset) == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                            <option value="Peralatan" {{ old('jenis_aset', $aset->jenis_aset) == 'Peralatan' ? 'selected' : '' }}>Peralatan</option>
                            <option value="Inventaris" {{ old('jenis_aset', $aset->jenis_aset) == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                            <option value="Lainnya" {{ old('jenis_aset', $aset->jenis_aset) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_aset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-map-marker-alt me-1"></i>Lokasi
                        </label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                               value="{{ old('lokasi', $aset->lokasi) }}" placeholder="Masukkan lokasi aset" required>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-ruler-combined me-1"></i>Luas
                        </label>
                        <input type="text" name="luas" class="form-control @error('luas') is-invalid @enderror" 
                               value="{{ old('luas', $aset->luas) }}" placeholder="Contoh: 100 m²">
                        @error('luas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user-check me-1"></i>Status Kepemilikan
                        </label>
                        <select name="status_kepemilikan" class="form-select @error('status_kepemilikan') is-invalid @enderror" required>
                            <option value="">Pilih status kepemilikan</option>
                            <option value="Milik Sendiri" {{ old('status_kepemilikan', $aset->status_kepemilikan) == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                            <option value="Sewa" {{ old('status_kepemilikan', $aset->status_kepemilikan) == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                            <option value="Hibah" {{ old('status_kepemilikan', $aset->status_kepemilikan) == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                            <option value="Pinjaman" {{ old('status_kepemilikan', $aset->status_kepemilikan) == 'Pinjaman' ? 'selected' : '' }}>Pinjaman</option>
                        </select>
                        @error('status_kepemilikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-calendar me-1"></i>Tahun Perolehan
                        </label>
                        <input type="number" name="tahun_perolehan" class="form-control @error('tahun_perolehan') is-invalid @enderror" 
                               value="{{ old('tahun_perolehan', $aset->tahun_perolehan) }}" placeholder="Contoh: 2023" min="1900" max="{{ date('Y') }}" required>
                        @error('tahun_perolehan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-money-bill-wave me-1"></i>Nilai Aset
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="nilai_aset" class="form-control @error('nilai_aset') is-invalid @enderror" 
                                   value="{{ old('nilai_aset', $aset->nilai_aset) }}" placeholder="0" step="0.01" min="0">
                        </div>
                        @error('nilai_aset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-info-circle me-1"></i>Keterangan
                        </label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                                  rows="3" placeholder="Tambahkan keterangan (opsional)">{{ old('keterangan', $aset->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('data_aset.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Update Aset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 