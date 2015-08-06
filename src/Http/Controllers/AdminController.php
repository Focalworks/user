<?php

namespace Focalworks\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Focalworks\Users\Http\Requests\CreatePermissionRequest;
use Focalworks\Users\PermissionMatrix;
use Focalworks\Users\Permissions;
use Focalworks\Users\RolePermissions;
use Focalworks\Users\Roles;
use Focalworks\Users\User;
use Focalworks\Users\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /*master layout page */
    protected $layout = '';

    /**
     * This is the constructor for the Controller
     */
    public function __construct()
    {
        // set which methods will be authenticated
        // and which are not
        $this->middleware('auth', []);

        if (!empty(config('user.master_layout_page'))) {
            $this->layout = config('user.master_layout_page');
        } else {
            $this->layout = 'users::layout.user-master';
        }
    }

    /**
     * This is the user listing page
     */
    public function userListing()
    {
        $check = access_check('user_listing');
        if ($check !== true) {
            return $check;
        }
        $users = User::where('id', '<>', 1)->get();
        return view('users::admin.user_listing')
            ->with('users', $users)
            ->with('layout', $this->layout);
    }

    /** This is function to edit users profile  */
    public function editUser($id)
    {
        $check = access_check('edit_user');
        if ($check !== true) {
            return $check;
        }

        $user = User::find($id);
        $roles = Roles::all();
        $user_roles = get_user_roles($id);

        if ($user) {
            return view('users::admin.edit-user')
                ->with('user', $user)
                ->with('user_roles', $user_roles)
                ->with('roles', $roles)
                ->with('layout', $this->layout);
        } else {
            Session::flash('error', 'This User not exist.');
            return redirect()->back();
        }
    }

    /**
     * Saving the user profile data on save.
     *
     * @param  Illuminate\Http\Request
     * @return redirect back
     */
    public function saveUserProfile(Request $request)
    {
        $check = access_check('edit_user');
        if ($check !== true) {
            return $check;
        }

        if (!empty($request->input('user_id'))) {
            $user_id = $request->input('user_id');

            if (!empty($request->input('name'))) {
                $user = User::find($user_id);
                $user->name = $request->input('name');
                $user->save();
            }
            /* delete all existing userroles of user */

            UserRoles::where('uid', $user_id)->delete();
            /*save new roles of user */
            UserRoles::create(['uid' => $user_id, 'rid' => 2]);
            if (!empty($request->input('roles')) and count($request->input('roles')) > 0) {

                $roles = $request->input('roles');

                foreach ($roles as $role) {
                    UserRoles::create(['uid' => $user_id, 'rid' => $role]);
                }
            }

            Session::flash('success', 'Profile data changed.');
            return redirect('admin/userListing');
        } else {
            Session::flash('error', 'No data to change.');
            return redirect('admin/userListing');
        }

    }


    /** This is function to delete users profile by admin */
    public function deleteUser($id)
    {
        $check = access_check('delete_user');
        if ($check !== true) {
            return $check;
        }

        $user = User::find($id);

        if ($user) {
            $user_roles = new UserRoles();
            /* delete all existing userroles of user */
            $user_roles->where('uid', '=', $id)->delete();
            $user->delete();

            Session::flash('success', 'User deleted successfully.');
            return redirect()->back();
        } else {
            Session::flash('error', 'This User not exist.');
            return redirect()->back();
        }
    }


    /** This is function to change users password by admin  */
    public function changeUserPassword($id)
    {
        $check = access_check('change_user_password');
        if ($check !== true) {
            return $check;
        }

        $user = User::find($id);
        if ($user) {
            return view('users::admin.change-user-password')
                ->with('user', $user)
                ->with('layout', $this->layout);
        } else {
            Session::flash('error', 'This User not exist.');
            return redirect()->back();
        }
    }


    /**
     * Check current password and then change
     * the new password set by the admin.
     *
     * @param  Illuminate\Http\Request
     * @return redirect to change password
     */
    public function saveUserPassword(Request $request)
    {
        $check = access_check('change_user_password');
        if ($check !== true) {
            return $check;
        }

        $fields = array(
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );
        $rules = array('password' => 'required|min:5|confirmed');
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $user_id = $request->input('user_id');
            $user = User::find($user_id);
            // change password and send back
            $user->password = Hash::make($request->input('password'));
            $user->save();
            Session::flash('success', 'Password changed successfully.');
            return redirect()->back();
        }
    }


    /**
     * This function used to get permission matrix
     */

    public function getPermissionMatrix()
    {
        $check = access_check('permission_matrix');
        if ($check !== true) {
            return $check;
        }
        $permissionMatrixObj = new PermissionMatrix();
        $permissionMatrix = $permissionMatrixObj->get_all_permisssions();
        $all_roles = Roles::all();
        return view('users::admin.permission-matrix')
            ->with('permission_matrix', $permissionMatrix)
            ->with('all_roles', $all_roles)
            ->with('layout', $this->layout);
    }

    /**
     * This function used to save permission matrix
     */
    public function savePermissionMatrix(Request $request)
    {
        $check = access_check('permission_matrix');
        if ($check !== true) {
            return $check;
        }

        RolePermissions::truncate();
        $permission_matrix = $request->input('pm');
        if (count($permission_matrix) > 0) {
            foreach ($permission_matrix as $permission) {
                $piece = explode('_', $permission);
                RolePermissions::create(array('pid' => $piece[0], 'rid' => $piece[1]));
            }
        }
        Session::flash('success', 'Permission Matrix Saved successfully.');
        return redirect('admin/permissionMatrix');
    }

    /**
     * This function gives list of all roles
     *
     */
    public function role_listing()
    {
        $check = access_check('role_listing');
        if ($check !== true) {
            return $check;
        }
        $roles = Roles::all();
        return view('users::admin.role_listing')
            ->with('roles', $roles)
            ->with('layout', $this->layout);
    }


    /**
     * This is function to edit role
     **/
    public function editRole($id)
    {
        $check = access_check('edit_role');
        if ($check !== true) {
            return $check;
        }
        $role = Roles::GetByRoleID($id)->first();
        if ($role) {
            return view('users::admin.edit-role')
                ->with('role', $role)
                ->with('layout', $this->layout);
        } else {
            Session::flash('error', 'This Role not exist.');
            return redirect()->back();
        }
    }


    /**
     * This is function to save role changes
     **/

    public function saveRole(Request $request)
    {
        $role_id = $request->input('rid');
        if ($role_id) {
            $check = access_check('edit_role');
        } else {
            $check = access_check('add_role');
        }

        if ($check !== true) {
            return $check;
        }
        $fields = array(
            'role' => Input::get('role')
        );
        $rules = array('role' => 'required|min:2');
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            if ($role_id) {
                $role = Roles::GetByRoleID($role_id)->first();
                // change password and send back
                $role->role = $request->input('role');
                $role->save();
                Session::flash('success', 'Role changes saved successfully.');
            } else {
                Roles::create([
                    'role' => $request->input('role')
                ]);
                Session::flash('success', 'Role created successfully.');
            }
            return redirect('admin/roleListing');
        }
    }

    /**
     * This function is to delete role
     */
    public function deleteRole($role_id)
    {
        $check = access_check('delete_role');
        if ($check !== true) {
            return $check;
        }

        $role = Roles::GetByRoleID($role_id)->first();

        if ($role) {
            $user_roles = new UserRoles();
            $user_roles->where('rid', '=', $role_id)->delete();
            $role->delete();
            Session::flash('success', 'Role deleted successfully.');
            return redirect()->back();
        } else {
            Session::flash('error', 'This Role not exist.');
            return redirect()->back();
        }
    }

    /**
     * this function is used to add new role
     */
    public function addRole()
    {
        $check = access_check('add_role');
        if ($check !== true) {
            return $check;
        }

        return view('users::admin.add-role')
            ->with('layout', $this->layout);
    }

    /**
     * This function gives list of all permissions
     *
     */
    public function permissionsListing()
    {
        $check = access_check('permission_listing');
        if ($check !== true) {
            return $check;
        }
        $permissions = Permissions::all();
        return view('users::admin.permissions-listing')
            ->with('permissions', $permissions)
            ->with('layout', $this->layout);
    }

    /**
     * This will delete permission
     *
     */
    public function deletePermission($id)
    {
        $check = access_check('delete_permission');
        if ($check !== true) {
            return $check;
        }

        $permission = Permissions::find($id);
        if ($permission) {
            $permissionObj = new Permissions();
            $permissionObj->where('pid', $id)->delete();
        }
        return redirect('admin/permissionsListing');
    }

    /**
     * This will display add permission
     *
     */
    public function addPermission()
    {
        $check = access_check('add_permission');
        if ($check !== true) {
            return $check;
        }
        $permissions = Permissions::all();
        return view('users::admin.add-permission')
            ->with('layout', $this->layout);
    }

    /**
     * This will display edit permission
     *
     */
    public function editPermission($id)
    {
        $check = access_check('edit_permission');
        if ($check !== true) {
            return $check;
        }
        $permission = Permissions::find($id);
        return view('users::admin.edit-permission')
            ->with('permission', $permission)
            ->with('layout', $this->layout);
    }

    /**
     * This will display add permission
     * @param CreatePermissionRequest $request
     * @return Redirect
     */
    public function savePermission(CreatePermissionRequest $request)
    {
        $check = access_check('add_permission');
        if ($check !== true) {
            return $check;
        }
        Permissions::create($request->all());
        return redirect('admin/permissionsListing');
    }

    /**
     * This will display edit permission
     * @param CreatePermissionRequest $request
     * @return Redirect
     */
    public function updatePermission(CreatePermissionRequest $request)
    {
        $check = access_check('edit_permission');
        if ($check !== true) {
            return $check;
        }
        $permissions = Permissions::find($request->input('pid'));
        $permissions->update($request->all());
        return redirect('admin/permissionsListing');
    }
}