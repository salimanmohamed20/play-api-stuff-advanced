<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @resource App\Models\Book 
     */
    public function toArray(Request $request): array
    {

        return [
            "id" => $this->id,  
            "title" => $this->title,
            "description" => $this->when(
                $request->routeIs('books.show'),
                $this->description
            ),
            "user" => new UserResource($this->whenLoaded('user')),
            "publisher" => $this->publisher,
            "publication_date" => $this->publication_date,
'created'=> new DateResource($this->created_at),
'updated'=> new DateResource($this->updated_at),

        ];
    }
}
