<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\FacultyAuthenticate;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(PreventBackHistory::class);
        
        $middleware->alias([
            'auth' => FacultyAuthenticate::class,
            'admin' => AdminAuthenticate::class,
            'prevent-back-history' => PreventBackHistory::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })
    ->create();