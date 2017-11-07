<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;

class DonHangNguoiBanController extends Controller
{
/*---------------------Đơn hàng home------------------------------*/
	public function getHomeDonHang(){
		$dhmoi = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
					->where('dh.trangthai',1)
					->where('dh.mattdh',1)
					->where('sp.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'ct.soluongct', 'dh.mattdh')
					->distinct()
					->paginate(10);
		
		return view('nguoiban.donhang.donhang_home')->with('dhmoi',$dhmoi);
	}

/*--------------------Tất cả đơn hàng--------------------------*/
	public function getTatCaDonHang(){
		$tatcadh = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')					
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
					->where('dh.trangthai',1)
					->where('sp.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'ct.soluongct', 'dh.mattdh')
					->distinct()
					->paginate(10);

		return view('nguoiban.donhang.tatca_donhang')->with('tatcadh', $tatcadh);
	}

	public function getTimKiemTatCaDH(Request $request){
		if($request->txtngaybd == '' && $request->txtngaykt == ''){
			$v = Validator::make($request->all(),
			[
				'txtkey'=>'required'
			],
			[
				'txtkey.required'=>'Bạn chưa nhập dữ liệu tìm kiếm.'
			]);
			if($v->fails()){
				return redirect()->back()->withErrors($v->errors());
			}else{
				$ngayht = Carbon::now();
				$dh = DB::table('don_hang as dh')
							->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')		
							->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
							->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							->where('dh.trangthai',1)
							->where('sp.manb', $_SESSION['manb'])
							->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'ct.soluongct', 'dh.mattdh')
							->distinct()
							->get();

				$result = DB::table('don_hang as dh')
							->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
							->where('dh.madh','like','%'.$request->txtkey.'%')
							->orwhere('kh.tenkh','like', '%'.$request->txtkey.'%')
							->get();
							
				$arr = array();
				foreach ($dh as $val) {
					$arr[] = $val->madh;
				}
				
				$result_arr = array();
				foreach ($result as $val) {
					if(in_array($val->madh, $arr)){
						$result_arr[] = $val->madh;
					}
				}


				return view('nguoiban.donhang.timkiem_tatca')->with('ngayht',$ngayht)->with('result_arr',$result_arr);
			}
		}else {
			$ngayht = Carbon::now();
			$ngaybd = $request->txtngaybd;
			$ngaykt = $request->txtngaykt;
		/*	$result = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
						->where('dh.madh','like','%'.$request->txtkey.'%')
						->orwhere('kh.tenkh','like', '%'.$request->txtkey.'%')
						->get();  */
			$result_thoigian = DB::table('don_hang as dh')
								->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')		
								->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
								->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
								->where('dh.trangthai',1)
								->where('sp.manb', $_SESSION['manb'])
								->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'ct.soluongct', 'dh.mattdh')
								->distinct()
								->get();

			return view('nguoiban.donhang.timkiem_tatca')->with('ngayht',$ngayht)->with('ngaybd',$ngaybd)->with('ngaykt',$ngaykt)->with('result_thoigian',$result_thoigian); 
		}
	}

/*--------------------Chi tiết đơn hàng-------------------------*/
	public function getChiTietDonHang($madh){
		$ctdh = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')		
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
					->where('dh.trangthai',1)
					->where('sp.manb', $_SESSION['manb'])
					->where('dh.madh',$madh)
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'ct.soluongct', 'dh.mattdh')
					->distinct()
					->first();


		return view('nguoiban.donhang.chitiet_donhang')->with('ctdh',$ctdh);
	}




}
