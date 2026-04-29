<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProdiId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil PRODI_ID dari file .env
        $prodiId = env('PRODI_ID');

        // Periksa apakah user sedang login
        if (Auth::check()) {
            // Aktifkan Debugbar jika user sedang login
            \Debugbar::enable();

            // Periksa apakah id_ps user sesuai dengan PRODI_ID
            if (Auth::user()->id_ps == $prodiId) {
                return $next($request);
            } else {
                // Jika id_ps tidak sesuai, logout user dan redirect ke halaman login dengan pesan error
                Auth::logout();
                return redirect('/masuk-admin')->withErrors(['sid' => 'Access denied.']);
            }
        }

        // Jika user tidak sedang login, redirect ke halaman login
        return redirect('/masuk-admin');
    }
}
