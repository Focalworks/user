<?php

namespace Focalworks\Users;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name'];

}