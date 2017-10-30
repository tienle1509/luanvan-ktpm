<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Carbon\Carbon;
use Response;
use DB;
use Cart;

class GioHangController extends Controller
{

/*---------------------------Thêm sản phẩm vào giỏ hàng------------------------------*/
    public function getMuaHang(){
    	if(Request::ajax()){
    		$masp = Request::get('masp');

    		$ngayht = Carbon::now();
			$sp_mua = DB::table('san_pham')->where('masp',$masp)->first();

			//Kiểm tra sản phẩm có đang khuyến mãi hay không
			$checkKM = DB::table('khuyen_mai as km')
							->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							->where('ctkm.masp',$masp)
							->get();

			$giasp = $sp_mua->dongia;
			foreach ($checkKM as $val) {
				if((strtotime($ngayht) > strtotime($val->ngaybd)) && (strtotime($ngayht)<strtotime($val->ngaykt))){
					$giasp = $sp_mua->dongia-($sp_mua->dongia*$val->chietkhau*0.01);
				}
			}
			Cart::add(array('id'=>$masp, 'name'=>$sp_mua->tensp, 'qty'=>1, 'price'=>$giasp, 'options'=>array('img'=>$sp_mua->anh)));
			//Thay đổi khi sử dụng script
			$content = Cart::content();
			$sl = Cart::count();
			$tong = Cart::total();

			//Lấy giá trị khi load lại trang
    		$_SESSION['content'] = $content;
    		$_SESSION['soluong'] = $sl;
    		$_SESSION['tongtien'] = $tong;
    		return Response::json(['success'=>true, 'soluong'=>$sl, 'content'=>$content, 'tongtien'=>$tong]); 
    	}
    }


    public function getXoaSanPham(){
    	if(Request::ajax()){
    		$id = Request::get('id');
    		Cart::remove($id);

    		//Thay đổi khi sử dụng script
			$content = Cart::content();
			$sl = Cart::count();
			$tong = Cart::total();

			//Lấy giá trị khi load lại trang
    		$_SESSION['content'] = $content;
    		$_SESSION['soluong'] = $sl;
    		$_SESSION['tongtien'] = $tong;
    		if ($sl == 0) {
    			unset($_SESSION['content']);
    		}

    		return Response::json(['success'=>true, 'soluong'=>$sl, 'content'=>$content, 'tongtien'=>$tong]); 
    	}    	
    }


    public function getSuaSanPham(){
    	if(Request::ajax()){
    		$qty = Request::get('soluong'); //qty là số lượng
    		$id = Request::get('id');
    		$masp = Request::get('masp');

    		$hangton = DB::table('san_pham')
    						->where('masp',$masp)
    						->first();

    		if($qty > $hangton->soluong){
    			$errors[] = 'Số lượng hàng trong kho không đủ. Chúng tôi sẽ cập nhật sớm !';
    			return Response::json(['success'=>false, 'errors'=>$errors]);
    		}  else if($qty == 0){
    			$errors[] = 'Số lượng sản phẩm phải lớn hơn không !';
    			return Response::json(['success'=>false, 'errors'=>$errors]);
    		} else {
    			Cart::update($id, $qty);

    			
    			//Thay đổi khi sử dụng script
				$content = Cart::content();
				$sl = Cart::count();
				$tong = Cart::total();

				//Lấy giá trị khi load lại trang
	    		$_SESSION['content'] = $content;
	    		$_SESSION['soluong'] = $sl;
	    		$_SESSION['tongtien'] = $tong;
	    		return Response::json(['success'=>true, 'soluong'=>$sl, 'content'=>$content, 'tongtien'=>$tong]); 
    		}
    	}
    }


}
