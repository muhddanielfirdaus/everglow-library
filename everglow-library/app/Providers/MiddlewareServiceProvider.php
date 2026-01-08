<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware\AdminAuth;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
    }
}
