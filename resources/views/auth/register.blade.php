@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <h5 class="fw-bold text-primary mb-3">{{ __('Register') }}</h5>
    <p class="text-muted">Daftar akun baru PCM Benowo</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="nama_lengkap" class="form-label">{{ __('Nama Lengkap') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-user"></i>
            </span>
            <input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" autofocus placeholder="Masukkan nama lengkap Anda" style="height: 40px;">
        </div>
        @error('nama_lengkap')
            <div class="invalid-feedback d-block">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email Anda" style="height: 40px;">
        </div>
        @error('email')
            <div class="invalid-feedback d-block">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan password Anda" style="height: 40px;">
        </div>
        @error('password')
            <div class="invalid-feedback d-block">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password Anda" style="height: 40px;">
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
        </button>
    </div>

    <div class="text-center">
        <p class="mb-0">Sudah punya akun? 
            <a href="{{ route('login') }}" class="link-primary">Login disini</a>
        </p>
    </div>
</form>
@endsection 