<?php

namespace Focalworks\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('users', function ($app) {
            return new Users;
        });
    }

    public function boot()
    {
        // loading the routes from the routes file.
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        // define the path to views
        $this->loadViewsFrom(__DIR__ . '/../views', 'users');
    }
}