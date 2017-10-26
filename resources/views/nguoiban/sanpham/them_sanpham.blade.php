@extends('nguoiban_home')

@section('sanpham', 'active')

@section('noidung')


<style type="text/css">
	.error {
		color: red;
		margin-top: 6px;
	}
</style>


<div class="container-fluid">
				<h1>Thêm sản phẩm</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/ql-sanpham')}}">Sản phẩm</a></li>
						  <li class="active">Thêm sản phẩm</li>
						</ol>
					</div>
				</div>

				<div class="row">
					<form id="formInfoProduct" class="form-horizontal" role="form" enctype="multipart/form-data" action="{{action('SanPhamNguoiBanController@postLuuSanPham')}}" method="post">

						<input type="hidden" name="_token" value="{{ csrf_token()}}">

						<div class="col-md-3 col-sm-3">
							<input id="imgDaiDien" name="anhDaiDien" type="file">
							<div class="error" style="margin-top: 10px; text-align: center;">{{$errors->first('anhDaiDien')}}</div>
						</div>
						<div class="col-md-9 col-sm-9">
							<div class="title-thongtin"><h3>Thông tin chung</h3></div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Chọn danh mục <b style="color: red">*</b></label>
							    <div class="col-sm-10">
							    	<select name="cbxDanhMuc" class="form-control">
							    		<option value="">-- Chọn danh mục sản phẩm --</option>
							    		@foreach($list_dm as $val)
							    			@if(!empty($val))
							    				<option value="{{$val->madm}}">{{$val->tendanhmuc}}</option>
							    			@endif
							    		@endforeach
							    	</select>
							    	<div class="error">{{$errors->first('cbxDanhMuc')}}</div>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Tên sản phẩm <b style="color: red">*</b></label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" name="txtTenSanPham" placeholder="Nhập tên sản phẩm" value="{{ old('txtTenSanPham')}}">
							      <div class="error">{{$errors->first('txtTenSanPham')}}</div>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Giá <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <input type="text" class="form-control" name="txtGia" placeholder="Nhập giá" value="{{old('txtGia')}}">
							      <div class="error">{{$errors->first('txtGia')}}</div>
							    </div>
							    <label class="col-sm-1 control-label">VND</label>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Số lượng <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <input type="text" class="form-control" name="txtSoLuong" value="{{old('txtSoLuong')}}" placeholder="Nhập số lượng" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							      <div class="error">{{$errors->first('txtSoLuong')}}</div>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Xuất xứ <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <input type="text" class="form-control" name="txtXuatXu" placeholder="Nhập xuất xứ" value="{{old('txtXuatXu')}}">
							      <div class="error">{{$errors->first('txtXuatXu')}}</div>
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Bảo hành <b style="color: red">*</b></label>
							    <div class="col-sm-6">
							      <select name="cbxBaoHanh" class="form-control">
							      	<option value="">-- Chọn thời gian bảo hành --</option>
							      	@for($i = 1; $i <= 12; $i++)
							      		<option value="{{$i}}">{{$i}}  tháng</option>
							      	@endfor
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
							    	<input type="text" name="txtDPGMH" class="form-control" placeholder="Nhập độ phân giải màn hình" value="{{old('txtDPGMH')}}">
							    	<div class="error">{{$errors->first('txtDPGMH')}}</div>
							    </div>
								<label class="col-sm-2 control-label">Kích thước màn hình <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="type" name="txtKichThuocMH" class="form-control" placeholder="Nhập kích thước màn hình" value="{{old('txtKichThuocMH')}}">						      
							      <div class="error">{{$errors->first('txtKichThuocMH')}}</div>	
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Hệ điều hành <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtHeDieuHanh" class="form-control" placeholder="Nhập hệ điều hành" value="{{old('txtHeDieuHanh')}}">
							    	<div class="error">{{$errors->first('txtHeDieuHanh')}}</div>
							    </div>
								<label class="col-sm-2 control-label">Màu sắc <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtMauSac" class="form-control" placeholder="Nhập màu sản phẩm" value="{{old('txtMauSac')}}">
							    	<div class="error">{{$errors->first('txtMauSac')}}</div>
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Camera trước <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<select name="cbxCameraTruoc" class="form-control">
							    		<option value="">-- Chọn độ phân giải camera trước --</option>
							    		@for($i = 1; $i <= 13; $i++)
							    			<option value="{{$i}}">{{$i }} MP</option>
							    		@endfor
							    		<option value="0">Không có camera</option>
							    	</select>
							    	<div class="error">{{$errors->first('cbxCameraTruoc')}}</div>
							    </div>
							    <label class="col-sm-2 control-label">Camera sau <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<select name="cbxCameraSau" class="form-control">
							    		<option value="">-- Chọn độ phân giải camera sau --</option>
							    		@for($i = 1; $i <= 20; $i++)
							    			<option value="{{$i}}">{{$i }} MP</option>
							    		@endfor
							    		<option value="0">Không có camera</option>
							    	</select>
							    	<div class="error">{{$errors->first('cbxCameraSau')}}</div>
							    </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Bộ nhớ trong <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtBoNhoTrong" class="form-control" placeholder="Nhập bộ nhớ trong" value="{{old('txtBoNhoTrong')}}">
							    	<div class="error">{{$errors->first('txtBoNhoTrong')}}</div>
							    </div>
							    <label class="col-sm-2 control-label">Dung lượng pin <b style="color: red">*</b></label>
							    <div class="col-sm-4">
							    	<input type="text" name="txtDungLuongPin" class="form-control" placeholder="Nhập dung lượng pin" value="{{old('txtDungLuongPin')}}">
							    	<div class="error">{{$errors->first('txtDungLuongPin')}}</div>
							    </div>
							</div>
						</div> <!-- end thuộc tính sản phẩm -->


						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Mô tả sản phẩm</h3></div>
							<textarea name="txtMoTa" class="ckeditor" id="editor1"></textarea>
							<div class="error">{{$errors->first('txtMoTa')}}</div>
						</div> <!--end mô tả sản phẩm -->

						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Ảnh sản phẩm</h3></div>
							<input id="imgListProduct" name="imgListProduct[]" type="file" multiple>
						</div>

						<div class="col-md-12 col-sm-12">
							<button id="btn-addProduct" type="submit" class="btn btn-primary btn-lg">Lưu lại</button>
							<a id="btn-cancelAdd" href="{{asset('nguoiban/ql-sanpham')}}" type="button" class="btn btn-default btn-lg">Hủy</a>	
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
		   	defaultPreviewContent: '<img src="{{asset("public/img/imgdaidien.png")}}" class="file-preview-image" width="200px" height="200px"><h4>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click chọn ảnh đại diện</h4>',
		   	initialPreviewConfig: [{
		   		width: '260px',
				height: '260px',
		   	}],
		   	allowedFileExtensions: ["jpg", "png", "gif"]
		});


		$("#imgListProduct").fileinput({
	        uploadUrl: 'http://localhost/luanvan-ktpm/nguoiban/ql-sanpham/luu-sanpham',
	        showUpload: false,
	        showClose: false,
	        maxFileCount: 4,
	        msgFilesTooMany: 'Chỉ được chọn 4 ảnh',
	        allowedFileExtensions: ["jpg", "png", "gif"],
	        msgInvalidFileExtension: 'Vui lòng chọn file ảnh có đuôi jpg, png, gif',
	        msgPlaceholder: 'Chọn file',
	        dropZoneTitle: 'Bạn có thể đăng tối đa 4 hình ảnh trong 1 sản phẩm<br> Click Browser phía dưới để thêm ảnh !'
	    });  
		
	</script>


@stop