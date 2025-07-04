<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's HTTP middleware stack.
     *
     * This stack is run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // ...existing code...
        \Fruitcake\Cors\HandleCors::class,
        // ...existing code...
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // ...existing code...
    ];
}