<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pid', 'rid'];

    public function permissions()
    {
        return $this->hasOne('Focalworks\Users\Permissions', 'pid', 'pid');
    }

}