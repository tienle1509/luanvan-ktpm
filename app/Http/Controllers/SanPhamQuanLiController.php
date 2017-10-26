<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class SanPhamQuanLiController extends Controller
{
/*-----------------------Trang chủ quản lí-----------------------------*/
    public function getHomeSanPham(){
    	$list_spmoi = DB::table('san_pham as sp')
    					->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
    					->where('sp.trangthai',0)
    					->paginate(10); //Phân trang

    	return view('quanli.sanpham.sanpham_home')->with('list_spmoi', $list_spmoi);
    }

/*-----------------------Sản phẩm chờ duyệt-----------------------------*/
	public function getDuyetSanPham(){
		$list_duyetsp = DB::table('san_pham as sp')
							->join('nguoi_ban as nb', 'nb.manb', '=','sp.manb')
							->where('sp.trangthai',0)
							->paginate(10);

		return view('quanli.sanpham.duyet_sanpham')->with('list_duyetsp',$list_duyetsp);
	}

/*-----------------------Tất cả sản phẩm-----------------------------*/
	public function getTatCaSanPham(){
		$list_all = DB::table('san_pham as sp')
						->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
						->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
						->paginate(10);

		$list_khuyenmai = DB::table('khuyen_mai as km')
								->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
								->get();

		return view('quanli.sanpham.tatca_sanpham')->with('list_all', $list_all)->with('list_khuyenmai', $list_khuyenmai);
	}

	public function getTimKiemSanPham(Request $request){
		$v = Validator::make($request->all(),
			[
				'key'=>'required'
			],
			[
				'key.required'=>'Bạn chưa nhập dữ liệu tìm kiếm.'
			]);

		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		} else {
			$result_search = DB::table('san_pham as sp')
						->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
						->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
						->where('dm.tendanhmuc','like','%'.$request->key.'%')
						->orwhere('sp.tensp', 'like', '%'.$request->key.'%')
						->orwhere('nb.tengianhang', 'like', '%'.$request->key.'%')
						->paginate(10);

			return view('quanli.sanpham.timkiem_tatca')->with('result_search',$result_search);
		}
	}

/*-----------------------Chi tiết sản phẩm-----------------------------*/
	public function getChiTietSanPham($masp){
		$chitietsp = DB::table('san_pham as sp')
						->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
						->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
						->where('sp.masp',$masp)
						->first();
		$img_phu = DB::table('anh_sanpham')->where('masp',$masp)->get();

		return view('quanli.sanpham.chitiet_sanpham')->with('chitietsp',$chitietsp)->with('img_phu', $img_phu);
	}


}
