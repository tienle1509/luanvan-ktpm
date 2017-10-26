<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;
use File;

class XoaKhuyenMaiController extends Controller
{
    public function getXoaKhuyenMai(){
    	if(Request::ajax()){
    		$makm = Request::get('makm');

    		//Xóa ảnh trong thư mục
    		$anh = DB::table('khuyen_mai')->where('makm',$makm)->first();
    		$duongdan = 'public/anh-khuyenmai/'.$anh->anhkm;
    		if(File::exists($duongdan)){
    			File::delete($duongdan);
    		}

    		//Xóa khuyến mãi trong bảng khuyến mãi
    		DB::table('khuyen_mai')->where('makm',$makm)->delete();
    		//Xóa khuyến mãi trong bảng chi tiết khuyến mãi
    		DB::table('chitiet_khuyenmai')->where('makm',$makm)->delete();

    		return Response::json(['success'=>true]);
    	}
    }
}
