<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login, cek apakah admin
        if (Auth::check()) {
            if (!Auth::user()->isAdmin()) {
                // Jika bukan admin, redirect ke dashboard dengan pesan error
                return redirect('/dashboard')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
            }
        } else {
            // Jika belum login, redirect ke login
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
