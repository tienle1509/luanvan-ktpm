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
date_default_timezone_set('Asia/Ho_Chi_Minh');



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

	//Chỉnh sửa thông tin quản lí
	Route::post('sua-taikhoan',['uses'=>'EditAccountQuanLiController@postSuaTaiKhoan']);

	//Quản lí đơn hàng
	Route::get('ql-donhang', ['uses'=>'DonHangQuanLiController@getHomeDonHang']);
	Route::group(['prefix'=>'ql-donhang'], function(){
		Route::get('duyet-donhang', ['uses'=>'DonHangQuanLiController@getDuyetDonHang']);
		Route::get('duyet', ['uses'=>'DuyetDonHangController@getDuyetDonHang']);
		Route::get('donhang-trongngay', ['uses'=>'DonHangQuanLiController@getDonHangTrongNgay']);
		Route::get('timkiem-trongngay', ['uses'=>'DonHangQuanLiController@getTimKiemTrongNgay']);
		Route::get('tatca-donhang', ['uses'=>'DonHangQuanLiController@getTatCaDonHang']);
		Route::get('timkiem-tatca', ['uses'=>'DonHangQuanLiController@getTimKiemTatCaDH']);
		Route::get('chitiet-donhang/{madh}',['uses'=>'DonHangQuanLiController@getChiTietDonHang']);
	});

	//Quản lí nhà bán hàng
	Route::get('nhabanhang', ['uses'=>'QuanLiNguoiBanController@getNhaBanHang']);
	Route::group(['prefix'=>'nhabanhang'], function(){
		Route::get('sua/{manb}', ['uses'=>'QuanLiNguoiBanController@getSuaNhaBanHang']);
		Route::post('luu-thongtin', ['uses'=>'QuanLiNguoiBanController@postLuuThongTin']);
		Route::post('luu-matkhau', ['uses'=>'QuanLiNguoiBanController@postLuuMatKhau']);
		Route::get('thongke-doanhthu/{manb}', ['uses'=>'QuanLiNguoiBanController@getThongKeDoanhSo']);
		Route::get('xoa-nhabanhang', ['uses'=>'XoaTaiKhoanController@getXoaNguoiBan']);

		//Tìm kiếm nhà bán hàng
		Route::get('tim-kiem', ['uses'=>'QuanLiNguoiBanController@getTimKiemNguoiBan']);
	});

	//Quản lí khách hàng
	Route::get('khachhang', ['uses'=>'QuanLiKhachHangController@getKhachHang']);
	Route::group(['prefix'=>'khachhang'], function(){
		Route::get('sua/{makh}', ['uses'=>'QuanLiKhachHangController@getSuaKhachHang']);
		Route::post('luu-thongtin', ['uses'=>'QuanLiKhachHangController@postLuuThongTin']);
		Route::post('luu-matkhau', ['uses'=>'QuanLiKhachHangController@postLuuMatKhau']);
		Route::get('xoa-khachhang', ['uses'=>'XoaTaiKhoanController@getXoaKhachHang']);

		//Tìm kiếm khách hàng
		Route::get('tim-kiem', ['uses'=>'QuanLiKhachHangController@getTimKiemKhachHang']);
	});


	Route::get('thongke-taikhoan', ['uses'=>'ThongKeQuanLiController@getThongKeTaiKhoan']);
	
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

		Route::get('sanpham-banchay', ['uses'=>'SanPhamNguoiBanController@getSPBanChay']);
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

	//Thống kê doanh thu bán hàng
	Route::get('thongke', ['uses'=>'ThongKeNguoiBanController@getThongKe']);

	//Quản lí đơn hàng
	Route::get('donhang',['uses'=>'DonHangNguoiBanController@getHomeDonHang']);
	Route::group(['prefix'=>'donhang'], function(){
		Route::get('tatca-donhang', ['uses'=>'DonHangNguoiBanController@getTatCaDonHang']);
		Route::get('timkiem-tatca', ['uses'=>'DonHangNguoiBanController@getTimKiemTatCaDH']);
		Route::get('chitiet-donhang/{madh}', ['uses'=>'DonHangNguoiBanController@getChiTietDonHang']);
		Route::get('donhang-trongngay', ['uses'=>'DonHangNguoiBanController@getDonHangTrongNgay']);
		Route::get('donhang-dangxuli', ['uses'=>'DonHangNguoiBanController@getDonHangDangXuLi']);
		Route::get('timkiem-dhdangxuli', ['uses'=>'DonHangNguoiBanController@getTimKiemDHDangXuLi']);
		Route::get('xoa-donhang', ['uses'=>'CapNhatDonHangController@getXoaDonHang']);
		Route::get('capnhat-donhang', ['uses'=>'CapNhatDonHangController@getCapNhatDonHang']);
		Route::get('donhang-danggiaodi', ['uses'=>'DonHangNguoiBanController@getDonHangDangGiao']);
		Route::get('timkiem-danggiao', ['uses'=>'DonHangNguoiBanController@getTimKiemDangGiao']);
		Route::get('donhang-thatbai', ['uses'=>'DonHangNguoiBanController@getDonHangThatBai']);
		Route::get('donhang-dagiao', ['uses'=>'DonHangNguoiBanController@getDonHangDaGiao']);
	});
});






/*------------------Giao diện khách hàng------------------*/
Route::get('home', ['uses'=>'HomeKhachHangController@getHomeKhachHang']);
Route::get('timkiem',['uses'=>'HomeKhachHangController@getTimKiemSanPham']);

//Kiểm tra đơn hàng
Route::get('kiemtra-donhang', ['uses'=>'KiemTraDonHangController@getKiemTraDonHang']);
Route::get('thongtin-donhang', ['uses'=>'KiemTraDonHangController@getThongTinDonHang']);


//Đăng kí tài khoản
Route::post('dangki-taikhoan',['uses'=>'TaiKhoanKhachHangController@postDangKi']);
Route::get('quanli-taikhoan', ['uses'=>'TaiKhoanKhachHangController@getQuanLiTaiKhoan']);
Route::get('thaydoi-email', ['uses'=>'EditAccountThanhVienController@getThayDoiEmail']);
Route::post('luu-thaydoi-email', ['uses'=>'EditAccountThanhVienController@postThayDoiEmail']);
Route::get('thaydoi-diachi-giaohang', 
		['uses'=>'EditAccountThanhVienController@getThayDoiDiaChiGiaoHang']);
Route::post('luu-thaydoi-diachi',
		['uses'=>'EditAccountThanhVienController@postThayDoiDiaChiGiaoHang']);
Route::get('thaydoi-matkhau', ['uses'=>'EditAccountThanhVienController@getThayDoiMatKhau']);
Route::post('luu-thaydoi-matkhau', ['uses'=>'EditAccountThanhVienController@postThayDoiMatKhau']);
Route::get('quanli-donhang', ['uses'=>'LichSuDonHangController@getQuanLiDonHang']);
Route::group(['prefix'=>'quanli-donhang'], function(){
	Route::get('chitiet-donhang/{madh}', ['uses'=>'LichSuDonHangController@getChiTietDonHang']);
});


//Đăng nhập, đăng xuất
Route::post('dangnhap',['uses'=>'TaiKhoanKhachHangController@postDangNhap']);
Route::get('dangxuat', ['uses'=>'TaiKhoanKhachHangController@getDangXuat']);


Route::get('chitiet-sanpham/{masp}',['uses'=>'HomeKhachHangController@getChiTietSanPham']);
Route::post('gui-nhanxet', ['uses'=>'NhanXetDanhGiaController@postNhanXet']);

//Thêm sản phẩm vào giỏ hàng
Route::get('muahang', ['uses'=>'GioHangController@getMuaHang']);
Route::get('xoa-sanpham', ['uses'=>'GioHangController@getXoaSanPham']);
Route::get('sua-sanpham', ['uses'=>'GioHangController@getSuaSanPham']);

//Đặt hàng
Route::get('nhap-thongtin-donhang',['uses'=>'HomeKhachHangController@getNhapThongTin']);
Route::get('chontinh', ['uses'=>'GioHangController@getChonTinh']);
Route::post('nhap-thongtin-donhang', ['uses'=>'HomeKhachHangController@postNhapThongTin']);


Route::get('hinhthucthanhtoan', ['uses'=>'HomeKhachHangController@getHinhThucThanhToan']);
Route::post('dathang', ['uses'=>'HomeKhachHangController@postDatHang']);
Route::get('thanhtoan-tructuyen', ['uses'=>'HomeKhachHangController@getThanhToanTrucTuyen']);
Route::post('thanhtoan-tructuyen',['uses'=>'HomeKhachHangController@postThanhToanTrucTuyen']);
Route::get('dathang-thanhcong',['uses'=>'HomeKhachHangController@getDatHangThanhCong']);

//Chi tiết danh mục
Route::get('chitiet-danhmuc/{madm}', ['uses'=>'HomeKhachHangController@getChiTietDanhMuc']);

//Sắp xếp tăng giảm theo giá
Route::get('sapxep-gia',['uses'=>'SapXepTheoGiaController@getSapXep']);
Route::get('ketqua-sapxep', ['uses'=>'SapXepTheoGiaController@getKetQuaSapXep']);

//Sản phẩm bán chạy
Route::get('sanpham-banchay', ['uses'=>'HomeKhachHangController@getSanPhamBanChay']);
Route::get('sapxep-banchay',['uses'=>'SapXepTheoGiaController@getSapXepBanChay']);
Route::get('kq-sapxep-banchay', ['uses'=>'SapXepTheoGiaController@getKetQuaSapXepBanChay']);


//Khuyến mãi
Route::get('khuyenmai', ['uses'=>'HomeKhachHangController@getKhuyenMai']);
Route::get('chitiet-khuyenmai/{makm}', ['uses'=>'HomeKhachHangController@getChiTietKhuyenMai']);


