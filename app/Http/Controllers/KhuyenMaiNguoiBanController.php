<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class KhuyenMaiNguoiBanController extends Controller
{
    public function getHomeKhuyenMai(){
    	$dskm = DB::table('khuyen_mai')->get();
    	$ngayht = Carbon::now();

    	return view('nguoiban.khuyenmai')->with('dskm', $dskm)->with('ngayht', $ngayht);
    }

    public function getChiTietKhuyenMai($makm){
    	$ctkm = DB::table('khuyen_mai')->where('makm',$makm)->first();
    	$num_pro = DB::table('chitiet_khuyenmai')->where('makm',$makm)->count('masp');

    	return view('nguoiban.khuyenmai.chitiet_khuyenmai')->with('ctkm', $ctkm)->with('num_pro', $num_pro);
    }

    public function getThemSanPhamKhuyenMai($makm){
    	$km = DB::table('khuyen_mai')->where('makm', $makm)->first();

    	$sp_dakm = DB::table('khuyen_mai as km')
    					->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
    					->join('san_pham as sp', 'sp.masp', '=', 'ctkm.masp')
    					->where('km.makm',$makm)
    					->where('sp.manb', $_SESSION['manb'])
    					->where('sp.trangthai',1)
                        ->where('sp.soluong', '>',0)
    					->get();
    	$spkm = array();
    	foreach ($sp_dakm as $value) {
    		$spkm[] = $value->masp;
    	}
    	
    	$sp = DB::table('san_pham')
    					->where('manb', $_SESSION['manb'])
    					->where('trangthai',1)
                        ->where('soluong', '>',0)
    					->get();
    	
    	
    	return view('nguoiban.khuyenmai.them_sanpham_km')->with('spkm',$spkm)->with('sp',$sp)->with('km',$km);
    }

    public function getDSSanPhamKhuyenMai($makm){
    	$km = DB::table('khuyen_mai')->where('makm', $makm)->first();

    	$sp_dakm = DB::table('khuyen_mai as km')
    					->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
    					->join('san_pham as sp', 'sp.masp', '=', 'ctkm.masp')
    					->where('km.makm',$makm)
    					->where('sp.manb', $_SESSION['manb'])
    					->where('sp.trangthai',1)
                        ->where('soluong', '>',0)
    					->get();
    	$spkm = array();
    	foreach ($sp_dakm as $value) {
    		$spkm[] = $value->masp;
    	}
    	
    	$sp = DB::table('san_pham')
    					->where('manb', $_SESSION['manb'])
    					->where('trangthai',1)
                        ->where('soluong', '>',0)
    					->get();

    	return view('nguoiban.khuyenmai.ds_sanpham_km')->with('spkm',$spkm)->with('sp',$sp)->with('km',$km);
    }

}
