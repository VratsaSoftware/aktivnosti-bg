<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Organization;
use App\Models\Activity;

class ProtectActivityRoute
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

            $organizations= Auth::user()->organizations()->get();

            foreach ($organizations as $organization) {
                $organization_id=$organization->organization_id;
            }
            
            if($organizations){
                $activities=Activity::where('organization_id', $organization_id)->pluck('activities.activity_id')->toArray();
                
            }

            if(!in_array($request->id, $activities)){
            return abort(404);     
            }
        }
        
        return $next($request); 
    }
}
