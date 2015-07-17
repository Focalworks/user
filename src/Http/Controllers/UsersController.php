<?php

namespace Focalworks\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Focalworks\Users\User;
use Focalworks\Users\UserRoles;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * This is the construvtor for the Controller
     */
    public function __construct()
    {
        // set which methods will be authenticated
        // and which are not
        $this->middleware('auth', [
            'except' => ['register','doRegister','login','doLogin','logout'],
        ]);
    }

    /**
     * Register page
     *
     * @return void
     */

    public function register()
    {
        return view('users::register');
    }


    /**
     * save registered user
     *
     */

    public function doRegister(Request $request)
    {
        $fields = array('name' => Input::get('name'),'email' => Input::get('email'),'password'=> Input::get('password'),'password_confirmation'=> Input::get('password_confirmation'));

        // setting up rules
        $rules = array('name' => 'required|min:2','email' => 'required|email|unique:users','password' => 'required|min:5|confirmed');


        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('users/register')->withInput()->withErrors($validator);
        }else
        {
            //create new user and save into users table
            $user_arr = array('name' => $request->input('name'),'email' => $request->input('email'), 'password' => Hash::make($request->input('password'))) ;
            $user = User::create($user_arr);

            if(!$user)
            {
                //if registration fails
                Session::flash('error', 'Registration failed..please try again later');
               return Redirect::to('users/register'); 
            }else
            {
                UserRoles::create(array('uid' => $user->id ,'rid' => 3));
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
        if(Auth::check()){
            //if user already logged in
            return Redirect::to('users/dashboard');
        }elseif(Auth::viaRemember()){
            //if user set remember me token
            return Redirect::to('users/dashboard');
        }else
            return view('users::login');
    }

    /**
     * Function to match credentials and logged in user
     *
     * @return void
     */

    public function doLogin(Request $request)
    {
        $fields = array('username' => Input::get('username'),'password'=> Input::get('password'));

        // setting up rules
        $rules = array('username' => 'required|email','password' => 'required');


        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('users/login')->withInput()->withErrors($validator);
        }else
        {
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
            return Redirect::to('users/dashboard');
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

        if($current_role == 1)
        {
           return Redirect::to('admin/dashboard');
        }else
        {
           return Redirect::to('users/myprofile');
        }
        
    }


    /**
     * Current User's Profile page
     *
     */

    public function myprofile()
    {
        $user = Auth::user();
        return view('users::myprofile')
            ->with('user',$user);
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