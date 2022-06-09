<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatPhong extends Model
{
    //
    protected $table = 'datphong';
    protected $filltable = [
        'id',
        'ngaydat',
        'tongsophong',
        'tongtien',
        'start_date',
        'end_date',
        'chuthich',
        'user_id',
        'trang_thai',
    ];


    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function chitietdp()
    {
        return $this->hasMany('App\ChiTietDP','datphong_id');
    }

    public function hoadon()
    {
        return $this->belongsTo('App\HoaDon','datphong_id');
    }


}
