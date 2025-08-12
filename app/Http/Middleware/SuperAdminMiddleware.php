<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();

        $allowedEmail = 'rezkyfadliahwahdahh@gmail.com';
        $userEmailLower = strtolower(trim($user->email));
        $allowedEmailLower = strtolower(trim($allowedEmail));

        $isAllowedByEmail = $userEmailLower === $allowedEmailLower;
        $isSuperAdmin = (bool) ($user->is_super_admin ?? false);

        if (!$isSuperAdmin && !$isAllowedByEmail) {
            return redirect()->route('dashboard')
                ->with('error', 'Hanya super admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}


