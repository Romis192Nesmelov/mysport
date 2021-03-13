<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserCredsMiddleware
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
        if (!Auth::user()->email && $request->path() != 'profile') {
            return redirect()->guest('/profile')->with('message',trans('auth.define_your_creds'));
        }
        return $next($request);
    }
}
