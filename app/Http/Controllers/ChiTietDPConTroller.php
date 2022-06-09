<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietDP;
use App\DatPhong;
use App\KhachHang;
use App\Phong;
use App\LoaiPhong;
use App\HoaDon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChiTietDPConTroller extends Controller
{
    //Lấy danh sách đặt phòng
    public function getDanhSach() {
        // $chitietdp = ChiTietDP::orderBy('id','DESC')->get();
        $datphong = DatPhong::orderBy('id','DESC')->get();
 
        $viewData = [
            'datphong' => $datphong,
            // 'chitietdp' => $chitietdp,
        ];


        return view('admin.chitietdp.chitietdp_list', $viewData);
    }

    //Hiển thị ra view sửa chi tiết đặt phòng
    public function getSua($id) {
        $chitietdp = ChiTietDP::find($id);
        $loaiphong = LoaiPhong::all();
        $phong = Phong::all();

        return view('admin.chitietdp.sua_ctdp' ,['chitietdp'=>$chitietdp,'loaiphong'=>$loaiphong, 'phong'=>$phong]);
    }

    //Thực hiện sửa
    public function postSua(Request $request, $id) {
        $chitietdp = new ChiTietDP();
        $chitietdp = ChiTietDP::find($id);
        $kh = KhachHang::find($chitietdp->datphong->user->kh->id);
        
        $datphong = DatPhong::find($chitietdp->datphong->id);
        $user = User::find($datphong->user->id);

        $data = $request->except('_token');

        $messages = [
    		'Ten_kh.required' => 'Hãy nhập tên',
            'SDT.required' => 'Hãy nhập Số điện thoại',
            'Start_date.required' => 'Hãy nhập Ngày Checkin',
            'End_date.required' => 'Hãy nhập Ngày Checkout',
            'LoaiPhong.required' => 'Hãy nhập Loại phòng',
            'Phong.required' => 'Hãy nhập Phòng',
            'Sophong.required' => 'Hãy nhập Số phòng'
        ];
        
        $validator = Validator::make($data,[
            'Ten_kh' => 'required',
            'SDT' => 'required',
            'Start_date' => 'required',
            'End_date' => 'required',
            'LoaiPhong' => 'required',
            'Phong' => 'required',
            'Sophong' => 'required'
        ], $messages);

        if($validator->fails()) {
    		$errors = $validator->errors();
    		return redirect()->back()->with('errors', $errors);
    	} else {

        $user->name             = $request->Ten_kh;
        $kh->sdt                = $request->SDT;
        $datphong->start_date   = $request->Start_date;
        $datphong->end_date     = $request->End_date;
        $chitietdp->phong_id    = $request->Phong;
        $chitietdp->sophong     = $request->Sophong;
        $chitietdp->chuthich    = $request->Chuthich;

        $chitietdp->save();
        $kh->save();
        $datphong->save();
        $user->save();

        return redirect()->back()->with('thongbao', 'SỬA THÀNH CÔNG');
        }
        
    }

    //Xoá đặt phòng
    public function getXoa($id) {
        $datphong = DatPhong::find($id);
        $ctdp = ChiTietDP::where('datphong_id', '=', $id)->get();
        $hoadon = HoaDon::where('datphong_id', '=', $id)->get();
        foreach ($hoadon as $value) {
            $value->delete();
        }
        
        foreach ($ctdp as $value) {
            $phong = Phong::find($value->phong_id);
            $phong->soluong += $value->sophong;
            $phong->booked -= $value->sophong;
            $phong->save();
            $value->delete();
        }
        $datphong->delete();
        return redirect(route('admin.chitietdp.danhsach'))->with('thongbao', 'XOÁ THÀNH CÔNG!');
    }

    //Xem chi tiết đặt phòng
    public function getView($id) {
        $dp = DatPhong::find($id);
        $ctdp = ChiTietDP::where('datphong_id', '=', $id)->get();
        foreach($ctdp as $key => $value) {
            $p = $value->phong;
            $lp = $value->phong->loaiphong;
        }

        $user = User::find($dp->user);

        $kh = KhachHang::find($user[0]->kh->id);
        $time= $dp->created_at->format('d/m/Y H:m:s');
        return response()->json(['data'=>$dp, 'ctdp'=>$ctdp, 'user'=>$user[0], 'kh'=>$kh,'time'=>$time],200);
    }

    public function getXacNhan($id) {
        $dp = DatPhong::find($id);
        $dp->trang_thai = 1;
        $dp->save();
        return redirect(route('admin.chitietdp.danhsach'))->with('thongbao', 'Xác nhận đã thanh toàn thành công!');
    }

    public function getHuyXacNhan($id) {
        $dp = DatPhong::find($id);
        $dp->trang_thai = 0;
        $dp->save();
        return redirect(route('admin.chitietdp.danhsach'))->with('thongbao', 'Huỷ x ác nhận đã thanh toàn thành công!');
    }
}
