<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * Registration rules
     **/
    public static $registration_rules = array(
        'name' => 'required|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:5|confirmed'
    );
    /**
     * Login rules
     **/
    public static $login_rules = array(
        'username' => 'required|email',
        'password' => 'required'
    );
    /**
     * Change Password rules
     **/
    public static $change_password_rules = array(
        'current_password' => 'required',
        'password' => 'required|min:5|confirmed'
    );
    /**
     * Change User Password rules
     **/
    public static $change_user_password_rules = array(
        'password' => 'required|min:5|confirmed'
    );


    /**
     * Forgot Password rules
     **/
    public static $forgot_password_rules = array(
        'username' => 'required|email',
    );
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'pasword_confirmation'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function user_roles()
    {
        return $this->hasMany('Focalworks\Users\UserRoles', 'uid', 'id');
    }


}
