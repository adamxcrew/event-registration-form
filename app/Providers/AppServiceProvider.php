<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!App::environment('local')) {
            Schema::defaultStringLength(191);
        }
        
        Blade::directive('activeRoute', function ($expression) {
            return "<?= request()->routeIs($expression) ? 'active' : ''; ?>";
        });

        Blade::directive('active', function ($expression) {
            return "<?= request()->is($expression) ? 'active' : ''; ?>";
        });

        Blade::if('role', function ($rolename) {
            return Auth::user()->hasRole($rolename);
        });

        Blade::if('not', function ($rolename) {
            return !Auth::user()->hasRole($rolename);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
