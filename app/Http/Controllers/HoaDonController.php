<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\HoaDon;
use App\DatPhong;
use App\ChiTietDP;
use App\KhachHang;
use App\SoPhong;
use App\Phong;
use App\ConvertWord;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HoaDonController extends Controller
{
    //
    public function getDanhSach() {
        $hoadon = HoaDon::all();
        $viewData = [
            'hoadon' => $hoadon,
        ];
        return view('admin.hoadon.danhsach', $viewData);
    }

    public function getThem(Request $request) {
        $datphong = DatPhong::where('trang_thai', '=', null)->get();
        $sophong = SoPhong::where('trang_thai', '=', 0)->get();
        $viewData = [
            'datphong' => $datphong,
            'sophong' => $sophong,
        ];

        return view('admin.hoadon.them', $viewData);
    }

    public function postThem(Request $request) {
        $data = $request->except('_token');

        $messages = [
            // "madp.unique" => "Mã đặt phòng đã có hoá đơn!",
            "name.required" => "Hãy nhập tên",
            "name.max" => "Tên quá dài",
            "name.min" => "Tên quá ngắn",
            "sdt.required" => "Hãy nhập số điện thoại",
            "tienphong.required" => "Hãy nhập tiền phòng",
            "dia_chi.required" => "Hãy nhập địa chỉ",
        ];

        $validator = Validator::make($data,[
            'name' => 'required|min:5|max:50',
            // 'madp' => 'unique:hoadon,datphong_id',
            'sdt' => 'required',
            'dia_chi' => 'required',
            'tienphong' => 'required',
        ], $messages);

        if($validator->fails()) {
    		$errors = $validator->errors();
    		return redirect()->back()->with('errors', $errors);
    	} else {
            $hoadon = new HoaDon;
            $hoadon->user_id = Auth::user()->id;
            $hoadon->datphong_id = $request->madp;
            $hoadon->name = $request->name;
            $hoadon->sdt = $request->sdt;
            $hoadon->dia_chi = $request->dia_chi;
            $hoadon->tienphong = $request->tienphong;

            $chitietdp = ChiTietDP::where('datphong_id', '=',  $request->madp)->get();

            foreach ($chitietdp as $ct) {
                $sophong = SoPhong::where('chitietdp_id', '=', $ct->id)->get();
                $text = [];
                $i = 0;

                foreach ($sophong as $sp) {
                    $sp->trang_thai = 1;
                    $text[$i] = $sp->so_phong;
                    $sp->save();
                    $i++;
                }
                $ct->so_phong = implode(', ',$text);
                $ct->save();
            }

            $hoadon->save();

            return redirect()->route('admin.hoadon.getDanhSach')->with('thongbao', 'Thêm hoá đơn thành công!');
        }
    }

    public function getSua($id) {
        $hoadon = HoaDon::find($id);
        $viewData = [
            'hoadon' => $hoadon,
        ];
        return view('admin.hoadon.sua', $viewData);
    }

    public function postSua(Request $request, $id) {
        $hoadon = HoaDon::find($id);
        $data = $request->except('_token');

        $messages = [
            "name.required" => "Hãy nhập tên",
            "name.max" => "Tên quá dài",
            "name.min" => "Tên quá ngắn",
            "sdt.required" => "Hãy nhập số điện thoại",
            "tienphong.required" => "Hãy nhập tiền phòng",
            "dia_chi.required" => "Hãy nhập địa chỉ",
            "madp.unique" => "Mã đặt phòng đã có hoá đơn!",
        ];

        $validator = Validator::make($data,[
            'name' => 'required|min:5|max:50',
            'madp' => 'unique:hoadon,datphong_id,'.$hoadon->id,
            'sdt' => 'required',
            'dia_chi' => 'required',
            'tienphong' => 'required',
        ], $messages);

        if($validator->fails()) {
    		$errors = $validator->errors();
    		return redirect()->back()->with('errors', $errors);
    	} else {


            $hoadon->user_id = Auth::user()->id;
            $hoadon->datphong_id = $request->madp;
            $hoadon->name = $request->name;
            $hoadon->sdt = $request->sdt;
            $hoadon->dia_chi = $request->dia_chi;

            $hoadon->tienphong = $request->tienphong;

            $hoadon->save();

            return redirect()->route('admin.hoadon.getDanhSach')->with('thongbao', 'Sửa hoá đơn thành công!');
        }
    }

    public function getXacNhan($id) {
        $hoadon = HoaDon::find($id);
        $datphong = DatPhong::find($hoadon->datphong_id);
        $hoadon->trang_thai = 1;
        $hoadon->ngaythanhtoan = date('m-d-Y');
        $datphong->trang_thai = 1;


            $chitietdp = ChiTietDP::where('datphong_id', '=', $datphong->id)->get();
            foreach ($chitietdp as $ctdp) {
                $sophong = SoPhong::where('chitietdp_id', '=', $ctdp->id)->get();
                foreach ($sophong as $item) {
                        $item->trang_thai = 0;
                        $phong = Phong::find($item->phong_id);
                        $phong->soluong += 1;
                        $phong->booked -= 1;
                        $item->save();
                        $phong->save();
                }
            }


        $hoadon->save();
        $datphong->save();
        return redirect()->route('admin.hoadon.getDanhSach')->with('thongbao', 'Xác nhận thành công!');
    }

    public function getXuatHoaDon($id) {
        $hoadon = HoaDon::find($id);
        $datphong = DatPhong::find($hoadon->datphong_id);
        $chitietdp = ChiTietDP::where('datphong_id', '=', $hoadon->datphong_id)->get();

        $sophong = SoPhong::all();

        $viewData = [
            'hoadon' => $hoadon,
            'sophong' => $sophong,
            'datphong' => $datphong,
            'chitietdp' => $chitietdp,
        ];
        // return view('admin.hoadon.viewHoaDon', $viewData);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('admin.hoadon.viewHoaDon', $viewData), 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->set_option('defaultMediaType', 'all');
        $dompdf->set_option('isFontSubsettingEnabled', true);
        $dompdf->render();
        return $dompdf->stream('Hoa-don-'.$hoadon->id.'.pdf');
    }

    public function getXoa($id) {
        $hoadon = HoaDon::find($id);
        $datphong = DatPhong::find($hoadon->datphong_id);
        $datphong->trang_thai = 0;
        $datphong->save();
        $hoadon->delete();
        return redirect()->route('admin.hoadon.getDanhSach')->with('thongbao', 'Xoá thành công!');
    }

    public function getView($id) {
        $dp = DatPhong::find($id);

        $ctdp = ChiTietDP::where('datphong_id', '=', $id)->get();
        foreach($ctdp as $key => $value) {
            $p = $value->phong;
            $lp = $value->phong->loaiphong;
            // $sophong = $value->phong->sophong;
            $sophong = SoPhong::where('chitietdp_id', '=', $value->id)->get();
        }



        $user = User::find($dp->user);

        $kh = KhachHang::find($user[0]->kh->id);
        $time= $dp->created_at->format('d/m/Y H:m:s');
        return response()->json(['data'=>$dp, 'ctdp'=>$ctdp, 'user'=>$user[0], 'kh'=>$kh, 'sophong' => $sophong, 'time'=>$time],200);
    }

    public function getSoPhong() {
        $sophong = SoPhong::where('trang_thai', '=', 0)->get();
        return $sophong;
    }

    public function getThemSoPhong($id, $ctdp) {
        $sophong = SoPhong::find($id);
        $sophong->chitietdp_id = $ctdp;
        $sophong->save();
        return $sophong;
    }
}
