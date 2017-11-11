<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;

class CapNhatDonHangController extends Controller
{
/*------------------------------Xóa đơn hàng-------------------------------*/
	public function getXoaDonHang(){
		if(Request::ajax()){
			$madh = Request::get('madh');

			//Lấy mã khách hàng của đơn hàng hiện tại
			$kh = DB::table('don_hang')->select('makh')->where('madh',$madh)->first();

			//Thêm số lượng sản phẩm lại trong bảng sản phẩm khi hủy đơn hàng
			$slsp_capnhat = DB::table('chitiet_donhang')->where('madh',$madh)->get();
			foreach ($slsp_capnhat as $val) {
				//Lấy số lượng sản phẩm hiện tại
				$sl_hientai = DB::table('san_pham')->where('masp',$val->masp)->first();

				DB::table('san_pham')->where('masp',$val->masp)->update(['soluong'=>$sl_hientai->soluong+$val->soluongct]);
			}

			//Xóa đơn hàng trong bảng đơn hàng và bảng chi tiết đơn hàng
			DB::table('chitiet_donhang')->where('madh',$madh)->delete();
			DB::table('don_hang')->where('madh',$madh)->delete();

			//Kiểm tra khách hàng của đơn hàng đó còn đơn hàng nào khác không, nếu không sẽ xóa
			$kh_dh = DB::table('don_hang')->where('makh', $kh->makh)->get();
			if(count($kh_dh) == 0){
				DB::table('khach_hang')->where('makh',$kh->makh)->delete();
			}

			return Response::json(['success'=>true]);
		}
	}

/*------------------------------Xóa đơn hàng-------------------------------*/
	public function getCapNhatDonHang(){
		if(Request::ajax()){
			$madh = Request::get('madh');
			$mattdh = Request::get('mattdh');

			//Cập nhật tình trạng đơn hàng
			DB::table('don_hang')->where('madh',$madh)->update(['mattdh'=>$mattdh]);

			return Response::json(['success'=>true]);
		}
	}



}
