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


        //(Gate filter) the logic in the before gate is run first and complete to define method if the before is false and if the before return nothing
        Gate::before(function($user){
          if($user->type == 'super-admin'){
            return true;
          }
        });  
        foreach (config('abilities') as $key => $value) {
            Gate::define($key, function ($user) use ($key): bool {
                foreach ($user->roles as $role) {
                    if (in_array($key, $role->abilities)) {
                        return true;
                    }
                }
                return false;
            });
        }
    }
}
