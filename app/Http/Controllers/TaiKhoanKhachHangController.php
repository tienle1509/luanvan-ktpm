<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;
use Validator;
use Carbon\Carbon;
use App\KhachHang;
use Hash;

class TaiKhoanKhachHangController extends Controller
{
/*---------------------------Đăng nhập khách hàng-----------------------------*/
	public function postDangNhap(){
		if(Request::ajax()){
			$email = Request::get('email');
			$matkhau = Request::get('matkhau');
			$v = Validator::make(Request::all(),
				[
					'email'=>'required|email',
					'matkhau'=>'required'
				],
				[
					'email.required'=>'Email không được rỗng',
					'email.email'=>'Email không đúng định dạng',
					'matkhau.required'=>'Mật khẩu không được rỗng'
				]);
			if($v->fails()){
				return Response::json([
					'success'=>false,
					'errors'=>$v->errors()->toArray()
				]);
			}else{
				$check_db = DB::table('khach_hang')->where('email', $email)->first();

	            if(empty($check_db)){
	                $errors['sai_dl'] = 'Email hoặc mật khẩu không đúng';
	                return Response::json([
	                    'success'=>false,
	                    'errors'=>$errors
	                ]);
	            } else {
	                if(Hash::check($matkhau, $check_db->matkhau)){
	                   	$_SESSION['makh'] = $check_db->makh;

	                    return Response::json(['success'=>true]);
	                } else {
	                    $errors['sai_dl'] = 'Email hoặc mật khẩu không đúng';
	                    return Response::json([
	                        'success'=>false,
	                        'errors'=>$errors
	                    ]);
	                }
	            }
			}
		}
	}


/*---------------------------Đăng xuất khách hàng-----------------------------*/
	public function getDangXuat(){
		unset($_SESSION['makh']);
    	return redirect('home');
	}


/*---------------------------Mã khách hàng tự tăng-------------------------------*/
	public function maKhachHang(){
		$kh = DB::table('khach_hang')->select('makh')->get();
		$max = 0;

		foreach ($kh as $value) {
			$cat_chuoi = substr($value->makh, 2);
			if($cat_chuoi > $max)
				$max = $cat_chuoi;
		}

		$chuoi_so = $max+1;
		if($chuoi_so < 10){
            $makh = 'KH00'.$chuoi_so;
        }else{
            $makh = 'KH0'.$chuoi_so;
        }
        return $makh;
	}

/*--------------------Đăng kí tài khoản-----------------------*/
	public function postDangKi(){
		if(Request::ajax()){
			$hoten = Request::get('hoten');
			$email = Request::get('email');
			$matkhau1 = Request::get('matkhau1');
			$matkhau2 = Request::get('matkhau2');
			$makh = $this->maKhachHang();

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
				//Kiểm tra email đã có trong hệ thống chưa
				$checkmail = DB::table('khach_hang')
								->where('email',$email)
								->first();
				if(!empty($checkmail)){
					$errors['email'] = 'Email này đã tồn tại trong hệ thống';
					return Response::json([
						'success'=>false,
						'errors'=>$errors
					]);
				}else{
					$khtv = new KhachHang();
					$khtv->makh = $makh;
					$khtv->tennguoidung = $hoten;
					$khtv->tenkh = '';
					$khtv->email = $email;
					$khtv->matkhau = Hash::make($matkhau1);
					$khtv->sodienthoai = '';
					$khtv->diachigiaohang = '';
					$khtv->thanhvien = 1;
					$khtv->ngaytao = date('Y-m-d',strtotime(Carbon::now()));
					$khtv->save();

					$_SESSION['makh'] = $makh;

					return Response::json(['success'=>true]);
				}				
			}
		}
	}

/*-----------------------------Quản lí tài khoản--------------------------------*/
	public function getQuanLiTaiKhoan(){
		return view('khachhang.home_qltaikhoan');
	}
}
