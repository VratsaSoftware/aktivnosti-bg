<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Activity;

use Closure;

class ProtectScheduleRoute
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
            $organizations = Auth::user()->organizations()->get();
            foreach ($organizations as $organization) {
                $activities = $organization->activities()->get();
                foreach ($activities as $activity) {
                    $groups = $activity->groups()->pluck('group_id')->toArray();
                    $groups_array = array_merge($groups_array,$groups);
                }
            }

            if(isset($request->groupId) && !in_array($request->groupId,$groups_array)){
                return abort(404);
            }


            if(isset($request->group_id) && !in_array($request->group_id,$groups_array)){

                return abort(404);
            }

            $schedule = Schedule::find($request->schedule);
            if(isset($schedule->group->group_id) && !in_array($schedule->group->group_id,$groups_array)){
                 return abort(404);
            }

        }

        return $next($request);
    }
}
