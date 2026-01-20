<?php


declare(strict_types=1);

namespace App\Http\Responses\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\Paginator;

final class CollectionResponse implements Responsable
{
    public function __construct(private String $key,
    private Paginator $paginator,
    private  AnonymousResourceCollection $collection, private int $status = JsonResponse::HTTP_OK){}


    public function toResponse($request)
    {
        return new JsonResponse(
            data:[
                $this->key=>$this->collection,
                'meta'=>[
                    'per_page'=>$this->paginator->perPage(),
                    'current_page'=>$this->paginator->currentPage(),
                    'has_more'=>$this->paginator->hasMorePages(),
                ],

            ],
            status:$this->status,
        );
    }

}
