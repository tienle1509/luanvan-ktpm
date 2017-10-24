<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\SanPham;
use App\AnhSanPham;
use Image;


class SanPhamNguoiBanController extends Controller
{	

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
			session_start();
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



}
