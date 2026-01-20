<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class ApiController 
{
    public function include(Request $request)
    {
        $with = [];

        if ($request->has('include')) {
            $with = explode(',', $request->input('include'));
        }

        return $with;
    }



    public function cacheCollection(string $key, $collection, int $ttl = 60)
    {
        return cache()->remember($key, $ttl, function () use ($collection) {
            return $collection;
        });
    }
}
