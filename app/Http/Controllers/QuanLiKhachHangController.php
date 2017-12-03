<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Hash;

class QuanLiKhachHangController extends Controller
{
    public function getKhachHang(){
    	$ds_kh = DB::table('khach_hang')->orderBy('makh', 'desc')->paginate(10);
    	$sokh = DB::table('khach_hang')->count('makh');

    	return view('quanli.khachhang.khachhang')->with('ds_kh', $ds_kh)->with('sokh',$sokh);
    }

/*--------------Sửa thông tin khách hàng---------------*/
	public function getSuaKhachHang($makh){
		$thongtin = DB::table('khach_hang')->where('makh',$makh)->first();

		return view('quanli.khachhang.sua_thongtin_khachhang')->with('thongtin',$thongtin);
	}

	public function postLuuThongTin(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtTenKH'=>'required',
				'txtEmail'=>'required|email',
				'txtSDT'=>'required|between:10,11',
				'txtDiaChi'=>'required'
			],
			[
				'txtTenKH.required'=>'Tên khách hàng không được rỗng',
				'txtEmail.required'=>'Email không được rỗng',
				'txtEmail.email'=>'Email không đúng định dạng',
				'txtSDT.required'=>'Số điện thoại không được rỗng',
				'txtSDT.between'=>'Số điện thoại không đúng định dạng',
				'txtDiaChi.required'=>'Địa chỉ không được rỗng'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			DB::table('khach_hang')->where('makh', $request->txtMaKH)
				->update([
					'tenkh'=>$request->txtTenKH,
					'email'=>$request->txtEmail,
					'sodienthoai'=>$request->txtSDT,
					'diachigiaohang'=>$request->txtDiaChi
				]);
			$_SESSION['updateTT'] = 'Cập nhật thông tin khách hàng '.$request->txtTenKH.' thành công !';
			return redirect('quanli/khachhang');
		}
	}

	public function postLuuMatKhau(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtMatKhau1'=>'required|min:8',
				'txtMatKhau2'=>'required|same:txtMatKhau1'
			],
			[
				'txtMatKhau1.required'=>'Mật khẩu không được rỗng',
				'txtMatKhau1.min'=>'Mật khẩu phải có ít nhất 8 kí tự',
				'txtMatKhau2.required'=>'Xác nhận mật khẩu không được rỗng',
				'txtMatKhau2.same'=>'Không khớp mật khẩu'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			DB::table('khach_hang')->where('makh', $request->txtMaKH)
				->update([
					'matkhau'=>Hash::make($request->txtMatKhau1)
				]);

			$_SESSION['updateTK'] = 'Cập nhật tài khoản khách hàng '.$request->txtMaNB.' thành công !';
			return redirect('quanli/khachhang');
		}
	}

/*--------------------Tìm kiếm khách hàng------------------------*/
	public function getTimKiemKhachHang(Request $request){
		$v = Validator::make($request->all(), 
			[
				'key'=>'required'
			],
			[
				'key.required'=>'Bạn chưa nhập dữ liệu tìm kiếm'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			$kq_timkiem = DB::table('khach_hang')
							->where('makh', 'like', '%'.$request->key.'%')
							->orwhere('tenkh', 'like', '%'.$request->key.'%')
							->orwhere('email', 'like', '%'.$request->key.'%')
							->orderBy('makh', 'desc')
							->get();

			return view('quanli.khachhang.timkiem')->with('kq_timkiem',$kq_timkiem);
		}
	}

}
