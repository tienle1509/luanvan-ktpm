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
		if(!isset($_SESSION['manb'])){
			header("Location: http://localhost/luanvan-ktpm/nguoiban/dangnhap");	
			exit;
		}
		$dhmoi = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',1)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
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
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
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
							->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
							->distinct()
							->orderBy('dh.madh', 'desc')
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
								->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
								->distinct()
								->orderBy('dh.madh', 'desc')
								->get();

			return view('nguoiban.donhang.timkiem_tatca')->with('ngayht',$ngayht)->with('ngaybd',$ngaybd)->with('ngaykt',$ngaykt)->with('result_thoigian',$result_thoigian); 
		}
	}

/*--------------------Chi tiết đơn hàng-------------------------*/
	public function getChiTietDonHang($madh){
		$ctdh = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')		
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('ct.manb', $_SESSION['manb'])
					->where('dh.madh',$madh)
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->first();


		return view('nguoiban.donhang.chitiet_donhang')->with('ctdh',$ctdh);
	}

/*--------------------Đơn hàng trong ngày-------------------------*/
	public function getDonHangTrongNgay(){
		$ngayht = Carbon::now();

		$dh_trongngay = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')					
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
					->where('dh.trangthai',1)
					->where('sp.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

		return view('nguoiban.donhang.donhang_trongngay')->with('ngayht',$ngayht)->with('dh_trongngay', $dh_trongngay);
	}
	
/*--------------------Đơn hàng đang xử lí-------------------------*/
	public function getDonHangDangXuLi(){
		$dh_dangxuli = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',1)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

		return view('nguoiban.donhang.donhang_dangxuli')->with('dh_dangxuli', $dh_dangxuli);
	}

	public function getTimKiemDHDangXuLi(Request $request){
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
			$dh_dangxuli = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',1)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

			$result = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
						->where('dh.madh','like','%'.$request->txtkey.'%')
						->orwhere('kh.tenkh','like', '%'.$request->txtkey.'%')
						->get();
							
			$arr = array();
			foreach ($dh_dangxuli as $val) {
				$arr[] = $val->madh;
			}
			
			$t = 0;
			foreach ($result as $val) {
				if(in_array($val->madh, $arr)){
					$t += 1;
				}
			}

			return view('nguoiban.donhang.timkiem_dangxuli', compact('arr', 't', 'result'));
		}
	}

/*--------------------Đơn hàng đang giao đi-------------------------*/
	public function getDonHangDangGiao(){
		$dh_danggiao = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',2)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

		return view('nguoiban.donhang.donhang_danggiaodi')->with('dh_danggiao', $dh_danggiao);
	}

	public function getTimKiemDangGiao(Request $request){
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
			$dh_danggiao = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',2)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

			$result = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
						->where('dh.madh','like','%'.$request->txtkey.'%')
						->orwhere('kh.tenkh','like', '%'.$request->txtkey.'%')
						->get();
							
			$arr = array();
			foreach ($dh_danggiao as $val) {
				$arr[] = $val->madh;
			}
			
			$t = 0;
			foreach ($result as $val) {
				if(in_array($val->madh, $arr)){
					$t += 1;
				}
			}

			return view('nguoiban.donhang.timkiem_danggiao', compact('arr', 't', 'result'));
		}
	}

/*--------------------Đơn hàng thất bại------------------------*/
	public function getDonHangThatBai(){
		$dh_thatbai = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',3)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

		return view('nguoiban.donhang.donhang_thatbai', compact('dh_thatbai'));
	}

/*--------------------Đơn hàng đã giao------------------------*/
	public function getDonHangDaGiao(){
		$dh_dagiao = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',4)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'dh.mattdh')
					->distinct()
					->orderBy('dh.madh', 'desc')
					->paginate(10);

		return view('nguoiban.donhang.donhang_dagiao')->with('dh_dagiao', $dh_dagiao);
	}

}
