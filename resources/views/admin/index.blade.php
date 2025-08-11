@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold text-primary">
            <i class="fas fa-users-cog me-2"></i>Manajemen Admin & Pengguna
        </h4>
        <a class="btn btn-primary" href="{{ route('admins.create') }}">
            <i class="fas fa-plus me-1"></i>Tambah Admin
        </a>
    </div>

    <!-- Pending Users Section -->
    @if($pendingUsers->count() > 0)
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning bg-opacity-10 border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-warning">
                    <i class="fas fa-clock me-2"></i>Pengguna Menunggu Persetujuan ({{ $pendingUsers->count() }})
                </h6>
                <a href="{{ route('admin.pending-users') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-eye me-1"></i>Lihat Semua
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Tanggal Registrasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers->take(3) as $user)
                        <tr>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->tanggal_dibuat ? $user->tanggal_dibuat->format('d/m/Y H:i') : 'N/A' }}</td>
                            <td class="d-flex gap-2">
                                <form method="POST" action="{{ route('admin.approve-user', $user->id_pengguna) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui akun ini?')">
                                        <i class="fas fa-check me-1"></i>Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.reject-user', $user->id_pengguna) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak akun ini? Akun akan dihapus permanen.')">
                                        <i class="fas fa-times me-1"></i>Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($pendingUsers->count() > 3)
            <div class="text-center mt-3">
                <small class="text-muted">Menampilkan 3 dari {{ $pendingUsers->count() }} pengguna pending</small>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Admin List Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h6 class="mb-0 fw-bold text-primary">
                <i class="fas fa-users-cog me-2"></i>Daftar Admin
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Super Admin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $admin->nama_lengkap }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @if($admin->is_super_admin)
                                    <span class="badge bg-success">
                                        <i class="fas fa-crown me-1"></i>Super Admin
                                    </span>
                                @else
                                    <span class="badge bg-primary">Admin</span>
                                @endif
                            </td>
                            <td>
                                @if($admin->is_approved)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a class="btn btn-sm btn-warning" href="{{ route('admins.edit', $admin->id_pengguna) }}">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                @if(!$admin->is_super_admin)
                                <form method="POST" action="{{ route('admins.destroy', $admin->id_pengguna) }}" onsubmit="return confirm('Hapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-users fa-2x mb-3"></i>
                                <p class="mb-0">Belum ada admin</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


