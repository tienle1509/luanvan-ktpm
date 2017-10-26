<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\QuanLi;
use Hash;

class LoginQuanLiController extends Controller
{
    /*-------------------Đăng nhập, đăng xuất quản lí-------------------------*/

    public function getDangNhapQuanLi(){
        return view('auth.dangnhap_quanli');
    }

    public function postDangNhapQuanLi(Request $request){
        $v = Validator::make($request->all(), [
                'txtEmail'=>'required',
                'txtMatKhau'=>'required',
            ],
            [
                'txtEmail.required'=>'Vui lòng nhập email',
                'txtMatKhau.required'=>'Vui lòng nhập mật khẩu'
            ]);

        if($v->fails()){
            return redirect()->back()->withInput($request->except('password'))->withErrors($v->errors());
        }

        $check_db = DB::table('nguoi_quanli')->where('email',$request->txtEmail)->first();    
        	
  
        if(!empty($check_db)){
	        if(Hash::check($request->txtMatKhau, $check_db->matkhau)){
	        	$_SESSION['maql'] = $check_db->maql;

	        	return redirect('quanli/ql-sanpham');
	        }
	        else {
	        	return redirect()->back()->withInput($request->except('password'))->withErrors('Email hoặc mật khẩu không đúng !');
	        }  
	    } else {
	    	return redirect()->back()->withInput($request->except('password'))->withErrors('Email hoặc mật khẩu không đúng !');
	    }
    } 


    public function getDangXuatQuanLi(){
        unset($_SESSION['maql']);
    	return redirect('quanli/dangnhap');
    }

}
