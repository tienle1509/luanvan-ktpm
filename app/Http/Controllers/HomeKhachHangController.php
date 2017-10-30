<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Cart;

class HomeKhachHangController extends Controller
{
    public function getHomeKhachHang(){
    	$ngayht = Carbon::now();

    	$list_sp = DB::table('san_pham')
    				->where('trangthai',1)
    				->where('soluong','>',0)
    				->get();

    	$ma_giam = array();
    	foreach ($list_sp as $val) {
    		$ma_giam[] = $val->masp;
    	}
    	//Sắp xếp mã sản phẩm giảm dần
    	rsort($ma_giam);

    	/*for ($i=0; $i <10 ; $i++) { 
    		foreach ($sp as $val) {
	    		if ($val->masp == $sp_giam[$i]) {
	    			echo $val->masp.'	'.$val->tensp.'<br>';
	    		}
    		}
    	}   */

    	return view('khachhang.home')->with('list_sp',$list_sp)->with('ma_giam',$ma_giam)->with('ngayht',$ngayht);
    }

/*------------------------Tìm kiếm sản phẩm--------------------------------*/
	public function getTimKiemSanPham(Request $request){
		$v = Validator::make($request->all(),
			[
				'keysearch'=>'required'
			]);

		if($v->fails()){
			return redirect('home');
		} else {

			$ngayht = Carbon::now();

			if($request->searchdanhmuc == ''){
				$result_search = DB::table('san_pham as sp')
									->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
									->where('sp.soluong', '>', 0)
									->where('sp.trangthai',1)
									->where('sp.tensp', 'like', '%'.$request->keysearch.'%')
									->paginate(20);				
				return view('khachhang.timkiem')->with('result_search', $result_search)->with('keynhap',$request->keysearch)->with('ngayht',$ngayht);
			} 
			else {
				$searchdm = DB::table('danhmuc_sanpham')
								->where('madm',$request->searchdanhmuc)
								->first();

				$result_search = DB::table('san_pham as sp')
									->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
									->where('sp.soluong', '>', 0)
									->where('sp.trangthai',1)
									->where('sp.tensp', 'like', '%'.$request->keysearch.'%')
									->where('dm.madm',$request->searchdanhmuc)
									->paginate(20);

				return view('khachhang.timkiem')->with('result_search', $result_search)->with('searchdm',$searchdm)->with('ngayht',$ngayht);
			}		
		}
	}



/*---------------------------Chi tiết sản phẩm-------------------------------------*/
	public function getChiTietSanPham($masp){
		$ngayht = Carbon::now();

		$chitietsp = DB::table('san_pham as sp')
						->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
						->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
						->where('sp.masp', $masp)
						->first();


		return view('khachhang.chitiet_sanpham')->with('chitietsp',$chitietsp)->with('ngayht',$ngayht);
	}

/*---------------------------Gior hàng------------------------------------*/
	public function getGioHang(){

		return view('khachhang.giohang');
	}


}
