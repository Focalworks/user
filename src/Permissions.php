<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

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

    public function getPermissionData($id)
    {

    }

}