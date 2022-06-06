<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class BaseService
{
    /**
     * find city by subdomain
     */
    public static function findCityBySubdomain()
    {
        $url = parse_url(URL::current());

        $urlComponents = explode('.', $url['host']);

        return City::where('subdomain', $urlComponents[0])
            ->first();
    }
}
