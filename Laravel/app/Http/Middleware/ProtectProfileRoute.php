<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProtectProfileRoute
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
        //prevent access to profiles of other users
        if($request->profile == Auth::user()->user_id){
            return $next($request);
        }
        else
        {
            return abort(404);
        }
    }

}
