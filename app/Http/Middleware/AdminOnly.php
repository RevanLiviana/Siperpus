<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Hanya Admin (Petugas Perpus) yang boleh akses route ini.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki role admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Hanya Admin (Petugas Perpus) yang dapat insert buku baru.');
        }

        return $next($request);
    }
}