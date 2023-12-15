<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Memeriksa apakah pengguna telah melakukan autentikasi
        if (!$request->user()) {
            return redirect('/login')->with('toast_error', 'Anda harus login dulu !'); // Ganti dengan rute atau tindakan login sesuai kebutuhan Anda
        }

        // Memeriksa apakah peran pengguna ada dalam array peran yang diterima
        if (!in_array($request->user()->current_role, $roles)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            // Atau, jika ingin mengarahkan ke halaman lain:
            // return redirect('/forbidden');
        }

        return $next($request);
    }
}
