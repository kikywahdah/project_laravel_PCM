@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-clock me-2"></i>Pengguna Menunggu Persetujuan
                        </h5>
                        <a href="{{ route('admins.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Admin
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($pendingUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Tanggal Registrasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingUsers as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->tanggal_dibuat ? $user->tanggal_dibuat->format('d/m/Y H:i') : 'N/A' }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.approve-user', $user->id_pengguna) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-2" onclick="return confirm('Setujui akun ini?')">
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
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">Tidak ada pengguna yang menunggu persetujuan</h5>
                            <p class="text-muted">Semua pengguna telah disetujui atau ditolak.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
