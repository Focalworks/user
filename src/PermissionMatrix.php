<?php
/**
 * Created by PhpStorm.
 * User: shirish
 * Date: 23/7/15
 * Time: 11:27 AM
 */

namespace Focalworks\Users;

use Focalworks\Users\User;
use Focalworks\Users\Roles;
use Focalworks\Users\Permissions;

class PermissionMatrix
{
    /**
     * get all permissions with rolewise access
     * @return array
     */
    public function get_all_permisssions()
    {
        $all_permissions = Permissions::all();
        $all_roles = Roles::all();
        $permission_matrix = array();

        foreach ($all_permissions as $permission) {
            $permission_matrix[$permission->group][$permission->pid]['permission'] = $permission;
            foreach ($all_roles as $role) {
                $permission_matrix[$permission->group][$permission->pid]['roles'][$role->rid]['role'] = $role;
                $role_permission_access = $role->role_permissions()->where('pid', '=', $permission->pid)->get();

                if (count($role_permission_access) > 0) {
                    $permission_matrix[$permission->group][$permission->pid]['roles'][$role->rid]['access'] = 1;
                } else {
                    $permission_matrix[$permission->group][$permission->pid]['roles'][$role->rid]['access'] = 0;
                }

            }
        }
        return $permission_matrix;
    }

    function get_users_all_permissions($user_id)
    {
        $all_permissions = [];
        $current_user_roles = User::find($user_id)->user_roles()->get();
        foreach ($current_user_roles as $role) {
            /* all permissions of each role of user */
            $role_permissions = $role->role_permissions()->get();
            foreach ($role_permissions as $role_permission) {
                /*get permission name of each permission */
                $all_permissions[] = $role_permission->permissions->name;
            }
        }

        return $all_permissions;
    }

    public function check_permission_access($permission_id, $user_roles)
    {
        $rolePermissionsCount = RolePermissions::where('pid', '=', $permission_id)->whereIn('rid',
            $user_roles)->count();
        if ($rolePermissionsCount > 0) {
            return true;
        }
        return false;
    }

} 