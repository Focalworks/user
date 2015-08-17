<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \Focalworks\Users\Permissions::create([
            'name' => 'manage_users',
            'display_name' => 'Manage Users',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'manage_profile',
            'display_name' => 'View / Edit Own profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'delete_user',
            'display_name' => 'Delete User Profile',
            'group' => 'User'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'manage_permission_matrix',
            'display_name' => 'Manage Permission Matrix',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'manage_permissions',
            'display_name' => 'Manage Permissions',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'delete_permission',
            'display_name' => 'Delete Permission',
            'group' => 'Permission'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'manage_roles',
            'display_name' => 'Manage Roles',
            'group' => 'Role'
        ]);
        \Focalworks\Users\Permissions::create([
            'name' => 'delete_role',
            'display_name' => 'Delete Role',
            'group' => 'Role'
        ]);
    }

}