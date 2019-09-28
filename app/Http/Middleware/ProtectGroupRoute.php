<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Activity;

use Closure;

class ProtectGroupRoute
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
            $groups_array = [];
            $activities_array = [];
            $organizations = Auth::user()->organizations()->get();
            foreach ($organizations as $organization) {
                $activities = $organization->activities()->get();
                foreach ($activities as $activity) {
                    $groups = $activity->groups()->pluck('group_id')->toArray();
                    $groups_array = array_merge($groups_array,$groups);
                    array_push($activities_array, $activity->activity_id);
                }
            }

            if(isset($request->activityId) && !in_array($request->activityId,$activities_array)){
                return abort(404);
            }

            if(isset($request->group) && !in_array($request->group,$groups_array)){
                 return abort(404);
            }
        }
        return $next($request);
    }
}
