<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'rid'];

    public function roles()
    {
        return $this->hasOne('Focalworks\Users\Roles', 'rid', 'rid');
    }

    public function user_permissions()
    {
        return $this->hasMany('Focalworks\Users\UserPermissions', 'rid', 'rid');
    }
}