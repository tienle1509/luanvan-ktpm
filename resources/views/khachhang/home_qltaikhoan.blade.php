@extends('khachhang_home')

@section('title-page','Quản lí tài khoản')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-qltaikhoan.css')}}">

<?php
	if(!isset($_SESSION['makh'])){
		header("Location: http://localhost/luanvan-ktpm/home");	
		exit;
	}else{
		$kh = DB::table('khach_hang')->where('makh', $_SESSION['makh'])->first();
	}
?>

<div class="nav-bottom ">
		<div class="container">
			<div class="row">
				<ul class="nav nav-pills">
					<li class="danhmuc">
						<button type="button" class="btn-danhmuc">
							<span class="fa fa-navicon"></span>&nbsp;&nbsp;&nbsp;DANH MỤC SẢN PHẨM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="fa fa-angle-down"></span>
						</button>
						<div class="dropdown-content">
							<?php
								$dmleft = DB::table('danhmuc_sanpham')->get();
							?>
							@foreach($dmleft as $val)
								<a href="{{asset('chitiet-danhmuc/'.$val->madm)}}">{{$val->tendanhmuc}}</a>
							@endforeach
						</div>
					</li>
					<li>
						<a class="nav-bottom-km" href="#">
						<span class="fa fa-gift"></span>&nbsp;&nbsp;&nbsp;KHUYẾN MÃI
						</a>
					</li>
					<li><a class="nav-bottom-banchay" href="#"><span class="fa fa-tags"></span>&nbsp;&nbsp;&nbsp;BÁN CHẠY</a></li>	
				</ul>
			</div>
		</div>
</div>
	<div class="clearfix"></div>


	<!-- Body -->
	<div class="container">	
		<div class="col-md-3 panel-left">
			<h3><b>{{$kh->tennguoidung}}</b></h3>
			<a href="{{asset('quanli-taikhoan')}}">Quản lí tài khoản</a>
			<br>
			<a href="{{asset('quanli-donhang')}}">Quản lí đơn hàng</a>
		</div>	
		<div class="col-md-9 panel-right">
			<div class="col-md-4 panel-tt">
				<h4>Thông tin cá nhân</h4>
				{{$kh->tennguoidung}}
				<br>{{$kh->email}}
				<br><a href="{{asset('thaydoi-email')}}">Thay đổi email</a>
			</div>
			
			<div class="col-md-4">
				<div class="col-md-12 col-sm-12 panel-cd">
					<h4>Địa chỉ giao hàng</h4>
					@if($kh->tenkh == '')
						Bạn chưa có địa chỉ giao hàng
						<br><a href="{{asset('thaydoi-diachi-giaohang')}}">Thêm địa chỉ mới</a>
					@else
						{{$kh->tenkh}}<br>
						{{$kh->diachigiaohang}}<br>
						{{$kh->sodienthoai}}
						<br><a href="{{asset('thaydoi-diachi-giaohang')}}">Chỉnh sửa</a>
					@endif					
				</div>
			</div>	

			<div class="col-md-4 panel-cd">
				<h4>Cài đặt tài khoản</h4>
				Địa chỉ email: {{$kh->email}}
				<br>
				<a href="{{asset('thaydoi-matkhau')}}">Thay đổi mật khẩu</a>
			</div>			
		</div>
		

		
	</div>


	


@stop