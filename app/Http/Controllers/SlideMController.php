<?php

namespace App\Http\Controllers;

use App\KhachHang;
use App\User;
use Illuminate\Http\Request;
use App\Phong;
use App\LoaiPhong;
use App\SlideM;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SlideMController extends Controller
{
    //
    public function getDanhSach() {
        $danhsach = SlideM::all();

        $viewData = [
            'slide' => $danhsach

        ];
        return view('admin.slide.slide_list', $viewData);
    }

    public function getThem() {
        return view('admin.slide.slide_add');
    }

    public function postThem(Request $request) {
        $slide = new SlideM;
        $slide->tieude = $request->tieude;
        $slide->noidung = $request->noidung;

        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect()->back()->with('loi', 'File ảnh tải lên không đúng định dạng!');
            }
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5)."_".Str::random(5)."_".$name;
            while(file_exists("upload/slide/".$hinh)){
                $hinh = Str::random(5)."_".Str::random(5)."_".$name;
            }
            $file->move("upload/slide",$hinh);
            $slide->hinh = $hinh;
        } else {
            $slide->hinh = "";
        }

        $slide->save();

        return redirect(route('admin.slide.danhsach'))->with('thongbao', 'Đã thêm thành công: '.$request->ten);
    }

    public function getSua($id) {
        $slide = SlideM::find($id);
        return view('admin.slide.sua_slide', ['slide' => $slide]);

    }

    public function postSua(Request $request, $id) {
        $slide = SlideM::find($id);

        $data = $request->except('_token');

        $slide->tieude = $request->tieude;
        $slide->noidung = $request->noidung;


        if($request->hasFile('hinh')){
            if(File::exists(public_path('upload/slide/'.$slide->hinh))){
                File::delete(public_path('upload/slide/'.$slide->hinh));
            }
            $file = $request->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect()->back()->with('loi', 'File ảnh tải lên không đúng định dạng!');
            }
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5)."_".Str::random(5)."_".$name;
            while(file_exists("upload/slide/".$hinh)){
                $hinh = Str::random(5)."_".Str::random(5)."_".$name;
            }
            $file->move("upload/slide",$hinh);
            $slide->hinh = $hinh;
        }

        $slide->save();

        return redirect(route('admin.slide.danhsach'))->with('thongbao', 'SỬA THÀNH CÔNG!');
        }


    public function getXoa($id) {
        $slide = SlideM::find($id);
        if(File::exists(public_path('upload/slide/'.$slide->hinh))){
            File::delete(public_path('upload/slide/'.$slide->hinh));
        }
        $slide->delete();
        return redirect(route('admin.slide.danhsach'))->with('thongbao', 'XOÁ THÀNH CÔNG: '.$slide->ten);

    }
}
