<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * 
 * @property CarbonIntrface $resource
 */
class DateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            

        'human'=>$this->resource->diffForHumans(),
        'string'=>$this->resource->toDateTimeString(),
        ];
    }
}
