@extends('nguoiban_home')

@section('sanpham','active')


@section('noidung')

<style type="text/css">
	.error {
		color: red;
		margin-top: 6px;
	}
	.panel-sp img {
		width: 250px;
		height: 250px;
		margin-bottom: 40px;
		border: 1px solid blue;
		margin-right: -10px;
		box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.3);
	}
	.panel-sp span {
		font-size: 28px;
		color: #EB2828;
	}
	.panel-sp span:hover {
		color: #D01B1B;
	}
	#btn-Xoa{
		position: relative;
		left: -35px;
		top: -120px;
		cursor: pointer;
	}
</style>

	<script type="text/javascript">
		//Xóa từng ảnh phụ
		$(document).ready(function(){
			$('a#btn-Xoa').click(function(){
				var url = "http://localhost/luanvan-ktpm/nguoiban/ql-sanpham/xoa-anh";
				var _token = $('form[name="formInfoProduct"]').find('input[name="_token"]').val();
				var maanh = $(this).parent().find("img").attr("id");
				var link = $(this).parent().find("img").attr('src');

				$.ajax({
					url : url,
					type: "GET",
					dataType : "JSON",
					data : {"maanh":maanh},
					success : function(result){
						if(result.success){
							$("#"+maanh).remove();
						}
					}
				});
			});
		});

		//Show lỗi khi chọn ảnh phụ lớn hơn 4
	/*	$(document).ready(function(){
			$('#imgListProduct').on("change",function(){
				var numFiles = document.getElementById('imgListProduct').files.length;
				var allImg = numFiles+<?php //echo count($img_ctsp) ?>;
				var imgAdd = 4-<?php //echo count($img_ctsp) ?>;
				
				if(allImg > 4){
					$('.alert-danger').removeClass('hide');
					$('.alert-danger').html('Bạn chỉ được chọn thêm '+imgAdd+' ảnh');
				}
			});
		});  */
		

		//Xóa sản phẩm
		$(document).ready(function(){
			$('#btn-cancelAdd').click(function(){
				var url = "http://localhost/luanvan-ktpm/nguoiban/ql-sanpham/xoa-sanpham";
				var _token = $('form[name="InfoPro"]').find('input[name="_token"]').val();
				var masp = $('form[name="InfoPro"]').find('input[name="txtMaSP"]').val();

				if(confirm('Bạn có chắc chắn xóa sản phẩm không ?')){
					$.ajax({
						url : url,
						type : "POST",
						dataType : "JSON",
						data : {"masp":masp, "_token":_token},
						success : function(result){
							$.notify({
									// options
									message: 'Xóa sản phẩm thành công !'
								},{
									// settings
									element: 'body',
									position: null,
									type: "success",
									allow_dismiss: true,
									placement: {
										from: "top",
										align: "right"
									},
									offset: 80,
									spacing: 10,
									z_index: 1031,
									delay: 1000,
									timer: 800,
								});

							setTimeout(function(){
								location = "http://localhost/luanvan-ktpm/nguoiban/ql-sanpham/tatca-sanpham";
							}, 1500);						
						}
					});
				}
			});
		});

	</script>

<div class="container-fluid">
				<h1>Chi tiết sản phẩm</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/ql-sanpham')}}">Sản phẩm</a></li>
						  <li class="active">Chi tiết sản phẩm</li>
						</ol>
					</div>
				</div>

				<div class="row">
					<form id="formInfoProduct" name="InfoPro" class="form-horizontal" role="form" method="post" action="{{ url('nguoiban/ql-sanpham/capnhat-sanpham')}}" enctype="multipart/form-data">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="col-md-3 col-sm-3">
							<input id="imgDaiDien" name="anhDaiDien" type="file">
						</div>
						<div class="col-md-9 col-sm-9">
							<div class="title-thongtin"><h3>Thông tin chung</h3></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Mã sản phẩm</label>
								<div class="col-sm-10">
									<input type="text" name="txtMaSP" class="form-control" value="{{$chitiet_sanpham->masp}}" readonly="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Chọn danh mục <b style="color: red">*</b></label>
							    <div class="col-sm-10">
							      <select name="cbxDanhMuc" class="form-control">
							      	<option value="">-- Chọn danh mục sản phẩm --</option>
							      	<?php
							      		$list_danhmuc = DB::table('danhmuc_sanpham')->get();
							      		foreach ($list_danhmuc as $val) {
							      			if($val->madm == $chitiet_sanpham->madm){
							      				echo '<option value="'.$val->madm.'"selected>'.$val->tendanhmuc.'</option>';
							      			} else {
							      				echo '<option value="'.$val->madm.'">'.$val->tendanhmuc.'</option>';
							      			}
							      		}
							      	?>
							      </select>
							      <div class="error">{{$errors->first('cbxDanhMuc')}}</div>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Tên sản phẩm <b style="color: red">*</b></label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" name="txtTenSP" value="{{$chitiet_sanpham->tensp}}">
							      <div class="error">{{$errors->first('txtTenSP')}}</div>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Giá <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <input type="text" class="form-control" name="txtGia" value="{{$chitiet_sanpham->dongia}}">
							      <div class="error">{{$errors->first('txtGia')}}</div>
							    </div>
							    <label class="col-sm-1 control-label">VND</label>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Số lượng <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <input type="text" class="form-control" name="txtSoLuong" value="{{$chitiet_sanpham->soluong}}">
							      <div class="error">{{$errors->first('txtSoLuong')}}</div>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Xuất xứ <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <input type="text" class="form-control" name="txtXuatXu" value="{{$chitiet_sanpham->xuatxu}}">
							      <div class="error">{{$errors->first('txtXuatXu')}}</div>
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Bảo hành <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <select name="cbxBaoHanh" class="form-control">
							      	<option value="">-- Chọn thời gian bảo hành --</option>
							      	<?php
							      		for ($i=1; $i <= 12; $i++) { 
							      			if($i == $chitiet_sanpham->baohanh){
							      				echo '<option value="'.$i.'"selected>'.$i.' tháng</option>';
							      			}else{
							      				echo '<option value="'.$i.'">'.$i.' tháng</option>';
							      			}
							      		}
							      	?>
							      </select>
							      <div class="error">{{$errors->first('cbxBaoHanh')}}</div>
							    </div>
							</div>
						</div> <!-- end thông tin -->
						<div class="clearfix"></div>

						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Thuộc tính sản phẩm</h3></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Độ phân giải màn hình <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtDPGMH" class="form-control" value="{{$chitiet_sanpham->dophangiaimanhinh}}">
							    	<div class="error">{{$errors->first('txtDPGMH')}}</div>
							    </div>
								<label class="col-sm-2 control-label">Kích thước màn hình <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							      <input type="text" name="txtKichThuocMH" class="form-control" value="{{$chitiet_sanpham->kichthuocmanhinh}}">		
							      <div class="error">{{$errors->first('txtKichThuocMH')}}</div>				    
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Hệ điều hành <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtHeDieuHanh" class="form-control" value="{{$chitiet_sanpham->hedieuhanh}}">
							    	<div class="error">{{$errors->first('txtHeDieuHanh')}}</div>
							    </div>
								<label class="col-sm-2 control-label">Màu sắc <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtMauSac" class="form-control" value="{{$chitiet_sanpham->mausac}}">
							    	<div class="error">{{$errors->first('txtMauSac')}}</div>
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Camera trước <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<select name="cbxCameraTruoc" class="form-control">
							    		<option value="">-- Chọn độ phân giải camera trước --</option>
							    		@for($i = 1; $i <= 13; $i++)
							    			@if($chitiet_sanpham->cameratruoc == $i)
							    				<option value="{{$i}}" selected>{{$i }} MP</option>
							    			@else
							    				<option value="{{$i}}">{{$i }} MP</option>
							    			@endif
							    		@endfor
							    		@if($chitiet_sanpham->cameratruoc == 0)
							    			<option value="0" selected>Không có camera</option>
							    		@else
							    			<option value="0">Không có camera</option>
							    		@endif							    		
							    	</select>
							    	<div class="error">{{$errors->first('cbxCameraTruoc')}}</div>
							    </div>
							    <label class="col-sm-2 control-label">Camera sau <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<select name="cbxCameraSau" class="form-control">
							    		<option value="">-- Chọn độ phân giải camera sau --</option>
							    		@for($i = 1; $i <= 20; $i++)
							    			@if($chitiet_sanpham->camerasau == $i)
							    				<option value="{{$i}}" selected>{{$i }} MP</option>
							    			@else
							    				<option value="{{$i}}">{{$i }} MP</option>
							    			@endif
							    		@endfor
							    		@if($chitiet_sanpham->camerasau == 0)
							    			<option value="0" selected>Không có camera</option>
							    		@else
							    			<option value="0">Không có camera</option>
							    		@endif	
							    	</select>
							    	<div class="error">{{$errors->first('cbxCameraSau')}}</div>
							    </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Bộ nhớ trong <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtBoNhoTrong" class="form-control" value="{{$chitiet_sanpham->bonhotrong}}">
							    	<div class="error">{{$errors->first('txtBoNhoTrong')}}</div>
							    </div>
							    <label class="col-sm-2 control-label">Dung lượng pin <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtDungLuongPin" class="form-control" value="{{$chitiet_sanpham->dungluongpin}}">
							    	<div class="error">{{$errors->first('txtDungLuongPin')}}</div>
							    </div>
							</div>
						</div> <!-- end thuộc tính sản phẩm -->


						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Mô tả sản phẩm</h3></div>
							<textarea name="txtMoTa" class="ckeditor" id="editor1" >
								{{$chitiet_sanpham->mota}}
							</textarea>
							<div class="error">{{$errors->first('txtMoTa')}}</div>
						</div> <!--end mô tả sản phẩm -->

						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Ảnh sản phẩm</h3></div>
							@foreach($img_ctsp as $val)
                                <p class="panel-sp" style="float: left; margin-bottom: -10px" id="{!! $val->maanh !!}">
    		                	<img src="{{ asset('public/anh-sanpham/'.$val->tenanh) }}" id="{!! $val->maanh !!}">
    		                	<a id="btn-Xoa" type="button"><span class="fa fa-window-close"></span></a>
                                </p>
		                	@endforeach
						</div>
						<div class="col-md-12 col-sm-12">
							<input id="imgListProduct" name="imgListProduct[]" type="file" multiple>
							<div class="alert alert-danger hide" role="alert">
								
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<button id="btn-addProduct" type="submit" class="btn btn-primary btn-lg">Lưu lại</button>
							<button id="btn-cancelAdd" type="button" class="btn btn-danger btn-lg">Xóa</button>	
						</div>
					</form>
				</div>
			</div>


	<script>
		CKEDITOR.replace('editor1');


		$("#imgDaiDien").fileinput({
			overwriteInitial: true,
		   	showCaption: false,
		   	showUpload: false,
		   	showRemove: true,
		   	removeLabel: '&nbsp;Xóa ảnh',
		   	removeClass: 'btn btn-danger',
		   	showClose: false,
		   	showDrag: false,
		   	showBrowse: false,
		   	browseOnZoneClick: true,
		   	msgInvalidFileExtension: 'Chỉ hỗ trợ file jpg, png, gif',
		   	msgZoomTitle: 'Phóng to',
		   	msgZoomModalHeading: 'Ảnh phóng to',
		   	defaultPreviewContent: '<img src="{{asset("public/anh-sanpham/".$chitiet_sanpham->anh)}}" class="file-preview-image" width="200px" height="200px"><h4>Click chọn ảnh đại diện khác</h4>',
		   	initialPreviewConfig: [{
		   		width: '260px',
				height: '260px',
		   	}],
		   	allowedFileExtensions: ["jpg", "png", "gif"]
		});

		var imgAdd = 4-<?php echo count($img_ctsp) ?>;

		$("#imgListProduct").fileinput({
	        uploadUrl: 'http://localhost/luanvan-ktpm/nguoiban/ql-sanpham/luu-sanpham',
	        showUpload: false,
	        showClose: false,
	        maxFileCount: imgAdd,
	        msgFilesTooMany: 'Số ảnh còn lại bạn được thêm là '+imgAdd+' ảnh',
	        allowedFileExtensions: ["jpg", "png", "gif"],
	        msgInvalidFileExtension: 'Vui lòng chọn file ảnh có đuôi jpg, png, gif',
	        msgPlaceholder: 'Chọn file',
	        dropZoneTitle: 'Bạn có thể đăng tối đa 4 hình ảnh trong 1 sản phẩm<br> Click Browser phía dưới để thêm ảnh !'
	    });  
		
	</script>


@stop