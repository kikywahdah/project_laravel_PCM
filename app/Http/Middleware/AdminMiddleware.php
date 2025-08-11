<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Add debug logging
        Log::info('AdminMiddleware check:', [
            'is_authenticated' => Auth::check(),
            'user' => Auth::check() ? Auth::user()->email : 'not logged in',
            'is_admin' => Auth::check() ? Auth::user()->is_admin : false,
            'session_id' => session()->getId()
        ]);

        // Check if user is logged in and is admin or has allowed email
        if (!Auth::check()) {
            Log::warning('User not authenticated, redirecting to login');
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();
        // Email super admin bisa Anda ubah sewaktu-waktu di sini
        $allowedEmail = 'rezkyfadliahwahdahh@gmail.com';

        $userEmailLower = strtolower(trim($user->email));
        $allowedEmailLower = strtolower(trim($allowedEmail));
        Log::info('AdminMiddleware email check:', [
            'user_email' => $userEmailLower,
            'allowed_email' => $allowedEmailLower,
            'emails_match' => $userEmailLower === $allowedEmailLower,
            'is_admin' => $user->is_admin,
        ]);

        if (!$user->is_admin && $userEmailLower !== $allowedEmailLower) {
            Log::warning('Non-admin user attempting to access admin area:', [
                'email' => $user->email
            ]);
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        // User is authenticated and is an admin
        Log::info('Admin access granted:', [
            'email' => Auth::user()->email
        ]);

        return $next($request);
    }
} 