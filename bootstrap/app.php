<?php

use App\Http\Middleware\Encargado;
use App\Http\Middleware\GESTEC;
use App\Http\Middleware\SalaDeListas;
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
        /* AGREGA MIDDLEWARE ENCARGADO ,GESTEC Y SALA DE LISTAS */
        $middleware->alias([
          /*   'encargado' => Encargado::class,
            'gestec' => GESTEC::class,
            'salaDeListas' => SalaDeListas::class */
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
