<?php

namespace App\Http\Middleware;

use App\Services\BaseService;
use Closure;

class CheckForCity
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
        $cityLocation = BaseService::findCityBySubdomain();

        if ($cityLocation) {
            view()->share('cityLocation', $cityLocation);

            return $next($request);
        } else {
            return redirect()->route('static.cities-platforms');
        }
    }
}
