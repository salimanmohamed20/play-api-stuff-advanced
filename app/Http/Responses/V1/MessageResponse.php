<?php


declare(strict_types=1);

namespace App\Http\Responses\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response;

final class MessageResponse implements Responsable
{
    public function __construct(private readonly string $message, private readonly int $statusCode = Response::HTTP_ACCEPTED)
    {
        //
    }
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'message'=>$this->message,
        ],$this->statusCode);
    }
}