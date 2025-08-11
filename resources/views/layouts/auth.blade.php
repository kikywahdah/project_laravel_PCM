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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .auth-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        
        .auth-header {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .auth-header .logo-container {
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }
        
        .auth-body {
            padding: 40px;
        }
        
        .form-control:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0052a3 0%, #004080 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
        }
        
        .auth-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .auth-footer small {
            color: #6c757d;
        }
        
        .text-primary {
            color: #0066cc !important;
        }
        
        .link-primary {
            color: #0066cc !important;
            text-decoration: none;
        }
        
        .link-primary:hover {
            color: #0052a3 !important;
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
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }
        
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <div class="logo-container">
                <i class="fas fa-mosque"></i>
            </div>
            <h4 class="mb-1 fw-bold">PCM Benowo</h4>
            <small>Pimpinan Cabang Muhammadiyah</small>
        </div>
        
        <div class="auth-body">
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