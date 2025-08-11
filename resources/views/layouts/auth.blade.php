<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCM Benowo - Authentication</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2f3 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .auth-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            width: 100%;
            max-width: 460px;
        }
        
        .auth-header {
            background: transparent; /* remove gradient background */
            color: #1f2937;
            padding: 24px 24px 0 24px;
            text-align: center;
        }
        
        .auth-logo {
            height: 64px;
            width: auto;
            object-fit: contain;
            display: inline-block;
        }
        
        .auth-body {
            padding: 28px;
        }
        
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #23863b 0%, #1c6f31 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(33, 136, 56, 0.25);
        }
        
        .auth-footer {
            text-align: center;
            padding: 16px 20px 22px 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .auth-footer small {
            color: #6c757d;
        }
        
        .text-primary {
            color: #28a745 !important; /* adjust to green */
        }
        
        .link-primary {
            color: #28a745 !important;
            text-decoration: none;
        }
        
        .link-primary:hover {
            color: #1e7e34 !important;
            text-decoration: underline;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        
        .form-control {
            border-color: #dee2e6;
        }
        
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border-left: 4px solid #198754;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #0dcaf0;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #664d03;
            border-left: 4px solid #ffc107;
        }
        
        .btn-close {
            opacity: 0.7;
        }
        
        .btn-close:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <img src="{{ asset('images/Logo.jpg') }}" alt="PCM Benowo" class="auth-logo">
            <h5 class="mb-1 fw-bold mt-2 text-dark">PCM Benowo</h5>
            <small class="text-muted">Pimpinan Cabang Muhammadiyah</small>
        </div>
        
        <div class="auth-body">
            <!-- Notifications -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
        
        <div class="auth-footer">
            <small>© 2024 PCM Benowo. All rights reserved.</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 