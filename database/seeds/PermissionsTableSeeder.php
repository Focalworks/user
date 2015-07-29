<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {
        \Focalworks\Users\Permissions::create([
            'name' => 'user_list',
            'display_name' => 'View User Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'view_user',
            'display_name' => 'View User Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'edit_user',
            'display_name' => 'Edit User Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'delete_user',
            'display_name' => 'Delete User',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'change_user_password',
            'display_name' => 'Change User Password',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'edit_profile',
            'display_name' => 'Edit Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'myprofile',
            'display_name' => 'My Profile',
            'group' => 'User'
        ]);
    }

}