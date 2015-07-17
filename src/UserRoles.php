<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'rid'];

    public $timestamps = false;

}