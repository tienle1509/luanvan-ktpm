<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Hash;
use Charts;


class QuanLiNguoiBanController extends Controller
{
/*---------------------------Nhà bán hàng------------------------------*/
	public function getNhaBanHang(){
		$ds_nguoiban = DB::table('nguoi_ban')->orderBy('manb', 'desc')->paginate(10);
		$sonb = DB::table('nguoi_ban')->count('manb');
		
		return view('quanli.nhabanhang.nguoiban')->with('ds_nguoiban', $ds_nguoiban)->with('sonb',$sonb);
	}

/*---------------------------Sửa thông tin nhà bán hàng------------------------------*/
	public function getSuaNhaBanHang($manb){
		$thongtin = DB::table('nguoi_ban')->where('manb', $manb)->first();

		return view('quanli.nhabanhang.sua_thongtin_nguoiban')->with('thongtin', $thongtin);
	}

	public function postLuuThongTin(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtTenNB'=>'required',
				'txtTenGH'=>'required',
				'txtEmail'=>'required|email',
				'txtSDT'=>'required|between:10,11',
				'txtDiaChi'=>'required'
			],
			[
				'txtTenNB.required'=>'Tên người bán không được rỗng',
				'txtTenGH.required'=>'Tên gian hàng không được rỗng',
				'txtEmail.required'=>'Email không được rỗng',
				'txtEmail.email'=>'Email không đúng định dạng',
				'txtSDT.required'=>'Số điện thoại không được rỗng',
				'txtSDT.between'=>'Số điện thoại không đúng định dạng',
				'txtDiaChi.required'=>'Địa chỉ không được rỗng'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			DB::table('nguoi_ban')->where('manb', $request->txtMaNB)
				->update([
					'tennb'=>$request->txtTenNB,
					'tengianhang'=>$request->txtTenGH,
					'email'=>$request->txtEmail,
					'sodienthoai'=>$request->txtSDT,
					'diachi'=>$request->txtDiaChi
				]);
			$_SESSION['updateTT'] = 'Cập nhật thông tin gian hàng '.$request->txtTenGH.' thành công !';
			return redirect('quanli/nhabanhang');
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
				'txtMatKhau1.min'=>'Mật khẩu có ít nhất 8 kí tự',
				'txtMatKhau2.required'=>'Xác nhận mật khẩu không được rỗng',
				'txtMatKhau2.same'=>'Không khớp mật khẩu'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			DB::table('nguoi_ban')->where('manb', $request->txtMaNB)
				->update([
					'matkhau'=>Hash::make($request->txtMatKhau1)
				]);

			$_SESSION['updateTK'] = 'Cập nhật tài khoản gian hàng '.$request->txtMaNB.' thành công !';
			return redirect('quanli/nhabanhang');
		}
	}

/*--------------------Thống kê doanh thu theo từng nhà bán hàng------------------------*/
	public function getThongKeDoanhSo($manb){
		$dh_manb = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',4)
					->where('ct.manb', $manb)
					->select('dh.madh', 'dh.ngaydat', 'dh.tongtien')
					->distinct()
					->get();

		$tennb = DB::table('nguoi_ban')->where('manb',$manb)->first();

		$tong1 = 0; $tong2 = 0; $tong3 = 0; $tong4 = 0; $tong5 = 0; $tong6 = 0; $tong7 = 0; 
		$tong8 = 0; $tong9 = 0; $tong10 = 0; $tong11 = 0; $tong12 = 0; 
		foreach ($dh_manb as $val) {			
			if(date('Y', strtotime($val->ngaydat)) == date('Y')){
				switch (date('m', strtotime($val->ngaydat))) {
					case '1':
						$tong1 += $val->tongtien;
						break;
					case '2':
						$tong2 += $val->tongtien;
						break;
					case '3':
						$tong3 += $val->tongtien;
						break;
					case '4':
						$tong4 += $val->tongtien;
						break;
					case '5':
						$tong5 += $val->tongtien;
						break;
					case '6':
						$tong6 += $val->tongtien;
						break;
					case '7':
						$tong7 += $val->tongtien;
						break;
					case '8':
						$tong8 += $val->tongtien;
						break;
					case '9':
						$tong9 += $val->tongtien;
						break;
					case '10':
						$tong10 += $val->tongtien;
						break;
					case '11':
						$tong11 += $val->tongtien;
						break;
					case '12':
						$tong12 += $val->tongtien;
						break;				
				}
			}
		}

        $chart = Charts::create('bar', 'highcharts')
				->title('Biểu đồ doanh thu')
				->elementLabel('Doanh thu')
				->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 
        				'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'])
				->values([$tong1, $tong2, $tong3, $tong4, $tong5, $tong6, $tong7, $tong8,
							$tong9, $tong10, $tong11, $tong12])
				->dimensions(1000,500)
				->loader(false)
				->oneColor(true)
				->responsive(false);

		return view('quanli.nhabanhang.xem_doanhthu')->with('chart',$chart)->with('dh_manb', $dh_manb)->with('tennb', $tennb->tengianhang);
	}
		
/*--------------------Tìm kiếm nhà bán hàng------------------------*/
	public function getTimKiemNguoiBan(Request $request){
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
			$kq_timkiem = DB::table('nguoi_ban')
							->where('manb', 'like', '%'.$request->key.'%')
							->orwhere('tennb', 'like', '%'.$request->key.'%')
							->orwhere('email', 'like', '%'.$request->key.'%')
							->orderBy('manb', 'desc')
							->get();

			return view('quanli.nhabanhang.timkiem')->with('kq_timkiem',$kq_timkiem);
		}
	}



}	
