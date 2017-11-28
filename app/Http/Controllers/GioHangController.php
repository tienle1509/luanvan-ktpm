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
            $sl_nhan = Request::get('sl');

    		$ngayht = Carbon::now();
			$sp_mua = DB::table('san_pham')->where('masp',$masp)->first();

            //Kiểm tra số lượng khi bấm nút mua ngay
            $con = Cart::content();
            foreach ($con as $item) {
                if($item['id'] == $sp_mua->masp){
                    if($item['qty'] >= $sp_mua->soluong){
                        $errors[] = 'Chỉ còn lại '.$sp_mua->soluong.' sản phẩm';
                        return Response::json(['success'=>false, 'errors'=>$errors]);
                    }
                }
            }

            if($sl_nhan > $sp_mua->soluong){
                $errors[] = 'Chỉ còn lại '.$sp_mua->soluong.' sản phẩm';
                return Response::json(['success'=>false, 'errors'=>$errors]);
            }


            //Kiểm tra sản phẩm có đang khuyến mãi hay không
            $checkKM = DB::table('khuyen_mai as km')
                        ->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
                        ->where('ctkm.masp',$masp)
                        ->get();

            $giasp = $sp_mua->dongia;
            foreach ($checkKM as $val) {
                if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($val->ngaybd)) && (strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($val->ngaykt))){
                    $giasp = $sp_mua->dongia-($sp_mua->dongia*$val->chietkhau*0.01);
                }
            }
            Cart::add(array('id'=>$masp, 'name'=>$sp_mua->tensp, 'qty'=>$sl_nhan, 'price'=>$giasp, 'options'=>array('img'=>$sp_mua->anh)));
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
            $ngayht = Carbon::now();
    		$id = Request::get('id');
    		Cart::remove($id);

    		//Thay đổi khi sử dụng script
			$content = Cart::content();
			$sl = Cart::count();
			$tong = Cart::total();

            //Lấy mã từng nhà bán hàng
            $arr_manb = array();
            foreach ($content as $item) {
                $sanpham = DB::table('san_pham')->where('masp',$item['id'])->first();
                if(!in_array($sanpham->manb, $arr_manb)){
                    $arr_manb[] = $sanpham->manb;
                }
            }

            //Lấy tổng tiền theo từng nhà bán hàng
            $count_manb = 0; //Đếm số nhà bán hàng có đơn hàng lớn hơn 300000       
            foreach ($arr_manb as $val) {
                $tongtien_manb = 0;
                foreach ($content as $item) {
                    $sp = DB::table('san_pham')
                            ->where('masp',$item['id'])
                            ->where('manb',$val)
                            ->get();                
                    foreach ($sp as $valsp) {
                        $tongtien_manb += $item['qty']*$item['price'];
                    }
                }
                if($tongtien_manb < 300000){
                    $count_manb += 1;
                }
            }

			//Lấy giá trị khi load lại trang
    		$_SESSION['content'] = $content;
    		$_SESSION['soluong'] = $sl;
    		$_SESSION['tongtien'] = $tong;
    		if ($sl == 0) {
    			unset($_SESSION['content']);

    			//Khi đã nhập thông tin
    			unset($_SESSION['tenkh']);
    			unset($_SESSION['sdt']);
    			unset($_SESSION['mailkh']);
    			unset($_SESSION['tinh']);
    			unset($_SESSION['diachi']);
    			unset($_SESSION['tentinh']);
    			unset($_SESSION['matinh']);
    		}

    		return Response::json(['success'=>true, 'soluong'=>$sl, 'content'=>$content, 'tongtien'=>$tong, 'count_manb'=>$count_manb]); 
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
                $ngayht = Carbon::now();
    			Cart::update($id, $qty);

    			//Thay đổi khi sử dụng script
				$content = Cart::content();
				$sl = Cart::count();
				$tong = Cart::total();

                //Lấy mã từng nhà bán hàng
                $arr_manb = array();
                foreach ($content as $item) {
                    $sanpham = DB::table('san_pham')->where('masp',$item['id'])->first();
                    if(!in_array($sanpham->manb, $arr_manb)){
                        $arr_manb[] = $sanpham->manb;
                    }
                }

                //Lấy tổng tiền theo từng nhà bán hàng
                $count_manb = 0; //Đếm số nhà bán hàng có đơn hàng lớn hơn 300000       
                foreach ($arr_manb as $val) {
                    $tongtien_manb = 0;
                    foreach ($content as $item) {
                        $sp = DB::table('san_pham')
                                ->where('masp',$item['id'])
                                ->where('manb',$val)
                                ->get();                
                        foreach ($sp as $valsp) {
                            $tongtien_manb += $item['qty']*$item['price'];
                        }
                    }
                    if($tongtien_manb < 300000){
                        $count_manb += 1;
                    }
                }

				//Lấy giá trị khi load lại trang
	    		$_SESSION['content'] = $content;
	    		$_SESSION['soluong'] = $sl;
	    		$_SESSION['tongtien'] = $tong;
	    		return Response::json(['success'=>true, 'soluong'=>$sl, 'content'=>$content, 'tongtien'=>$tong, 'count_manb'=>$count_manb]); 
    		}
    	}
    }

/*---------------------------Chọn tỉnh thành giao hàng----------------------------*/
	public function getChonTinh(){
		if(Request::ajax()){
			$matinh = Request::get('matinh');
			$count_manb = Request::get('count_manb');

			if($count_manb == 0){
				return Response::json(['success'=>false]);
			} else{
				$phiship = DB::table('phi_vanchuyen as pvc')
						->join('khu_vuc as kv', 'kv.makv', '=', 'pvc.makv')
						->where('pvc.matinh', $matinh)
						->first();

				return Response::json(['success'=>true, 'phiship'=>($phiship->giacuoc*$count_manb)]);
			}
		}
	}

}
