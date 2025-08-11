@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <h5 class="fw-bold text-primary mb-3">{{ __('Login') }}</h5>
    <p class="text-muted">Masuk ke sistem PCM Benowo</p>
</div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="new-password" autofocus placeholder="Masukkan email Anda" style="height: 40px;" value="">
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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan password Anda" style="height: 40px;" value="">
        </div>
        @error('password')
            <div class="invalid-feedback d-block">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
        </button>
    </div>

    <div class="text-center">
        <p class="mb-2">Belum punya akun? 
            <a href="{{ route('register') }}" class="link-primary">Daftar disini</a>
        </p>
        
        @if (Route::has('password.request'))
            <small>
                <a href="{{ route('password.request') }}" class="link-primary">
                    {{ __('Lupa Password?') }}
                </a>
            </small>
        @endif
    </div>
</form>

<script>
// Clear form fields on page load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
    
    // Also clear on form submit to prevent browser from remembering
    document.querySelector('form').addEventListener('submit', function() {
        setTimeout(function() {
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
        }, 100);
    });
});
</script>
@endsection 