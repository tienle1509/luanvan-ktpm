<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;

class XoaTaiKhoanController extends Controller
{
/*------------------------Xóa tài khoản người bán hàng--------------------------*/
	public function getXoaNguoiBan(){
		if(Request::ajax()){
			$manb = Request::get('manb');

			DB::table('nguoi_ban')->where('manb',$manb)->delete();

			return Response::json(['success'=>true]);
		}
	}

/*------------------------Xóa tài khoản khách hàng--------------------------*/
	public function getXoaKhachHang(){
		if(Request::ajax()){
			$makh = Request::get('makh');
			DB::table('khach_hang')->where('makh',$makh)->delete();

			DB::table('nhanxet_danhgia')->where('makh',$makh)->delete();

			return Response::json(['success'=>true]);
		}
	}
}
