<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('pages.index');
// });

Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', 'HomeController@changeLanguage')
        ->name('user.change-language');
});

Route::get('admin/dangnhap', 'UserController@getLoginAdmin')->name('admin.dangnhap');
Route::post('admin/dangnhap', 'UserController@postLoginAdmin')->name('admin.login');
Route::get('admin/logout', 'UserController@getLogoutAdmin')->name('admin.logout');


Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

//    Route::get('/', function () {
//        return view('admin.layouts.index');
//    })->name('admin.index');
    Route::get('/',"\App\Http\Controllers\HomeController@index")->name('admin.index');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('{id}', 'ProfileConTroller@getProfile')->name('admin.profile');

        Route::post('sua/{id}', 'ProfileConTroller@postSua')->name('admin.profile.postSua');
        Route::post('password/{id}', 'ProfileConTroller@postPassword')->name('admin.profile.postPassword');
    });

    Route::group(['prefix' => 'chitietdp'], function () {
        Route::get('danhsach', 'ChiTietDPConTroller@getDanhSach')->name('admin.chitietdp.danhsach');

        Route::get('sua/{id}', 'ChiTietDPConTroller@getSua')->name('admin.chitietdp.getSua');
        Route::post('sua/{id}', 'ChiTietDPConTroller@postSua')->name('admin.chitietdp.postSua');

        Route::get('xoa/{id}', 'ChiTietDPConTroller@getXoa')->name('admin.chitietdp.xoa');
        Route::get('xac-nhan-thanh-toan/{id}', 'ChiTietDPConTroller@getXacNhan')->name('admin.chitietdp.xacnhan');
        Route::get('huy-xac-nhan-thanh-toan/{id}', 'ChiTietDPConTroller@getHuyXacNhan')->name('admin.chitietdp.huyxacnhan');

        Route::get('xem/{id}', 'ChiTietDPConTroller@getView')->name('admin.chitietdp.getView');
    });

    Route::group(['prefix' => 'loaiphong', 'middleware' => 'adminUser2'], function () {
        Route::get('danhsach', 'LoaiPhongController@getDanhSach')->name('admin.loaiphong.danhsach');;

        Route::get('update', 'LoaiPhongController@getThem')->name('admin.loaiphong.getThem');
        Route::post('update', 'LoaiPhongController@postThem')->name('admin.loaiphong.postThem');

        Route::get('sua/{id}', 'LoaiPhongController@getSua')->name('admin.loaiphong.getSua');
        Route::post('sua/{id}', 'LoaiPhongController@postSua')->name('admin.loaiphong.postSua');

        Route::get('xoa/{id}', 'LoaiPhongController@getXoa')->name('admin.loaiphong.getXoa');
    });

    Route::group(['prefix' => 'phong', 'middleware' => 'adminUser2'], function () {
        Route::get('danhsach', 'PhongController@getDanhSach')->name('admin.phong.danhsach');;

        Route::get('update', 'PhongController@getThem')->name('admin.phong.getThem');
        Route::post('update', 'PhongController@postThem')->name('admin.phong.postThem');

        Route::get('sua/{id}', 'PhongController@getSua')->name('admin.phong.getSua');
        Route::post('sua/{id}', 'PhongController@postSua')->name('admin.phong.postSua');

        Route::get('xoa/{id}', 'PhongController@getXoa')->name('admin.phong.getXoa');
    });

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaiphong/{id}', 'AjaxController@getLoaiPhong')->name('admin.ajax.getphong');
    });

    Route::group(['prefix' => 'slide', 'middleware' => 'adminUser1'], function () {
        Route::get('danhsach', 'SlideMController@getDanhSach')->name('admin.slide.danhsach');;

        Route::get('update', 'SlideMController@getThem')->name('admin.slide.getThem');
        Route::post('update', 'SlideMController@postThem')->name('admin.slide.postThem');

        Route::get('sua/{id}', 'SlideMController@getSua')->name('admin.slide.getSua');
        Route::post('sua/{id}', 'SlideMController@postSua')->name('admin.slide.postSua');

        Route::get('xoa/{id}', 'SlideMController@getXoa')->name('admin.slide.getXoa');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'adminUser1'], function () {
        Route::get('danhsach', 'UserController@getDanhSach')->name('admin.user.danhsach');;

        Route::get('update', 'UserController@getThem')->name('admin.user.getThem');
        Route::post('update', 'UserController@postThem')->name('admin.user.postThem');

        Route::get('sua/{id}', 'UserController@getSua')->name('admin.user.getSua');
        Route::post('sua/{id}', 'UserController@postSua')->name('admin.user.postSua');

        Route::get('xoa/{id}', 'UserController@getXoa')->name('admin.user.getXoa');

        Route::post('resetpassword/{id}', 'UserController@postResetPassword')->name('admin.user.postResetPassword');
    });

    Route::group(['prefix' => 'hoa-don'], function () {
        Route::get('danhsach', 'HoaDonController@getDanhSach')->name('admin.hoadon.getDanhSach');

        Route::get('them', 'HoaDonController@getThem')->name('admin.hoadon.getThem');
        Route::post('them', 'HoaDonController@postThem')->name('admin.hoadon.postThem');

        Route::get('sua/{id}', 'HoaDonController@getSua')->name('admin.hoadon.getSua');
        Route::post('sua/{id}', 'HoaDonController@postSua')->name('admin.hoadon.postSua');

        Route::get('xuat-hoa-don/{id}', 'HoaDonController@getXuatHoaDon')->name('admin.hoadon.getXuatHoaDon');
        Route::get('xoa/{id}', 'HoaDonController@getXoa')->name('admin.hoadon.getXoa');

        Route::get('xac-nhan/{id}', 'HoaDonController@getXacNhan')->name('admin.hoadon.getXacNhan');

        Route::get('xem/{id}', 'HoaDonController@getView')->name('admin.hoadon.getView');
        Route::get('lay-so-phong', 'HoaDonController@getSoPhong')->name('admin.hoadon.getSophong');
        Route::get('them-so-phong/{id}/chitietdp={ctdp}', 'HoaDonController@getThemSoPhong')->name('admin.hoadon.getThemSoPhong');
    });

    Route::group(['prefix' => 'lich-su'], function () {
        Route::get('danhsach', 'LichSuController@getDanhSach')->name('admin.thuephong.getDanhSach');
        Route::get('lichsuthuephong', 'LichSuController@getLichSu')->name('admin.thuephong.getLichSu');

    });

    Route::group(['prefix' => 'so-phong'], function () {
        Route::get('xem/{id}', 'SoPhongController@getView')->name('admin.sophong.getView');
        Route::get('them/{id}', 'SoPhongController@getThem')->name('admin.sophong.getThem');
        Route::post('them/{id}', 'SoPhongController@postThem')->name('admin.sophong.postThem');

        Route::get('xoa/{id}', 'SoPhongController@getXoa')->name('admin.sophong.getXoa');
    });
});


//Route hiển thị ngoài website
Route::get('/', 'IndexController@getIndex')->name('website');
Route::get('booking', 'IndexController@getBooking')->name('booking');
Route::group(['prefix' => 'my-booking'], function () {
    Route::get('/', 'IndexController@getMyBooking')->name('mybooking');

    Route::get('booking-to-cart', 'CartController@addIndextoCart')->name('cart.addIndextoCart');
});

Route::get('gioithieu', function () {
    return view('pages.gioithieu');
})->name('gioithieu');

Route::get('lienhe', function () {
    return view('pages.lienhe');
})->name('lienhe');

Route::get('tim-kiem', 'IndexController@getTimKiem')->name('search');


//Route thanh toán
Route::group(['prefix' => '/', 'middleware' => 'loginpayment'], function () {
    Route::get('/profile', 'KhachHangController@getThongTin')->name('khachhang.getThongTin');
    Route::post('/profile', 'KhachHangController@postThongTin')->name('khachhang.postThongTin');

    Route::post('/profile-doi-mat-khau', 'KhachHangController@postDoiMatKhau')->name('khachhang.postDoiMatKhau');

    Route::group(['prefix' => 'payment', 'middleware' => 'payment'], function () {
        Route::get('/', 'PaymentController@getPayment')->name('payment');
        Route::post('dat-phong', 'PaymentController@postPayment')->name('payment.postPayment');
    });
});

Route::get('thong-bao', 'PaymentController@getThongBao')->name('getThongBao');

//Route về giỏ hàng
Route::get('cart/add-cart/{id}', 'CartController@addCart')->name('cart.addCart');
Route::get('cart/delete-cart/{id}', 'CartController@deleteCart')->name('cart.deleteCart');

Route::get('cart', 'CartController@getCart')->name('cart');

Route::get('cart/update-cart/{id}/{quanty}', 'CartController@updateCart')->name('cart.updateCart');
Route::get('cart/update-cart-date/{date}/{std}/{end}', 'CartController@updateCartDate')->name('cart.updateCartDate');


Route::group(['prefix' => 'ajax'], function () {
    Route::get('loaiphong/{id}', 'AjaxController@getLoaiPhong')->name('ajax.getLoaiPhong');
    Route::get('booking/loaiphong/{id}', 'AjaxController@getBookingLoaiPhong')->name('ajax.getBookingLoaiPhong');
});

//Route khâch hàng
Route::group(['prefix' => '/'], function () {
    Route::get('/dang-nhap', 'KhachHangController@getDangNhap')->name('khachhang.getDangNhap');
    Route::post('/dang-nhap', 'KhachHangController@postDangNhap')->name('khachhang.postDangNhap');

    Route::get('/dang-xuat', 'KhachHangController@getDangXuat')->name('khachhang.getDangXuat');

    Route::get('/dang-ky', 'KhachHangController@getDangKy')->name('khachhang.getDangKy');
    Route::post('/dang-ky', 'KhachHangController@postDangKy')->name('khachhang.postDangKy');


});



