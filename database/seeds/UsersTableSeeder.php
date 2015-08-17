<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = \Focalworks\Users\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('pass'),
        ]);
        \Focalworks\Users\UserRoles::create([
            'uid' => $user->id,
            'rid' => 2,
        ]);
        \Focalworks\Users\UserRoles::create([
            'uid' => $user->id,
            'rid' => 1,
        ]);

    }

}