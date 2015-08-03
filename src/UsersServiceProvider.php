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

        $this->publishes([
            //copy package config file into app config location 

            __DIR__ . '/config/user.php' => config_path('user.php'),
            //copy package migrations into application's migrations

            __DIR__ . '/../database/migrations/2015_07_16_200000_create_roles_table.php' => base_path('database/migrations/2015_07_16_000000_create_roles_table.php'),
            __DIR__ . '/../database/migrations/2015_07_16_100000_create_permissions_table.php' => base_path('database/migrations/2015_07_16_000000_create_permissions_table.php'),
            __DIR__ . '/../database/migrations/2015_07_16_400000_create_user_roles_table.php' => base_path('database/migrations/2015_07_16_000000_create_user_roles_table.php'),
            __DIR__ . '/../database/migrations/2015_07_16_300000_create_role_permissions_table.php' => base_path('database/migrations/2015_07_16_000000_create_user_permissions_table.php'),
            //copy package seeds into application's seeds

            __DIR__ . '/../database/seeds/UsersTableSeeder.php' => base_path('database/seeds/UsersTableSeeder.php'),
            __DIR__ . '/../database/seeds/RolesTableSeeder.php' => base_path('database/seeds/RolesTableSeeder.php'),
            __DIR__ . '/../database/seeds/UserRolesTableSeeder.php' => base_path('database/seeds/UserRolesTableSeeder.php'),
            __DIR__ . '/../database/seeds/PermissionsTableSeeder.php' => base_path('database/seeds/PermissionsTableSeeder.php'),
            __DIR__ . '/../database/seeds/RolePermissionsTableSeeder.php' => base_path('database/seeds/RolePermissionsTableSeeder.php')
        ]);
    }
}