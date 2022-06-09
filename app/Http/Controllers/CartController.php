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

class CartConTroller extends Controller
{
    public function getCart() {
        return view('pages.cart');
    }

    public function addCart(Request $request, $id) {
        $phong = Phong::find($id);
        if ($phong != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($phong, $id, 1);

            $request->session()->put('Cart', $newCart);
        }
        view('pages.cart', compact('newCart'));
        return redirect()->route('mybooking');
    }

    public function addCart2(Request $request, $id) {
        $phong = Phong::find($id);
        if ($phong != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($phong, $id);

            $request->session()->put('Cart', $newCart);
        }
        return redirect()->route('cart');
    }

    public function deleteCart(Request $request, $id) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);

        if(Count($newCart->phong) > 0) {
            $request->Session()->put('Cart', $newCart);
        } else {
            $request->Session()->forget('Cart');
        }
        return redirect()->route('cart');
    }

    public function updateCart(Request $request, $id, $quanty) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id, $quanty);

        $request->Session()->put('Cart', $newCart);
       
        return redirect()->route('cart');
    }

    public function updateCartDate(Request $request, $date, $std, $end) {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateDate($date);
        $request->Session()->put('Cart', $newCart);

        $request->session()->put('std', $std);
        $request->session()->put('end', $end);

        return redirect()->route('cart');
    }

    public function addIndextoCart(Request $request) {
        $phong = Phong::find($request->phong);
        if ($phong != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);

            $d = new \DateTime($request->startdate);
            $timestamp = $d->getTimestamp(); // Unix timestamp

            $d2 = new \DateTime($request->enddate);
            $timestamp2 = $d2->getTimestamp(); // Unix timestamp

            $date = ($timestamp2 - $timestamp)/86400;
            if ($date <= 0) {
                $date = 1;
            }
            $newCart->addCart($phong, $request->phong, $date);

            $request->session()->put('Cart', $newCart);
        }
        $request->session()->put('std', $request->startdate);
        $request->session()->put('end', $request->enddate);

        return redirect()->route('mybooking');
    }





}
