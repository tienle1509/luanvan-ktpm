<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\SanPham;
use App\AnhSanPham;
use Image;
use App\DanhMucSanPham;


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
				'cbxKichThuocMH'=>'required',
				'txtHeDieuHanh'=>'required',
				'cbxMauSac'=>'required',
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
				'cbxKichThuocMH.required'=>'Bạn phải chọn kích thước màn hình',
				'txtHeDieuHanh.required'=>'Hệ điều hành không được rỗng',
				'cbxMauSac.required'=>'Bạn phải chọn màu sản phẩm',
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
			$sp->kichthuocmanhinh = $request->cbxKichThuocMH;
			$sp->hedieuhanh = $request->txtHeDieuHanh;
			$sp->mausac = $request->cbxMauSac;
			$sp->cameratruoc = $request->cbxCameraTruoc;
			$sp->camerasau = $request->cbxCameraSau;
			$sp->bonhotrong = $request->txtBoNhoTrong;
			$sp->dungluongpin = $request->txtDungLuongPin;
			$sp->mota = $request->txtMoTa;
			$sp->anh = $tenanhdaidien;
			$sp->luotxem = 0;
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
		$list_hethang = DB::table('san_pham as sp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							->where('sp.soluong',0)
							->where('sp.trangthai',1)
							->where('sp.manb',$_SESSION['manb'])
							->paginate(10);

		return view('nguoiban.sanpham.sanpham_hethang')->with('list_hethang',$list_hethang);
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


			return view('nguoiban.sanpham.timkiem_hethang')->with('result_search',$result_search); 
		}		
	}


}
