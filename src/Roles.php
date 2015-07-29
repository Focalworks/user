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

    protected $primaryKey = 'rid';

    public static function GetByRoleID($id)
    {
        return SELF::where('rid', '=', $id);
    }


    public function role_permissions()
    {
        return $this->hasMany('Focalworks\Users\RolePermissions', 'rid', 'rid');
    }
}