@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <h2 class="fw-bold text-dark mb-2">Login</h2>
    <p class="text-muted">Masuk ke sistem PCM Benowo</p>
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

<!-- Login Form -->
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold text-dark">Username or email address</label>
        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
               name="email" required autocomplete="email" autofocus 
               placeholder="Enter your email" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <label for="password" class="form-label fw-semibold text-dark">Password</label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none text-primary small">
                    Forgot password?
                </a>
            @endif
        </div>
        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
               name="password" required autocomplete="current-password" 
               placeholder="Enter your password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="d-grid mb-4">
        <button type="submit" class="btn btn-success btn-lg fw-semibold">
            Sign in
        </button>
    </div>
</form>

<!-- Footer -->
<div class="text-center">
    <p class="mb-0 text-muted">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar disini</a>
    </p>
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
</style>

<script>
// Clear form fields on page load
document.addEventListener('DOMContentLoaded', function() {
    // Don't clear email if there's an error (to preserve user input)
    if (!document.querySelector('.is-invalid')) {
        document.getElementById('email').value = '';
    }
    document.getElementById('password').value = '';
    
    // Also clear on form submit to prevent browser from remembering
    document.querySelector('form').addEventListener('submit', function() {
        setTimeout(function() {
            document.getElementById('password').value = '';
        }, 100);
    });
});
</script>
@endsection 