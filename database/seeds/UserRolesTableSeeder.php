<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserRolesTableSeeder extends Seeder {

    public function run()
    {
        \Focalworks\Users\UserRoles::create([
            'uid' => 1,
            'rid' => 1,
        ]);
    }

}