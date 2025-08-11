@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Profil Saya</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4 p-3 bg-light rounded">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-info bg-gradient rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 42px; height: 42px;">
                                <i class="fas fa-user-shield text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $user->nama_lengkap }}</div>
                                <small class="text-muted">{{ $user->email }}</small>
                                @if($user->is_super_admin)
                                    <span class="badge bg-success ms-1">Super Admin</span>
                                @elseif($user->is_admin)
                                    <span class="badge bg-primary ms-1">Admin</span>
                                @endif
                            </div>
                        </div>
                        <div class="row small text-muted">
                            <div class="col-12 col-md-6">
                                <i class="fas fa-calendar me-1 text-primary"></i>
                                Registrasi: {{ $user->tanggal_dibuat ? \Carbon\Carbon::parse($user->tanggal_dibuat)->format('d/m/Y') : ($user->created_at ? $user->created_at->format('d/m/Y') : 'N/A') }}
                            </div>
                            <div class="col-12 col-md-6">
                                <i class="fas fa-clock me-1 text-success"></i>
                                Login: {{ now()->format('d/m/Y H:i') }}
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <i class="fas fa-users me-1 text-warning"></i>
                                Total Admin: {{ \App\Models\Pengguna::where('is_admin', true)->count() }}
                            </div>
                            @php($latestAdmin = \App\Models\Pengguna::where('is_admin', true)->latest('tanggal_dibuat')->first())
                            @if($latestAdmin)
                            <div class="col-12 col-md-6 mt-1">
                                <i class="fas fa-user-plus me-1 text-info"></i>
                                Admin Terbaru: {{ $latestAdmin->nama_lengkap }} (Reg: {{ $latestAdmin->tanggal_dibuat ? \Carbon\Carbon::parse($latestAdmin->tanggal_dibuat)->format('d/m/Y') : 'N/A' }})
                            </div>
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


