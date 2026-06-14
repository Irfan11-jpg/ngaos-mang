<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('login');
        }

        // 2. Cek apakah role user ada di dalam daftar akses yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
        }

        return $next($request);
    }
}