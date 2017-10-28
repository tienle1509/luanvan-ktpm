<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\SanPham;
use App\AnhSanPham;
use Image;
use App\DanhMucSanPham;
use File;
use Carbon\Carbon;


class SanPhamNguoiBanController extends Controller
{	

/*---------Quản lí sản phẩm home, trang đầu tiên khi đăng nhập vào------------*/
	public function qlSanPhamHome(){
		if(!isset($_SESSION['manb'])){
			header("Location: http://localhost/luanvan-ktpm/nguoiban/dangnhap");	
			exit;
		}
		$manguoiban = $_SESSION['manb'];

		$list_spMoi = DB::table('san_pham as sp')
						->join('danhmuc_sanpham as dm','dm.madm','=','sp.madm')
						->where('sp.trangthai',0)->where('sp.manb', $manguoiban)
						->paginate(10); //Phân trang 
				
		$num_masp = DB::table('san_pham')->where('trangthai',0)->where('manb',$manguoiban)->count('masp');

		return view('nguoiban.sanpham.sanpham_home')->with('list_spMoi',$list_spMoi)->with('num_masp', $num_masp);
	}


/*--------------------Mã sản phẩm tự tăng-------------------------------*/
	public function maSanPham(){
		$list_masp = DB::table('san_pham')->select('masp')->get();
		$max =0;

		foreach ($list_masp as $value) {
			$catchuoi = substr($value->masp, 2);
			if($catchuoi > $max)
				$max = $catchuoi;
		}

		$so = $max+1;
		if($so < 10){
			$masp = 'SP00'.$so;
		} else if($so < 100) {
			$masp = 'SP0'.$so;
		} else if($so > 100){
			$masp = 'SP'.$so;
		}

		return $masp;
	}

/*--------------------Mã ảnh sản phẩm tự tăng------------------------------*/
	public function maAnhSanPham(){
		$list_maanh = DB::table('anh_sanpham')->select('maanh')->get();
		$max = 0;

		foreach ($list_maanh as$value) {
			$catchuoi = substr($value->maanh, 3);
			if($catchuoi > $max)
				$max = $catchuoi;
		}

		$so = $max + 1;
		$maanhsp = 'ASP'.$so;

		return $maanhsp;
	}

 
/*-----------------------Thêm sản phẩm----------------------------*/
	public function getThemSanPham(){
		$list_dm = DB::table('danhmuc_sanpham')->get();

		return view('nguoiban.sanpham.them_sanpham')->with('list_dm', $list_dm);
	}

	public function postLuuSanPham(Request $request){
		$masp = $this->maSanPham();

		$v = Validator::make($request->all(), 
			[
				'anhDaiDien'=>'required',
				'cbxDanhMuc'=>'required',
				'txtTenSanPham'=>'required',
				'txtGia'=>'required',
				'txtSoLuong'=>'required',
				'txtXuatXu'=>'required',
				'cbxBaoHanh'=>'required',
				'txtDPGMH'=>'required',
				'txtKichThuocMH'=>'required',
				'txtHeDieuHanh'=>'required',
				'txtMauSac'=>'required',
				'cbxCameraTruoc'=>'required',
				'cbxCameraSau'=>'required',
				'txtBoNhoTrong'=>'required',
				'txtDungLuongPin'=>'required',
				'txtMoTa'=>'required'
			],
			[
				'anhDaiDien.required'=>'Sản phẩm phải có ít nhất 1 ảnh làm đại diện !',
				'cbxDanhMuc.required'=>'Bạn phải chọn danh mục sản phẩm',
				'txtTenSanPham.required'=>'Tên sản phẩm không được rỗng',
				'txtGia.required'=>'Giá sản phẩm không được rỗng',
				'txtSoLuong.required'=>'Số lượng sản phẩm không được rỗng',
				'txtXuatXu.required'=>'Xuất xứ sản phẩm không được rỗng',
				'cbxBaoHanh.required'=>'Bạn phải chọn thời gian bảo hành',
				'txtDPGMH.required'=>'Độ phân giải màn hình không được rỗng',
				'txtKichThuocMH.required'=>'Bạn phải nhập kích thước màn hình',
				'txtHeDieuHanh.required'=>'Hệ điều hành không được rỗng',
				'txtMauSac.required'=>'Bạn phải nhập màu sản phẩm',
				'cbxCameraTruoc.required'=>'Bạn phải chọn camera trước',
				'cbxCameraSau.required'=>'Bạn phải chọn camera sau',
				'txtBoNhoTrong.required'=>'Bộ nhớ trong không được rỗng',
				'txtDungLuongPin.required'=>'Dung lượng pin không được rỗng',
				'txtMoTa.required'=>'Mô tả sản phẩm không được rỗng'
			]);

		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		else{
			//session_start(); Session bật bên route
			$manguoiban = $_SESSION['manb'];			

			//Lấy tên ảnh đại diện ra
			$tenanhdaidien = $request->file('anhDaiDien')->getClientOriginalName();
			
			//Thêm dữ liệu vào bản sản phẩm
			$sp = new SanPham();
			$sp->masp = $masp;
			$sp->tensp = $request->txtTenSanPham;
			$sp->dongia = $request->txtGia;
			$sp->soluong = $request->txtSoLuong;
			$sp->xuatxu = $request->txtXuatXu;
			$sp->baohanh = $request->cbxBaoHanh;
			$sp->dophangiaimanhinh = $request->txtDPGMH;
			$sp->kichthuocmanhinh = $request->txtKichThuocMH;
			$sp->hedieuhanh = $request->txtHeDieuHanh;
			$sp->mausac = $request->txtMauSac;
			$sp->cameratruoc = $request->cbxCameraTruoc;
			$sp->camerasau = $request->cbxCameraSau;
			$sp->bonhotrong = $request->txtBoNhoTrong;
			$sp->dungluongpin = $request->txtDungLuongPin;
			$sp->mota = $request->txtMoTa;
			$sp->anh = $tenanhdaidien;
			//$sp->luotxem = 0;
			$sp->trangthai = false;
			$sp->manb = $manguoiban;
			$sp->madm = $request->cbxDanhMuc;
			$sp->save();

			//Thêm ảnh chính vô thư mục public/anh-sanpham, nhỏ, trung bình
			$request->file('anhDaiDien')->move('public/anh-sanpham/', $tenanhdaidien);
			Image::make('public/anh-sanpham/'.$tenanhdaidien)->resize(350,350)->save('public/anh-sanpham-trungbinh/'.$tenanhdaidien);
			Image::make('public/anh-sanpham/'.$tenanhdaidien)->resize(42,42)->save('public/anh-sanpham-nho/'.$tenanhdaidien);


			//Thêm ảnh phụ vào bảng ảnh sản phẩm		
			if($request->file('imgListProduct') != ''){
	    		foreach ($request->file('imgListProduct') as $file) {
	    			if(isset($file)){
	    				//Lấy tên ảnh
	    				$tenanhphu = $file->getClientOriginalName();

	    				//Thêm tên ảnh vào bảng ảnh sản phẩm
						$anhsp = new AnhSanPham();
						$anhsp->maanh = $this->maAnhSanPham();
						$anhsp->tenanh = $tenanhphu;
						$anhsp->masp = $masp;
						$anhsp->save(); 

						//Lưu ảnh vào thư mục public/anh-sanpham, nhỏ, trung bình
						$file->move('public/anh-sanpham/',$tenanhphu);
						Image::make('public/anh-sanpham/'.$tenanhphu)->resize(350,350)->save('public/anh-sanpham-trungbinh/'.$tenanhphu);
						Image::make('public/anh-sanpham/'.$tenanhphu)->resize(42,42)->save('public/anh-sanpham-nho/'.$tenanhphu); 
				    }
			    } 
		   	}
			return redirect('nguoiban/ql-sanpham');
		}  
	}

/*-------------------Sản phẩm chờ duyệt------------------------*/
	public function getSPChoDuyet(){
		$list_choduyet = DB::table('san_pham as sp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							->where('sp.trangthai',0)
							->where('sp.manb', $_SESSION['manb'])
							->paginate(10);

		return view('nguoiban.sanpham.sanpham_choduyet')->with('list_choduyet', $list_choduyet);
	}

/*-----------------Sản phẩm hết hàng-----------------------*/
	public function getSPHetHang(){
		$ngayht = Carbon::now();

		$list_hethang = DB::table('san_pham as sp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							->where('sp.soluong',0)
							->where('sp.trangthai',1)
							->where('sp.manb',$_SESSION['manb'])
							->paginate(10);

		$list_khuyenmai = DB::table('khuyen_mai as km')
							->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							->join('san_pham as sp', 'sp.masp', '=', 'ctkm.masp')
							->where('sp.manb', $_SESSION['manb'])
							->get();
							
		$masp_khuyenmai = array();
		foreach ($list_khuyenmai as $val) {
			$masp_khuyenmai[] = $val->masp;
		}

		return view('nguoiban.sanpham.sanpham_hethang')->with('list_hethang',$list_hethang)->with('masp_khuyenmai', $masp_khuyenmai)->with('ngayht',$ngayht);
	}

	public function getTimKiemSPHetHang(Request $request){
		$v = Validator::make($request->all(),
			[
				'key'=>'required'
			],
			[
				'key.required'=>'Bạn chưa nhập từ khóa tìm kiếm'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}
		else {
			$ngayht = Carbon::now();
		
			$masp_nguoiban = DB::table('san_pham')
								->where('manb',$_SESSION['manb'])
								->where('trangthai',1)
								->where('soluong',0)
								->get();

			$arr = array();
			foreach ($masp_nguoiban as $value) {
				$arr[] = $value->masp;
			}

			$masp_result = DB::table('san_pham as sp')
							->join('danhmuc_sanpham as dm', 'sp.madm','=','dm.madm')
							->where('dm.tendanhmuc','like','%'.$request->key.'%')
							->orwhere('sp.tensp','like','%'.$request->key.'%')
							->get();
			
			$result_search = array();
			foreach ($masp_result as $value) {
				if(in_array($value->masp, $arr)){
					$result_search[] = $value->masp;
				}
			}


			return view('nguoiban.sanpham.timkiem_hethang')->with('result_search',$result_search)->with('ngayht',$ngayht); 
		}		
	}

/*--------------------------Tất cả sản phẩm-----------------------------*/
	public function getTatCaSanPham(){
		$ngayht = Carbon::now();

		$list_tatca = DB::table('san_pham as sp')
						->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
						->where('sp.manb',$_SESSION['manb'])
						->get();
		
		$list_khuyenmai = DB::table('khuyen_mai as km')
							->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							->join('san_pham as sp', 'sp.masp', '=', 'ctkm.masp')
							->where('sp.manb', $_SESSION['manb'])
							->get();
		$masp_khuyenmai = array();
		foreach ($list_khuyenmai as $val) {
			$masp_khuyenmai[] = $val->masp;
		}
		
		return view('nguoiban.sanpham.tatca_sanpham')->with('list_tatca', $list_tatca)->with('masp_khuyenmai', $masp_khuyenmai)->with('ngayht',$ngayht);
	}

	public function getTimKiemTatCaSP(Request $request){
		$v = Validator::make($request->all(),
			[
				'key'=>'required'
			],
			[
				'key.required'=>'Bạn chưa nhập từ khóa tìm kiếm'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}
		else {
			$ngayht = Carbon::now();
			$masp_nguoiban = DB::table('san_pham')
								->where('manb',$_SESSION['manb'])
								->get();

			$arr = array();
			foreach ($masp_nguoiban as $value) {
				$arr[] = $value->masp;
			}

			$masp_result = DB::table('san_pham as sp')
							->join('danhmuc_sanpham as dm', 'sp.madm','=','dm.madm')
							->where('dm.tendanhmuc','like','%'.$request->key.'%')
							->orwhere('sp.tensp','like','%'.$request->key.'%')
							->get();
			
			$result_search = array();
			foreach ($masp_result as $value) {
				if(in_array($value->masp, $arr)){
					$result_search[] = $value->masp;
				}
			}

			return view('nguoiban.sanpham.timkiem_tatca')->with('result_search',$result_search)->with('ngayht',$ngayht);
		}
		
	}

/*-----------------Chi tiết sản phẩm, sửa sản phẩm--------------------------*/
	public function getChiTietSanPham($masp){
		$chitiet_sanpham = DB::table('san_pham as sp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							->where('sp.masp', $masp)
							->first();

		$img_ctsp = DB::table('anh_sanpham')->where('masp',$masp)->get();

		return view('nguoiban.sanpham.chitiet_sanpham')->with('chitiet_sanpham', $chitiet_sanpham)->with('img_ctsp',$img_ctsp);
	}

	public function postCapNhatSanPham(Request $request){
		$v = Validator::make($request->all(), 
			[
				'cbxDanhMuc'=>'required',
				'txtTenSP'=>'required',
				'txtGia'=>'required',
				'txtSoLuong'=>'required',
				'txtXuatXu'=>'required',
				'cbxBaoHanh'=>'required',
				'txtDPGMH'=>'required',
				'txtKichThuocMH'=>'required',
				'txtHeDieuHanh'=>'required',
				'txtMauSac'=>'required',
				'cbxCameraTruoc'=>'required',
				'cbxCameraSau'=>'required',
				'txtBoNhoTrong'=>'required',
				'txtDungLuongPin'=>'required',
				'txtMoTa'=>'required'
			],
			[
				'cbxDanhMuc.required'=>'Bạn phải chọn danh mục sản phẩm',
				'txtTenSP.required'=>'Tên sản phẩm không được rỗng',
				'txtGia.required'=>'Giá sản phẩm không được rỗng',
				'txtSoLuong.required'=>'Số lượng sản phẩm không được rỗng',
				'txtXuatXu.required'=>'Xuất xứ sản phẩm không được rỗng',
				'cbxBaoHanh.required'=>'Bạn phải chọn thời gian bảo hành sản phẩm',
				'txtDPGMH.required'=>'Độ phân giản màn hình không được rỗng',
				'txtKichThuocMH.required'=>'Kích thước màn hình không được rỗng',
				'txtHeDieuHanh.required'=>'Hệ điều hành không được rỗng',
				'txtMauSac.required'=>'Màu sắc sản phẩm không được rỗng',
				'cbxCameraTruoc.required'=>'Bạn phải chọn camera trước',
				'cbxCameraSau.required'=>'Bạn phải chọn camera sau',
				'txtBoNhoTrong.required'=>'Bộ nhớ trong không được rỗng',
				'txtDungLuongPin.required'=>'Dung lượng pin không được rỗng',
				'txtMoTa.required'=>'Mô tả sản phẩm không được rỗng'
			]);

		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		} else {
			//Cập nhật lại bảng sản phẩm
			if(!empty($request->file('anhDaiDien'))){
				//Xóa ảnh chính trong thư mục cũ
				$sp = DB::table('san_pham')->where('masp',$request->txtMaSP)->first();
				$duongdan1 = 'public/anh-sanpham/'.$sp->anh;
				$duongdan2 = 'public/anh-sanpham-trungbinh/'.$sp->anh;
				$duongdan3 = 'public/anh-sanpham-nho/'.$sp->anh;

				if(File::exists($duongdan1)){
					File::delete($duongdan1);
				}
				if(File::exists($duongdan2)){
					File::delete($duongdan2);
				}
				if(File::exists($duongdan3)){
					File::delete($duongdan3);
				}

				//Lấy tên ảnh đại diện mới
				$anhmoi = $request->file('anhDaiDien')->getClientOriginalName();

				DB::table('san_pham')->where('masp',$request->txtMaSP)
							->update([
								'tensp'=>$request->txtTenSP,
								'dongia'=>$request->txtGia,
								'soluong'=>$request->txtSoLuong,
								'xuatxu'=>$request->txtXuatXu,
								'baohanh'=>$request->cbxBaoHanh,
								'dophangiaimanhinh'=>$request->txtDPGMH,
								'kichthuocmanhinh'=>$request->txtKichThuocMH,
								'hedieuhanh'=>$request->txtHeDieuHanh,
								'mausac'=>$request->txtMauSac,
								'cameratruoc'=>$request->cbxCameraTruoc,
								'camerasau'=>$request->cbxCameraSau,
								'bonhotrong'=>$request->txtBoNhoTrong,
								'dungluongpin'=>$request->txtDungLuongPin,
								'mota'=>$request->txtMoTa,
								'anh'=>$anhmoi
							]);
				//Thêm ảnh đại diện mới vào thư mục
				$request->file('anhDaiDien')->move('public/anh-sanpham/', $anhmoi);
				Image::make('public/anh-sanpham/'.$anhmoi)->resize(350,350)->save('public/anh-sanpham-trungbinh/'.$anhmoi);
				Image::make('public/anh-sanpham/'.$anhmoi)->resize(42,42)->save('public/anh-sanpham-nho/'.$anhmoi);
			} else {
				DB::table('san_pham')->where('masp',$request->txtMaSP)
							->update([
								'tensp'=>$request->txtTenSP,
								'dongia'=>$request->txtGia,
								'soluong'=>$request->txtSoLuong,
								'xuatxu'=>$request->txtXuatXu,
								'baohanh'=>$request->cbxBaoHanh,
								'dophangiaimanhinh'=>$request->txtDPGMH,
								'kichthuocmanhinh'=>$request->txtKichThuocMH,
								'hedieuhanh'=>$request->txtHeDieuHanh,
								'mausac'=>$request->txtMauSac,
								'cameratruoc'=>$request->cbxCameraTruoc,
								'camerasau'=>$request->cbxCameraSau,
								'bonhotrong'=>$request->txtBoNhoTrong,
								'dungluongpin'=>$request->txtDungLuongPin,
								'mota'=>$request->txtMoTa
							]);
			}

			//Thêm ảnh phụ vào bảng ảnh sản phẩm	
			if($request->file('imgListProduct') != ''){
	    		foreach ($request->file('imgListProduct') as $file) {
	    			if(isset($file)){
	    				//Lấy tên ảnh
	    				$tenanhphu = $file->getClientOriginalName();

	    				//Thêm tên ảnh vào bảng ảnh sản phẩm
						$anhsp = new AnhSanPham();
						$anhsp->maanh = $this->maAnhSanPham();
						$anhsp->tenanh = $tenanhphu;
						$anhsp->masp = $request->txtMaSP;
						$anhsp->save(); 

						//Lưu ảnh vào thư mục public/anh-sanpham, nhỏ, trung bình
						$file->move('public/anh-sanpham/',$tenanhphu);
						Image::make('public/anh-sanpham/'.$tenanhphu)->resize(350,350)->save('public/anh-sanpham-trungbinh/'.$tenanhphu);
						Image::make('public/anh-sanpham/'.$tenanhphu)->resize(42,42)->save('public/anh-sanpham-nho/'.$tenanhphu); 
				    }
			    } 
		   	}
		   	return redirect('nguoiban/ql-sanpham/tatca-sanpham');
		}

	}



}
