<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;

class DuyetSanPhamController extends Controller
{
    public function getDuyetSanPham(){
    	if(Request::ajax()){
    		$masp = Request::get('masp');

    		DB::table('san_pham')->where('masp',$masp)->update(['trangthai'=>1]);
    		return Response::json(['success'=>true]);
    	}
    }
}
