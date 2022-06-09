<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiPhong extends Model
{
    //
    protected $table = 'loaiphong';
    protected $filltable = [
        'id',
        'tenloaiphong',
        'slug',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function phong()
    {
        return $this->hasMany('App\Phong','loaiphong_id');
    }



}
