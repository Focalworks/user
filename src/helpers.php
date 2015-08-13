<?php
/**
 * This is a helper function to check whether current user have access to function or not
 *
 */


if (!function_exists('access_check')) {

    function access_check($permission_name = '', $view = false)
    {
        $current_user = Auth::user();
        $permissionObj = new Focalworks\Users\Permissions;
        //check permission is exist or not in permissions table
        $permission = $permissionObj->getPermissionByName($permission_name)->first();
        if ($permission) {
            //get all roles of current user
            $user_roles = get_user_roles($current_user->id);
            //check if current user is superadmin
            if (in_array(1, $user_roles)) {
                return true;
            } else {
                $permissionMatrix = new Focalworks\Users\PermissionMatrix;
                $permission_access = $permissionMatrix->check_permission_access($permission->pid, $user_roles);
                if ($permission_access) {
                    return true;
                }
            }
        }
        if ($view) {
            return false;
        }
//        return redirect('users/access_denied');
        header('Location:' . url('users/access_denied'));
        die;
    }
}


/**
 * This is a helper function to get current user all roles
 *
 */

if (!function_exists('get_user_roles')) {

    function get_user_roles($user_id)
    {
        $user_roles = array();
        $user = new Focalworks\Users\User;
        $current_user_roles = $user->find($user_id)->user_roles()->get();
        foreach ($current_user_roles as $user_role_row) {
            $user_roles[] = $user_role_row->rid;
        };
        return $user_roles;
    }
}


/**
 * This is a helper function to check whether current user is admin or not
 *
 */

if (!function_exists('is_admin')) {

    function is_admin($id = 0)
    {
        $user = new Focalworks\Users\User;
        $current_user = Auth::user();
        if ($id > 0) {
            $current_user = $user::find($id);
        }

        $user_roles = get_user_roles($current_user->id);
        if (in_array(1, $user_roles)) {
            return true; //if admin logged in
        }
        return false;
    }
}

/**
 * This is a helper function to check get admin email
 *
 */

if (!function_exists('get_admin_email')) {

    function get_admin_email()
    {
        $user = new Focalworks\Users\User;
        $admin_user = $user->find(1);
        if ($admin_user) {
            return $admin_user->email;
        } else {
            return 'test@test.com';
        }
    }
}


