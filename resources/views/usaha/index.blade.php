@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-gradient rounded-circle p-3 me-3">
                    <i class="fas fa-store text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-1 fw-bold text-success">Data Usaha</h2>
                    <p class="text-muted mb-0">Kelola data usaha PCM Benowo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards (non-print) -->
    <div class="row mb-4 no-print">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-store text-white fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-success mb-1">{{ count($usahas) }}</h3>
                    <p class="text-muted mb-0">Total Usaha</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-chart-line text-white fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-info mb-1">{{ $usahas->where('jenis_usaha', 'UMKM')->count() }}</h3>
                    <p class="text-muted mb-0">UMKM</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-building text-white fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-warning mb-1">{{ $usahas->where('jenis_usaha', 'Perusahaan')->count() }}</h3>
                    <p class="text-muted mb-0">Perusahaan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button -->
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <a href="{{ route('usaha.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Tambah Usaha Baru
            </a>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Print
            </button>
            <a class="btn btn-outline-info" href="{{ route('export.usaha') }}">
                <i class="fas a-file-excel me-2"></i>Export Excel
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show no-print" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 no-print">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="fas fa-list me-2"></i>Daftar Usaha
                </h5>
                <span class="badge bg-success">{{ $usahas->count() }} Usaha</span>
            </div>
        </div>
        <div class="card-body p-0 print-area">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0">No</th>
                            <th class="border-0">Nama Usaha</th>
                            <th class="border-0">Jenis Usaha</th>
                            <th class="border-0">Keterangan</th>
                            <th class="border-0">Tanggal Dibuat</th>
                            <th class="border-0 text-center no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usahas as $i => $usaha)
                        <tr>
                            <td class="align-middle">{{ $i+1 }}</td>
                            <td class="align-middle">
                                <div class="fw-semibold">{{ $usaha->nama_usaha }}</div>
                            </td>
                            <td class="align-middle">
                                @if($usaha->jenis_usaha == 'UMKM')
                                    <span class="badge bg-info">{{ $usaha->jenis_usaha }}</span>
                                @elseif($usaha->jenis_usaha == 'Perusahaan')
                                    <span class="badge bg-warning">{{ $usaha->jenis_usaha }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $usaha->jenis_usaha }}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if($usaha->keterangan)
                                    <span class="text-muted">{{ Str::limit($usaha->keterangan, 50) }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <span class="text-muted">{{ \Carbon\Carbon::parse($usaha->tanggal_dibuat)->format('d/m/Y') }}</span>
                            </td>
                            <td class="align-middle no-print">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('usaha.edit', $usaha->id_usaha) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $usaha->id_usaha }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $usaha->id_usaha }}" action="{{ route('usaha.destroy', $usaha->id_usaha) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-store fs-1 mb-3"></i>
                                    <p class="mb-0">Belum ada data usaha</p>
                                    <small>Klik tombol "Tambah Usaha Baru" untuk menambahkan usaha pertama</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade no-print" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus usaha ini?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const confirmBtn = document.getElementById('confirmDelete');
    
    confirmBtn.onclick = function() {
        document.getElementById('delete-form-' + id).submit();
    };
    
    modal.show();
}

// export handled by link
</script>
@endpush 