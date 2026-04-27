<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 1. Գրանցում ենք Alias-ները (օրինակ՝ 'admin')
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // 2. Ավելացնում ենք CheckBlocked-ը WEB խմբի մեջ
        // Սա կաշխատի բոլոր էջերի համար ավտոմատ
        $middleware->web(append: [
            \App\Http\Middleware\CheckBlocked::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
