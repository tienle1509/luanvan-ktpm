<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Cart;
use App\KhachHang;
use App\DonHang;
use App\ChiTietDonHang;

class HomeKhachHangController extends Controller
{
    public function getHomeKhachHang(){
    	$ngayht = Carbon::now();

    	$list_sp = DB::table('san_pham')
    				->where('trangthai',1)
    				->where('soluong','>',0)
    				->get();

    	$ma_giam = array();
    	foreach ($list_sp as $val) {
    		$ma_giam[] = $val->masp;
    	}
    	//Sắp xếp mã sản phẩm giảm dần
    	rsort($ma_giam);

    	/*for ($i=0; $i <10 ; $i++) { 
    		foreach ($sp as $val) {
	    		if ($val->masp == $sp_giam[$i]) {
	    			echo $val->masp.'	'.$val->tensp.'<br>';
	    		}
    		}
    	}   */

    	return view('khachhang.home')->with('list_sp',$list_sp)->with('ma_giam',$ma_giam)->with('ngayht',$ngayht);
    }

/*------------------------Tìm kiếm sản phẩm--------------------------------*/
	public function getTimKiemSanPham(Request $request){
		$v = Validator::make($request->all(),
			[
				'keysearch'=>'required'
			]);

		if($v->fails()){
			return redirect('home');
		} else {

			$ngayht = Carbon::now();

			if($request->searchdanhmuc == ''){
				$result_search = DB::table('san_pham as sp')
									->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
									->where('sp.soluong', '>', 0)
									->where('sp.trangthai',1)
									->where('sp.tensp', 'like', '%'.$request->keysearch.'%')
									->paginate(20);				
				return view('khachhang.timkiem')->with('result_search', $result_search)->with('keynhap',$request->keysearch)->with('ngayht',$ngayht);
			} 
			else {
				$searchdm = DB::table('danhmuc_sanpham')
								->where('madm',$request->searchdanhmuc)
								->first();

				$result_search = DB::table('san_pham as sp')
									->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
									->where('sp.soluong', '>', 0)
									->where('sp.trangthai',1)
									->where('sp.tensp', 'like', '%'.$request->keysearch.'%')
									->where('dm.madm',$request->searchdanhmuc)
									->paginate(20);

				return view('khachhang.timkiem')->with('result_search', $result_search)->with('searchdm',$searchdm)->with('ngayht',$ngayht);
			}		
		}
	}



/*---------------------------Chi tiết sản phẩm-------------------------------------*/
	public function getChiTietSanPham($masp){
		$ngayht = Carbon::now();

		$chitietsp = DB::table('san_pham as sp')
						->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
						->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
						->where('sp.masp', $masp)
						->first();


		return view('khachhang.chitiet_sanpham')->with('chitietsp',$chitietsp)->with('ngayht',$ngayht);
	}


/*---------------------------Nhập thông tin đặt hàng-------------------------------*/
	public function getNhapThongTin(){
		//Thay đổi khi sử dụng script
		$content = Cart::content();
		$sl = Cart::count();
		$tongtien = Cart::total();

		return view('khachhang.nhap_thongtin_donhang', compact('content', 'sl', 'tongtien'));
	}


/*---------------------------Nhập thông tin đặt hàng-------------------------------*/
	public function postNhapThongTin(Request $request){
		$v = Validator::make($request->all(), 
			[
				'txtTen'=>'required',
				'txtSDT'=>'required|between:10,11',
				'txtMail'=>'required|email',
				'cbxtinh'=>'required',
				'txtDiaChi'=>'required'
			],
			[
				'txtTen.required'=>'Tên không được để trống',
				'txtSDT.required'=>'Số điện thoại không được để trống',
				'txtSDT.between'=>'Số điện thoại không đúng định dạng',
				'txtMail.required'=>'Email không được để rỗng',
				'txtMail.email'=>'Email không đúng định dạng',
				'cbxtinh.required'=>'Tỉnh không được để trống',
				'txtDiaChi.required'=>'Địa chỉ không được để trống'
			]);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}else{

			//Lấy email trong bảng khách hàng là thành viên
			$email = DB::table('khach_hang')
						->where('email',$request->txtMail)
						->where('thanhvien',1)
						->first();

			//Nếu email có trùng hay không
			if(!empty($email)){
				$errors['txtMail'] = 'Email này đã đăng kí tài khoản trên hệ thống. Vui lòng đăng nhập !';
    			return redirect()->back()->withInput()->withErrors($errors);
			} else{
				$tinh = DB::table('phi_vanchuyen')
							->where('matinh',$request->cbxtinh)
							->first();

				$_SESSION['tenkh'] = $request->txtTen;
				$_SESSION['sdt'] = $request->txtSDT;
				$_SESSION['mailkh'] = $request->txtMail;
				$_SESSION['tinh'] = $request->cbxtinh;
				$_SESSION['diachi'] = $request->txtDiaChi;
				$_SESSION['tentinh'] = $tinh->tentinh;
				$_SESSION['matinh'] = $request->cbxtinh;

				return redirect('hinhthucthanhtoan');
			}			
		}
	}


/*---------------------------Hình thức thanh toán-------------------------------*/
	public function getHinhThucThanhToan(){
		$content = Cart::content();
		$sl = Cart::count();
		$tongtien = Cart::total();
		$phiship = DB::table('phi_vanchuyen as vc')
						->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
						->where('vc.matinh',$_SESSION['matinh'])
						->first();

		return view('khachhang.hinhthucthanhtoan', compact('content', 'sl', 'tongtien','phiship'));
	}

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
/*---------------------------Thanh toán trực tuyến---------------------------*/
	public function getThanhToanTrucTuyen(){
		if(Cart::total() == ''){
			return redirect('home');
		}
		return view('khachhang.thanhtoantructuyen');
	}

/*---------------------------Đặt hàng -------------------------------*/
	public function postDatHang(Request $request){
		$httt = $request->httt;
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
				$dh->maql = '';
				$dh->mattdh = 0;
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
				return redirect('dathang-thanhcong');
			} else {
				return redirect('thanhtoan-tructuyen');
			}
	}

/*---------------------------Thanh toán trực tuyến-------------------------------*/
	public function postThanhToanTrucTuyen(Request $request){
		$makh = $this->maKhachHang();
		$madh = $this->maDonHang();
		if(Cart::total() > 300000){
			$tongtien = Cart::total();
		}else{
			$phiship = DB::table('phi_vanchuyen as vc')
						->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
						->where('vc.matinh', $_SESSION['matinh'])
						->first();
			$tongtien = Cart::total()+$phiship->giacuoc;
		}
		
		\Stripe\Stripe::setApiKey("sk_test_5Dk4nOpbO6NiOkPiSzoXGv3X");
		try {
			\Stripe\Charge::create(array(
  				"amount" => number_format(($tongtien/22714.34),2)*100,
  				"currency" => "usd",
  				"source" => $request->stripeToken, // obtained with Stripe.js
  				"description" => $_SESSION['mailkh']
			));

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

			//Thêm thông tin vô bảng đơn hàng
			$dh = new DonHang();
			$dh->madh = $madh;
			$dh->ngaydat = date('Y-m-d',strtotime(Carbon::now()));
			$dh->tongtien = $tongtien;
			$dh->trangthai = 0;
			$dh->makh =$makh;
			$dh->maql = '';
			$dh->mattdh = 0;
			$dh->mahttt = 2;
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
			return redirect('dathang-thanhcong');
		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}  
	}


/*---------------------------Đặt hàng thành công-------------------------------*/
	public function getDatHangThanhCong(){
		return view('khachhang.dathang_thanhcong');
	}


}


