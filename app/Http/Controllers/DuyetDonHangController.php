<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use DB;
use Response;

class DuyetDonHangController extends Controller
{
/*----------------------------Duyệt đơn hàng----------------------------*/
	public function getDuyetDonHang(){
		if(Request::ajax()){
			$madh = Request::get('madh');
			$maql = Request::get('maql');

			DB::table('don_hang')->where('madh',$madh)->update(['trangthai'=>1, 'mattdh'=>1, 'maql'=>$maql]);
    		return Response::json(['success'=>true]);
		}
	}
}
