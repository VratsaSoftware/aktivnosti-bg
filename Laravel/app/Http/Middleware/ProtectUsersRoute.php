<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProtectUsersRoute
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
        //only admin or moderator can access users
        if(Auth::user()->hasAnyRole(['admin','moderator']) && Auth::user()->isApproved())
        {
            //moderators can't delete or edit admins
            if(!Auth::user()->hasRole('admin'))
            {
                $path=$request->path();
                if(strpos($path,'edit') || strpos($path,'update') || strpos($path,'delete'))
                {
                    if(User::find($request->user)->hasRole('admin'))
                    {
                        return abort(404);
                    }
                }
            }

            return $next($request);
        }   
        return abort(404);
    }
}
