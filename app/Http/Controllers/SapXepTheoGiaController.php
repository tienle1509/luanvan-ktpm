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
/*---------------------Sắp xếp theo danh mục-------------------------*/
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

        if(!isset($_SESSION['madm'])){
            header("Location: http://localhost/luanvan-ktpm/home"); 
            exit;
        }

    	return view('khachhang.sapxep_theogia')->with('ngayht',$ngayht);
    }

/*--------------------Sắp xếp theo sản phẩm bán chạy-------------------------*/
    public function getSapXepBanChay(){
        if(Request::ajax()){
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
                $_SESSION['sapxep_banchay'] = $sapxep;

                return Response::json(['success'=>true]);
            }
        }
    }

    public function getKetQuaSapXepBanChay(){      
        $ngayht = Carbon::now();


        if(!isset($_SESSION['sapxep_banchay'])){
            header("Location: http://localhost/luanvan-ktpm/home"); 
            exit;
        }

        return view('khachhang.sapxep_banchay')->with('ngayht',$ngayht);
    }

}
