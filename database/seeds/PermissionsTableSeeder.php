<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            array('name' => 'user_list', 'display_name' => 'Users List', 'group' => 'User'),
            array('name' => 'view_user', 'display_name' => 'View User Profile', 'group' => 'User'),
            array('name' => 'edit_user', 'display_name' => 'Edit User Profile', 'group' => 'User'),
            array('name' => 'delete_user', 'display_name' => 'Delete User Profile', 'group' => 'User'),
            array('name' => 'change_user_password', 'display_name' => 'Change User Password', 'group' => 'User'),
            array('name' => 'myprofile', 'display_name' => 'My Profile', 'group' => 'User'),
            array('name' => 'edit_profile', 'display_name' => 'Edit Profile', 'group' => 'User'),
            array('name' => 'change_password', 'display_name' => 'Change Password', 'group' => 'User'),
            array('name' => 'permission_matrix', 'display_name' => 'Permission Matrix', 'group' => 'Permission'),
            array('name' => 'role_listing', 'display_name' => 'Role List', 'group' => 'Role'),
            array('name' => 'add_role', 'display_name' => 'Add Role', 'group' => 'Role'),
            array('name' => 'edit_role', 'display_name' => 'Edit Role', 'group' => 'Role'),
            array('name' => 'delete_role', 'display_name' => 'Delete Role', 'group' => 'Role')
        );
        \Focalworks\Users\Permissions::insert($data);
    }

}