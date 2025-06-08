<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Direktur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $account = User::findOrFail($request->session()->get('user')->id);
        $hakAkses = $account->hakakses;

        switch ($hakAkses) {
            // Jika hak akses adalah HRD
            case 'HRD':
                return redirect('/noaccess');
                break;
            // Jika hak akses adalah Karyawan
            case 'Karyawan':
                return redirect('/noaccess');
                break;
            // Jika hak akses adalah Direktur
            case 'Direktur':
                return $next($request);
                break;
            default:
            // Jika hak akses tidak ditemukan atau tidak diatur
                return redirect('/noaccess');
                break;
        }
    }
}
