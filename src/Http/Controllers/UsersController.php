<?php

namespace Focalworks\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Focalworks\Users\Http\Requests\CreateUserRequest;
use Focalworks\Users\User;
use Focalworks\Users\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * URL where the user will redirect after successful login.
     *
     * @var Config|string
     */
    protected $login_redirect = 'users/dashboard';

    /**
     * The default layout which will be used for User screens.
     *
     * @var string
     */
    protected $layout = 'users::layout.user-master';

    /**
     * This is the constructor for the Controller
     */
    public function __construct()
    {
        // set which methods will be authenticated
        // and which are not
        $this->middleware('auth', [
            'except' => [
                'register',
                'doRegister',
                'login',
                'doLogin',
                'logout',
                'forgotPassword',
                'sendPasswordEmail',
                'resetPassword',
                'saveResetPassword',
                'access_denied'
            ],
        ]);

        // check the redirect url from the config file if there is any
        if (!empty(config('user.login_redirect'))) {
            $this->login_redirect = config('user.login_redirect');
        }

        // override the layout if config is set
        if (!empty(config('user.master_layout_page'))) {
            $this->layout = config('user.master_layout_page');
        }
    }

    /**
     * User registration page
     *
     * @return void
     */

    public function register()
    {
        return view('users::register')
            ->with('layout', $this->layout);
    }

    /**
     * Validate and save the user data to create a new user.
     *
     * @param Request $request
     * @return mixed
     */
    public function doRegister(CreateUserRequest $request)
    {
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
            UserRoles::create(array('uid' => $user->id, 'rid' => 2));
        }
        // successful registration
        Session::flash('success', 'You have registered successfully');
        return Redirect::to('users/login');
    }

    /**
     * function to request a new password for user
     * @return void
     */
    public function forgotPassword()
    {
        return view('users::forgot_password')->with('layout', $this->layout);
    }

    /**
     * Send email for password resetting.
     *
     * @param Request $request
     * @return Redirect
     */
    public function sendPasswordEmail(Request $request)
    {
        $fields = array('username' => Input::get('username'));

        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($fields, User::$forgot_password_rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('users/forgotPassword')->withInput()->withErrors($validator);
        } else {
            $username = $request->input('username');
            $user = User::where('email', '=', $username)->first(); //find user by given username
            if ($user) {
                $data['uid'] = $user->id;
                $data['email'] = $user->email;
                $encrypt = md5(1490 * 4 + $data['uid']);
                $data['password_reset_link'] = url() . '/users/resetPassword/' . $encrypt;

                $data['admin_email'] = get_admin_email(); // get admin email
                dd($data);
                Mail::send('emails.reset_password', $data, function ($message, $data) {
                    $message->from($data['admin_email'], 'Admin');
                    $message->to($data['email']);
                    $message->subject('Reset Your Password');
                });

                Session::flash('success', 'Please check your mails..for further details');
            } else {
                Session::flash('error', 'Invalid email address.please type a valid email');
            }

            return redirect('users/forgotPassword');
        }
    }

    /**
     * Reset users password here
     *
     * @param string $encrypt
     * @return $this|Redirect
     */
    public function resetPassword($encrypt = '')
    {
        if (!empty($encrypt)) {
            $user = DB::select(DB::raw('Select * from users where md5(1490 * 4 + id) = "' . $encrypt . '"'));
            if (count($user) > 0) {
                return view('users::reset_password')
                    ->with('user', $user[0])
                    ->with('layout', $this->layout);
            } else {
                Session::flash('error', 'Invalid password reset link.');
                return redirect('users/login');
            }
        } else {
            Session::flash('error', 'Invalid password reset link.');
            return redirect('users/login');
        }
    }

    /**
     * The new password set by the user.
     *
     * @param  Illuminate\Http\Request
     * @return redirect to change password
     */
    public function saveResetPassword(Request $request)
    {
        $fields = array(
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );
        $validator = Validator::make($fields, User::$change_user_password_rules);

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
            return redirect('users/login');
        }
    }

    /**
     * Login page of the user
     *
     * @return $this|Redirect
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
     * @param Request $request
     * @return Redirect
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
     * This is the user's dashboard page.
     */
    public function dashboard()
    {
        $roles = UserRoles::where('uid', '=', Auth::user()->id)->first();

        if ($roles->rid == 1) {
            // if admin, take him to the admin section
            return redirect('admin/userListing');
        }

        return $this->myprofile();
    }

    /**
     * Current User's Profile page
     *
     * @return $this|bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function myProfile()
    {
        access_check('manage_profile');

        $current_user_roles = User::find(Auth::user()->id)->user_roles()->get();

        //print_r($current_user_roles);exit;

        return view('users::user.myprofile')
            ->with('user', Auth::user())
            ->with('user_roles', $current_user_roles)
            ->with('layout', $this->layout);

    }

    /**
     * Access denied page
     *
     * @return $this
     */
    public function access_denied()
    {
        return view('users::access-denied')
            ->with('layout', $this->layout);
    }

    /**
     * Current User can change his own password
     *
     * @return $this|bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changePassword()
    {
        access_check('manage_profile');

        return view('users::user.change-password')
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
        access_check('manage_profile');

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
        access_check('manage_profile');

        return view('users::user.edit-profile')
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
        access_check('manage_profile');

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