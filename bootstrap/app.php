<?php

use App\Http\Middleware\EnsureUserType;
use App\Http\Middleware\UpdateUserLastActivityTime;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        apiPrefix:'app/api/', // for routes
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web([
            UpdateUserLastActivityTime::class,
        ]);
        $middleware->api([
            UpdateUserLastActivityTime::class,
        ]);
        $middleware->alias([
        'type'=>EnsureUserType::class
    ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withBroadcasting(__DIR__ . '/../routes/channels.php')
    ->create();
