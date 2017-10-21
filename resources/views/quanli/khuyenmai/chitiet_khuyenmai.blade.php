@extends('quanli_home')

@section('qlkhuyenmai','active')

@section('noidung')
<style type="text/css">
	body {
		background-color: #FFFFFF;
	}
</style>




<div class="container-fluid">
				<h1>Chi tiết khuyến mãi</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/khuyenmai')}}">Khuyến mãi</a></li>
						  <li class="active">Chi tiết khuyến mãi</li>
						</ol>
					</div>
				</div>

				<a href="{{asset('quanli/khuyenmai/chitiet-khuyenmai/dssanphamkm')}}" type="button" class="btn btn-primary btn-lg">
					<span class="fa fa-list"></span>&nbsp;&nbsp;Danh sách sản phẩm tham gia khuyến mãi
				</a>

				<form id="form-addPromotion" class="form-horizontal" role="form">
				  <div class="title"><h3>Thông tin</h3></div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Mã khuyến mãi <b style="color: red">*</b></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" value="KM001" readonly="">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Tên khuyến mãi <b style="color: red">*</b></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="" value="Deal giá sốc - Khuyến mãi chỉ duy nhất 2 ngày">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Ngày bắt đầu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="Sdate" name="txtSDate" value="12/03/2017" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
					</div>
					<label class="col-sm-3 control-label">Ngày kết thúc <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="Sdate" name="txtSDate" value="14/02/2017" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
					</div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Chiết khấu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
				      <input type="number" class="form-control" min="0" max="100" value="8">
				    </div>
				    <label class="col-sm-3 control-label">Hạn đăng kí <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="Sdate" name="txtSDate" value="10/03/2017" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
					</div>
				  </div>
				  <div class="title"><h3>Mô tả</h3></div>
				  <textarea name="editor1" class="ckeditor" id="editor1">
				  		Nhanh tay đặt phòng ngay bây giờ!!! Giảm ngay 10% giá tất cả các phòng trong tháng 4 này. 

						Để tạo điều kiện cho những khách đến Đà lạt vào tháng 4/2017 có một nơi nghĩ dưởng tốt nhất, Terracotta Hotel & Resort áp dụng chương trình khuyến mãi. Giảm giá 10% cho tất cả các loại phòng (kể cả các phòng thuộc villa như Premium hay Junior). 

						Với quy mô khách sạn 4 sao và khung cảnh gần gũi thiên nhiên chúng tôi đảm bảo sẽ làm hài lòng quý khách khi đến với khách sạn của chúng tôi.

						Terrcotta - Một điểm đến lý tưởng cho những ai yêu thích thiên nhiên và mong muốn tìm một nơi nghỉ dưỡng đẳng cấp đúng nghĩa.
				  </textarea>
				  <div class="title"><h3>Ảnh khuyến mãi</h3></div>
				  <img src="{{asset('public/anh-khuyenmai/salebirthday.jpg')}}" alt="anhkm">
				  <br><br>
				  <label><h4>Thay đổi ảnh khác</h4></label>
				  <input type="file" name="">
				  <div class="text-right footer">
				  	<button type="button" class="btn btn-danger btn-lg">Xóa</button>
				  	<button type="submit" class="btn btn-primary btn-lg">Lưu lại</button>
				  </div>
				</form>


			</div>

@stop