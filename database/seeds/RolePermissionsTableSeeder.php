<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolePermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \Focalworks\Users\RolePermissions::create([
            'rid' => 2,
            'pid' => 2,
        ]);

        \Focalworks\Users\RolePermissions::create([
            'rid' => 3,
            'pid' => 2,
        ]);
    }

}