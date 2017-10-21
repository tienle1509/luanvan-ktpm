<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="icon" type="text/css" href="{{asset('public/img/icon.png')}}">
	<title>Hình thức thanh toán</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-hinhthucthanhtoan.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap-select.min.js')}}"></script>


	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">


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
		<div class="col-md-8 col-sm-8">
			<div class="panel-thanhtoan row">
				<div class="title-thanhtoan">
					<h4>ĐỊA CHỈ NHẬN HÀNG</h4>
				</div>
				<div class="thongtingiao col-md-9 col-sm-9">
					<label>Nguyễn Văn A</label>
					<p>Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Cần Thơ</p>
					Điện thoại di động: 0927385686
				</div>	
				<div class="thaydoi col-md-3 col-sm-3">
					<a href="dathang1.php">Thay đổi</a>
				</div>			
			</div>

			<div class="panel-thanhtoan row">
				<div class="title-thanhtoan"><h4>PHƯƠNG THỨC THANH TOÁN</h4></div>
				<div class="ht-thanhtoan">
					<div class="col-md-1 col-sm-1">
						<input type="radio" name="httt">
					</div>
					<div class="col-md-11 col-sm-11">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="row-img"><img src="{{asset('public/img/shipper.png')}}"></td>
									<td>
										<label>Thanh toán khi nhận hàng</label>
										<p>Quý khách sẽ thanh toán bằng tiền mặt khi nhận hàng</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="ht-thanhtoan">
					<div class="col-md-1 col-sm-1">
						<input type="radio" name="httt">
					</div>
					<div class="col-md-11 col-sm-11">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="row-img"><img src="{{asset('public/img/iconthe.png')}}"></td>
									<td>
										<label>Thanh toán bằng thẻ ATM</label>
										<p>Thẻ ATM của bạn cần đăng kí sử dụng dịch vụ Internet Banking.</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="text-right">
				<button type="button" class="btn btn-danger">ĐẶT HÀNG</button>
			</div>
		</div> <!-- end panel thanh toán -->




		<div class="panel-donhang col-md-4 col-sm-4">
			<div class="title-donhang row">
				ĐƠN HÀNG (Có 1 sản phẩm)<a href="#" data-toggle="modal" data-target="#modalCart">Thay đổi</a>
			</div>


			<!-- Modal Giỏ hàng -->
			<div class="modal" id="modalCart" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
					  	<div class="modal-header">
					  		<button type="button" class="close1" data-dismiss="modal">
					  			<span aria-hidden="true">&times;</span>
					  			<span class="sr-only">Close</span>
					  		</button>
					  		<h5 class="modal-title">
					  			<span class="fa fa-shopping-cart"></span>
					  				&nbsp;<b style="font-size: 14px; text-align: center;">GIỎ HÀNG </b>
					  			( <b style="color: #DA0000">9</b> sản phẩm )
					  		</h5>	  				
					  	</div>
					  	<div class="modal-body">
					  		<div class="container-fluid list-cart">
					  			<div class="title-cart">
						  			<div class="row">
							  			<div class="col-md-6">Sản phẩm</div>
							  			<div class="col-md-2" style="text-align: center;">Số lượng</div>
							  			<div class="col-md-2" style="text-align: right;">Giá thành</div>
							  			<div class="col-md-2"></div>
						  			</div> 
					  			</div>
					  			<div class="box-scroll">			
							  		<div class="row detail-cart">
							  			<div class="col-md-6">
							  				<img id="imageProduct" src="{{asset('public/anh-sanpham/GalaxyS7_32GB.jpg')}}" alt="imageProduct">
							  				<div class="ten-sp">
								  				<label>ĐIỆN THOẠI SAMSUNG GALAXY S7 Edge 32GB (BẠC) FULL BOX</label>
								  				<a href="#"><span class="fa fa-heart-o">&nbsp;&nbsp;Thêm vào danh sách yêu thích</span></a>
							  				</div>
							  			</div>
							  			<div class="col-md-2 sl-cart">
							  				<select name="" id="">
							  					<option value="1">1</option>
							  					<option selected="" value="2">2</option>
							  					<option value="3">3</option>
							  					<option value="4">4</option>
							  					<option value="5">5</option>
							  				</select>
							  			</div>
							  			<div class="col-md-2 gia-cart">
							  				<label>3.790.000 đ</label>
							  			</div>			  					
							  			<div class="col-md-2 xoasp-cart">
							  				<button type="submit"><span class="fa fa-trash-o"></span></button>
							  			</div>
							  		</div>							  				
							  				
							  		<div class="row detail-cart">
							  			<div class="col-md-6">
							  				<img id="imageProduct" src="{{asset('public/anh-sanpham/GalaxyS7_32GB.jpg')}}" alt="imageProduct">
							  				<div class="ten-sp">
								  				<label>ĐIỆN THOẠI SAMSUNG GALAXY S7 Edge 32GB (BẠC) FULL BOX</label>
								  				<a href="#"><span class="fa fa-heart-o">&nbsp;&nbsp;Thêm vào danh sách yêu thích</span></a>
							  				</div>
							  			</div>
							  			<div class="col-md-2 sl-cart">
							  				<select name="" id="">
							  					<option value="1">1</option>
							  					<option selected="" value="2">2</option>
							  					<option value="3">3</option>
							  					<option value="4">4</option>
							  					<option value="5">5</option>
							  				</select>
							  			</div>
							  			<div class="col-md-2 gia-cart">
							  				<label>3.790.000 đ</label>
							  			</div>			  					
							  			<div class="col-md-2 xoasp-cart">
							  				<button type="submit"><span class="fa fa-trash-o"></span></button>
							  			</div>
							  		</div>

							  		<div class="row detail-cart">
							  			<div class="col-md-6">
							  				<img id="imageProduct" src="{{asset('public/anh-sanpham/GalaxyS7_32GB.jpg')}}" alt="imageProduct">
							  				<div class="ten-sp">
								  				<label>ĐIỆN THOẠI SAMSUNG GALAXY S7 Edge 32GB (BẠC) FULL BOX</label>
								  				<a href="#"><span class="fa fa-heart-o">&nbsp;&nbsp;Thêm vào danh sách yêu thích</span></a>
							  				</div>
							  			</div>
							  			<div class="col-md-2 sl-cart">
							  				<select name="" id="">
							  					<option value="1">1</option>
							  					<option selected="" value="2">2</option>
							  					<option value="3">3</option>
							  					<option value="4">4</option>
							  					<option value="5">5</option>
							  				</select>
							  			</div>
							  			<div class="col-md-2 gia-cart">
							  				<label>3.790.000 đ</label>
							  			</div>			  					
							  			<div class="col-md-2 xoasp-cart">
							  				<button type="submit"><span class="fa fa-trash-o"></span></button>
							  			</div>
							  		</div>							  				  				
							  	</div>	
					  		</div>
						</div>
					  	<div class="modal-footer">
					  		<label class="label-thanhtien">Thành tiền:</label>
					  		<label class="label-tong"> 17.980.000 VND</label>
					  		<div class="label-vat">(Đã bao gồm VAT)</div>
					  		<div class="footer-cart">
					  			<a class="tieptuc-cart" href="{{asset('home')}}"><span class="fa fa-undo">&nbsp;&nbsp;Tiếp tục mua hàng</span></a>
					  			<button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button>
					  		</div>
					  	</div>
					</div>
				</div>
			</div> <!-- end modal giỏ hàng -->



			<!--Thông tin đơn hàng-->
			<div class="content-donhang row">
				<div class="row chitietsp">
					<div class="col-md-3 col-sm-3">
						<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="row">Điện thoại samsung galaxy s7 edge 32gb (bạc) full box</div>						
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="row">1 x 3.790.000 đ</div>
					</div>
				</div>


				<div class="row chitietsp">
					<div class="col-md-3 col-sm-3">
						<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="row">Điện thoại samsung galaxy s7 edge 32gb (bạc) full box</div>						
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="row">1 x 3.790.000 đ</div>
					</div>
				</div>
			</div>
			<!--end thông tin đơn hàng -->


			<div class="tongtien row">
				<div class="col-md-5 col-sm-5">
					<div class="label-tamtinh">Tạm tính</div>
					<div class="label-phi">Phí vận chuyển</div>
				</div>
				<div class="col-md-7 col-sm-7 text-right">
					<div class="label-gia">19.389.000đ</div>
					<div class="label-phi">Miễn phí</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="tong row">
					<div class="col-md-5 col-sm-5">
						<label>Tổng tiền</label>
					</div>
					<div class="col-md-7 col-sm-7 text-right">
						<label>19.389.000đ</label>
					</div>
				</div>
			</div>
		</div> <!-- end panel đơn hàng -->
	</div>




</body>
</html>