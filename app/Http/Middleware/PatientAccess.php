<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PatientAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role_id;

            if ($role == 0) {
                return $next($request);
            } elseif ($role == 2) {
                return redirect('/home');
            } elseif ($role == 1) {
                return redirect('/');
            }
        }

        return redirect('/home')->with('error', 'You do not have access to this page.');
    }
}
