<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class EditAccountThanhVienController extends Controller
{
/*------------------Sửa email--------------------*/
	public function getThayDoiEmail(){
		return view('khachhang.thaydoi_email');
	}

/*------------------Lưu sửa email--------------------*/
	public function postThayDoiEmail(Request $request){
		$email = $request->txtEmail;

		$v = Validator::make($request->all(),
			[
				'txtEmail'=>'required|email'
			],
			[
				'txtEmail.required'=>'Vui lòng nhập địa chỉ email mới',
				'txtEmail.email'=>'Email không đúng định dạng'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			//Kiểm tra email đã tồn tại trong hệ thống hay chưa
			$checkmail = DB::table('khach_hang')->where('email', $email)->first();

			if(!empty($checkmail)){
				$errors['txtEmail'] = 'Email này đã tồn tại trong hệ thống';
				return redirect()->back()->withInput()->withErrors($errors);
			}else{
				DB::table('khach_hang')->where('makh', $_SESSION['makh'])
						->where('thanhvien',1)
						->update(['email'=>$email]);

				return view('khachhang.home_qltaikhoan');
			}
		}		
	}

/*-----------------------Thay đổi địa chỉ giao hàng--------------------------*/
	public function getThayDoiDiaChiGiaoHang(){
		return view('khachhang.thaydoi_diachi_giaohang');
	}

/*-----------------------Lưu thay đổi địa chỉ giao hàng--------------------------*/
	public function postThayDoiDiaChiGiaoHang(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtHoTen'=>'required',
				'txtSDT'=>'required|between:10,11',
				'cbxtinh'=>'required',
				'txtDiaChi'=>'required'
			],
			[
				'txtHoTen.required'=>'Họ tên không được rỗng',
				'txtSDT.required'=>'Số điện thoại không được rỗng',
				'txtSDT.between'=>'Số điện thoại không đúng định dạng',
				'cbxtinh.required'=>'Tỉnh không được rỗng',
				'txtDiaChi.required'=>'Địa chỉ không được rỗng'
			]);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}else{

			$tinh = DB::table('phi_vanchuyen')->where('matinh', $request->cbxtinh)->first();

			DB::table('khach_hang')->where('makh', $_SESSION['makh'])
					->where('thanhvien',1)
					->update([
								'tenkh'=>$request->txtHoTen,
								'sodienthoai'=>$request->txtSDT,
								'diachigiaohang'=>$request->txtDiaChi.', '.$tinh->tentinh
							]);
			return redirect('quanli-taikhoan');
		}
	}

/*-----------------------Thay đổi mật khẩu--------------------------*/
	public function getThayDoiMatKhau(){
		return view('khachhang.thaydoi_matkhau');
	}

/*-----------------------Lưư thay đổi mật khẩu--------------------------*/
	public function postThayDoiMatKhau(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtMKHT'=>'required',
				'txtMK1'=>'required|min:8',
				'txtMK2'=>'required|same:txtMK1'
			],
			[
				'txtMKHT.required'=>'Mật khẩu hiện tại không được rỗng',
				'txtMK1.required'=>'Mật khẩu mới không được rỗng',
				'txtMK1.min'=>'Mật khẩu mới phải có ít nhất 8 kí tự',
				'txtMK2.required'=>'Nhập lại mật khẩu không được rỗng',
				'txtMK2.same'=>'Không khớp mật khẩu'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			$check_mkht = DB::tableDF
		}
	}

}
