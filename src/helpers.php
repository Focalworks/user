<?php
/**
 * This is a helper function to check whether current user have access to function or not
 *
 */

if (!function_exists('access_check')) {

    function access_check($permission, $view = false)
    {
        $current_user = Auth::user();
        $user_roles_id = array_keys($current_user->roles);
        if (in_array(1, $user_roles_id)) {
            return true;
        } elseif (is_array($permission)) {
            $allowed_permission = array_intersect($permission, $current_user->permissions);
            if (array_count_values($permission) == array_count_values($allowed_permission)) {
                return true;
            }
        } else {
            if (in_array($permission, $current_user->permissions)) {
                return true;
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


