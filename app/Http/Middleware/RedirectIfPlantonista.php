<?php

namespace Horus\Http\Middleware;

use Closure;

class RedirectIfPlantonista
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
        if ( $request->user()->category == 'P' ) return redirect('/');
        return $next($request);
    }
}
