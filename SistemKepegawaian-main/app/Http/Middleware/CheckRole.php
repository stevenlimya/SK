<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $account = User::findOrFail($request->session()->get('user')->id);
        $hakAkses = $account->hakakses;

        switch ($hakAkses) {
            case 'HRD':
                // Jika hak akses adalah HRD
                return $next($request);
                break;
            case 'Karyawan':
                // Jika hak akses adalah Karyawan
                return redirect('');
                break;
            case 'Direktur':
                // Jika hak akses adalah Direktur
                return redirect('/noaccess');
                break;
            default:
                // Jika hak akses tidak ditemukan atau tidak diatur
                return redirect('/noaccess');
                break;
        }
    }
}
