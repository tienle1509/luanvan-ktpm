<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Cart;
use App\KhachHang;
use App\DonHang;
use App\ChiTietDonHang;
use Response;
use Request;

class DatHangController extends Controller
{
    /*---------------------------Mã đơn hàng tự tăng-------------------------------*/
	public function maDonHang(){
		$dh = DB::table('don_hang')->select('madh')->get();
		$max = 0;

		foreach ($dh as $value) {
			$cat_chuoi = substr($value->madh, 2);
			if($cat_chuoi > $max)
				$max = $cat_chuoi;
		}

		$chuoi_so = $max+1;
		if($chuoi_so < 10){
            $madh = 'DH00'.$chuoi_so;
        }else{
            $madh = 'DH0'.$chuoi_so;
        }
        return $madh;
	}

	/*---------------------------Nhập thông tin đặt hàng-------------------------------*/
	public function maKhachHang(){
		$kh = DB::table('khach_hang')->select('makh')->get();
		$max = 0;

		foreach ($kh as $value) {
			$cat_chuoi = substr($value->makh, 2);
			if($cat_chuoi > $max)
				$max = $cat_chuoi;
		}

		$chuoi_so = $max+1;
		if($chuoi_so < 10){
            $makh = 'KH00'.$chuoi_so;
        }else{
            $makh = 'KH0'.$chuoi_so;
        }
        return $makh;
	}

	/*---------------------------Đặt hàng-------------------------------*/
	public function postDatHang(){
		if(Request::ajax()){
			$httt = Request::get('httt');
			$makh = $this->maKhachHang();
			$madh = $this->maDonHang();

			if($httt == 1){
				//Thêm thông tin vô bảng khách hàng
				$kh = new KhachHang();
				$kh->makh = $makh;
				$kh->tennguoidung = '';
				$kh->tenkh = $_SESSION['tenkh'];
				$kh->email = $_SESSION['mailkh'];
				$kh->matkhau = '';
				$kh->sodienthoai = $_SESSION['sdt'];
				$kh->diachithanhtoan = $_SESSION['diachi'].' , '.$_SESSION['tentinh'];
				$kh->diachigiaohang = $_SESSION['diachi'].' , '.$_SESSION['tentinh'];
				$kh->thanhvien = 0;
				$kh->save();

				if(Cart::total() > 300000){
					$tongtien = Cart::total();
				}else{
					$phiship = DB::table('phi_vanchuyen as vc')
									->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
									->where('vc.matinh', $_SESSION['matinh'])
									->first();
					$tongtien = Cart::total()+$phiship->giacuoc;
				}

				//Thêm thông tin vô bảng đơn hàng
				$dh = new DonHang();
				$dh->madh = $madh;
				$dh->ngaydat = date('Y-m-d',strtotime(Carbon::now()));
				$dh->tongtien = $tongtien;
				$dh->trangthai = 0;
				$dh->makh =$makh;
				$dh->maql = 'QL001';
				$dh->mattdh = 1;
				$dh->mahttt = 1;
				$dh->save();

				$con = Cart::content();
				//Thêm vô bảng chi tiết đơn hàng					
				foreach ($con as $item) {
					$ct = new ChiTietDonHang();	
					$ct->madh = $madh;
					$ct->masp = $item['id'];
					$ct->soluong = $item['qty'];
					$ct->save();
				}						

				//Xóa session
				unset($_SESSION['tenkh']);
				unset($_SESSION['sdt']);
				unset($_SESSION['mailkh']);
				unset($_SESSION['tinh']);
				unset($_SESSION['diachi']);
				unset($_SESSION['tentinh']);
				unset($_SESSION['matinh']);
				unset($_SESSION['content']);
				unset($_SESSION['soluong']);
				unset($_SESSION['tongtien']);
				Cart::destroy();

				$_SESSION['makh'] = $makh;
				$_SESSION['madh'] = $madh;
				return Response::json(['success'=>true]);
			} else {

				$mathe = Request::get('mathe');
				$thang = Request::get('thang');
				$nam = Request::get('nam');
				$ccv = Request::get('ccv');

				$v = Validator::make(Request::all(),
					[
						'mathe'=>'required',
						'thang'=>'required|between:1,12',
						'nam'=>'required',
						'ccv'=>'required'
					],
					[
						'mathe.required'=>'Mã số thẻ không được trống',
						'thang.required'=>'Tháng hết hạn không được trống',
						'thang.between'=>'Tháng không đúng',
						'nam.required'=>'Năm hết hạn không được trống',
						'ccv.required'=>'Mã bảo mật không được trống',
					]);
				if($v->fails()){
					return Response::json(['success'=>false, 'errors'=>$v->errors()->toArray()]);
				} else {

					//Stripe::setApiKey("sk_test_BIOovV7j4J8IVvamJ21CMMPz");
					echo $thang;

				}
			}
		}
	}

}
