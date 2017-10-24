<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Response;
use Auth;
use DB;
use Hash;

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
            }

            $check_db = DB::table('nguoi_ban')->where('email', $email)->first();

            if(empty($check_db)){
                $errors[] = 'Email hoặc mật khẩu không đúng';
                return Response::json([
                    'success'=>false,
                    'errors'=>$errors
                ]);
            } else {
                if(Hash::check($password, $check_db->matkhau)){
                   // session_start(); bật session bên route
                    $_SESSION['manb'] = $check_db->manb;

                    return Response::json(['success'=>true]);
                } else {
                    $errors[] = 'Email hoặc mật khẩu không đúng';
                    return Response::json([
                        'success'=>false,
                        'errors'=>$errors
                    ]);
                }
            }
        }
    }

    public function getDangXuatNguoiBan(){
       // session_start();  bật session bên route
        unset($_SESSION['manb']);
        return redirect('nguoiban/dangnhap');
    }
}
