<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Dudi;
use App\Http\Middleware\Guru;
use App\Http\Middleware\Siswa;
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
        $middleware->alias([
            'admin' => Admin::class,
            'siswa' => Siswa::class,
            'guru' => Guru::class,
            'dudi' => Dudi::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
