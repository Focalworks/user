<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        \Focalworks\Users\Roles::create([
            'role' => 'admin'
        ]);
        \Focalworks\Users\Roles::create([
            'role' => 'user'
        ]);
        \Focalworks\Users\Roles::create([
            'role' => 'editor'
        ]);

    }

}