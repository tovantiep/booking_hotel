<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phong;
use App\LoaiPhong;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //
    public function getBooking() {
        return view ('pages.booking');


    }

    public function getMyBooking(Request $request) {
        if (Session::get('std') == null || Session::get('end') == null) {
            $request->session()->put('std', date('m-d-Y'));
            $request->session()->put('end', date('m-d-Y'));
        }
        return view ('pages.mybooking');
    }


    public function getIndex()
    {
        $loaiphong = LoaiPhong::all();

        $phong = Phong::where('soluong', '>', 0)->get();
        $phong1 = Phong::where('soluong', '>=', 0)->limit(1)->get();
        $phong2 = Phong::where('soluong', '>=', 0)->skip(1)->take(2)->get();
        $phong3 = Phong::where('soluong', '>=', 0)->skip(3)->take(2)->get();
        $phong4 = Phong::where('soluong', '>=', 0)->skip(5)->take(2)->get();

        $viewData = [
            'loaiphong' => $loaiphong,
            'phong1' => $phong1,
            'phong' => $phong,
            'phong2' => $phong2,
            'phong3' => $phong3,
            'phong4' => $phong4,

        ];
        return view('pages.index', $viewData);
    }



    public function getTimKiem(Request $request) {
        $phong = Phong::where('tenphong', 'like', '%'.$request->search.'%')->get();
        $lp = LoaiPhong::where('tenloaiphong', 'like', '%'.$request->search.'%')->get();
        if($phong->isEmpty()) {
            $phong = Phong::where('loaiphong_id', '=', $lp[0]->id)->get();
        };
        $viewData = [
            'search' => $phong,
        ];
        return view('pages.booking', $viewData);
    }




}
