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
 * This is a helper function to check whether current user is admin or not
 *
 */

if (!function_exists('is_admin')) {

    function is_admin()
    {
        $user = new Focalworks\Users\User;
        $current_user = Auth::user();
        $current_user_roles = $user->find($current_user->id)->user_roles()->get();
        foreach ($current_user_roles as $role) {
            if ($role->rid == 1) {
                return true; //if admin logged in
            }
        }
        return false;
    }
}


