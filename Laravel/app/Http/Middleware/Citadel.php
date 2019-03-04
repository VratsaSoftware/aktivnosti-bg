<?php

namespace App\Http\Middleware;

use Closure;
use Response;

class Citadel
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
        // if (is_null($request->user()) || $request->user() && $request->user()->role->role != 'administrator')
        //     {
        //         abort(403);
        //     }
        return $next($request);
    }
}
