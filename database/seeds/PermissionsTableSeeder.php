<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {
        //delete users table records
        DB::table('permissions')->delete();
        //insert some dummy records
        DB::table('permissions')->insert(array(
            array('name' => 'user_list', 'display_name' => 'Users List', 'group' => 'User'),
            array('name' => 'view_user', 'display_name' => 'View User Profile', 'group' => 'User'),
            array('name' => 'edit_user', 'display_name' => 'Edit User Profile', 'group' => 'User'),
            array('name' => 'delete_user', 'display_name' => 'Delete User', 'group' => 'User'),
            array('name' => 'change_user_password', 'display_name' => 'Change User Password', 'group' => 'User'),
            array('name' => 'change_password', 'display_name' => 'Change Password', 'group' => 'User'),
            array('name' => 'edit_profile', 'display_name' => 'Edit Profile', 'group' => 'User'),
            array('name' => 'myprofile', 'display_name' => 'My Profile', 'group' => 'User')
        ));
    }

}