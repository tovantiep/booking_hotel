<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    //
    protected $table = 'hoadon';
    protected $filltable = [
        'user_id',
        'datphong_id',
        'ngaythanhtoan',
        'tienphong',
    ];

    public function datphong()
    {
        return $this->belongsTo('App\DatPhong','datphong_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
