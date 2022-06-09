<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    //
    protected $table = 'kh';
    protected $filltable = [
        'ten_kh',
        'sdt',
        'email',
        'dia_chi',
        'gioi_tinh',
        'so_cmnd',
        'ngaysinh',
        'user_id',
    ];

    public function datphong()
    {
        return $this->hasMany('App\DatPhong','khachhang_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    

}
