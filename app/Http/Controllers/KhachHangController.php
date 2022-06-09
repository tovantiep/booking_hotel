<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhachHang;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    //
    public function getDangNhap() {
        return view('pages.form.dangnhap');
    }

    public function postDangNhap(Request $request) {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ], [
            'email.required'=>'Bạn chưa nhập Email',
            'password.required'=>'Bạn chưa nhập Mật khẩu'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('website');
        } else {
            return redirect()->back()->with('thongbao', 'Đăng nhập thất bại!');
        }
    }

    public function getDangKy() {
        return view('pages.form.dangky');
    }

    public function postDangKy(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email',
            'ngaysinh' => 'required',
            'so_cmnd' => 'required',
            'diachi' => 'required',
            'sdt' => 'required',

        ], [
            "name.required" => "Hãy điền tên của bạn",
            "email.required" => "Hãy điền địa chỉ email của bạn",
            "password.required" => "Hãy nhập password",
            "so_cmnd.required" => "Hãy điền số CMND của bạn",
            "email.unique" => "Email đã tồn tại",
            "diachi.required" => "Hãy điền địa chỉ của bạn",
            "ngaysinh.required" => "Hãy điền ngày sinh của bạn",
            "sdt.required" => "Hãy điền số điện thoại của bạn",
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = 4;

        $user->save();

        $kh = new KhachHang;
        $kh->user_id = $user->id;
        $kh->so_cmnd = $request->so_cmnd;
        $kh->dia_chi = $request->diachi;
        $kh->gioi_tinh = $request->gioitinh;
        $kh->ngaysinh = $request->ngaysinh;
        $kh->sdt = $request->sdt;

        $kh->save();

        return redirect()->route('khachhang.getDangKy')->with('thongbao', 'Đã đăng ký thành công!');
    }

    public function getThongTin(Request $request) {
        $user = Auth::user();
        $kh = KhachHang::where('user_id', '=', $user->id)->get();

        $viewData = [
            'kh' => $kh,
        ];

        return view('pages.form.thongtinkh', $viewData);
    }

    public function postThongTin(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'ngaysinh' => 'required',
            'so_cmnd' => 'required',
            'diachi' => 'required',
            'sdt' => 'required',

        ], [
            "name.required" => "Hãy điền tên của bạn",
            "so_cmnd.required" => "Hãy điền số CMND của bạn",
            "diachi.required" => "Hãy điền địa chỉ của bạn",
            "ngaysinh.required" => "Hãy điền ngày sinh của bạn",
            "sdt.required" => "Hãy điền số điện thoại của bạn",
        ]);

        $user = Auth::user();
        $kh = KhachHang::where('user_id', '=', $user->id)->first();

        $user->name = $request->name;
        $user->save();


        $kh->sdt = $request->sdt;

        $kh->so_cmnd = $request->so_cmnd;
        $kh->dia_chi = $request->diachi;
        $kh->gioi_tinh = $request->gioitinh;
        $kh->ngaysinh = $request->ngaysinh;
        $kh->save();



        return redirect()->route('khachhang.getThongTin')->with('thongbao', 'Thay đổi thông tin thành công!');
    }

    public function getDangXuat() {
        Auth::logout();
        return redirect(route('website'));
    }

    public function postDoiMatKhau(Request $request) {
        $user = Auth::user();

        if(!(Hash::check($request->oldPassword, $user->password))) {
    		return redirect(route('khachhang.getThongTin', ['id' => Auth::user()->id]))->with('loi', 'SAI MẬT KHẨU CŨ!');

    	} else if(strcmp($request->oldPassword, $request->newPassword) == 0){
    		return redirect(route('khachhang.getThongTin', ['id' => Auth::user()->id]))->with('loi', 'LỖI!');

    	}
    	//change password
    	$user->password = bcrypt($request->newPassword);
    	$user->save();

        return redirect(route('khachhang.getThongTin', ['id' => Auth::user()->id]))->with('thongbao', 'Đổi mật khẩu thành công!');
    }
}
