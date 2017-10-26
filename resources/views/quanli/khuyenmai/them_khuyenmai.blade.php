@extends('quanli_home')

@section('qlkhuyenmai','active')

@section('noidung')
<style type="text/css">
	body {
		background-color: #FFFFFF;
	}
</style>

<script type="text/javascript">
	$(function () {
                $("#ngaybd").datepicker({
                	dateFormat : 'dd-mm-yy',
                    minDate: 0,
                    onClose: function (selectedDate) {
                        if (selectedDate != ""){ 
                            $("#ngaykt").datepicker("option", "minDate", selectedDate); 
                            $("#handk").datepicker("option", "maxDate", selectedDate);
                        }
                    }
                });
                $("#ngaykt").datepicker({
                	dateFormat : 'dd-mm-yy',
                    minDate: 'selectedDate',
                });
                $("#handk").datepicker({
                	dateFormat : 'dd-mm-yy',
                    maxDate: 'selectedDate',
                });
        });
</script>


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


				<form id="form-addPromotion" class="form-horizontal" role="form" action="{{url('quanli/khuyenmai/them-khuyenmai')}}" method="post" enctype="multipart/form-data">

				  <input type="hidden" name="_token" value="{{csrf_token()}}">

				  <div class="title"><h3>Thông tin</h3></div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Tên khuyến mãi <b style="color: red">*</b></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="txtTenKM" placeholder="Nhập tên khuyến mãi" value="{{old('txtTenKM')}}">
				      <div style="color: red; margin-top: 5px;">{{$errors->first('txtTenKM')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Ngày bắt đầu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" name="txtBatDau" id="ngaybd" placeholder="Từ ngày" value="{{old('txtBatDau')}}">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
						<div style="color: red; margin-top: 5px;">{{$errors->first('txtBatDau')}}</div>
					</div>
					<label class="col-sm-3 control-label">Ngày kết thúc <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" name="txtKetThuc" id="ngaykt" placeholder="Đến ngày" value="{{old('txtKetThuc')}}">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
						<div style="color: red; margin-top: 5px;">{{$errors->first('txtKetThuc')}}</div>
					</div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Chiết khấu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
				      <input type="number" class="form-control" name="txtChietKhau" min="1" max="100" value="{{old('txtChietKhau')}}">
				      <div style="color: red; margin-top: 5px;">{{$errors->first('txtChietKhau')}}</div>
				    </div>
				    <label class="col-sm-3 control-label">Hạn đăng kí <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" name="txtHanDK" type="text" id="handk" placeholder="Hạn đăng kí" value="{{old('txtHanDK')}}">
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
						<div style="color: red; margin-top: 5px;">{{$errors->first('txtHanDK')}}</div>
					</div>
				  </div>
				  <div class="title"><h3>Mô tả</h3></div>
				  <textarea name="txtMoTa" class="ckeditor" id="editor1"></textarea>
				  <div style="color: red; margin-top: 5px;">{{$errors->first('txtMoTa')}}</div>
				  <div class="title"><h3>Ảnh khuyến mãi</h3></div>
				  <input type="file" name="imgKM">
				  <div style="color: red; margin-top: 5px;">{{$errors->first('imgKM')}}</div>
				  <div class="text-right footer">
				  	<a href="{{asset('quanli/khuyenmai')}}" type="button" class="btn btn-default btn-lg">Hủy</a>
				  	<button type="submit" class="btn btn-primary btn-lg">Lưu lại</button>
				  </div>
				</form>


			</div>

@stop