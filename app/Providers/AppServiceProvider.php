<?php

namespace App\Providers;

use App\Events\PostViewed;
use App\Listeners\IncrementPostViews;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
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
            Paginator::defaultView('pagination.custom-tailwind');
        }

        JsonResource::withoutWrapping();
        // Event::listen(
        //     'posts.viewed',
        //         IncrementPostViews::class,

        // );
        // Event::listen(
        //     PostViewed::class,
        //     IncrementPostViews::class,

        // ); // cause i initiate the event in the event class 

        Gate::define('users.view', function ($user): bool {
            return true;
        });

        Gate::define('users.create', function ($user): bool {
            return true;
        });
        Gate::define('users.update', function ($user): bool {
            return false;
        });
        Gate::define('users.delete', function ($user): bool {
            return false;
        });
    }
}
