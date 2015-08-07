<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissions extends Model
{

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'group'];

    protected $primaryKey = 'pid';

    public static function getPermissionByName($name)
    {

        //print_r(SELF::where('name', '=', $name)->get());
        //print_r(DB::getQueryLog());
        return SELF::where('name', '=', $name);
    }

    public function role_permissions()
    {
        return $this->hasMany('Focalworks\Users\RolePermissions', 'pid', 'pid');
    }

}