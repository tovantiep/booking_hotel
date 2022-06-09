<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';
    protected $filltable = [
        'id',
        'role_name'
    ];

    public function users()
    {
        return $this->hasMany('App\User','role_id');
    }
}
