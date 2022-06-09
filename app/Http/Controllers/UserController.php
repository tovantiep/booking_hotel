<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Lấy danh sách user
    public function getDanhSach() {
        $danhsach = User::all();

        $viewData = [
            'user' => $danhsach
        ];
        return view('admin.user.user_list', $viewData);
    }

    //Hiển thị ra view thêm user
    public function getThem() {
        $danhsach = Role::all();

        $viewData = [
            'role' => $danhsach

        ];
        return view('admin.user.user_add', $viewData);
    }

    //Thực hiện thêm user
    public function postThem(Request $request) {
        if($request->role_id == 4) {
            $this->validate($request, [
                'name' => 'required|min:5|max:50',
                'email' => 'required|unique:users,email',
                'password' => 'required',
            ], [
                "name.required" => "Hãy nhập tên",
                "name.max" => "Tên quá dài",
                "name.min" => "Tên quá ngắn",
                "email.required" => "Hãy nhập email",
                "email.unique" => "Email đã tồn tại",
                "password.required" => "Hãy nhập password",
            ]);
            $request->ma_nv = '';
        } else {
            $this->validate($request, [
                'name' => 'required|min:5|max:50',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'ma_nv' => 'required|unique:users,ma_nv'

            ], [
                "name.required" => "Hãy nhập tên",
                "name.max" => "Tên quá dài",
                "name.min" => "Tên quá ngắn",
                "email.required" => "Hãy nhập email",
                "email.unique" => "Email đã tồn tại",
                "password.required" => "Hãy nhập password",
                "ma_nv.required" => "Hãy nhập mã nhân viên",
                "ma_nv.unique" => "Trùng mã nhân viên"
            ]);
        }


        $user = new User;
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->ma_nv = $request->ma_nv;

        $user->save();

        return redirect(route('admin.user.danhsach'))->with('thongbao', 'Đã thêm thành công User');
    }

    //Hiển thị ra view sửa user
    public function getSua($id) {
        $user = User::find($id);
        $role = Role::all();

        return view('admin.user.sua_user', ['user' => $user, 'role'=>$role]);

    }

    //Thực hiện sửa user
    public function postSua(Request $request, $id) {
        $user = User::find($id);

        $data = $request->except('_token');

        if($request->role_id == 4 || $user->role_id == 1) {
            $this->validate($request, [
                'name' => 'required|min:5|max:50',
            ], [
                "name.required" => "Hãy nhập tên",
                "name.max" => "Tên quá dài",
                "name.min" => "Tên quá ngắn",
            ]);
            $request->ma_nv = '';
        } else {
            $this->validate($request, [
                'name' => 'required|min:5|max:50',
                'ma_nv' => 'required|unique:users,ma_nv,'.$user->id,

            ], [
                "name.required" => "Hãy nhập tên",
                "ma_nv.required" => "Hãy nhập mã nhân viên",
                "ma_nv.unique" => "Trùng mã nhân viên",
                "name.max" => "Tên quá dài",
                "name.min" => "Tên quá ngắn",
            ]);
        }

        if ($user->role_id == 1) {
            $request->role_id = 1;
        }

        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ma_nv = $request->ma_nv;

        $user->save();

        return redirect(route('admin.user.danhsach'))->with('thongbao', 'SỬA THÀNH CÔNG!');


    }

    //Xoá user
    public function getXoa($id) {
        $user = User::find($id);

        $user->delete();

        return redirect(route('admin.user.danhsach'))->with('thongbao', 'XOÁ THÀNH CÔNG: '.$user->name);

    }

    //Hiển thị ra view đăng nhập
    public function getLoginAdmin() {
        return view('layouts.dangnhap');

    }

    //Thực hiện đăng nhập
    public function postLoginAdmin(Request $request) {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ], [
            'email.required'=>'Bạn chưa nhập Usernane',
            'password.required'=>'Bạn chưa nhập Password'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('admin.index'));
        } else {
            return redirect()->back()->with('thongbao', 'Đăng nhập thất bại!');
        }
    }

    //Đăng xuất
    public function getLogoutAdmin() {
        Auth::logout();
        return redirect(route('admin.dangnhap'));
    }

    //reset password
    public function postResetPassword($id) {
        $user = User::find($id);
        $user->password = bcrypt("12345678");

        return back()->with('thongbao', 'Đặt lại mật khẩu về mặc định thành công!');

    }

}
