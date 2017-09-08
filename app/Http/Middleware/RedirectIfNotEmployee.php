<?php

namespace Horus\Http\Middleware;

use Closure;

class RedirectIfNotEmployee
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
        if ( !$request->user()->employee ) return redirect('/');
        return $next($request);
    }
}
