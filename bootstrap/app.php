<?php

use App\Http\Middleware\EnsureApiUserIsAdmin;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\RedirectIfAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'redirectIfAuth' => RedirectIfAuth::class,
            'admin' => EnsureUserIsAdmin::class,
            'api.admin' => EnsureApiUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if (! $request->is('api/*') && ! $request->expectsJson()) {
                return null;
            }

            return \App\Http\Controllers\Api\ApiExceptionHandler::render($e);
        });
    })->create();
