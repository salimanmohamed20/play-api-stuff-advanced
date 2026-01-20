<?php

namespace App\Http\Controllers\Api\V1\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\V1\BookResource;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Responses\V1\CollectionResponse;
use Illuminate\Contracts\Support\Responsable;

class IndexController extends ApiController
{
    




   public function __invoke():Responsable
{

    $books=$this->cacheCollection(
        'books.index',
        Book::query()->with('user')->simplePaginate(5)
    );
    return new CollectionResponse(
       'books',
       $books,
        BookResource::collection(
            $books
        )
    );
}

}
