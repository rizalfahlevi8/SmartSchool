<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUrl = $request->getRequestUri();
        if (Auth::guard('admin')->check()) {
            return $next($request);
        } elseif (Auth::guard('kepsek')->check()) {
            return $next($request);
        } elseif (Auth::guard('guru')->check()) {
            return $next($request);
        } elseif (Auth::guard('siswa')->check()) {
            return $next($request);
        } else {

            return redirect("/?redirect=$currentUrl")->with('toast_error', 'Anda harus login dulu !');
        }
    }
}
