<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phong;
use App\SoPhong;
use Illuminate\Support\Facades\Validator;

class SoPhongController extends Controller
{
    //
    public function getThem($id) {
        $phong = Phong::find($id);
        $sophong = SoPhong::where('phong_id', '=', $id)->get()->count();
        $viewData = [
            'phong' => $phong,
            'sophong' => $sophong,
        ];
        if ($phong->soluong - SoPhong::where('phong_id', '=', $id)->get()->count() <= 0) {
            return redirect()->back()->with('loi', 'Đã đủ số phòng!');
        } else {
            return view('admin.sophong.them', $viewData);
        }
    }

    public function postThem(Request $request, $id) {
        $phong = Phong::find($id);
        
        $token = $request->except('_token');
            $sophong = SoPhong::where('phong_id', '=', $id)->get()->count();
            $count = $phong->soluong - $sophong;
            $data = array_fill(0, $count, []);
            
            for ($i = 1; $i<=$count; $i++) {
                    $messages = [
                        'sophong_'.$i.'.required' => 'Hãy nhập tên loại phòng!',
                        'sophong_'.$i.'.unique' => 'Số phòng này đã tồn tại!',
        
                    ];
                    $validator = Validator::make($token, [
                        'sophong_'.$i => 'required|unique:sophong,so_phong',
                    ], $messages);

                    if ($validator->fails()) {
                        $errors = $validator->errors();
                        return redirect()->back()->with('errors', $errors);
                    } else {
                        $data[$i-1] = [
                            'so_phong' => $request['sophong_'.$i],
                            'phong_id' => $id,
                        ];
                    }
            }
            SoPhong::insert($data);

            return redirect(route('admin.phong.danhsach'))->with('thongbao', 'Bạn đã thêm thành công '.$count.' Số Phòng vào '.$phong->tenphong);
        
    }

    public function getView($id) {
        $sophong = SoPhong::where('phong_id', '=', $id)->get();
        return $sophong;
    }

    public function getXoa($id) {
        $sophong = SoPhong::find($id);
        $sophong->delete();
        return redirect()->back()->with('thongbao', 'Xoá thanh công số phòng!');
    }
}
