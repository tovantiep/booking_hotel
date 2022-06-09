<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role_id', 
        'ma_nv',
        'gioitinh',
        'sdt',
        'ngaysinh',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }

    public function datphong()
    {
        return $this->hasMany('App\DatPhong','user_id');
    }

    public function loaiphong()
    {
        return $this->hasMany('App\LoaiPhong','user_id');
    }

    public function phong()
    {
        return $this->hasMany('App\Phong','user_id');
    }

    public function hoadon()
    {
        return $this->hasMany('App\HoaDon','user_id');
    }

    public function kh()
    {
        return $this->hasOne('App\KhachHang','user_id');
    }
}
