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

/*-----------------BẬT SESSION CHO TOÀN HỆ THỐNG----------------------*/
session_start();



/*--------Đăng nhập, Đăng xuất người quản lí--------------*/
Route::get('quanli/dangnhap', 'LoginQuanLiController@getDangNhapQuanLi');
Route::post('quanli/dangnhap', 'LoginQuanLiController@postDangNhapQuanLi');

Route::get('quanli/dangxuat', ['uses'=>'LoginQuanLiController@getDangXuatQuanLi']);

Route::group(['prefix'=>'quanli'],function(){
	//Quản lí sản phẩm
	Route::get('ql-sanpham', ['uses'=>'SanPhamQuanLiController@getHomeSanPham']);
	Route::group(['prefix'=>'ql-sanpham'], function(){
		Route::get('duyet-sanpham', ['uses'=>'SanPhamQuanLiController@getDuyetSanPham']);
		Route::get('duyet', ['uses'=>'DuyetSanPhamController@getDuyetSanPham']);
		Route::get('tatca-sanpham', ['uses'=>'SanPhamQuanLiController@getTatCaSanPham']);
		Route::get('tim-kiem-sp', ['uses'=>'SanPhamQuanLiController@getTimKiemSanPham']);
		Route::get('chitiet-sanpham/{masp}', ['uses'=>'SanPhamQuanLiController@getChiTietSanPham']);
	});

	//Quản lí khuyến mãi
	Route::get('khuyenmai', ['uses'=>'KhuyenMaiQuanLiController@getHomeKhuyenMai']);
	Route::group(['prefix'=>'khuyenmai'], function(){
		Route::get('them-khuyenmai', ['uses'=>'KhuyenMaiQuanLiController@getThemKhuyenMai']);
		Route::post('them-khuyenmai', ['uses'=>'KhuyenMaiQuanLiController@postThemKhuyenMai']);
		Route::get('chitiet-khuyenmai/{makm}', ['uses'=>'KhuyenMaiQuanLiController@getChiTietKhuyenMai']);
		Route::post('capnhat-khuyenmai', ['uses'=>'KhuyenMaiQuanLiController@postCapNhatKhuyenMai']);
		Route::get('xoa-khuyenmai', ['uses'=>'XoaKhuyenMaiController@getXoaKhuyenMai']);
		Route::get('dssanphamkm/{makm}',['uses'=>'KhuyenMaiQuanLiController@getDSSanPhamKhuyenMai']);
	});

	Route::post('sua-taikhoan',['uses'=>'EditAccountQuanLiController@postSuaTaiKhoan']);
});



/*--------------------GIAO DIỆN QUẢN LÍ----------------------------*/

Route::group(['prefix'=>'quanli'], function(){
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
});




/*------------------Đăng nhập, đăng xuất nhà bán hàng------------------*/
Route::get('nguoiban/dangnhap', ['uses'=>'LoginNguoiBanController@getDangNhapNguoiBan']);
Route::post('nguoiban/postdangnhap', ['uses'=>'LoginNguoiBanController@postDangNhapNguoiBan']);

Route::get('nguoiban/dangxuat', ['uses'=>'LoginNguoiBanController@getDangXuatNguoiBan']);
	

/*----------Đăng kí bán hàng và gửi mail xác nhận-----------*/
//Route::get('nguoiban/dangky', ['uses'=>'RegisterNguoiBanController@getDangKyNguoiBan']);
Route::post('nguoiban/postdangky',['uses'=>'RegisterNguoiBanController@postDangKyNguoiBan']);

Route::get('nguoiban/xacthuc-mail',['uses'=>'RegisterNguoiBanController@getXacThucMail']);
Route::post('nguoiban/postxacthuc-mail', ['uses'=>'RegisterNguoiBanController@postXacThucMail']);
Route::post('nguoiban/postguilaimail', ['uses'=>'RegisterNguoiBanController@postGuiLạiMail']);

Route::get('nguoiban/dien-thongtin', ['uses'=>'RegisterNguoiBanController@getDienThongTin']);
Route::post('nguoiban/postdien-thongtin', ['uses'=>'RegisterNguoiBanController@postDienThongTin']);



Route::group(['prefix'=>'nguoiban'], function(){
	//Quản lí sản phẩm
	Route::get('ql-sanpham', ['uses'=>'SanPhamNguoiBanController@qlSanPhamHome']);	
	Route::group(['prefix'=>'ql-sanpham'], function(){
		Route::get('them-sanpham', ['uses'=>'SanPhamNguoiBanController@getThemSanPham']);
		Route::post('luu-sanpham', ['uses'=>'SanPhamNguoiBanController@postLuuSanPham']);

		Route::get('sanpham-choduyet', ['uses'=>'SanPhamNguoiBanController@getSPChoDuyet']);
		Route::get('sanpham-hethang', ['uses'=>'SanPhamNguoiBanController@getSPHetHang']);
		Route::group(['prefix'=>'sanpham-hethang'], function(){
			Route::get('tim-kiem', ['uses'=>'SanPhamNguoiBanController@getTimKiemSPHetHang']);
			Route::get('capnhat-soluong', ['uses'=>'CapNhatSoLuongSanPhamController@postCapNhatSoLuong']);
		});
		Route::get('tatca-sanpham', ['uses'=>'SanPhamNguoiBanController@getTatCaSanPham']);
		Route::get('tim-kiem-tatca', ['uses'=>'SanPhamNguoiBanController@getTimKiemTatCaSP']);
				
		Route::get('chitiet-sanpham/{masp}', ['uses'=>'SanPhamNguoiBanController@getChiTietSanPham']);
		Route::post('capnhat-sanpham', ['uses'=>'SanPhamNguoiBanController@postCapNhatSanPham']);
		Route::get('xoa-anh', ['uses'=>'CapNhatSoLuongSanPhamController@getXoaAnhSanPham']);
		Route::post('xoa-sanpham', ['uses'=>'CapNhatSoLuongSanPhamController@postXoaSanPham']);
	});
	
	//Khuyến mãi
	Route::get('khuyenmai', ['uses'=>'KhuyenMaiNguoiBanController@getHomeKhuyenMai']);
	Route::group(['prefix'=>'khuyenmai'], function(){
		Route::get('chitiet-khuyenmai/{makm}', ['uses'=>'KhuyenMaiNguoiBanController@getChiTietKhuyenMai']);
		Route::get('themspkm/{makm}', ['uses'=>'KhuyenMaiNguoiBanController@getThemSanPhamKhuyenMai']);
		Route::get('them-spkm', ['uses'=>'ThemSanPhamKhuyenMaiNguoiBanController@getThemSanPham']);
		Route::get('dssanphamkm/{makm}', ['uses'=>'KhuyenMaiNguoiBanController@getDSSanPhamKhuyenMai']);
		Route::get('xoa-spkm', ['uses'=>'ThemSanPhamKhuyenMaiNguoiBanController@getXoaSanPham']);
	});

	//Thay đổi thông tin, tài khoản nhà bán
	Route::post('sua-thongtin', ['uses'=>'EditProfileNguoiBanController@postSuaThongTin']);
	Route::post('sua-taikhoan', ['uses'=>'EditProfileNguoiBanController@postSuaTaiKhoan']);
});


/*--------------------------GIAO DIỆN NHÀ BÁN HÀNG-------------------------------*/

Route::group(['prefix'=>'nguoiban'], function(){
	//Quản lí sản phẩm
	Route::group(['prefix'=>'ql-sanpham'], function(){		
		Route::get('sanpham-banchay', function() {
			return view('nguoiban.sanpham.sanpham_banchay');
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

Route::get('taobang2', function(){
	Schema::create('mau_sanpham', function($tab){
		$tab->integer('mamau');
		$tab->primary('mamau');
		$tab->string('tenmau',50);
	});
});

Route::get('demo2', function () {
	if(date('d-m-Y', strtotime('2017/10/27')) < date('d-m-Y', strtotime('2017/11/07'))){
		echo 'bé hơn';
	}else{
		echo "lớn hơn";
	}
});
