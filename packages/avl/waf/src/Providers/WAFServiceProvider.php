<?php

namespace AVL\WAF\Providers;

use AVL\WAF\Http\Middleware\WAFMiddleware;
use AVL\WAF\WAF;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class WAFServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'waf');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->app->instance('waf', new WAF());
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('firewall', WAFMiddleware::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
