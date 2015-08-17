<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        \Focalworks\Users\Roles::create([
            'role' => 'Superadmin'
        ]);
        \Focalworks\Users\Roles::create([
            'role' => 'User'
        ]);
        \Focalworks\Users\Roles::create([
            'role' => 'Editor'
        ]);

    }

}