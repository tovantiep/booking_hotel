<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietDP;
use App\DatPhong;
use App\KhachHang;
use App\Phong;
use App\LoaiPhong;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{

    public function getLoaiPhong($id) {

        //Lấy ra các phòng theo loaiphong_id với $id được truyền vào
        $phong = Phong::where('loaiphong_id', $id)->get();

        //Hiển thị ra html
        echo "<option value='' disabled selected>Chọn phòng</option>";

        //Chạy vòng foreach để hiển thị ra các phòng
        foreach($phong as $p) {
            //Check nếu số lượng phòng đó > 0 thì mới hiển thị
            if ($p->soluong > 0) {
                //Hiển thị ra html
                echo "<option value='".$p->id."'>".$p->tenphong."</option>";
            }
        }
    }

    public function getBookingLoaiPhong($id) {
       // dd($id);
        if ($id != "all") {
            //Lấy ra phòng theo $id được truyền vào
            $phong = Phong::where('loaiphong_id', $id)->orWhere('soluong','>',0)->get();
            $viewData = [
                'phong' => $phong,
            ];
        } //Ngược lại sẽ lấY ra tất cả các phòng
        else {
            //Lây ra tất cả các phòng và sắp xếp tăng dần theo loaiphong_id
            $phong = Phong::orderBy('loaiphong_id','DESC')->orWhere('soluong','>',0)->get();
            $viewData = [
                'phong' => $phong,
            ];
        }
        //Trả về view cùng với dữ liệu là $viewData
        return view('admin.ajax.booking_loaiphong', $viewData);
    }

}
