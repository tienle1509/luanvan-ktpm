@extends('quanli_home')

@section('qlsanpham','active')

@section('noidung')
<style type="text/css">
	body {
		background-color: #FFFFFF;
	}
</style>




<div class="container-fluid">
				<h1>Quản lí sản phẩm</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-sanpham')}}">Quản lí sản phẩm</a></li>
						  <li class="active">Chi tiết sản phẩm</li>
						</ol>
					</div>
				</div>


				<div class="row">
					<form id="formInfoProduct" class="form-horizontal" role="form">
						<div class="col-md-12 col-sm-12">
							<div class="title-thongtin">
								<h3>Thông tin sản phẩm của nhà bán hàng <b style="color: #E80202; font-weight: normal;">{{$chitietsp->tengianhang}}</b></h3>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Tên sản phẩm</label>
							    <div class="col-sm-4">
							      <input type="text" class="form-control" value="{{$chitietsp->tensp}}" readonly="">
							    </div>
							    <label class="col-sm-2 control-label">Danh mục sản phẩm</label>
							    <div class="col-sm-4">
							      <input type="text" value="{{$chitietsp->tendanhmuc}}" readonly="" class="form-control">
							    </div>							    
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Giá</label>
							    <div class="col-sm-4">
							      <input type="text" class="form-control" value="{{number_format($chitietsp->dongia)}}" readonly="">
							    </div>	
							    <label class="col-sm-2 control-label">Số lượng</label>
							    <div class="col-sm-4">
							      <input type="text" class="form-control" value="{{$chitietsp->soluong}}" readonly="">
							    </div>					    
							</div>
							<div class="form-group">
								
							</div>
							<div class="form-group">
							    <label class="col-sm-2 control-label">Xuất xứ</label>
							    <div class="col-sm-4">
							      <input type="text" class="form-control" value="{{$chitietsp->xuatxu}}" readonly="">
							    </div>	
							    <label class="col-sm-2 control-label">Bảo hành</label>
							    <div class="col-sm-4">
							      <input type="text" value="{{$chitietsp->baohanh}} tháng" readonly="" class="form-control">
							    </div>						    
							</div>
						</div> <!-- end thông tin -->
						<div class="clearfix"></div>

						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Thuộc tính sản phẩm</h3></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Độ phân giải màn hình</label>
							    <div class="col-sm-4">
							    	<input type="text" class="form-control" value="{{$chitietsp->dophangiaimanhinh}} pixels" readonly="">
							    </div>
								<label class="col-sm-2 control-label">Kích thước màn hình</label>
							    <div class="col-sm-4">
							      	<input type="text" class="form-control" value="{{$chitietsp->kichthuocmanhinh}} inches" readonly="">	    
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Hệ điều hành</label>
							    <div class="col-sm-4">
							    	<input type="text" name="" class="form-control" value="{{$chitietsp->hedieuhanh}}" readonly="">
							    </div>
								<label class="col-sm-2 control-label">Màu sắc</label>
							    <div class="col-sm-4">
							    	<input type="text" class="form-control" value="{{$chitietsp->mausac}}" readonly="">
							    </div>							    
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Camera trước</label>
							    <div class="col-sm-4">
							    	<input type="text" class="form-control" value="{{$chitietsp->cameratruoc}} MP" readonly="">
							    </div>
							    <label class="col-sm-2 control-label">Camera sau</label>
							    <div class="col-sm-4">
							    	<input type="text" class="form-control" value="{{$chitietsp->camerasau}} MP" readonly="">
							    </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Bộ nhớ trong</label>
							    <div class="col-sm-4">
							    	<input type="text" class="form-control" value="{{$chitietsp->bonhotrong}}" readonly="">
							    </div>
							    <label class="col-sm-2 control-label">Dung lượng pin</label>
							    <div class="col-sm-4">
							    	<input type="text" class="form-control" value="{{$chitietsp->dungluongpin}}" readonly="">
							    </div>
							</div>
						</div> <!-- end thuộc tính sản phẩm -->


						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Mô tả sản phẩm</h3></div>
							<textarea name="editor1" class="ckeditor" id="editor1">
								{{$chitietsp->mota}}
							</textarea>
						</div> <!--end mô tả sản phẩm -->

						<div class="col-md-12 col-sm-12">
							<div class="title"><h3>Ảnh sản phẩm</h3></div>
							<input id="imgListProduct" name="" type="file" multiple>
						</div>

						<div class="col-md-12 col-sm-12">
							<a href="{{asset('quanli/ql-sanpham')}}" id="btn-link" class="btn btn-primary btn-lg">Quay lại</a>
						</div>
					</form>
				</div>
			</div>



	<script type="text/javascript">
		CKEDITOR.replace('editor1');


		$(document).ready(function(){

			$("#imgListProduct").fileinput({
				initialPreview: [
				<?php
				//ảnh chính
				echo "'http://localhost/luanvan-ktpm/public/anh-sanpham/".$chitietsp->anh."',";
				//Ảnh phụ
				foreach ($img_phu as $img) {
				echo "'http://localhost/luanvan-ktpm/public/anh-sanpham/".$img->tenanh."',";
				}
				?>
				],
				initialPreviewAsData: true, 
				initialPreviewConfig: [
					{showDrag: false, },
					{showDrag: false, },
					{showDrag: false, },
					{showDrag: false, },
					{showDrag: false, }
				], 
		        showUpload: false,
		        showClose: false,	
		        showRemove: false,
		        showBrowse: false,
		    });
		});
	</script>


@stop