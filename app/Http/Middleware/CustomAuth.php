<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Gunakan Auth::check() untuk cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login'); // Redirect ke login jika user belum login
        }

        return $next($request); // Teruskan request jika user sudah login
    }
}