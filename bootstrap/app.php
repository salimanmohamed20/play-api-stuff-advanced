<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;


use App\Exceptions\ApiExceptionRenderer;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/Api/routes.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'api-log' => \App\Http\Middleware\ApiLogMiddleware::class,
    ]);
})

   ->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->render(function (Throwable $e, Request $request) {
        if ($request->expectsJson()) {
            $renderer = new ApiExceptionRenderer($e, $request);
            return $renderer->render();
        }
        return null;
    });
})->create();

