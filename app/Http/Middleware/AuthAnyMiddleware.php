<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAnyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek web guard (user biasa)
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // Cek admin guard
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Kalau tidak ada yang login, redirect ke login
        return redirect()->route('login');
    }
}