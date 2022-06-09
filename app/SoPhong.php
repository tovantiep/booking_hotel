<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoPhong extends Model
{
    //
    protected $table = 'sophong';
    protected $filltable = [
        'id',
        'phong_id',
        'so_phong',
        'trang_thai',
        'chitietdp_id'
    ];

    public function phong() {
        return $this->belongsTo('App\Phong','phong_id');
    }

    public function chitietdp() {
        return $this->belongsTo('App\ChiTietDP','chitietdp_id');
    }

}
