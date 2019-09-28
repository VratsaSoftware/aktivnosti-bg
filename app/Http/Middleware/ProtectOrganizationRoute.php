<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Organization;
use App\Models\Purpose;

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
            $path = $request->path();

            $organizations = Auth::user()->organizations()->get();

            $userOrganizations = Auth::user()->organizations()->pluck('organizations.organization_id')->toArray();

            //dispatch deleteGallery method, when user not admin or moderator
            if(strpos($path,'/organizations/destroyGallery/')){
                $photo_purpose = Purpose::where('description','gallery')->first();
                $photos_array = [];

                foreach($organizations as $organization){
                    $photos = $organization->photos()->get();
                        foreach($photos as $photo){
                            if($photo->purpose_id == $photo_purpose->purpose_id){
                                array_push($photos_array, $photo->photo_id);
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

            if(!in_array($request->organization, $userOrganizations)){
            return abort(404);
            }
        }
        return $next($request);
    }
}
