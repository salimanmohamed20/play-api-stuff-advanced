<?php

namespace App\Http\Controllers\Api\V1\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\V1\BookResource;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Responses\V1\CollectionResponse;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Requests\Api\V1\StoreBookRequest;

use App\Http\Responses\V1\MessageResponse;


use App\Jobs\Books\V1\CreateBook as V1CreateBook;
use Symfony\Component\HttpFoundation\Response;

class StoreBookController
{

    public function __construct(private Dispatcher $bus)
    {


    }
    public function __invoke(StoreBookRequest $request)
    {
        \Illuminate\Support\defer(
         callback:fn()=>$this->bus->dispatch(command:new V1CreateBook($request->payloads(),(string) auth()->id()),)
        );

        return new MessageResponse('Book created successfully',Response::HTTP_ACCEPTED);

    }
}
