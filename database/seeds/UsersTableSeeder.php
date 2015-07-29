<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        \Focalworks\Users\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('pass'),
        ]);
    }

}