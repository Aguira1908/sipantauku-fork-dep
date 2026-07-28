<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardPassword
{
    public function handle(Request $request, Closure $next): Response
    {
        // kalau sudah memasukkan password
        if (session('dashboard_access')) {
            return $next($request);
        }

        // tampilkan halaman password
        return redirect('/dashboard-password');
    }
}
