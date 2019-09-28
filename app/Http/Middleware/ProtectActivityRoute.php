<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Organization;
use App\Models\Activity;
use App\Models\Purpose;

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
            $path=$request->path();

            foreach ($organizations as $organization) {
                $organization_id=$organization->organization_id;
            }

            if($organizations){
                $activities=Activity::where('organization_id', $organization_id)->pluck('activities.activity_id')->toArray();

            }

            //dispatch deleteGallery method, when user not admin or moderator
            if(strpos($path,'/activities/destroyGallery/')){
                $photo_purpose = Purpose::where('description','gallery')->first();
                $photos_array = [];
                foreach($organizations as $organization){
                    $activities = $organization->activities()->get();
                    foreach($activities as $activity){
                        $photos = $activity->photos()->get();
                            foreach($photos as $photo){
                                if($photo->purpose_id == $photo_purpose->purpose_id){
                                    array_push($photos_array, $photo->photo_id);
                                }
                            }
                    }
                }
                if(in_array($request->id, $photos_array)){
                    return $next($request);
                }
                else{
                    return abort(404);
                }
            }

            if(!in_array($request->id, $activities)){
                return abort(404);
            }
        }

        return $next($request);
    }
}
