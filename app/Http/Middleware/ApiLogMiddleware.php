<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiLog;

class ApiLogMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);


        $requestId = $request->fingerprint();
        $uri       = $request->path();
        $method    = $request->method();
        $token     = $request->bearerToken();
        $userId    = auth()->id();
        $payload   = $request->except(['password', 'password_confirmation']);

        $response = $next($request);

        $status   = $response->getStatusCode();
        $duration = round((microtime(true) - $start) * 1000);

        $responseContent = rescue(
            fn () => method_exists($response, 'getContent')
                ? json_decode($response->getContent(), true)
                : null,
            null
        );

        \Illuminate\Support\defer(function () use (
            $requestId,
            $uri,
            $method,
            $status,
            $duration,
            $payload,
            $responseContent,
            $token,
            $userId
        ) {
            ApiLog::create([
                'request_id'  => $requestId,
                'uri'         => $uri,
                'method'      => $method,
                'status_code' => $status,
                'duration'    => $duration,
                'request'     => $payload,
                'response'    => $responseContent,
                'token'       => $token,
                'user_id'     => $userId,
            ]);
        });

        return $response;
    }
}
