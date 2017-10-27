<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;

class ThemSanPhamKhuyenMaiNguoiBanController extends Controller
{
    public function getThemSanPham(){
    	if(Request::ajax()){
    		$masp = Request::get('masp');
    		$makm = Request::get('makm');

    		DB::table('chitiet_khuyenmai')->insert(['makm'=>$makm, 'masp'=>$masp]);
    		return Response::json(['success'=>true]);
    	}
    }

    public function getXoaSanPham(){
    	if(Request::ajax()){
    		$masp = Request::get('masp');
    		$makm = Request::get('makm');

    		DB::table('chitiet_khuyenmai')->where('masp', $masp)->delete();
    		return Response::json(['success'=>true]);
    	}
    }
}
