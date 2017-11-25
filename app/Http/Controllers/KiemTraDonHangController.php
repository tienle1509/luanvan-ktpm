<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;
use Validator;
use Carbon\Carbon;

class KiemTraDonHangController extends Controller
{
/*---------------------------Kiểm tra đơn hàng-----------------------------*/
    public function getKiemTraDonHang(){
    	if(Request::ajax()){
    		$madh = Request::get('madh');
    		$email = Request::get('email');

    		$v = Validator::make(Request::all(),
    			[
    				'madh'=>'required',
    				'email'=>'required|email'
    			],
    			[
    				'madh.required'=>'Mã đơn hàng không được rỗng',
    				'email.required'=>'Email không được rỗng',
    				'email.email'=>'Email không đúng định dạng'
    			]);
    		if($v->fails()){
    			return Response::json([
    				'success'=>false,
    				'errors'=>$v->errors()->toArray()
    			]);
    		}else{
    			$ngayht = Carbon::now();

    			$ctdh = DB::table('don_hang as dh')
    					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
    					->where('dh.madh',$madh)
    					->where('kh.email', $email)
    					->first();
    			if(count($ctdh) == 0){
    				$errors['tt_sai'] = 'Vui lòng nhập thông tin chính xác !';
    				return Response::json([
	    				'success'=>false,
	    				'errors'=>$errors
	    			]);
    			}else{
	    			$_SESSION['ctdh'] = $ctdh;
	    			$_SESSION['ngayht'] = $ngayht;

	    			return Response::json(['success'=>true]);
	    		}
    		} 		
		}
    }

/*---------------------------Kiểm tra đơn hàng-----------------------------*/
	public function getThongTinDonHang(){		
		return view('khachhang.donhang');
	}

}
