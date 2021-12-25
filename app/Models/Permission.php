<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = ['admin'];

    protected $fillable = ['name' ,'display_name' , 'description'];
}
