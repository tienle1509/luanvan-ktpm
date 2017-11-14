@extends('quanli_home')

@section('qlnguoiban', 'active')

@section('noidung')

<style type="text/css">
	body{
		background-color: #FFFFFF;
	}
	.title{
		margin-top: -15px;
		border-bottom: 2px solid blue;
	}
</style>

<div class="container-fluid">
	<h1>Quản lí nhà bán hàng</h1>
	<hr style="border: 1px solid #F9F9FF">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<ol class="breadcrumb">
			  <li><a href="{{asset('quanli/nhabanhang')}}">Quản lí nhà bán hàng</a></li>
			  <li class="active">Sửa thông tin</li>
			</ol>
		</div>
	</div>

	<div class="title"><h3>Thông tin chung</h3></div>
	<div class="container" style="width: 900px; margin-top: 30px; margin-bottom: 30px;">
		<form class="form-horizontal" role="form" action="{{url('quanli/nhabanhang/luu-thongtin')}}" method="post">

			<input type="hidden" name="_token" value="{{csrf_token()}}">

		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Mã nhà bán hàng</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" value="{{$thongtin->manb}}" name="txtMaNB" readonly="">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Tên người bán</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="txtTenNB" value="{{$thongtin->tennb}}">
		      		<div style='color:red;'>{{$errors->first('txtTenNB')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Tên gian hàng</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="txtTenGH" value="{{$thongtin->tengianhang}}">
		      		<div style='color:red;'>{{$errors->first('txtTenGH')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Email</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="txtEmail" value="{{$thongtin->email}}">
		      		<div style='color:red;'>{{$errors->first('txtEmail')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Số điện thoại</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="txtSDT" value="{{$thongtin->sodienthoai}}">
		      		<div style='color:red;'>{{$errors->first('txtSDT')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Địa chỉ</label>		    	
		    	<div class="col-sm-10">
		      		<textarea name="txtDiaChi" rows="2" class="form-control" >{!! $thongtin->diachi !!}
			    	</textarea>
			    	<div style='color:red;'>{{$errors->first('txtDiaChi')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-primary">Lưu lại</button>&nbsp;&nbsp;&nbsp;
		      		<a href="{{asset('quanli/nhabanhang')}}" type="button" class="btn btn-default">Hủy</a>
		    	</div>
		  	</div>
		</form>
	</div>



	<div class="title"><h3>Cài đặt tài khoản</h3></div>
	<div class="container" style="width: 900px; margin-top: 30px; margin-bottom: 30px;">
		<form class="form-horizontal" role="form" action="{{url('quanli/nhabanhang/luu-matkhau')}}" method="post">

			<input type="hidden" name="_token" value="{{csrf_token()}}">

		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Mã nhà bán hàng</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="txtMaNB" value="{{$thongtin->manb}}" readonly="">
		    	</div>
			</div>
			<div class="form-group">
		    	<label class="col-sm-2 control-label">Email</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" value="{{$thongtin->email}}" readonly="">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Mật khẩu mới</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="txtMatKhau1">
		      		<div style='color:red;'>{{$errors->first('txtMatKhau1')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="col-sm-2 control-label">Nhập lại mật khẩu</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="txtMatKhau2">
		      		<div style='color:red;'>{{$errors->first('txtMatKhau2')}}</div>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-primary">Lưu lại</button>&nbsp;&nbsp;&nbsp;
		      		<a href="{{asset('quanli/nhabanhang')}}" type="button" class="btn btn-default">Hủy</a>
		    	</div>
		  	</div>
		</form>
	</div>


</div>

@stop