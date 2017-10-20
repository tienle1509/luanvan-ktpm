<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Response;

class LoginNguoiBanController extends Controller
{
    public function getDangNhapNguoiBan() {
        return view('auth.dangnhap_ban');
    }


    public function postDangNhapNguoiBan(Request $request) {
    	if(Request::ajax()){
            //Lấy dữ liệu từ ajax
            $email = Request::get('email');
            $password = Request::get('password');


            $v = Validator::make(Request::all(), [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'password.required'=>'Vui lòng nhập mật khẩu'
            ]);

            if($v->fails()){
                return Response::json([
                    'success'=>false,
                    'errors'=>$v->errors()->toArray()
                ]);
            } else {
                $auth = array(
                        'email'=>$email,
                        'password'=>$password,
                        'quyen'=>2
                );

                if(Auth::attempt()){
                    return Response::json(['success'=>true]);
                }else{
                    return Response::json([
                        'success'=>false,
                        'errors'=>'Email hoặc mật khẩu không đúng'
                    ]);
                }
            }
        }
    }
}
