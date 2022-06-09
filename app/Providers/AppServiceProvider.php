<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\LoaiPhong;
use App\Phong;
use App\SlideM;
use App\SoPhong;
use App\DatPhong;
use App\ChiTietDP;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        view()->composer('pages.index', function($view) {
            $slide = SlideM::orderBy('id','DESC')->take(3)->get();
            $viewdata = [
                'slide' => $slide,
            ];

            $datphong = DatPhong::all();
            $now = \Carbon\Carbon::now();
            
            foreach ($datphong as $dp) {
                $chitietdp = ChiTietDP::where('datphong_id', '=', $dp->id)->get();
                foreach ($chitietdp as $ctdp) {
                    $sophong = SoPhong::where('chitietdp_id', '=', $ctdp->id)->get();
                    foreach ($sophong as $item) {
                        $d = \Carbon\Carbon::createFromFormat('d-m-Y', $dp->end_date);
                        if ($d < $now) {
                            $item->trang_thai = 0;
                            $phong = Phong::find($item->phong_id);
                            $phong->soluong += 1;
                            $item->save();
                            $phong->save();
                        }
                        
                    }
                }
            }

            $view->with($viewdata);
        });

        view()->composer('pages.booking', function($view) {
            $loaiphong = LoaiPhong::all();
            $phong = Phong::orderBy('id','DESC')->get();
            $viewdata = [
                'loaiphong' => $loaiphong,
                'phong' => $phong,
            ];
            $view->with($viewdata);
        });

        view()->composer('pages.mybooking', function($view) {
            $loaiphong = LoaiPhong::all();
            $viewdata2 = [
                'loaiphong' => $loaiphong,
            ];
            $view->with($viewdata2);
        });


    
    }
}
