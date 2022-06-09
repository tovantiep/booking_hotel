<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideM extends Model
{
    //
    protected $table = 'slide';
    protected $filltable = [
        'id',
        'hinh',
        'tieude',
        'noidung',
    ];
}
