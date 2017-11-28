<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;
use Carbon\Carbon;
use Validator;

class SapXepTheoGiaController extends Controller
{
    public function getSapXep(){
    	if(Request::ajax()){
    		$madm = Request::get('madm');
    		$sapxep = Request::get('sapxep');

    		$v = Validator::make(Request::all(), [
                'sapxep'=>'required',
            ],
            [
                'sapxep.required'=>'Bạn chưa chọn hình thức sắp xếp !'
            ]);

            if($v->fails()){
                return Response::json([
                    'success'=>false,
                    'errors'=>$v->errors()->toArray()
                ]);
            }else{
	    		$_SESSION['madm'] = $madm;
	    		$_SESSION['sapxep'] = $sapxep;

	    		return Response::json(['success'=>true]);
	    	}
    	}
    }

    public function getKetQuaSapXep(){    	
    	$ngayht = Carbon::now();

    	return view('khachhang.sapxep_theogia')->with('ngayht',$ngayht);
    }
}
