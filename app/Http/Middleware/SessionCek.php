<?php

namespace App\Http\Middleware;

use Closure;

class SessionCek
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
        if (!session('iwa')) {
            return redirect('/');
        }

        return $next($request);
    }
}
