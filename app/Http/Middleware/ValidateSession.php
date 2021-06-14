<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;

class ValidateSession
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
        if(session()->has('access_token'))
            return $next($request);
        else{
            if(Route::currentRouteName() != 'admin.dashboard')
                return redirect('login')->withErrors('Please login.');
            else
                return redirect('login');
        }
    }
}
