<?php
/**
 * This is a helper function to check whether current user have access to function or not
 *
 */

if (!function_exists('access_check')) {

    function access_check($permission_name = '')
    {
        $current_user = Auth::user();

        if ($current_user->id == 1) {
            return true; //if admin logged in
        } else {
            $permissionMatrix = new Focalworks\Users\PermissionMatrix;
            $permissions = $permissionMatrix->get_users_all_permissions($current_user->id);

            if (in_array($permission_name, $permissions)) {
                return true;
            }
        }
        return redirect('users/access_denied');
    }
}

/**
 * This is a helper function to check whether current user have access to function or not
 * function specifically for views
 *
 */

if (!function_exists('view_access_check')) {

    function view_access_check($permission_name = '')
    {
        $current_user = Auth::user();
        $user_roles = get_user_roles($current_user->id);

        if (in_array(1, $user_roles)) {
            return true; //if admin logged in
        } else {
            $permissionMatrix = new Focalworks\Users\PermissionMatrix;
            $permissions = $permissionMatrix->get_users_all_permissions($current_user->id);

            if (in_array($permission_name, $permissions)) {
                return true;
            }
        }

        return false;
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

    function is_admin()
    {
        $user = new Focalworks\Users\User;
        $current_user = Auth::user();
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


