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
						<a class="nav-bottom-km" href="{{asset('khuyenmai')}}">
						<span class="fa fa-gift"></span>&nbsp;&nbsp;&nbsp;KHUYẾN MÃI
						</a>
					</li>
					<li><a class="nav-bottom-banchay" href="{{asset('sanpham-banchay')}}"><span class="fa fa-tags"></span>&nbsp;&nbsp;&nbsp;BÁN CHẠY</a></li>	
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
			<h4>Thay đổi địa chỉ giao hàng</h4>
			@if($kh->tenkh == '')
				<form id="form-suathongtin" class="form-horizontal" role="form" method="post" action="{{ url('luu-thaydoi-diachi')}}">

				<input type="hidden" name="_token" value="{{csrf_token()}}">

				  <div class="form-group">
				    <label class="col-sm-4 control-label">Họ tên <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				    	<input type="text" name="txtHoTen" class="form-control" value="{{old('txtHoTen')}}">
				    	<div style="color: red; margin-bottom: -10px;">{{$errors->first('txtHoTen')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Số điện thoại <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				      <input type="text" name="txtSDT" class="form-control" value="{{old('txtSDT')}}">
				      <div style="color: red; margin-bottom: -10px;">{{$errors->first('txtSDT')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Tỉnh/Thành Phố <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				    	<select name="cbxtinh" class="input-sm form-control">
							<option value=""> -- Chọn Tỉnh/Thành phố --</option>
					    	<?php
					    		$tinh = DB::table('phi_vanchuyen')->get();
					    		foreach ($tinh as $val) { 
					    			echo '<option value="'.$val->matinh.'">'.$val->tentinh.'</option>';
					    		}
					    	?>					    	
					  	</select>
					  	<div style="color: red; margin-bottom: -10px;">{{$errors->first('cbxtinh')}}</div>					  					  	
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Địa chỉ chi tiết <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				    	<textarea class="form-control" rows="2" name="txtDiaChi"></textarea>
				    	<div style="color: red; margin-bottom: -10px;">{{$errors->first('txtDiaChi')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-8">
				      <button type="submit" class="btn btn-primary">Lưu lại</button>&nbsp;&nbsp;&nbsp;
				      <a href="{{asset('quanli-taikhoan')}}" type="button" class="btn btn-default">Hủy bỏ</a>
				    </div>
				  </div>
				</form>
			@else
				<form id="form-suathongtin" class="form-horizontal" role="form" method="post" action="{{ url('luu-thaydoi-diachi')}}">

					<input type="hidden" name="_token" value="{{csrf_token()}}">

				  <div class="form-group">
				    <label class="col-sm-4 control-label">Họ tên <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				    	<input type="text" name="txtHoTen" class="form-control" value="{{$kh->tenkh}}">
				    	<div style="color: red; margin-bottom: -10px;">{{$errors->first('txtHoTen')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Số điện thoại <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				      <input type="text" name="txtSDT" class="form-control" value="{{$kh->sodienthoai}}">
				      <div style="color: red; margin-bottom: -10px;">{{$errors->first('txtSDT')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Tỉnh/Thành Phố <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				    	<?php
					 		$tinh = DB::table('phi_vanchuyen')->get();
					  		$matinh = '';
					    	foreach ($tinh as $val) { 
					    		if(mb_stripos($kh->diachigiaohang, $val->tentinh)){
					    			$matinh += $val->matinh;
					    			break;
					    		}				    		
					   	} ?>
					    	<select name="cbxtinh" class="input-sm form-control">
								<option value=""> -- Chọn Tỉnh/Thành phố --</option>
						    	<?php
						    		$tinh = DB::table('phi_vanchuyen')->get();
						    		foreach ($tinh as $val) { 
						    			if($val->matinh == $matinh){
								        	echo '<option value="'.$val->matinh.'" selected>'.$val->tentinh.'</option>';
								        }else{
								        	echo '<option value="'.$val->matinh.'">'.$val->tentinh.'</option>';
								        }						    			
						    		}
						    	?>					    	
						  	</select>
						  	<div style="color: red; margin-bottom: -10px;">{{$errors->first('cbxtinh')}}</div>	  	
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Địa chỉ chi tiết <b style="color: red">*</b></label>
				    <div class="col-sm-8">
				    	<?php
				    		$tinh = DB::table('phi_vanchuyen')->get();
							$tentinh = '';
						   	foreach ($tinh as $val) { 
						  		if(mb_stripos($kh->diachigiaohang, $val->tentinh)){
						  			$tentinh = $val->tentinh;
						   			break;
						   		}				    		
						   	}
						   	$dc_chitiet = str_replace($tentinh, '', $kh->diachigiaohang);
				    	?>
				    	<textarea class="form-control" rows="2" name="txtDiaChi">{{rtrim($dc_chitiet,', ')}}</textarea>
				    	<div style="color: red; margin-bottom: -10px;">{{$errors->first('txtDiaChi')}}</div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-8">
				      <button type="submit" class="btn btn-primary">Lưu lại</button>&nbsp;&nbsp;&nbsp;
				      <a href="{{asset('quanli-taikhoan')}}" type="button" class="btn btn-default">Hủy bỏ</a>
				    </div>
				  </div>
				</form>
			@endif
		</div>
		
	</div>


	


@stop