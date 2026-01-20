<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;



class ApiLog extends Model
{


protected $guarded = [];


    protected $casts = [
        'status_code' => 'integer',
        'duration' => 'integer',
        'request' => 'json',
        'response' => 'json',

    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
