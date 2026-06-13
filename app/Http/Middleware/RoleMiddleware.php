<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login dan role-nya sesuai dengan yang diminta
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika bukan haknya, lemparkan kembali ke dashboard utama mereka
            return redirect('/dashboard');
        }

        return $next($request);
    }
}