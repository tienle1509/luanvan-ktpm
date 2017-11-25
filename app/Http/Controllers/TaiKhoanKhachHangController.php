<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;
use Validator;

class TaiKhoanKhachHangController extends Controller
{
/*--------------------Đăng kí tài khoản-----------------------*/
	public function postDangKi(){
		if(Request::ajax()){
			$hoten = Request::get('hoten');
			$email = Request::get('email');
			$matkhau1 = Request::get('matkhau1');
			$matkhau2 = Request::get('matkhau2');

			$v = Validator::make(Request::all(),
				[
					'hoten'=>'required',
					'email'=>'required|email',
					'matkhau1'=>'required|min:8',
					'matkhau2'=>'required|same:matkhau1'
				],
				[
					'hoten.required'=>'Họ tên không được rỗng',
					'email.required'=>'Email không được rỗng',
					'email.email'=>'Email không đúng định dạng',
					'matkhau1.required'=>'Mật khẩu không được rỗng',
					'matkhau1.min'=>'Mật khẩu có ít nhất 8 kí tự',
					'matkhau2.required'=>'Xác nhận mật khẩu không được rỗng',
					'matkhau2.same'=>'Không khớp mật khẩu'
				]);
			if($v->fails()){
				return Response::json([
					'success'=>false,
					'errors'=>$v->errors()->toArray()
				]);
			}else{
				
			}
		}
	}
}
