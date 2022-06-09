<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietDP;
use App\DatPhong;
use App\KhachHang;
use App\Phong;
use App\LoaiPhong;
use App\Cart;
use App\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class PaymentController extends Controller
{
    public function getPayment(Request $request) {
        return view('pages.payment');
    }

    public function getThongBao() {
        return view('pages.thongbao');
    }

    public function postPayment(Request $request) {

        $data = $request->except('_token');

        $messages = [
            "name.required" => "Hãy nhập đầy đủ họ tên.",
            "sdt.required" => "Hãy nhập đầy đủ họ tên.",
            "diachi.required" => "Hãy nhập diachi.",
            "name.min" => "Hãy nhập đầy đủ họ tên.",
            "name.max" => "Hãy nhập đầy đủ họ tên.",
        ];

        $validator = Validator::make($data,[
            "name" => "required|min:5|max:50",
            "sdt" => "required",
            "diachi" => "required",
        ], $messages);

        if($validator->fails()) {
    		$errors = $validator->errors();
    		return redirect()->back()->with('errors', $errors);
    	} else {
            $user = Auth::user();
            $kh = KhachHang::find($user->kh->id);
            $user->name = $request->name;
            $kh->sdt = $request->sdt;
            $kh->dia_chi = $request->diachi;
            $user->save();
            $kh->save();

            $cart = Session::get('Cart');

            $datphong = new DatPhong;
            $datphong->user_id = Auth::user()->id;
            $datphong->ngaydat = \Carbon\Carbon::now()->format('d-m-Y H:i:s');
            $datphong->tongsophong = $cart->tongSoluong;
            $datphong->tongtien = $cart->tongGia;
            $datphong->start_date = Session::get('std');
            $datphong->end_date = Session::get('end');
            $datphong->songay = $cart->songay;
            $datphong->chuthich = $request->chuthich;
            $datphong->save();


            foreach ($cart->phong as $key => $value) {
                $chitietdp = new ChiTietDP;
                $chitietdp->datphong_id = $datphong->id;
                $chitietdp->phong_id = $key;
                $chitietdp->sophong = $value['soluong'];
                $chitietdp->gia = ($value['gia']/$value['soluong']);
                $chitietdp->save();

                $p = Phong::find($key);
                $p->soluong -= $value['soluong'];
                $p->booked += $value['soluong'];
                $p->save();

            }

            $data = [
                'hoten' => $request->name,
                'email' => Auth::user()->email,
                'sdt' => $request->sdt,
                'diachi' => $request->diachi,
                'checkin' => $datphong->start_date,
                'checkout' => $datphong->end_date,
                'sophong' => $datphong->tongsophong,
                'tongtien' => $datphong->tongtien,
                'cart' => $cart->phong,
            ];

            $request->session()->forget('Cart');
            $request->session()->forget('std');
            $request->session()->forget('end');

            \Mail::to(Auth::user()->email)->send(new \App\Mail\MailNotify($data));

            return redirect(route('getThongBao'))->with('thongbao', 'ĐƠN HÀNG CỦA BẠN ĐƯỢC ĐẶT THÀNH CÔNG, CHI TIẾT ĐƯỢC GỬI VỀ EMAIL CỦA BẠN: '.Auth::user()->email);
        }
    }

}
