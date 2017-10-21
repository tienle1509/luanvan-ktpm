@extends('quanli_home')

@section('qlkhuyenmai','active')

@section('noidung')
<style type="text/css">
	body {
		background-color: #FFFFFF;
	}
</style>


<div class="container-fluid">
				<h1>Thêm khuyến mãi</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/khuyenmai')}}">Khuyến mãi</a></li>
						  <li class="active">Thêm khuyến mãi</li>
						</ol>
					</div>
				</div>


				<form id="form-addPromotion" class="form-horizontal" role="form">
				  <div class="title"><h3>Thông tin</h3></div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Tên khuyến mãi <b style="color: red">*</b></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="" placeholder="Nhập tên khuyến mãi">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Ngày bắt đầu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="Sdate" name="txtSDate" placeholder="Từ ngày" />
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
					</div>
					<label class="col-sm-3 control-label">Ngày kết thúc <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="Sdate" name="txtSDate" placeholder="Đến ngày" />
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
					</div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Chiết khấu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
				      <input type="number" class="form-control" min="0" max="100">
				    </div>
				    <label class="col-sm-3 control-label">Hạn đăng kí <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="Sdate" name="txtSDate" placeholder="Hạn đăng kí" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
					</div>
				  </div>
				  <div class="title"><h3>Mô tả</h3></div>
				  <textarea name="editor1" class="ckeditor" id="editor1"></textarea>
				  <div class="title"><h3>Ảnh khuyến mãi</h3></div>
				  <input type="file" name="">
				  <div class="text-right footer">
				  	<a href="{{asset('quanli/khuyenmai')}}" type="button" class="btn btn-default btn-lg">Hủy</a>
				  	<button type="submit" class="btn btn-primary btn-lg">Lưu lại</button>
				  </div>
				</form>


			</div>

@stop