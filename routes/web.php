<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\UsahaController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Default route redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Home route redirect to dashboard if authenticated, otherwise to login
Route::get('/home', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Auth routes (only for guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('data_aset', AsetController::class);
    Route::resource('usaha', UsahaController::class);
    Route::resource('modal', ModalController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin management (only admin)
    Route::middleware('admin')->group(function () {
        Route::resource('admins', AdminController::class)->parameters([
            'admins' => 'admin'
        ]);
    });

    // Export CSV (Excel compatible)
    Route::get('/export/aset', [ExportController::class, 'aset'])->name('export.aset');
    Route::get('/export/usaha', [ExportController::class, 'usaha'])->name('export.usaha');
    Route::get('/export/modal', [ExportController::class, 'modal'])->name('export.modal');
});
