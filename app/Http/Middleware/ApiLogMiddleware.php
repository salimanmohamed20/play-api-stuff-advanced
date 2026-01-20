<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiLog;



class ApiLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         $start = microtime(true);

        $response = $next($request);

  \Illuminate\Support\defer(
    fn()=>ApiLog::query()->create([
        'request_id'=>$request->header('request-id') ?? (string) \Illuminate\Support\Str::uuid(),
        'uri'=>$request->path(),
        'method'=>$request->method(),
        'status_code'=>$response->getStatusCode(),
        'duration'=>round((microtime(true)-$start)*1000),
        'request'=>$request->all(),
        'response'=>json_decode($response->getContent(),true) ?? $response->getContent(),
        'token'=>$request->header('token'),
        'user_id'=>1,
    ])
  );




        return $response;
    }
}
