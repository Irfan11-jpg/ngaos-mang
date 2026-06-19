<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Kalau belum login, redirect ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Kalau role tidak sesuai, redirect ke dashboard sesuai role-nya
        if (auth()->user()->role !== $role) {
            if (auth()->user()->role === 'guru') {
                return redirect()->route('dashboard.guru');
            }
            return redirect()->route('dashboard.santri');
        }

        return $next($request);
    }
}