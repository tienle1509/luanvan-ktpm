<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Validator;

class DonHangQuanLiController extends Controller
{
/*---------------------Đơn hàng home----------------------------*/
	public function getHomeDonHang(){
		$ordernew = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh','=','dh.makh')
						->where('dh.trangthai',0)
						->paginate(10);

		return view('quanli.donhang.donhang_home')->with('ordernew',$ordernew);
	}

/*---------------------Đơn hàng chờ duyệt----------------------------*/
	public function getDuyetDonHang(){
		$duyet_donhang = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh','=','dh.makh')
						->where('dh.trangthai',0)
						->paginate(10);

		return view('quanli.donhang.duyet_donhang')->with('duyet_donhang',$duyet_donhang);
	}

/*---------------------Đơn hàng trong ngày----------------------------*/
	public function getDonHangTrongNgay(){
		$ngayht = Carbon::now();
		$dh = DB::table('don_hang as dh')
							->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
							->paginate(10);
		
		return view('quanli.donhang.donhang_trongngay')->with('dh',$dh)->with('ngayht',$ngayht);
	}

	public function getTimKiemTrongNgay(Request $request){
		$v = Validator::make($request->all(),
			[
				'keysearch'=>'required'
			],
			[
				'keysearch.required'=>'Bạn chưa nhập dữ liệu tìm kiếm'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}else{
			$ngayht = Carbon::now();

			$result = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
						->where('dh.madh','like','%'.$request->keysearch.'%')
						->orwhere('kh.tenkh','like', '%'.$request->keysearch.'%')
						->paginate(10);

			return view('quanli.donhang.timkiem_trongngay')->with('ngayht',$ngayht)->with('result',$result);
		}
	}

/*---------------------Tất cả đơn hàng--------------------------*/
	public function getTatCaDonHang(){
		$ngayht = Carbon::now();
		$tatcadh = DB::table('don_hang as dh')
					->join('khach_hang as kh', 'kh.makh','=', 'dh.makh')
					->paginate(10);

		return view('quanli.donhang.tatca_donhang')->with('ngayht',$ngayht)->with('tatcadh',$tatcadh);
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
				$result = DB::table('don_hang as dh')
							->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
							->where('dh.madh','like','%'.$request->txtkey.'%')
							->orwhere('kh.tenkh','like', '%'.$request->txtkey.'%')
							->paginate(10);
				
				return view('quanli.donhang.timkiem_tatca')->with('ngayht',$ngayht)->with('result',$result);
			}
		}else{
			$ngayht = Carbon::now();
			$ngaybd = $request->txtngaybd;
			$ngaykt = $request->txtngaykt;
		/*	$result = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
						->where('dh.madh','like','%'.$request->txtkey.'%')
						->orwhere('kh.tenkh','like', '%'.$request->txtkey.'%')
						->get();  */
			$result_thoigian = DB::table('don_hang as dh')
						->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
						->paginate(10);

				
			return view('quanli.donhang.timkiem_tatca')->with('ngayht',$ngayht)->with('ngaybd',$ngaybd)->with('ngaykt',$ngaykt)->with('result_thoigian',$result_thoigian); 
		}
	}

/*--------------------------Chi tiết đơn hàng---------------------------*/
	public function getChiTietDonHang($madh){
		$ctdh = DB::table('don_hang as dh')
					->join('khach_hang as kh', 'kh.makh','=', 'dh.makh')
					->where('dh.madh',$madh)
					->first();

		return view('quanli.donhang.chitiet_donhang')->with('ctdh',$ctdh);
	}


}
