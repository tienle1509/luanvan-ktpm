<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Response;
use DB;

class CapNhatSoLuongSanPhamController extends Controller
{
    public function postCapNhatSoLuong(){
    	if(Request::ajax()){
    		$masp = Request::get('masp');
    		$soluong = Request::get('soluong');

    		$v = Validator::make(Request::all(),
    			[
    				'soluong'=>'required'
    			],
    			[
    				'soluong.required'=>'Số lượng sản phẩm không được rỗng !'
    			]);
    		if($v->fails()){
    			return Response::json([
    				'success'=>false,
    				'errors'=>$v->errors()->toArray()
    			]);
    		}
    		else {
    			DB::table('san_pham')->where('masp',$masp)->update(['soluong'=>$soluong]);

    			return Response::json(['success'=>true]);
    		}
    	}
    }
}
