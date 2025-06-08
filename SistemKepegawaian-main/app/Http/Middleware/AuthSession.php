<?php

namespace App\Http\Middleware;

use App\Helpers\UserInfoHelper;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;

class AuthSession
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
        if(!$request->session()->has('user')) {
            return redirect('/login');
        }

        $account = User::findOrFail($request->session()->get('user')->id);
        
        return $next($request);
    }
}
