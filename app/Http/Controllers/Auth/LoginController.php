<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

use User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

        use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } 

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

        $auth = array(
                    'email'=>$request->txtEmail,
                    'password'=>$request->txtMatKhau,
                    'quyen'=>3
                );

        if(Auth::attempt($auth)){
            return redirect('quanli/ql-sanpham'); 
        }else{
            return redirect()->back()->withInput($request->except('password'))->withErrors('Email hoặc mật khẩu không đúng !');
        }
    } 


    public function getDangXuatQuanLi(){
        Auth::logout();
        return redirect('quanli/dangnhap');
    }

}
