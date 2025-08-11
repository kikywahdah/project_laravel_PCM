<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if user exists and is approved
        $pengguna = Pengguna::where('email', $credentials['email'])->first();
        
        if (!$pengguna) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar.',
            ]);
        }

        if (!$pengguna->is_approved) {
            return back()->withErrors([
                'email' => 'Akun Anda belum disetujui oleh admin. Silakan tunggu persetujuan.',
            ]);
        }

        // Coba login dengan email dan password
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            // Debug: Log user information
            Log::info('User logged in:', [
                'email' => Auth::user()->email,
                'nama_lengkap' => Auth::user()->nama_lengkap
            ]);
            
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:pengguna'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create user (default non-admin, pending approval)
        $pengguna = Pengguna::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->password),
            'is_admin' => false,
            'is_super_admin' => false,
            'is_approved' => false,
        ]);

        // Send approval request to super admin
        $this->sendApprovalRequest($pengguna);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu persetujuan dari admin. Anda akan menerima email ketika akun disetujui.');
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $pengguna = Pengguna::where('email', $googleUser->getEmail())->first();

            if (!$pengguna) {
                // User does not exist, create new user
                $pengguna = Pengguna::create([
                    'nama_lengkap' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'kata_sandi' => Hash::make($googleUser->getId()), // Use Google ID as password for now
                    'is_admin' => false,
                    'is_super_admin' => false,
                    'is_approved' => false,
                ]);
                $this->sendApprovalRequest($pengguna);
                return redirect()->route('login')
                    ->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu persetujuan dari admin.');
            }

            // User exists, log them in
            if (Auth::loginUsingId($pengguna->id_pengguna)) {
                $request->session()->regenerate();
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang!');
            }

        } catch (\Exception $e) {
            Log::error('Google OAuth callback failed', ['error' => $e->getMessage()]);
            return redirect()->route('login')
                ->with('error', 'Gagal masuk menggunakan Google. Silakan coba lagi.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    private function sendApprovalRequest(Pengguna $pengguna)
    {
        $superAdminEmail = 'rezkyfadliahwahdahh@gmail.com';
        
        try {
            // Send email to super admin
            Mail::send('emails.approval_request', [
                'pengguna' => $pengguna,
                'approvalUrl' => route('admin.approve-user', ['id' => $pengguna->id_pengguna])
            ], function ($message) use ($superAdminEmail, $pengguna) {
                $message->to($superAdminEmail)
                        ->subject('Permintaan Persetujuan Akun Baru - PCM Benowo')
                        ->html("
                            <h3>Permintaan Persetujuan Akun Baru</h3>
                            <p><strong>Nama:</strong> {$pengguna->nama_lengkap}</p>
                            <p><strong>Email:</strong> {$pengguna->email}</p>
                            <p><strong>Tanggal Registrasi:</strong> {$pengguna->tanggal_dibuat}</p>
                            <br>
                            <p>Klik link berikut untuk menyetujui atau menolak akun ini:</p>
                            <a href='" . route('admin.approve-user', ['id' => $pengguna->id_pengguna]) . "'>Review Akun</a>
                        ");
            });

            Log::info('Approval request sent to super admin', [
                'user_id' => $pengguna->id_pengguna,
                'email' => $pengguna->email,
                'super_admin_email' => $superAdminEmail
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send approval request', [
                'error' => $e->getMessage(),
                'user_id' => $pengguna->id_pengguna
            ]);
        }
    }
} 