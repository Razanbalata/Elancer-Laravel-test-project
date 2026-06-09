<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind("APP_CONFIG", function () {
            return config("app");
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->is("dashboard/*")) {
            Paginator::useTailwind();
        } else {
            Paginator::useBootstrapFive();
        }
    }
}
