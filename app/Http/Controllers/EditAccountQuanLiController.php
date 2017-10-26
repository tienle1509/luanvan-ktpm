<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use Validator;
use DB;
use Hash;

class EditAccountQuanLiController extends Controller
{
/*------------------Cài đặt tài khoản quản lí-------------------------*/
	public function postSuaTaiKhoan(){
		if(Request::ajax()){
			$maql = Request::get('maql');
			$matkhau1 = Request::get('matkhau1');
			$matkhau2 = Request::get('matkhau2');

			$v = Validator::make(Request::all(), 
				[
					'matkhau1'=>'required|min:8',
					'matkhau2'=>'required|same:matkhau1'
				],
				[
					'matkhau1.required'=>'Mật khẩu không được rỗng',
					'matkhau1.min'=>'Mật khẩu phải có ít nhất 8 kí tự',
					'matkhau2.required'=>'Xác nhận mật khẩu không được rỗng',
					'matkhau2.same'=>'Không khớp mật khẩu'
				]);
			if($v->fails()){
				return Response::json([
					'success'=>false,
					'errors'=>$v->errors()->toArray()
				]);
			} else {
				DB::table('nguoi_quanli')->where('maql',$maql)->update(['matkhau'=>Hash::make($matkhau1)]);
				return Response::json(['success'=>true]);
			}
		}
	}

}
