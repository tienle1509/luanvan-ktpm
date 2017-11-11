<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="icon" type="text/css" href="{{asset('public/img/icon.png')}}">
	<title>Chọn địa chỉ giao hàng</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-nhap-thongtin-donhang.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap-select.min.js')}}"></script>


	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">

	<style type="text/css">
		.err {
			color: red;
			margin-top: 5px;
			font-size: 13px;
			margin-bottom: -5px;
		}
	</style>

	<script type="text/javascript">
		function redirect(){
			window.location = window.location = "http://localhost/luanvan-ktpm/home";
		}

		$(document).ready(function(){
			$('#cbxTinh').change(function(){
				var url = "http://localhost/luanvan-ktpm/chontinh";
				var matinh = $(this).val();
				var count_manb = $(this).parent().attr('id');

				$.ajax({
					url : url,
					type : "GET",
					dataType : "JSON",
					data : {"matinh":matinh, "count_manb":count_manb},
					success : function(result){
						if(result.success){
							$('.gia-ship').html(result.phiship.toLocaleString('de-DE'));
							$('.thanhtien').html((result.phiship+{{$tongtien}}).toLocaleString('de-DE') + ' đ');
						}
					}
				});
			});
		});

	</script>

</head>

<body>
	<div class="header">
		<div class="container container-header">
			<a href="{{asset('home')}}">
				<img src="{{asset('public/img/logo2.png')}}" alt="logoMobileStore">
			</a>
			<div class="text-right">
			    <a href="#" data-toggle="modal" data-target="#modalLogin" data-backdrop="static">Đăng nhập</a> để thanh toán tiện lợi hơn
			    <div><span class="fa fa-question-circle"></span>&nbsp;19008088 (8h-21h hằng ngày)</div>
			</div>


			<!-- Modal Đăng nhập -->
			<div class="modal" id="modalLogin" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close1" data-dismiss="modal">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title">ĐĂNG NHẬP TÀI KHOẢN</h4>
						</div>
						<div class="modal-body">
							<form id="form-dangki">
								<div class="form-group form-group-sm">
									<label>Email<b style="color: red;"> *</b></label>
									<input type="text" name="" class="form-control" placeholder="Nhập địa chỉ email">
								</div>
								<div class="form-group form-group-sm">
									<label>Mật khẩu<b style="color: red;"> *</b></label>
									<input type="text" name="" class="form-control" placeholder="Vui lòng nhập mật khẩu">
								</div>
							</form>						
						</div>
						<div class="modal-footer">
							<button type="submit" class="btntim btn btn-block">ĐĂNG NHẬP</button>
						</div>
					</div>
				</div>
			</div> <!-- end modal đăng nhập -->
		</div>
	</div> <!-- end header -->



	<!-- Body -->
	<div class="container panel-step">
		<div class="step col-md-12 col-sm-12">
			<div class="col-md-4 col-sm-4 step1">
				<span class="badge">1</span>&nbsp;&nbsp;Thông tin giao hàng
			</div>			
			<div class="col-md-4 col-sm-4 step2"> 
				<span class="badge">2</span>&nbsp;&nbsp;Hình thức thanh toán
			</div>
			<div class="col-md-4 col-sm-4 step3">
				<span class="badge">3</span>&nbsp;&nbsp;Đặt hàng
			</div>
		</div>
	</div> <!-- end body -->

	
	<div class="body container">

		<?php
			if($sl == 0){ ?>
				<div class="alert alert-danger" role="alert">
					<strong>Lỗi !</strong> Giỏ hàng đã hết thời gian chờ
				</div>

			<?php 				
				echo '<script type="text/javascript">
					setTimeout("redirect()", 3000);
				</script>';
			}
		?>		

			<div class="panel-diachi col-md-8 col-sm-8">
				<div class="title-diachi row"><h4><span class="fa fa-map-marker"></span>&nbsp;&nbsp;&nbsp;ĐỊA CHỈ GIAO HÀNG</h4></div>
				<form id="form-diachi" action="{{url('nhap-thongtin-donhang')}}" class="form-horizontal" method="post">

					<input type="hidden" name="_token" value="{{csrf_token()}}">

				    <div class="form-group">
				      <label class="control-label col-md-3 col-sm-3">Họ tên: </label>
				      <div class="col-md-9 col-sm-9">
				      	<input type="text" class="form-control input-sm" name="txtTen" placeholder="Ví dụ: Nguyễn Văn A" value="{{old('txtTen')}}">
				      	<div class="err">{{$errors->first('txtTen')}}</div>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3 col-sm-3">Điện thoại:</label>
				      <div class="col-md-4 col-sm-4">
				      	<input type="text" class="form-control input-sm" name="txtSDT" placeholder="Ví dụ: 0978592522" value="{{old('txtSDT')}}">
				      	<div class="err">{{$errors->first('txtSDT')}}</div>
				      </div>
				      <div class="col-md-5 col-sm-5">
				      	<div class="row">Nhân viên giao hàng sẽ liên hệ với SĐT này<br> khi giao hàng</div>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3 col-sm-3">Email:</label>
				      <div class="col-md-9 col-sm-9">
				      	<input type="text" class="form-control input-sm" placeholder="mobilestore@gmail.com" name="txtMail" value="{{old('txtMail')}}">
				      	<div class="err">{{$errors->first('txtMail')}}</div>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3 col-sm-3">Tỉnh/Thành phố:</label>
				      <div class="col-md-9 col-sm-9" id="{{$count_manb}}">
					      <select id="cbxTinh" name="cbxtinh" class="input-sm form-control">
						    	<option value=""> -- Chọn Tỉnh/Thành phố --</option>
						    	<?php
						    		$tinh = DB::table('phi_vanchuyen')->get();
						    		foreach ($tinh as $val) { 
						    			echo '<option value="'.$val->matinh.'">'.$val->tentinh.'</option>';
						    		}
						    	?>					    	
						  </select>
						  <div class="err">{{$errors->first('cbxtinh')}}</div>
					  </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3 col-sm-3">Địa chỉ chi tiết: </label>
				      <div class="col-md-9 col-sm-9">
				     	<textarea class="form-control" placeholder=" Ví dụ: số 5, đường 3/2, phường Xuân Khánh, quận Ninh Kiều" rows="2" name="txtDiaChi"></textarea>
				     	<div class="err">{{$errors->first('txtDiaChi')}}</div>
				      </div>
				    </div>
				    <div class="text-right">
				    	<button type="submit" class="btn btn-danger btn-md">TIẾP TỤC&nbsp;&nbsp;<span class="fa fa-long-arrow-right"></span></button>
				    </div>			    
				</form>
			</div> <!-- end panel địa chỉ-->


		<div class="panel-donhang col-md-4 col-sm-4">
			<div class="title-donhang row">
				ĐƠN HÀNG (Có {{$sl}} sản phẩm)
			</div>

			<!--Thông tin đơn hàng-->
			<div class="content-donhang row">
				@foreach($content as $item)
					<div class="row chitietsp">
						<div class="col-md-3 col-sm-3">
							<img src="{{asset('public/anh-sanpham/'.$item['options']['img'])}}">
						</div>
						<div class="col-md-5 col-sm-5">
							<div class="row">{{$item['name']}}</div>						
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="row">{{$item['qty']}} x {{number_format($item['price'],0,'.','.')}} đ</div>
						</div>
					</div>
				@endforeach
			</div>
			<!--end thông tin đơn hàng -->

			<div class="tongtien row">
				<div class="col-md-5 col-sm-5">
					<div class="label-tamtinh">Tạm tính</div>
					<div class="label-phi">Phí vận chuyển</div>
				</div>
				<div class="col-md-7 col-sm-7 text-right">
					<div class="label-gia">{{number_format($tongtien,0,'.','.')}} đ</div>
					@if($count_manb == 0)
						<div class="label-phi gia-ship">Miễn phí</div>
					@else
						<div class="label-phi gia-ship">
							
						</div>
					@endif
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="tong row">
					<div class="col-md-5 col-sm-5">
						<label>Tổng tiền</label>
					</div>
					<div class="col-md-7 col-sm-7 text-right">
						@if($count_manb == 0)
							<div>{{number_format($tongtien,0,'.','.')}} đ</div>
						@else
							<div class="thanhtien">
								{{number_format($tongtien,0,'.','.')}} đ
							</div>
						@endif
					</div>
				</div>
			</div>
		</div> <!-- end panel đơn hàng -->
	</div>
	
</body>
</html>