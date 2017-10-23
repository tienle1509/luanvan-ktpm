<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Response;
use Hash;
use DB;

class EditProfileNguoiBanController extends Controller
{
    public function postSuaThongTin(Request $request){
    	if(Request::ajax()){
    		$manb = Request::get('manb');
    		$tennb = Request::get('tennb');
    		$sdt = Request::get('sdt');
    		$diachi = Request::get('diachi');

    		$v = Validator::make(Request::all(), 
                [
    				'tennb'=>'required',
    				'sdt'=>'required|between:10,11',
    				'diachi'=>'required'
    			],
    			[
    				'tennb.required'=>'Tên người bán không được rỗng',
    				'sdt.required'=>'Số điện thoại không được rỗng',
    				'sdt.between'=>'Số điện thoại không đúng định dạng',
    				'diachi.required'=>'Địa chỉ không được rỗng'
    			]);

    		if($v->fails()){
    			return Response::json([
    				'success'=>false,
    				'errors'=>$v->errors()->toArray()
    			]); 
    		} 
            else {
    			DB::table('nguoi_ban')->where('manb', $manb)->update(['tennb'=>$tennb, 'sodienthoai'=>$sdt, 'diachi'=>$diachi]);

    			return Response::json(['success'=>true]);
    		}    
    	}
    }


    public function postSuaTaiKhoan(Request $request){
        if(Request::ajax()){
            $manb = Request::get('manb');
           // $email = Request::get('email');
            $matkhau1 = Request::get('matkhau1');
            $matkhau2 = Request::get('matkhau2');

            $v = Validator::make(Request::all(), 
                [
                    //'email'=>'required|email',
                    'matkhau1'=>'required|min:8',
                    'matkhau2'=>'required|same:matkhau1'
                ],
                [
                   // 'email.required'=>'Email không được rỗng',
                   // 'email.email'=>'Email không đúng định dạng',
                    'matkhau1.required'=>'Mật khẩu không được rỗng',
                    'matkhau1.min'=>'Mật khẩu ít nhất 8 kí tự',
                    'matkhau2.required'=>'Xác nhận mật khẩu không được rỗng',
                    'matkhau2.same'=>'Không khớp mật khẩu'
                ]);

            if($v->fails()){
                return Response::json([
                    'success'=>false,
                    'errors'=>$v->errors()->toArray()
                ]);
            } 
            else {
                //Kiểm tra mật khẩu tồn tại chưa
               // $check_mail = DB::table('nguoi_ban')->where('email',$email)->first();

              /*  if(!empty($check_mail)){
                    $errors['email'] = 'Email này đã tồn tại';
                    return Response::json([
                        'success'=>false,
                        'errors'=>$errors
                    ]);
                }
                else { */ //Update dữ liệu vào bảng người bán
                    DB::table('nguoi_ban')->where('manb',$manb)->update(['matkhau'=>Hash::make($matkhau1)]);

                    return Response::json(['success'=>true]);
                //}
            }
        }
    }


}
