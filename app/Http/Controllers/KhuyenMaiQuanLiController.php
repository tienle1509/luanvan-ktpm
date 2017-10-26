<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\KhuyenMai;
use File;

class KhuyenMaiQuanLiController extends Controller
{

/*--------------------Trang chủ khuyến mãi-----------------------------*/
	public function getHomeKhuyenMai(){
		$list_km = DB::table('khuyen_mai')->get();

		return view('quanli.khuyenmai')->with('list_km', $list_km);
	}


/*--------------------Mã khuyến mãi tự tăng-----------------------------*/
	public function maKhuyenMai(){
		$km = DB::table('khuyen_mai')->select('makm')->get();
		$max = 0;

		foreach ($km as $value) {
			$cat_chuoi = substr($value->makm, 2);
			if($cat_chuoi > $max)
				$max = $cat_chuoi;
		}

		$chuoi_so = $max+1;
		if($chuoi_so < 10){
            $makm = 'KM00'.$chuoi_so;
        }else{
            $makm = 'KM0'.$chuoi_so;
        }
        return $makm;
	}

/*--------------------Thêm khuyến mãi-----------------------------*/
	public function getThemKhuyenMai(){
		return view('quanli.khuyenmai.them_khuyenmai');
	}

	public function postThemKhuyenMai(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtTenKM'=>'required',
				'txtBatDau'=>'required',
				'txtKetThuc'=>'required',
				'txtChietKhau'=>'required',
				'txtHanDK'=>'required',
				'txtMoTa'=>'required',
				'imgKM'=>'required'
			],
			[
				'txtTenKM.required'=>'Tên khuyến mãi không được rỗng',
				'txtBatDau.required'=>'Ngày bắt đầu không được rỗng',
				'txtKetThuc.required'=>'Ngày kết thúc không được rỗng',
				'txtChietKhau.required'=>'Chiết khấu không được rỗng',
				'txtHanDK.required'=>'Hạn đăng kí không được rỗng',
				'txtMoTa.required'=>'Mô tả khuyến mãi không được rỗng',
				'imgKM.required'=>'Ảnh khuyến mãi không được rỗng'
			]);

		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		} else {

			$makm = $this->maKhuyenMai();
			//Lấy tên ảnh khuyến mãi
			$tenanh = $request->file('imgKM')->getClientOriginalName();

			$km = new KhuyenMai();
			$km->makm = $makm;
			$km->ngaybd = date('Y-m-d', strtotime($request->txtBatDau));
			$km->ngaykt = date('Y-m-d',strtotime($request->txtKetThuc));
			$km->handangki = date('Y-m-d',strtotime($request->txtHanDK));
			$km->tenkm = $request->txtTenKM;
			$km->mota = $request->txtMoTa;
			$km->chietkhau = $request->txtChietKhau;
			$km->anhkm = $tenanh;
			$km->maql = $_SESSION['maql'];
			$km->save();

			//Thêm ảnh vô thư mục khuyến mãi
			$request->file('imgKM')->move('public/anh-khuyenmai/',$tenanh);

			return redirect('quanli/khuyenmai');
		}
	}

/*--------------------Chi tiết, sửa khuyến mãi-----------------------------*/
	public function getChiTietKhuyenMai($makm){
		$chitiet_km = DB::table('khuyen_mai')->where('makm',$makm)->first();

		return view('quanli.khuyenmai.chitiet_khuyenmai')->with('chitiet_km',$chitiet_km);
	}

	public function postCapNhatKhuyenMai(Request $request){
		$v = Validator::make($request->all(),
			[
				'txtTenKM'=>'required',
				'txtngaybd'=>'required',
				'txtngaykt'=>'required',
				'txtChietKhau'=>'required',
				'txthandk'=>'required',
				'txtMoTa'=>'required'
			],
			[
				'txtTenKM.required'=>'Tên khuyến mãi không được rỗng',
				'txtngaybd.required'=>'Ngày bắt đầu không được rỗng',
				'txtngaykt.required'=>'Ngày kết thúc không được rỗng',
				'txtChietKhau.required'=>'Chiết khấu không được rỗng',
				'txthandk.required'=>'Hạn đăng kí không được rỗng',
				'txtMoTa.required'=>'Mô tả sản phẩm không được rỗng'
			]);
		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		} else {
			//Cập nhật lại trong bảng khuyến mãi
			if(!empty($request->file('anhKM'))){
				//Xóa ảnh cũ trong thư mục
				$anhcu = DB::table('khuyen_mai')->where('makm',$request->txtMaKM)->first();
				$duongdan = 'public/anh-khuyenmai/'.$anhcu->anhkm;
				if(File::exists($duongdan)){
					File::delete($duongdan);
				}

				//Lấy tên ảnh mới 
				$anhmoi = $request->file('anhKM')->getClientOriginalName();
				//Thêm ảnh mới vào thư mục
				$request->file('anhKM')->move('public/anh-khuyenmai/',$anhmoi);
				//Cập nhật lại csdl
				DB::table('khuyen_mai')->where('makm',$request->txtMaKM)
						->update([
							'ngaybd'=>date('Y-m-d',strtotime($request->txtngaybd)),
							'ngaykt'=>date('Y-m-d',strtotime($request->txtngaykt)),
							'handangki'=>date('Y-m-d',strtotime($request->txthandk)),
							'tenkm'=>$request->txtTenKM,
							'mota'=>$request->txtMoTa,
							'chietkhau'=>$request->txtChietKhau,
							'anhkm'=>$anhmoi,
							'maql'=>$_SESSION['maql']
						]);
			} else {
				DB::table('khuyen_mai')->where('makm',$request->txtMaKM)
						->update([
							'ngaybd'=>date('Y-m-d',strtotime($request->txtngaybd)),
							'ngaykt'=>date('Y-m-d',strtotime($request->txtngaykt)),
							'handangki'=>date('Y-m-d',strtotime($request->txthandk)),
							'tenkm'=>$request->txtTenKM,
							'mota'=>$request->txtMoTa,
							'chietkhau'=>$request->txtChietKhau,
							'maql'=>$_SESSION['maql']
						]);
			}
			return redirect('quanli/khuyenmai');
		}

	}

/*--------------------Danh sách sản phẩm khuyến mãi-----------------------------*/
	public function getDSSanPhamKhuyenMai(){
		

		return view('quanli.khuyenmai.sanpham_km');
	}

}
