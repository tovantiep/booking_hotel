<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phong;
use App\ChiTietDP;
use App\SoPhong;

class LichSuController extends Controller
{
    //
    public function getDanhSach() {
        $sophong = SoPhong::where('trang_thai', '=', 1)->get();
        // foreach ($sophong as $sp) {
        //     dd($sp->chitietdp);
        // }
        $viewData = [
            'sophong' => $sophong,
        ];
        return view('admin.thuephong.danhsach', $viewData);

    }

    public function getLichSu() {
        $respone = ['chitietdp' => '','sophong' => '' ,'date_now' => ''];
        $chitiet = [];
        $chitietdp = ChiTietDP::all();
        $date_now = date('m-d-Y');
        foreach ($chitietdp as $item) {
            $chitiet['chitietdp'] = $item;
            $chitiet['phong'] = $item->phong;
            $chitiet['datphong'] = $item->datphong;
        }
        $respone['chitietdp'] = $chitietdp;
        $respone['date_now'] = $date_now;
        return  $respone;

        // $sophong = SoPhong::where('chitietdp_id', '=', $item->id)->get();
        // $viewData = [
        //     'sophong' => $sophong,
        // ];
        // return view('admin.thuephong.danhsach', $viewData);

    }
}
