<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*--------------------GIAO DIỆN QUẢN LÍ----------------------------*/

//Đăng nhập quản lí
Route::get('quanli/dangnhap', function(){
	return view('auth/dangnhap_quanli');
});


Route::group(['prefix'=>'quanli'], function(){

	//Quản lí sản phẩm
	Route::get('ql-sanpham', function (){
		return view('quanli.sanpham.sanpham_home');
	});
	Route::group(['prefix'=>'ql-sanpham'], function(){
		Route::get('duyet-sanpham', function () {
			return view('quanli.sanpham.duyet_sanpham');
		});
		Route::get('sanpham-trongngay', function () {
			return view('quanli.sanpham.sanpham_trongngay');
		});
		Route::get('tatca-sanpham', function () {
			return view('quanli.sanpham.tatca_sanpham');
		});
		Route::get('chitiet-sanpham', function () {
			return view('quanli.sanpham.chitiet_sanpham');
		});
	});


	//Quản lí đơn hàng
	Route::get('ql-donhang',function () {
		return view('quanli.donhang.donhang_home');
	});
	Route::group(['prefix'=>'ql-donhang'], function(){
		Route::get('duyet-donhang',function(){
			return view('quanli.donhang.duyet_donhang');
		});
		Route::get('donhang-trongngay',function(){
			return view('quanli.donhang.donhang_trongngay');
		});
		Route::get('tatca-donhang',function(){
			return view('quanli.donhang.tatca_donhang');
		});
		Route::get('chitiet-donhang',function(){
			return view('quanli.donhang.chitiet_donhang');
		});
	});


	//Quản lí khuyến mãi
	Route::get('khuyenmai', function(){
		return view('quanli.khuyenmai');
	});
	Route::group(['prefix'=>'khuyenmai'], function(){
		Route::get('them-khuyenmai', function(){
			return view('quanli.khuyenmai.them_khuyenmai');
		});
		Route::get('chitiet-khuyenmai', function(){
			return view('quanli.khuyenmai.chitiet_khuyenmai');
		});
			Route::group(['prefix'=>'chitiet-khuyenmai'], function(){
				Route::get('dssanphamkm', function(){
					return view('quanli.khuyenmai.sanpham_km');
				});
			});
	});
});


/*--------------------------GIAO DIỆN NHÀ BÁN HÀNG-------------------------------*/
//Đăng nhập bán hàng
Route::get('nguoiban/dangnhap', function(){
	return view('auth.dangnhap_ban');
});



Route::group(['prefix'=>'nguoiban'], function(){
	//Đăng kí bán hàng
	Route::get('dangky', function(){
		return view('auth.dangnhap_ban');
	});
	Route::group(['prefix'=>'dangky'], function(){
		Route::get('xacthuc-mail', function(){
			return view('nguoiban.dangky.xacthuc_mail');
		});
		Route::get('dien-thongtin', function(){
			return view('nguoiban.dangky.dien_thongtin');
		});
	});

	//Quản lí sản phẩm
	Route::get('ql-sanpham', function(){
		return view('nguoiban.sanpham.sanpham_home');
	});
	Route::group(['prefix'=>'ql-sanpham'], function(){
		Route::get('them-sanpham', function(){
			return view('nguoiban.sanpham.them_sanpham');
		});
		Route::get('sanpham-choduyet', function(){
			return view('nguoiban.sanpham.sanpham_choduyet');
		});
		Route::get('sanpham-banchay', function() {
			return view('nguoiban.sanpham.sanpham_banchay');
		});
		Route::get('sanpham-hethang', function(){
			return view('nguoiban.sanpham.sanpham_hethang');
		});
		Route::get('tatca-sanpham', function(){
			return view('nguoiban.sanpham.tatca_sanpham');
		});
		Route::get('chitiet-sanpham', function(){
			return view('nguoiban.sanpham.chitiet_sanpham');
		});
	});

	//Quản lí đơn hàng
	Route::get('donhang', function(){
		return view('nguoiban.donhang.donhang_home');
	});
	Route::group(['prefix'=>'donhang'], function(){
		Route::get('tatca-donhang', function(){
			return view('nguoiban.donhang.tatca_donhang');
		});
		Route::get('donhang-trongngay', function(){
			return view('nguoiban.donhang.donhang_trongngay');
		});
		Route::get('donhang-dangxuli', function(){
			return view('nguoiban.donhang.donhang_dangxuli');
		});
		Route::get('donhang-danggiaodi', function(){
			return view('nguoiban.donhang.donhang_danggiaodi');
		});
		Route::get('donhang-thatbai', function(){
			return view('nguoiban.donhang.donhang_thatbai');
		});
		Route::get('donhang-dagiao', function(){
			return view('nguoiban.donhang.donhang_dagiao');
		});
		Route::get('chitiet-donhang', function(){
			return view('nguoiban.donhang.chitiet_donhang');
		});
	});

	//Quản lí khuyến mãi
	Route::get('khuyenmai', function(){
		return view('nguoiban.khuyenmai');
	});
	Route::group(['prefix'=>'khuyenmai'], function(){
		Route::get('chitiet-khuyenmai', function(){
			return view('nguoiban.khuyenmai.chitiet_khuyenmai');
		});
		Route::group(['prefix'=>'chitiet-khuyenmai'], function(){
			Route::get('themspkm', function(){
				return view('nguoiban.khuyenmai.them_sanpham_km');
			});
			Route::get('dssanphamkm', function(){
				return view('nguoiban.khuyenmai.ds_sanpham_km');
			});
		});
	});
});


/*---------------GIAO DIỆN KHÁCH HÀNG---------------------------------*/
Route::get('home',function(){
	return view('khachhang.home');
});
Route::get('chitiet-danhmuc',function(){
	return view('khachhang.chitiet_danhmuc');
});
Route::get('chitiet-sanpham',function(){
	return view('khachhang.chitiet_sanpham');
});
Route::get('donhang',function(){
	return view('khachhang.donhang');
});
Route::get('nhap-thongtin-donhang', function(){
	return view('khachhang.nhap_thongtin_donhang');
});
Route::get('hinhthucthanhtoan', function(){
	return view('khachhang.hinhthucthanhtoan');
});
Route::get('dathang-thanhcong',function(){
	return view('khachhang.dathang_thanhcong');
});

//-------------------------------------------------------------------------------------
Route::get('demo1', function () {
	return view('khachhang.home');
});

Route::get('demo2', function () {
	$a = DB::table('san_pham')->join('nguoi_ban','manb','=','nguoi_ban.manb')->get();

	echo '<pre>';
	print_r($a);
	echo '</pre>';
});


