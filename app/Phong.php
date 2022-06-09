<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    //
    protected $table = 'phong';
    protected $filltable = [
        'id',
        'loaiphong_id',
        'tenphong',
        'chuthich',
        'user_id',
        'soluong',
        'gia',
        'slug',
        'booked'
    ];

    public function loaiphong() {
        return $this->belongsTo('App\LoaiPhong','loaiphong_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    
    public function chitietdp()
    {
        return $this->hasMany('App\ChiTietDP','phong_id');
    }

    public function sophong() {
        return $this->hasMany('App\SoPhong','phong_id');
    }
}
