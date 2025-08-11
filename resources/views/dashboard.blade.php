@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2 fw-bold">
                                <i class="fas fa-tachometer-alt me-3"></i>Dashboard PCM Benowo
                            </h2>
                            <p class="mb-0 fs-5">Selamat datang di sistem manajemen aset dan usaha PCM Benowo</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end">
                                <div class="text-center me-4">
                                    <div class="fs-4 fw-bold">{{ date('d') }}</div>
                                    <small>{{ date('M Y') }}</small>
                                </div>
                                <div class="text-center">
                                    <div class="fs-4 fw-bold">{{ date('H:i') }}</div>
                                    <small>{{ date('l') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-box text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-primary mb-1">{{ $totalAset }}</h3>
                    <p class="text-muted mb-0">Total Aset</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up me-1"></i>+12% dari bulan lalu
                    </small>
                    <!-- Debug: {{ $totalAset }} -->
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-store text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-success mb-1">{{ $totalUsaha }}</h3>
                    <p class="text-muted mb-0">Total Usaha</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up me-1"></i>+8% dari bulan lalu
                    </small>
                    <!-- Debug: {{ $totalUsaha }} -->
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-coins text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-warning mb-1">Rp {{ number_format($totalNilaiModal, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Total Nilai Modal</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up me-1"></i>+15% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-chart-line text-white fs-3"></i>
                    </div>
                    <h3 class="fw-bold text-info mb-1">{{ $totalAset + $totalUsaha }}</h3>
                    <p class="text-muted mb-0">Total Keseluruhan</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up me-1"></i>+10% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3 no-print">
                            <a href="{{ route('data_aset.create') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-plus-circle fs-1 mb-2"></i>
                                <span class="fw-semibold">Tambah Aset</span>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3 no-print">
                            <a href="{{ route('usaha.create') }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-store fs-1 mb-2"></i>
                                <span class="fw-semibold">Tambah Usaha</span>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3 no-print">
                            <a href="{{ route('modal.create') }}" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-coins fs-1 mb-2"></i>
                                <span class="fw-semibold">Tambah Modal</span>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3 no-print">
                            <button class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4" onclick="printReport()">
                                <i class="fas fa-print fs-1 mb-2"></i>
                                <span class="fw-semibold">Print Laporan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Report Section -->
    <div class="print-report-section" style="display: none;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="fas fa-chart-bar me-3"></i>LAPORAN DIAGRAM
            </h2>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-chart-bar me-2"></i>Visualisasi Data
                        </h5>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; height: 400px; width: 100%;">
                            <canvas id="printChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-info-circle me-2"></i>Informasi Terkini
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex">
                                <div class="me-2 text-primary"><i class="fas fa-percentage"></i></div>
                                <div>
                                    <div class="fw-semibold">Persentase Komposisi Data</div>
                                    <small class="text-muted">Aset {{ $percentages['Aset'] ?? 0 }}%, Usaha {{ $percentages['Usaha'] ?? 0 }}%, Modal {{ $percentages['Modal'] ?? 0 }}% dari total {{ $totalSemua }}</small>
                                </div>
                            </li>
                            <li class="mb-3 d-flex">
                                <div class="me-2 text-success"><i class="fas fa-trophy"></i></div>
                                <div>
                                    <div class="fw-semibold">Kategori Terbanyak</div>
                                    <small class="text-muted">{{ $topName }} ({{ $topValue }})</small>
                                </div>
                            </li>
                            <li class="mb-3 d-flex">
                                <div class="me-2 text-warning"><i class="fas fa-level-down-alt"></i></div>
                                <div>
                                    <div class="fw-semibold">Kategori Tersedikit</div>
                                    <small class="text-muted">{{ $bottomName }} ({{ $bottomValue }})</small>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="me-2 text-info"><i class="fas fa-info"></i></div>
                                <div>
                                    <div class="fw-semibold">Ringkasan</div>
                                    <small class="text-muted">Total data: {{ $totalSemua }} (Aset {{ $counts['Aset'] }}, Usaha {{ $counts['Usaha'] }}, Modal {{ $counts['Modal'] }})</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm print-area">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-chart-bar me-2"></i>Visualisasi Data
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 400px; width: 100%;">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 print-area">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Informasi Terkini
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex">
                            <div class="me-2 text-primary"><i class="fas fa-percentage"></i></div>
                            <div>
                                <div class="fw-semibold">Persentase Komposisi Data</div>
                                <small class="text-muted">Aset {{ $percentages['Aset'] ?? 0 }}%, Usaha {{ $percentages['Usaha'] ?? 0 }}%, Modal {{ $percentages['Modal'] ?? 0 }}% dari total {{ $totalSemua }}</small>
                            </div>
                        </li>
                        <li class="mb-3 d-flex">
                            <div class="me-2 text-success"><i class="fas fa-trophy"></i></div>
                            <div>
                                <div class="fw-semibold">Kategori Terbanyak</div>
                                <small class="text-muted">{{ $topName }} ({{ $topValue }})</small>
                            </div>
                        </li>
                        <li class="mb-3 d-flex">
                            <div class="me-2 text-warning"><i class="fas fa-level-down-alt"></i></div>
                            <div>
                                <div class="fw-semibold">Kategori Tersedikit</div>
                                <small class="text-muted">{{ $bottomName }} ({{ $bottomValue }})</small>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="me-2 text-info"><i class="fas fa-info"></i></div>
                            <div>
                                <div class="fw-semibold">Ringkasan</div>
                                <small class="text-muted">Total data: {{ $totalSemua }} (Aset {{ $counts['Aset'] }}, Usaha {{ $counts['Usaha'] }}, Modal {{ $counts['Modal'] }})</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dashboard Chart
    var ctx = document.getElementById('dashboardChart').getContext('2d');
    var data = {
        labels: ['Aset', 'Usaha', 'Modal'],
        datasets: [{
            label: 'Jumlah',
            data: [{{ $totalAset }}, {{ $totalUsaha }}, {{ $totalModal }}],
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(255, 206, 86, 0.7)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 2
        }]
    };
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    };
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    // Print Chart
    var printCtx = document.getElementById('printChart').getContext('2d');
    var printData = {
        labels: ['Aset', 'Usaha', 'Modal'],
        datasets: [{
            label: 'Jumlah',
            data: [{{ $totalAset }}, {{ $totalUsaha }}, {{ $totalModal }}],
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(255, 206, 86, 0.7)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 2
        }]
    };
    var printOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    };
    new Chart(printCtx, {
        type: 'bar',
        data: printData,
        options: printOptions
    });
});

// Print functionality
function printReport() {
    // Hide all non-print elements
    document.querySelectorAll('.no-print').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.print-area').forEach(el => el.style.display = 'none');
    
    // Show print report section
    document.querySelector('.print-report-section').style.display = 'block';
    
    // Wait a bit for the chart to render properly
    setTimeout(() => {
        window.print();
        
        // Restore display after printing
        setTimeout(() => {
            document.querySelectorAll('.no-print').forEach(el => el.style.display = '');
            document.querySelectorAll('.print-area').forEach(el => el.style.display = '');
            document.querySelector('.print-report-section').style.display = 'none';
        }, 1000);
    }, 500);
}
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-warning:hover,
.btn-outline-info:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Print styles */
@media print {
    body * {
        visibility: hidden;
    }
    
    .print-report-section,
    .print-report-section * {
        visibility: visible;
    }
    
    .print-report-section {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        display: block !important;
    }
    
    .container {
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    #printChart {
        display: block !important;
        margin: 0 auto !important;
        max-width: 100% !important;
        height: auto !important;
    }
}

/* Hide print report section by default */
.print-report-section {
    display: none;
}
</style>
