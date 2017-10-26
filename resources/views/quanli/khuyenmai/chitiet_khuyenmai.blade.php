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

	//Xóa khuyến mãi
	$(document).ready(function(){
		$('#btnXoaKM').click(function(){
			var url = "http://localhost/luanvan-ktpm/quanli/khuyenmai/xoa-khuyenmai";
			var makm = $('#idMaKM').val();

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"makm":makm},
				success : function(resutl){
					if(resutl.success){
						location ="http://localhost/luanvan-ktpm/quanli/khuyenmai";
					}
				}
			});
		});
	});
</script>



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

				<a href="{{asset('quanli/khuyenmai/dssanphamkm')}}" type="button" class="btn btn-primary btn-lg">
					<span class="fa fa-list"></span>&nbsp;&nbsp;Danh sách sản phẩm tham gia khuyến mãi
				</a>

				<form id="form-addPromotion" class="form-horizontal" role="form" method="post" action="{{url('quanli/khuyenmai/capnhat-khuyenmai')}}" enctype="multipart/form-data">

				  <input type="hidden" name="_token" value="{{csrf_token()}}">

				  <div class="title"><h3>Thông tin</h3></div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Mã khuyến mãi <b style="color: red">*</b></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="idMaKM" value="{{$chitiet_km->makm}}" readonly="" name="txtMaKM">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Tên khuyến mãi <b style="color: red">*</b></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="txtTenKM" value="{{$chitiet_km->tenkm}}">
				      <div style="color: red; margin-top: 5px;">{{$errors->first('txtTenKM')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Ngày bắt đầu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="ngaybd" name="txtngaybd" value="{{date('d-m-Y',strtotime($chitiet_km->ngaybd))}}" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
						<div style="color: red; margin-top: 5px;">{{$errors->first('txtngaybd')}}</div>
					</div>
					<label class="col-sm-3 control-label">Ngày kết thúc <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="ngaykt" name="txtngaykt" value="{{date('d-m-Y',strtotime($chitiet_km->ngaykt))}}" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
						<div style="color: red; margin-top: 5px;">{{$errors->first('txtngaykt')}}</div>
					</div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Chiết khấu <b style="color: red">*</b></label>
				    <div class="col-sm-3">
				      <input type="number" class="form-control" min="1" max="100" value="{{$chitiet_km->chietkhau}}" name="txtChietKhau">
				      <div style="color: red; margin-top: 5px;">{{$errors->first('txtChietKhau')}}</div>
				    </div>
				    <label class="col-sm-3 control-label">Hạn đăng kí <b style="color: red">*</b></label>
				    <div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date" type="text" id="handk" name="txthandk" value="{{date('d-m-Y',strtotime($chitiet_km->handangki))}}" />
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
						</div>
						<div style="color: red; margin-top: 5px;">{{$errors->first('txthandk')}}</div>
					</div>
				  </div>
				  <div class="title"><h3>Mô tả</h3></div>
				  <textarea name="txtMoTa" class="ckeditor" id="editor1">
				  		{{$chitiet_km->mota}}
				  </textarea>
				  <div style="color: red; margin-top: 5px;">{{$errors->first('txtMoTa')}}</div>
				  <div class="title"><h3>Ảnh khuyến mãi</h3></div>
				  <img src="{{asset('public/anh-khuyenmai/'.$chitiet_km->anhkm)}}" alt="anhkm" width="300px" height="160px">
				  <br><br>
				  <label><h4>Thay đổi ảnh khác</h4></label>
				  <input type="file" name="anhKM">
				  <div class="text-right footer">
				  	<button id="btnXoaKM" type="button" class="btn btn-danger btn-lg">Xóa</button>
				  	<button type="submit" class="btn btn-primary btn-lg">Lưu lại</button>
				  </div>
				</form>


			</div>

@stop