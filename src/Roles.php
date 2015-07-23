<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role'];

    public function role_permissions()
    {
        return $this->hasMany('Focalworks\Users\UserPermissions', 'rid', 'rid');
    }
}