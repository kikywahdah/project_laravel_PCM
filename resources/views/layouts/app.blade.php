<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCM Benowo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }
        .navbar-brand {
            font-weight: 600;
            color: #0066cc !important;
        }
        .text-primary {
            color: #0066cc !important;
        }
        .logo-container {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            border-radius: 8px;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .navbar-nav .nav-link {
            color: #495057 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #0066cc !important;
        }
        @media (max-width: 991.98px) {
            .navbar-brand h4 {
                font-size: 1.1rem;
            }
            .navbar-brand small {
                font-size: 0.75rem;
            }
        }
        
        /* Admin Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 8px;
            min-width: 280px;
        }
        
        .dropdown-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px 8px 0 0;
            padding: 15px;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-item i {
            width: 16px;
        }
        
        .bg-primary {
            background-color: #0066cc !important;
        }
        
        .bg-info {
            background-color: #17a2b8 !important;
        }
        
        @media (max-width: 768px) {
            .dropdown-menu {
                min-width: 250px;
                margin-right: 10px;
            }
            
            .dropdown-header {
                padding: 10px;
            }
            
            .dropdown-header .fw-bold {
                font-size: 0.9rem;
            }
            
            .dropdown-header small {
                font-size: 0.75rem;
            }
        }
        
        /* Footer Styles */
        .site-footer {
            margin-top: auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            height: 10vh; /* 10% dari tinggi layar */
        }
        .site-footer .social-btn {
            width: 32px; height: 32px; padding: 0;
        }

        /* Elements that show only on print */
        .print-only { display: none; }

        /* Print A4 rules */
        @media print {
            @page { size: A4; margin: 12mm; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            nav, .navbar, footer, .site-footer, .no-print { display: none !important; }
            .card, .container { box-shadow: none !important; border: none !important; }
            .print-area { display: block !important; }
            .table { font-size: 12px; border-collapse: collapse !important; }
            .table, .table th, .table td { border: 1px solid #000 !important; }
            .table thead th { background: #efefef !important; color: #000 !important; }
            .table-striped tbody tr:nth-of-type(odd) { background-color: #fafafa !important; }
            .table th, .table td { padding: 6px 8px !important; }
            .print-only { display: block !important; }
            .print-title { font-weight: 700; font-size: 16pt; text-align: center; margin-bottom: 8mm; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <img src="{{ asset('images/Logo.jpg') }}" alt="Inventori Aset & Usaha PCM Benowo" style="width: 50px; height: 50px; object-fit: contain;" />
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-primary">Pimpinan Cabang Muhammadiyah</h4>
                    <small class="text-muted">Kecamatan Benowo, Surabaya</small>
                </div>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_aset.index') }}"><i class="fas fa-box me-1"></i>Data Aset</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usaha.index') }}"><i class="fas fa-store me-1"></i>Data Usaha</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('modal.index') }}"><i class="fas fa-coins me-1"></i>Data Modal</a>
                    </li>
                    <li class="nav-item">
                        <div class="vr mx-2" style="height: 20px;"></div>
                    </li>
                    
                    <!-- Admin Information Dropdown -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    <i class="fas fa-user text-white" style="font-size: 14px;"></i>
                                </div>
                                <span class="d-none d-md-inline">{{ Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'Admin' }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                <li>
                                    <div class="dropdown-header">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info bg-gradient rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user-shield text-white"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'Admin' }}</div>
                                                <small class="text-muted">{{ Auth::user()->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user-cog me-2"></i>Profil Saya
                            </a>
                                </li>
                                <li>
                            <a class="dropdown-item" href="{{ route('admins.index') }}">
                                <i class="fas fa-cog me-2"></i>Pengaturan Admin
                            </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    @endauth
                    
                    <li class="nav-item">
                        <div class="vr mx-2" style="height: 20px;"></div>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="/">PCM Benowo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer minimal 10% tinggi -->
    <footer class="site-footer d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/Logo.jpg') }}" alt="PCM Benowo" style="width: 32px; height: 32px; object-fit: contain;" class="me-2" />
                <span class="fw-bold text-primary">PCM Benowo</span>
            </div>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-secondary social-btn"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="btn btn-outline-secondary social-btn"><i class="fab fa-instagram"></i></a>
                <a href="#" class="btn btn-outline-secondary social-btn"><i class="fab fa-youtube"></i></a>
                <a href="#" class="btn btn-outline-secondary social-btn"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 