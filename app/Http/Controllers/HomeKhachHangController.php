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
    				->orderBy('masp', 'desc')
    				->get();
    	
    	return view('khachhang.home')->with('list_sp',$list_sp)->with('ngayht',$ngayht);
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
									->get();				
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
						->where('sp.soluong','>',0)
						->first();
		if(count($chitietsp) == 0){
			header("Location: http://localhost/luanvan-ktpm/home");	
			exit;
		}

		$nhanxet = DB::table('nhanxet_danhgia')
					->where('masp', $chitietsp->masp)
					->orderBy('thoigiannxdg', 'desc')
					->paginate(10);
		
		return view('khachhang.chitiet_sanpham')
				->with('chitietsp',$chitietsp)
				->with('ngayht',$ngayht)
				->with('nhanxet',$nhanxet);
	}


/*---------------------------Nhập thông tin đặt hàng-------------------------------*/
	public function getNhapThongTin(){
		if(isset($_SESSION['makh'])){
			$dc = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();
		}


		if(!empty($dc->diachigiaohang)){
			return redirect('hinhthucthanhtoan');
		}else{
			$ngayht = Carbon::now();

			//Thay đổi khi sử dụng script
			$content = Cart::content();
			$sl = Cart::count();
			$tongtien = Cart::total();

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

			return view('khachhang.nhap_thongtin_donhang', compact('content', 'sl', 'tongtien', 'count_manb'));
		}
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
		if(isset($_SESSION['makh'])){
			$dc = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();
		}

		if(!empty($dc->diachigiaohang)){//Đã đăng nhập và có địa chỉ
			$ngayht = Carbon::now();

			$content = Cart::content();
			$sl = Cart::count();
			$tongtien = Cart::total();

			$kh = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();

			//Cắt chuỗi địa chỉ giao hàng lấy mã tỉnh
			$tinh = DB::table('phi_vanchuyen')->get();
			$matinh = '';
		   	foreach ($tinh as $val) { 
		  		if(mb_stripos($kh->diachigiaohang, $val->tentinh)){
		   			$matinh += $val->matinh;
		   			break;
		   		}				    		
		   	}

		   	$phiship = DB::table('phi_vanchuyen as vc')
						->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
						->where('vc.matinh',$matinh)
						->first();

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

			return view('khachhang.hinhthucthanhtoan', compact('content', 'sl', 'tongtien','phiship', 'count_manb', 'matinh'));
		}else{
			$ngayht = Carbon::now();

			$content = Cart::content();
			$sl = Cart::count();
			$tongtien = Cart::total();
			$phiship = DB::table('phi_vanchuyen as vc')
							->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
							->where('vc.matinh',$_SESSION['matinh'])
							->first();

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


			return view('khachhang.hinhthucthanhtoan', compact('content', 'sl', 'tongtien','phiship', 'count_manb'));
		}
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

/*---------------------------Mã khách hàng tự tăng-------------------------------*/
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
		$ngayht = Carbon::now();
		$httt = $request->httt;
		if(isset($_SESSION['makh'])){
			$makh = $_SESSION['makh'];
		}else{
			$makh = $this->maKhachHang();	
		}

		if($httt == 1){			
			$content = Cart::content();
			//Lấy mã từng nhà bán hàng
			$arr_manb = array();
			foreach ($content as $item) {
				$sanpham = DB::table('san_pham')->where('masp',$item['id'])->first();
				if(!in_array($sanpham->manb, $arr_manb)){
					$arr_manb[] = $sanpham->manb;
				}
			}
			if(isset($_SESSION['makh'])){
				$dc = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();
			}

			if(!empty($dc->diachigiaohang)){//Đã đăng nhập và địa chỉ rỗng
				$madh_thanhvien = array();
				//Mỗi nhà bán hàng là 1 đơn hàng      
	            foreach ($arr_manb as $val) {               	
					$madh = $this->maDonHang();  
					$madh_thanhvien[] = $madh;             	
					
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

	                if($tongtien_manb >= 300000){
	                	$tongtien_manb = $tongtien_manb;
	                }else{
	                	$kh = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();

						//Cắt chuỗi địa chỉ giao hàng lấy mã tỉnh
						$tinh = DB::table('phi_vanchuyen')->get();
						$matinh = '';
					   	foreach ($tinh as $valtinh) { 
					  		if(mb_stripos($kh->diachigiaohang, $valtinh->tentinh)){
					   			$matinh += $valtinh->matinh;
					   			break;
					   		}				    		
					   	}
	                	$phiship = DB::table('phi_vanchuyen as vc')
									->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
									->where('vc.matinh', $matinh)
									->first();
						$tongtien_manb = $tongtien_manb + $phiship->giacuoc;
	                }

	                //Thêm thông tin vô bảng đơn hàng
					$dh = new DonHang();
					$dh->madh = $madh;
					$dh->ngaydat = date('Y-m-d',strtotime(Carbon::now()));
					$dh->tongtien = $tongtien_manb;
					$dh->trangthai = 0;
					$dh->makh =$_SESSION['makh'];
					$dh->maql = '';
					$dh->mattdh = 0;
					$dh->mahttt = 1;
					$dh->save();	


					foreach ($content as $item) {
	                    $sp = DB::table('san_pham')
	                            ->where('masp',$item['id'])
	                            ->where('manb',$val)
	                            ->get();                
	                    foreach ($sp as $valsp) {
	                       	//Thêm vô bảng chi tiết đơn hàng					
							$ct = new ChiTietDonHang();	
							$ct->madh = $madh;
							$ct->masp = $item['id'];
							$ct->manb = $valsp->manb;
							$ct->soluongct = $item['qty'];
							$ct->save();

							//Giảm số lượng sản phẩm xuống
							DB::table('san_pham')->where('masp',$item['id'])
								->update(['soluong'=>$valsp->soluong-$item['qty']]);
	                    }
	                }    						
	            }

	            //Xóa session
				unset($_SESSION['content']);
				unset($_SESSION['soluong']);
				unset($_SESSION['tongtien']);
				Cart::destroy();

				$_SESSION['madh_thanhvien'] = $madh_thanhvien;

				return redirect('dathang-thanhcong');
			}else{
				if(isset($_SESSION['makh'])){
					//Thêm thông tin giao hàng vào bảng
					DB::table('khach_hang')->where('makh',$_SESSION['makh'])
							->update([
								'tenkh'=>$_SESSION['tenkh'],
								'sodienthoai'=>$_SESSION['sdt'],
								'diachigiaohang'=>$_SESSION['diachi'].', '.$_SESSION['tentinh']
							]);
				}else{
					//Thêm thông tin vô bảng khách hàng
					$kh = new KhachHang();
					$kh->makh = $makh;
					$kh->tennguoidung = '';
					$kh->tenkh = $_SESSION['tenkh'];
					$kh->email = $_SESSION['mailkh'];
					$kh->matkhau = '';
					$kh->sodienthoai = $_SESSION['sdt'];
					$kh->diachigiaohang = $_SESSION['diachi'].', '.$_SESSION['tentinh'];
					$kh->thanhvien = 0;
					$kh->ngaytao = date('Y-m-d',strtotime(Carbon::now()));
					$kh->save();
				}

				//Mỗi nhà bán hàng là 1 đơn hàng      
	            foreach ($arr_manb as $val) {               	
					$madh = $this->maDonHang();               	
					
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

	                if($tongtien_manb >= 300000){
	                	$tongtien_manb = $tongtien_manb;
	                }else{
	                	$phiship = DB::table('phi_vanchuyen as vc')
									->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
									->where('vc.matinh', $_SESSION['matinh'])
									->first();
						$tongtien_manb = $tongtien_manb + $phiship->giacuoc;
	                }

	                //Thêm thông tin vô bảng đơn hàng
					$dh = new DonHang();
					$dh->madh = $madh;
					$dh->ngaydat = date('Y-m-d',strtotime(Carbon::now()));
					$dh->tongtien = $tongtien_manb;
					$dh->trangthai = 0;
					$dh->makh =$makh;
					$dh->maql = '';
					$dh->mattdh = 0;
					$dh->mahttt = 1;
					$dh->save();	


					foreach ($content as $item) {
	                    $sp = DB::table('san_pham')
	                            ->where('masp',$item['id'])
	                            ->where('manb',$val)
	                            ->get();                
	                    foreach ($sp as $valsp) {
	                       	//Thêm vô bảng chi tiết đơn hàng					
							$ct = new ChiTietDonHang();	
							$ct->madh = $madh;
							$ct->masp = $item['id'];
							$ct->manb = $valsp->manb;
							$ct->soluongct = $item['qty'];
							$ct->save();

							//Giảm số lượng sản phẩm xuống
							DB::table('san_pham')->where('masp',$item['id'])
								->update(['soluong'=>$valsp->soluong-$item['qty']]);
	                    }
	                }    						
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
				return redirect('dathang-thanhcong');
			}	
		} else {
			return redirect('thanhtoan-tructuyen');
		}
	}

/*---------------------------Thanh toán trực tuyến-------------------------------*/
	public function postThanhToanTrucTuyen(Request $request){
		if(isset($_SESSION['makh'])){
			$makh = $_SESSION['makh'];
		}else{
			$makh = $this->maKhachHang();	
		}
		
		$content = Cart::content();
		//Lấy mã từng nhà bán hàng
		$arr_manb = array();
		foreach ($content as $item) {
			$sanpham = DB::table('san_pham')->where('masp',$item['id'])->first();
			if(!in_array($sanpham->manb, $arr_manb)){
				$arr_manb[] = $sanpham->manb;
			}
		}

		if(isset($_SESSION['makh'])){
			$dc = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();
		}

		if(!empty($dc->diachigiaohang)){//Đã đăng nhập và địa chỉ không rỗng
			$madh_thanhvien = array();
			//Mỗi nhà bán hàng là 1 đơn hàng   
			$tongtien_tatcadh = 0;   
	        foreach ($arr_manb as $val) {               	
				$madh = $this->maDonHang();   
				$madh_thanhvien[] = $madh;              	
				
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

	            if($tongtien_manb >= 300000){
	              	$tongtien_manb = $tongtien_manb;
	              	$tongtien_tatcadh += $tongtien_manb;
	            }else{
	            	$kh = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();

					//Cắt chuỗi địa chỉ giao hàng lấy mã tỉnh
					$tinh = DB::table('phi_vanchuyen')->get();
					$matinh = '';
					foreach ($tinh as $valtinh) { 
						if(mb_stripos($kh->diachigiaohang, $valtinh->tentinh)){
							$matinh += $valtinh->matinh;
							break;
						}				    		
					}
	                $phiship = DB::table('phi_vanchuyen as vc')
								->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
								->where('vc.matinh', $matinh)
								->first();

					$tongtien_manb = $tongtien_manb + $phiship->giacuoc;
					$tongtien_tatcadh += $tongtien_manb;
	            }

	            //Thêm thông tin vô bảng đơn hàng
				$dh = new DonHang();
				$dh->madh = $madh;
				$dh->ngaydat = date('Y-m-d',strtotime(Carbon::now()));
				$dh->tongtien = $tongtien_manb;
				$dh->trangthai = 0;
				$dh->makh =$makh;
				$dh->maql = '';
				$dh->mattdh = 0;
				$dh->mahttt = 2;
				$dh->save();	



				foreach ($content as $item) {
	                $sp = DB::table('san_pham')
	                        ->where('masp',$item['id'])
	                        ->where('manb',$val)
	                        ->get();                
	                foreach ($sp as $valsp) {
	                  	//Thêm vô bảng chi tiết đơn hàng					
						$ct = new ChiTietDonHang();	
						$ct->madh = $madh;
						$ct->masp = $item['id'];
						$ct->manb = $valsp->manb;
						$ct->soluongct = $item['qty'];
						$ct->save();

						//Giảm số lượng sản phẩm xuống
						DB::table('san_pham')->where('masp',$item['id'])
							->update(['soluong'=>$valsp->soluong-$item['qty']]);
	                }
	            }               				
	        }
	        $kh = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();

	        \Stripe\Stripe::setApiKey("sk_test_5Dk4nOpbO6NiOkPiSzoXGv3X");
			try {
				\Stripe\Charge::create(array(
		  			"amount" => number_format(($tongtien_tatcadh/22714.34),2)*100,
		  			"currency" => "usd",
		  			"source" => $request->stripeToken, // obtained with Stripe.js
		  			"description" => $kh->email
		  		));
			} catch (Exception $e) {
				return redirect()->back()->withErrors($e->getMessage());
			} 
						
			//Xóa session			
			unset($_SESSION['content']);
			unset($_SESSION['soluong']);
			unset($_SESSION['tongtien']);
			Cart::destroy();

			$_SESSION['madh_thanhvien'] = $madh_thanhvien;
			return redirect('dathang-thanhcong');	
		}else{//Đã đăng nhập chưa nhập địa chỉ và khách vãng lai
			if(isset($_SESSION['makh'])){
				//Thêm thông tin giao hàng vào bảng
				DB::table('khach_hang')->where('makh',$_SESSION['makh'])
						->update([
							'tenkh'=>$_SESSION['tenkh'],
							'sodienthoai'=>$_SESSION['sdt'],
							'diachigiaohang'=>$_SESSION['diachi'].', '.$_SESSION['tentinh']
						]);
			}else{
				//Thêm thông tin vô bảng khách hàng
				$kh = new KhachHang();
				$kh->makh = $makh;
				$kh->tennguoidung = '';
				$kh->tenkh = $_SESSION['tenkh'];
				$kh->email = $_SESSION['mailkh'];
				$kh->matkhau = '';
				$kh->sodienthoai = $_SESSION['sdt'];
				$kh->diachigiaohang = $_SESSION['diachi'].', '.$_SESSION['tentinh'];
				$kh->thanhvien = 0;
				$kh->ngaytao = date('Y-m-d',strtotime(Carbon::now()));
				$kh->save();
			}

			//Mỗi nhà bán hàng là 1 đơn hàng   
			$tongtien_tatcadh = 0;   
	        foreach ($arr_manb as $val) {               	
				$madh = $this->maDonHang();               	
				
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

	            if($tongtien_manb >= 300000){
	              	$tongtien_manb = $tongtien_manb;
	              	$tongtien_tatcadh += $tongtien_manb;
	            }else{
	              	$phiship = DB::table('phi_vanchuyen as vc')
								->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
								->where('vc.matinh', $_SESSION['matinh'])
								->first();
					$tongtien_manb = $tongtien_manb + $phiship->giacuoc;
					$tongtien_tatcadh += $tongtien_manb;
	            }

	            //Thêm thông tin vô bảng đơn hàng
				$dh = new DonHang();
				$dh->madh = $madh;
				$dh->ngaydat = date('Y-m-d',strtotime(Carbon::now()));
				$dh->tongtien = $tongtien_manb;
				$dh->trangthai = 0;
				$dh->makh =$makh;
				$dh->maql = '';
				$dh->mattdh = 0;
				$dh->mahttt = 2;
				$dh->save();	



				foreach ($content as $item) {
	                $sp = DB::table('san_pham')
	                        ->where('masp',$item['id'])
	                        ->where('manb',$val)
	                        ->get();                
	                foreach ($sp as $valsp) {
	                  	//Thêm vô bảng chi tiết đơn hàng					
						$ct = new ChiTietDonHang();	
						$ct->madh = $madh;
						$ct->masp = $item['id'];
						$ct->manb = $valsp->manb;
						$ct->soluongct = $item['qty'];
						$ct->save();

						//Giảm số lượng sản phẩm xuống
						DB::table('san_pham')->where('masp',$item['id'])
							->update(['soluong'=>$valsp->soluong-$item['qty']]);
	                }
	            }               				
	        }
	        \Stripe\Stripe::setApiKey("sk_test_5Dk4nOpbO6NiOkPiSzoXGv3X");
			try {
				\Stripe\Charge::create(array(
		  			"amount" => number_format(($tongtien_tatcadh/22714.34),2)*100,
		  			"currency" => "usd",
		  			"source" => $request->stripeToken, // obtained with Stripe.js
		  			"description" => $_SESSION['mailkh']
		  		));
			} catch (Exception $e) {
				return redirect()->back()->withErrors($e->getMessage());
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
			return redirect('dathang-thanhcong');	
	    }        	 
	}


/*---------------------------Đặt hàng thành công-------------------------------*/
	public function getDatHangThanhCong(){
		if(!isset($_SESSION['makh'])){
			header("Location: http://localhost/luanvan-ktpm/home");	
			exit;
		}else{
			$kh_thanhvien = DB::table('khach_hang')
								->where('makh',$_SESSION['makh'])
								->where('thanhvien',1)
								->first();
			if(count($kh_thanhvien) != 0){
				if(!isset($_SESSION['madh_thanhvien'])){
					header("Location: http://localhost/luanvan-ktpm/home");	
					exit;
				}
			}
		}

		return view('khachhang.dathang_thanhcong');
	}

/*-----------------------Chi tiết danh mục-----------------------------*/
	public function getChiTietDanhMuc($madm){
		$ngayht = Carbon::now();

		return view('khachhang.chitiet_danhmuc')->with('madm',$madm)->with('ngayht',$ngayht);
	}

/*-----------------------Sản phẩm bán chạy-----------------------------*/
	public function getSanPhamBanChay(){
		$ngayht = Carbon::now();

		$sp_banchay = DB::table('san_pham as sp')->select('sp.masp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							 ->where('sp.soluong', '>', 0)
							->where('sp.trangthai',1)
							->get();

		$mang_masp = array(); 
		foreach ($sp_banchay as $val) {
			$sl_ma = DB::table('chitiet_donhang')->where('masp',$val->masp)->sum('soluongct');
			$mang_masp[$val->masp] = $sl_ma;
		}

		arsort($mang_masp);	

		return view('khachhang.sanpham_banchay')->with('ngayht',$ngayht)->with('mang_masp',$mang_masp);
	}

/*-----------------------Khuyến mãi----------------------------*/
	public function getKhuyenMai(){
		$ngayht = Carbon::now();
		$ds_khuyenmai = DB::table('khuyen_mai')->get();

		return view('khachhang.khuyenmai')->with('ds_khuyenmai',$ds_khuyenmai)->with('ngayht',$ngayht);
	}

	public function getChiTietKhuyenMai($makm){
		$tenkm = DB::table('khuyen_mai')->where('makm',$makm)->first();

		$dsspkm = DB::table('khuyen_mai as km')
						->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
						->join('san_pham as sp', 'sp.masp', '=', 'ctkm.masp')
						->where('km.makm',$makm)
						->where('sp.soluong', '>',0)
						->paginate(20);

		return view('khachhang.chitiet_khuyenmai')->with('tenkm', $tenkm)->with('dsspkm', $dsspkm);
	}	

}


