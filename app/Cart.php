<?php
namespace App;
class Cart {
    public $phong = null;
    public $tongGia = 0;
    public $tongSoluong = 0;
    public $songay = 0;

    public function __construct($cart) {
        if ($cart) {
            $this->phong = $cart->phong;
            $this->tongGia = $cart->tongGia;
            $this->tongSoluong = $cart->tongSoluong;
            $this->songay = $cart->songay;
        }
    }

    public function addCart($p, $id, $date) {
        $phongInfo = ['id' => $p->id, 'tenloaiphong' => $p->loaiphong->tenloaiphong, 'tenphong' => $p->tenphong, 'gia'=>$p->gia];
        $newPhong = ['soluong' => 0, 'gia' => $p->gia, 'phongInfo' => $p];
        if ($this->phong) {
            if (array_key_exists($id, $this->phong)) {
                $newPhong = $this->phong[$id];
            }
        }
        $newPhong['soluong']++;
        $newPhong['gia'] = $newPhong['soluong'] * $p->gia;
        $this->phong[$id] = $newPhong;
        $this->songay = $date;
        $this->tongGia += ($p->gia * $this->songay);
        $this->tongSoluong++;
    }

    public function deleteItemCart($id) {
         $this->tongSoluong -= $this->phong[$id]['soluong'];
         $this->tongGia -= ($this->phong[$id]['gia']*$this->songay);
         unset($this->phong[$id]);
    }

    public function UpdateItemCart($id, $tong) {
        $this->tongSoluong -= $this->phong[$id]['soluong'];
        $this->tongGia -= ($this->phong[$id]['gia'] * $this->songay);

        $this->phong[$id]['soluong'] = $tong;
        $this->phong[$id]['gia'] = $tong * $this->phong[$id]['phongInfo']->gia;

        $this->tongSoluong += $this->phong[$id]['soluong'];
        $this->tongGia += ($this->phong[$id]['gia'] * $this->songay);
    }

    public function UpdateDate($date) {
        $this->tongGia = $this->tongGia/$this->songay;
        $this->songay = $date;
        $this->tongGia = $this->tongGia*$this->songay;
    }
}

?>