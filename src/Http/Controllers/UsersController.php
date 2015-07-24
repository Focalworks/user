<?php

namespace Focalworks\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Focalworks\Users\User;
use Focalworks\Users\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /*callback function after successfull login */
    protected $login_redirect = 'dashboard';

    /*master layout page */
    protected $layout = null;

    /**
     * This is the constructor for the Controller
     */
    public function __construct()
    {
        // set which methods will be authenticated
        // and which are not
        $this->middleware('auth', [
            'except' => ['register', 'doRegister', 'login', 'doLogin', 'logout', 'access_denied'],
        ]);

        if (!empty(config('user.login_redirect'))) {
            $this->login_redirect = config('user.login_redirect');
        }

        if (!empty(config('user.master_layout_page'))) {
            $this->layout = config('user.master_layout_page');
        }
    }

    /**
     * Register page
     *
     * @return void
     */

    public function register()
    {
        return view('users::register')->with('layout', $this->layout);
    }


    /**
     * save registered user
     *
     */

    public function doRegister(Request $request)
    {
        $fields = array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );

        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($fields, User::$registration_rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('users/register')->withInput()->withErrors($validator);
        } else {
            //create new user and save into users table
            $user_arr = array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            );
            $user = User::create($user_arr);

            if (!$user) {
                //if registration fails
                Session::flash('error', 'Registration failed..please try again later');
                return Redirect::to('users/register');
            } else {
                UserRoles::create(array('uid' => $user->id, 'rid' => 3));
            }

        }
        // successful registration
        Session::flash('success', 'You have registered successfully');
        return Redirect::to('users/login');
    }

    /**
     * Login page
     *
     * @return void
     */

    public function login()
    {
        if (Auth::check()) {
            //if user already logged in
            return redirect($this->login_redirect);
        } elseif (Auth::viaRemember()) {
            //if user set remember me token
            return redirect($this->login_redirect);
        } else {
            return view('users::login')->with('layout', $this->layout);
        }
    }

    /**
     * Function to match credentials and logged in user
     *
     * @return void
     */

    public function doLogin(Request $request)
    {
        $fields = array('username' => Input::get('username'), 'password' => Input::get('password'));

        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($fields, User::$login_rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('users/login')->withInput()->withErrors($validator);
        } else {
            $credentials = [
                'email' => $request->input('username'),
                'password' => $request->input('password'),
            ];
            if (!Auth::attempt($credentials)) {
                // if the user credentials are not correct we
                // will redirect user to the login page with
                // message that the credentials were wrong
                Session::flash('error', 'Something went wrong with the username and / or password');
                return Redirect::to('users/login');
            }

            Session::flash('success', 'You have logged in successfully');

            return redirect($this->login_redirect);
        }
    }

    /**
     * Dashboard page
     *
     */
    public function dashboard()
    {
        $user = Auth::user();
        $roles = UserRoles::where('uid', '=', $user->id)->first();

        $current_role = $roles->rid;

        if ($current_role == 1) {
            return redirect('admin/userListing');
        } else {
            return $this->myprofile();
        }

    }


    /**
     * Current User's Profile page
     *
     */

    public function myprofile()
    {
        $check = access_check('myprofile');
        if ($check !== true) {
            return $check;
        }

        $user = Auth::user();
        $current_user_roles = User::find($user->id)->user_roles()->get();
        //print_r($current_user_roles);exit;
        return view('users::myprofile')
            ->with('user', $user)
            ->with('user_roles', $current_user_roles)
            ->with('layout', $this->layout);

    }

    /** access denied page **/
    public function access_denied()
    {
        return view('users::access-denied')
            ->with('layout', $this->layout);
    }

    /**
     * Current User can change his own password
     *
     */

    public function changePassword()
    {
        $check = access_check('change_password');
        if ($check !== true) {
            return $check;
        }

        return view('users::change-password')
            ->with('layout', $this->layout);
    }

    /**
     * Check current password and then change
     * the new password set by the user.
     *
     * @param  Illuminate\Http\Request
     * @return redirect to change password
     */
    public function saveNewPassword(Request $request)
    {
        $fields = array(
            'current_password' => Input::get('current_password'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );

        $validator = Validator::make($fields, User::$change_password_rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('users/changePassword')->withInput()->withErrors($validator);
        } else {
            $currentUser = Auth::user();
            // checking if the current password is correct
            if (!Hash::check($request->input('current_password'), $currentUser->password)) {
                Session::flash('error', 'Current password is wrong.');
                return redirect()->back();
            }

            // change password and send back
            $currentUser->password = Hash::make($request->input('password'));
            $currentUser->save();
            Session::flash('success', 'Password changed.');
            return redirect()->back();
        }
    }

    /**
     * This is the user profile edit page.
     *
     * @return view user profile edit.
     */

    public function editProfile()
    {
        $check = access_check('edit_profile');
        if ($check !== true) {
            return $check;
        }

        return view('users::edit-profile')
            ->with('user', Auth::user())
            ->with('layout', $this->layout);
    }

    /**
     * Saving the user profile data on save.
     *
     * @param  Illuminate\Http\Request
     * @return redirect back
     */
    public function saveUserProfile(Request $request)
    {
        if (!empty($request->input('name'))) {
            $user = User::find(Auth::user()->id);
            $user->name = $request->input('name');
            $user->save();
            Session::flash('success', 'Profile data changed.');
            return redirect()->back();
        } else {
            Session::flash('error', 'No data to change.');
            return redirect()->back();
        }

    }

    /**
     * This page will log out the user
     * destroy his session and take
     * him back to login screen.
     *
     * @return redirect
     */
    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'You have logged out.');
        return Redirect::to('users/login');
    }


}