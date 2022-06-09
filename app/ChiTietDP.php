<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDP extends Model
{
    //
    protected $table = 'chitietdp';
    protected $filltable = [
        'id',
        'datphong_id',
        'phong_id',
        'sophong',
        'gia',
        'chuthich'
    ];

    public function datphong() {
        return $this->belongsTo('App\DatPhong','datphong_id');
    }

    public function phong() {
        return $this->belongsTo('App\Phong','phong_id');
    }

    public function sophong() {
        return $this->hasMany('App\SoPhong','chitietdp_id');
    }
}
