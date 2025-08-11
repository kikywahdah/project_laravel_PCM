@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <h2 class="fw-bold text-dark mb-2">Register</h2>
    <p class="text-muted">Daftar akun baru PCM Benowo</p>
</div>

<!-- Google OAuth Button -->
<div class="mb-4">
    <button type="button" class="btn btn-outline-secondary w-100 py-3" onclick="window.location.href='{{ route('google.login') }}'">
        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" width="20" height="20" class="me-2">
        <span class="fw-semibold">Continue with Google</span>
    </button>
</div>

<!-- Separator -->
<div class="text-center mb-4">
    <div class="position-relative">
        <hr class="my-0">
        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">or</span>
    </div>
</div>

<!-- Register Form -->
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="nama_lengkap" class="form-label fw-semibold text-dark">Nama Lengkap</label>
        <input id="nama_lengkap" type="text" class="form-control form-control-lg @error('nama_lengkap') is-invalid @enderror" 
               name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="name" autofocus 
               placeholder="Masukkan nama lengkap Anda">
        @error('nama_lengkap')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" required autocomplete="email" 
               placeholder="Masukkan email Anda">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label fw-semibold text-dark">Password</label>
        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
               name="password" required autocomplete="new-password" 
               placeholder="Masukkan password Anda">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password-confirm" class="form-label fw-semibold text-dark">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control form-control-lg" 
               name="password_confirmation" required autocomplete="new-password" 
               placeholder="Konfirmasi password Anda">
    </div>

    <div class="d-grid mb-4">
        <button type="submit" class="btn btn-success btn-lg fw-semibold">
            Register
        </button>
    </div>
</form>

<!-- Footer -->
<div class="text-center">
    <p class="mb-0 text-muted">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login disini</a>
    </p>
</div>

<!-- Info about approval process -->
<div class="mt-4 p-3 bg-light rounded-3">
    <div class="text-center">
        <i class="fas fa-info-circle text-info me-2"></i>
        <small class="text-muted">
            <strong>Penting:</strong> Setelah mendaftar, akun Anda akan ditinjau oleh admin. 
            Anda akan menerima email notifikasi ketika akun disetujui.
        </small>
    </div>
</div>

<style>
.form-control {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.btn-outline-secondary {
    border: 1px solid #e0e0e0;
    color: #333;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #f8f9fa;
    border-color: #d0d0d0;
    color: #333;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
    transform: translateY(-1px);
}

.form-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.form-control-lg {
    height: 48px;
    font-size: 1rem;
}

.btn-lg {
    height: 48px;
    font-size: 1rem;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.rounded-3 {
    border-radius: 0.5rem !important;
}
</style>
@endsection 