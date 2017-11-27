@extends('khachhang_home')

@section('title-page','Sửa tài khoản')

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
			<h4><b>{{mb_strtoupper($kh->tennguoidung)}}</b></h4>
			<a href="{{asset('quanli-taikhoan')}}">Quản lí tài khoản</a>
			<br>
			<a href="{{asset('quanli-donhang')}}">Quản lí đơn hàng</a>
		</div>	

		<div class="col-md-9 panel-sua-thongtin">
			<h4>Thay đổi mật khẩu</h4>
			<form id="form-suathongtin" class="form-horizontal" role="form" method="post" action="{{ url('luu-thaydoi-matkhau')}}">

				<input type="hidden" name="_token" value="{{csrf_token()}}">

			  <div class="form-group">
			    <label class="col-sm-4 control-label">Mật khẩu hiện tại <b style="color: red">*</b></label>
			    <div class="col-sm-8">
			      <input type="password" name="txtMKHT" class="form-control">
			      <div style="color: red; margin-bottom: -10px;">{{$errors->first('txtMKHT')}}</div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">Mật khẩu mới <b style="color: red">*</b></label>
			    <div class="col-sm-8">
			      <input type="password" name="txtMK1" class="form-control">
			      <div style="color: red; margin-bottom: -10px;">{{$errors->first('txtMK1')}}</div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">Nhập lại mật khẩu <b style="color: red">*</b></label>
			    <div class="col-sm-8">
			      <input type="password" name="txtMK2" class="form-control">
			      <div style="color: red; margin-bottom: -10px;">{{$errors->first('txtMK2')}}</div>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-8">
			      <button type="submit" class="btn btn-primary">Lưu lại</button>&nbsp;&nbsp;&nbsp;
			      <a href="{{asset('quanli-taikhoan')}}" type="button" class="btn btn-default">Hủy bỏ</a>
			    </div>
			  </div>
			</form>
		</div>
		
	</div>


	


@stop