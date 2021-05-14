<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if ($type != 'admin' && $type != 'half') throw new Exception('Getting wrong user type in auth.admin');
        if (!in_array(Auth::user()->type,($type == 'half' ? [1,2] : [1]))) abort(403);
        return $next($request);
    }
}
