<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Organization;

class ProtectOrganizationRoute
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
        if(!Auth::user()->hasAnyRole(['admin','moderator'])){
            $userOrganizations = Auth::user()->organizations()->pluck('organizations.organization_id')->toArray();
            if(!in_array($request->organization, $userOrganizations)){
            return abort(404);     
            }
        }
        return $next($request); 
    }
}
