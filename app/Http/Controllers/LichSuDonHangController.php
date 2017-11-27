<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LichSuDonHangController extends Controller
{
/*--------------------Quản lí đơn hàng----------------------------*/
	public function getQuanLiDonHang(){
		return view('khachhang.lichsu_donhang');
	}

/*-------------------------Chi tiết đơn hàng--------------------------*/
	public function getChiTietDonHang($madh){
		return view('khachhang.chitiet_donhang')->with('madh', $madh);
	}
}
