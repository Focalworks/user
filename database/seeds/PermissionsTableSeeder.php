<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \Focalworks\Users\Permissions::create([
            'name' => 'user_list',
            'display_name' => 'Users List',
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
            'display_name' => 'Delete User Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'change_user_password',
            'display_name' => 'Change User Password',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'myprofile',
            'display_name' => 'My Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'edit_profile',
            'display_name' => 'Edit Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'change_password',
            'display_name' => 'Change Password',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'permission_matrix',
            'display_name' => 'Permission Matrix',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'permission_listing',
            'display_name' => 'Permission Listing',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'add_permission',
            'display_name' => 'Add Permission',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'edit_permission',
            'display_name' => 'Edit Permission',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'delete_permission',
            'display_name' => 'Delete Permission',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'role_listing',
            'display_name' => 'Role List',
            'group' => 'Role'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'add_role',
            'display_name' => 'Add Role',
            'group' => 'Role'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'edit_role',
            'display_name' => 'Edit Role',
            'group' => 'Role'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'delete_role',
            'display_name' => 'Delete Role',
            'group' => 'Role'
        ]);
    }

}