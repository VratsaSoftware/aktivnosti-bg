<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpException;
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
        if ((is_null($request->user()) || ((!is_null($request->user()) && $request->user()->role->role == 'guest'))))
        {
          
            throw new HttpException(403);
           
        }
        return $next($request);
    }
}
