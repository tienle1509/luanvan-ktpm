<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="icon" type="text/css" href="{{asset('public/img/icon.png')}}">
	<title>@yield('title-page')</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/slick.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-khachhang-home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/slick-theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/star-rating.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/jquery-migrate-1.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/slick.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap-select.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/jquery.elevatezoom.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/star-rating.js')}}"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">


	<script type="text/javascript">
		$(document).ready(function(){
	        $('[data-toggle="tooltip"]').tooltip();
	    });    


//Xóa sản phẩm trong gio hàng
$(document).ready(function(){
	$("body").on("click", ".XoaSP",function(){
	    var url = "http://localhost/luanvan-ktpm/xoa-sanpham";
	    var id = $(this).attr('id');

	    $.ajax({
	    	url : url,
	    	type : "GET",
	    	dataType : "JSON",
	    	data : {"id":id},
	    	success : function(result){
	    		if(result.success){
	    			$('#numCart').html(result.soluong);
	    			$('#btnCart').html(result.soluong);
	    			var box = '';
	    			var duongdan = '';
	    			var ten = '';
	    			var gia = '';
	    			var soluong = '';
	    			var tongtien = '';
	    			var ndGioHang = '';
	    			var rowid = '';
	    			var masp = '';

if(result.soluong == 0){
ndGioHang = '<div class="modal-footer"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><br><div class="text-center" style="margin-bottom: 40px;"><img src="{{asset('public/img/Cart.png')}}"><h4><b>Giỏ hàng của bạn hiện đang trống</b></h4><p>Hãy nhanh tay sở hữu những sản phẩm yêu thích của bạn</p><button type="button" class="btn btn-danger" data-dismiss="modal">Tiếp tục mua sắm&nbsp;&nbsp;<span class="fa fa-long-arrow-right"></span></button></div></div>';


$('#ndGioHang').html(ndGioHang);

} else {

	for (var i in result.content) {
	   //console.log(result.content[i]['qty']);
	   	masp = result.content[i]['id'];
	    rowid = result.content[i]['rowid'];
	    duongdan = '/luanvan-ktpm/public/anh-sanpham/'+result.content[i]['options']['img'];
	    ten = result.content[i]['name'];
	    gia = result.content[i]['price'];
	    soluong = result.content[i]['qty']
	    tongtien = result.tongtien;

box += '<div class="row detail-cart"><div class="col-md-6"><img id="imageProduct" src="'+ duongdan +'" alt="imageProduct"><div class="ten-sp"><label>'+ ten +'</label><div class="xoasp-cart"><button class="XoaSP" id="'+ rowid +'"><span class="fa fa-trash-o"></span>&nbsp;Bỏ sản phẩm</button></div></div></div><div class="col-md-2 gia-cart"><label>'+ gia.toLocaleString('de-DE') +' đ</label></div><div class="col-md-2 sl-cart" id="'+ masp +'"><input type="number" id="'+ rowid +'" class="inputSL" min="1" max="100" value="'+ soluong +'"></div><div class="col-md-2 tong-cart"><label>'+ (gia*soluong).toLocaleString('de-DE') +' đ</label></div></div>';
	}


ndGioHang = '<div class="modal-header"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h5 class="modal-title"><span class="fa fa-shopping-cart"></span>&nbsp;<b style="font-size: 14px; text-align: center; color: blue">GIỎ HÀNG </b>( <b style="color: #DA0000" id="numCart">'+ result.soluong +'</b> sản phẩm )</h5></div><div id="erroCart" class="alert alert-danger hide" style="margin:15px;"></div><div class="modal-body"><div class="container-fluid list-cart"><div class="title-cart"><div class="row"><div class="col-md-6">Sản phẩm</div><div class="col-md-2" style="text-align: center;">Giá thành</div><div class="col-md-2" style="text-align: center;">Số lượng</div><div class="col-md-2">Thành tiền</div></div></div><div class="box-scroll">'+ box +'</div></div></div><div class="modal-footer"><label class="label-thanhtien">Thành tiền:</label><label class="label-tong">'+ tongtien.toLocaleString('de-DE') +' VND</label><div class="label-vat">(Đã bao gồm VAT)</div><div class="footer-cart"><a class="tieptuc-cart" data-dismiss="modal" class="btn" type="button" style="cursor: pointer;"><span class="fa fa-long-arrow-left">&nbsp;&nbsp;Tiếp tục mua hàng</span></a><form action="{{url("nhap-thongtin-donhang")}}" method="get"><button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button></form></div></div>';

$('#ndGioHang').html(ndGioHang); 

	    				}
	    			} 
	    		}
	    	}); 
	    }); 
	});  



//Cập nhật số lượng trong giỏ hàng
$(document).ready(function(){
	$('body').on('change', '.inputSL', function(){
		var url = "http://localhost/luanvan-ktpm/sua-sanpham";
		//var soluong = $(this).attr('value');
		var soluong = $(this).val();
		var id = $(this).attr('id');
		var masp = $(this).parent().attr('id');

		$.ajax({
			url : url,
			type : "GET",
			dataType : "JSON",
			data : {"soluong":soluong, "id":id, "masp":masp},
			success : function(result){
				if(!result.success){
					var loi = '';
					$.each(result.errors, function(key, item){
						loi += item;
					});
					$('#erroCart').removeClass('hide');
					$('#erroCart').html(loi);
				} else {
					$('#erroCart').addClass('hide');
					
					$('#numCart').html(result.soluong);
	    			$('#btnCart').html(result.soluong);
	    			var box = '';
	    			var duongdan = '';
	    			var ten = '';
	    			var gia = '';
	    			var soluong = '';
	    			var tongtien = '';
	    			var ndGioHang = '';
	    			var rowid = '';
	    			var masp = '';

for (var i in result.content) {
	   //console.log(result.content[i]['qty']);
	   	masp = result.content[i]['id'];
	    rowid = result.content[i]['rowid'];
	    duongdan = '/luanvan-ktpm/public/anh-sanpham/'+result.content[i]['options']['img'];
	    ten = result.content[i]['name'];
	    gia = result.content[i]['price'];
	    soluong = result.content[i]['qty']
	    tongtien = result.tongtien;

box += '<div class="row detail-cart"><div class="col-md-6"><img id="imageProduct" src="'+ duongdan +'" alt="imageProduct"><div class="ten-sp"><label>'+ ten +'</label><div class="xoasp-cart"><button class="XoaSP" id="'+ rowid +'"><span class="fa fa-trash-o"></span>&nbsp;Bỏ sản phẩm</button></div></div></div><div class="col-md-2 gia-cart"><label>'+ gia.toLocaleString('de-DE') +' đ</label></div><div class="col-md-2 sl-cart" id="'+ masp +'"><input type="number" id="'+ rowid +'" class="inputSL" min="1" max="100" value="'+ soluong +'"></div><div class="col-md-2 tong-cart"><label>'+ (gia*soluong).toLocaleString('de-DE') +' đ</label></div></div>';
	}


ndGioHang = '<div class="modal-header"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h5 class="modal-title"><span class="fa fa-shopping-cart"></span>&nbsp;<b style="font-size: 14px; text-align: center; color: blue">GIỎ HÀNG </b>( <b style="color: #DA0000" id="numCart">'+ result.soluong +'</b> sản phẩm )</h5></div><div id="erroCart" class="alert alert-danger hide" style="margin:15px;"></div><div class="modal-body"><div class="container-fluid list-cart"><div class="title-cart"><div class="row"><div class="col-md-6">Sản phẩm</div><div class="col-md-2" style="text-align: center;">Giá thành</div><div class="col-md-2" style="text-align: center;">Số lượng</div><div class="col-md-2">Thành tiền</div></div></div><div class="box-scroll">'+ box +'</div></div></div><div class="modal-footer"><label class="label-thanhtien">Thành tiền:</label><label class="label-tong">'+ tongtien.toLocaleString('de-DE') +' VND</label><div class="label-vat">(Đã bao gồm VAT)</div><div class="footer-cart"><a class="tieptuc-cart" data-dismiss="modal" class="btn" type="button" style="cursor: pointer;"><span class="fa fa-long-arrow-left">&nbsp;&nbsp;Tiếp tục mua hàng</span></a><form action="{{url("nhap-thongtin-donhang")}}" method="get"><button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button></form></div></div>';

$('#ndGioHang').html(ndGioHang); 


				}
			}
		}); 
	});
});

	
	//Kiểm tra đơn hàng
	$(document).ready(function(){
		$('#btnKTDonHang').click(function(){
			var url = "http://localhost/luanvan-ktpm/kiemtra-donhang";
			var madh = $('form[name="form-ktdonhang"]').find('input[name="madonhang"]').val();
			var email = $('form[name="form-ktdonhang"]').find('input[name="email"]').val();

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"madh":madh, "email":email},
				success : function(result){
					if(!result.success){
						var madh = '';
						var email = '';
						var tt_sai = '';
						$.each(result.errors, function(key, item){
							if(key == 'madh'){
								madh += item;			
							}
							if(key == 'email'){
								email += item;
							}
							if(key == 'tt_sai'){
								tt_sai += item;
							}
						});
						$('.error_madh').html(madh);
						$('.error_email').html(email);
						$('.tt_sai').html(tt_sai);
					}else{
						window.location="http://localhost/luanvan-ktpm/thongtin-donhang";
					}
				}
			});
		});
	});

	//Đăng kí tài khoản
	$(document).ready(function(){
		$('#btnDangKi').click(function(){
			var url = "http://localhost/luanvan-ktpm/dangki-taikhoan";
			var hoten = $('form[name="form-dangki"]').find('input[name="hoten"]').val();
			var email = $('form[name="form-dangki"]').find('input[name="email"]').val();
			var matkhau1 = $('form[name="form-dangki"]').find('input[name="matkhau1"]').val();
			var matkhau2 = $('form[name="form-dangki"]').find('input[name="matkhau2"]').val();
			var _token = $('form[name="form-dangki"]').find('input[name="_token"]').val();

			$.ajax({
				url : url,
				type : "POST", 
				dataType : "JSON",
				data : {"hoten":hoten, "email":email, "matkhau1":matkhau1, "matkhau2":matkhau2, "_token":_token},
				success : function(result){
					if(!result.success){
						var ht = '';
						var email = '';
						var mk1 = '';
						var mk2 = '';
						$.each(result.errors, function(key, item){
							if(key == 'hoten'){
								ht += item;
							}
							if(key == 'email'){
								email += item;
							}
							if(key == 'matkhau1'){
								mk1 += item;
							}
							if(key == 'matkhau2'){
								mk2 += item;
							}
						});
						$('#errHT').html(ht);
						$('#errEmail').html(email);
						$('#errMK1').html(mk1);
						$('#errMK2').html(mk2);
					}else{
						window.location="http://localhost/luanvan-ktpm/quanli-taikhoan";
					}
				}
			});
		});
	});

	//Đăng nhập tài khoản
	$(document).ready(function(){
		$('#btnDangNhap').click(function(){
			var url = "http://localhost/luanvan-ktpm/dangnhap";
			var email = $('form[name="form-dangnhap"]').find('input[name="email"]').val();
			var matkhau = $('form[name="form-dangnhap"]').find('input[name="matkhau"]').val();
			var _token = $('form[name="form-dangnhap"]').find('input[name="_token"]').val();

			$.ajax({
				url : url,
				type : "POST",
				dataType : "JSON",
				data : {"email":email, "matkhau":matkhau, "_token":_token},
				success : function(result){
					if(!result.success){
						var email = '';
						var mk = '';
						var sai_dl = '';
						$.each(result.errors, function(key, item){
							if(key == 'email'){
								email += item;
							}
							if(key == 'matkhau'){
								mk += item;
							}
							if(key == 'sai_dl'){
								sai_dl += item;
							}
						});
						$('.sai_dl').html(sai_dl);
						$('.mail_dn').html(email);
						$('.mk_dn').html(mk);
					}else{
						window.location="http://localhost/luanvan-ktpm/quanli-taikhoan";
					}
				}
			});
		});
	});

	</script>


</head>

<body>

	<header>
		<div class="container">
			<div class="row">
				<ul class="submenu nav nav-pills col-md-9 col-sm-9 pull-right">		
					<?php 
						if(isset($_SESSION['makh'])){ 
							$kh = DB::table('khach_hang')->where('makh', $_SESSION['makh'])->first();
						?>
							<li>
								<button class="btndrop dropdown-toggle" data-toggle="dropdown" style="min-width: 150px;">
									<span class="fa fa-user-o"></span>&nbsp;&nbsp;{{$kh->tennguoidung}}
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{asset('quanli-taikhoan')}}"><span class="fa fa-smile-o"></span>&nbsp;&nbsp;Quản lí tài khoản</a></li>
						            <li><a href="#"><span class="fa fa-bars"></span>&nbsp;&nbsp;Đơn hàng của tôi</a></li>
						            <li class="divider"></li>
						           	<li><a href="{{ asset('dangxuat') }}"><span class="fa fa-power-off"></span>&nbsp;&nbsp;Đăng xuất</a></li>
						        </ul>
							</li>							
						<?php }
					?>
					<?php 
						if(!isset($_SESSION['makh'])){ ?>
							<li>
								<button class="btndrop btnmodal" data-toggle="modal" data-target="#modalRegister" data-backdrop="static">
									<span class="fa fa-user-plus"></span>&nbsp;&nbsp;Đăng ký
								</button>
							</li>
							<li>
								<button class="btndrop btnmodal" data-toggle="modal" data-target="#modalLogin" data-backdrop="static">
									<span class="fa fa-user"></span>&nbsp;&nbsp;Đăng nhập
								</button>
							</li>							
						<?php }
					?>
					<li>
						<button class="btndrop" data-toggle="modal" data-target="#modalCheckOrder">
							<span class="fa fa-list-alt"></span>&nbsp;&nbsp;Kiểm tra đơn hàng&nbsp;
						</button>
					</li>
					<li><a href="{{asset('nguoiban/dangnhap')}}" target="_blank"><span class="fa fa-handshake-o"></span>&nbsp;&nbsp;Bán hàng cùng Mobile Store</a></li>




					<!-- Modal kiểm tra đơn hàng -->
					<div class="modal" id="modalCheckOrder" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close1" data-dismiss="modal">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<h4 class="modal-title">KIỂM TRA ĐƠN HÀNG</h4>
								</div>

								<div class="tt_sai" style="color: red; margin-left: 10px;"></div>

								<div class="modal-body">
									<form name="form-ktdonhang" method="get" action="{{ action('KiemTraDonHangController@getKiemTraDonHang') }}">
										<div class="form-group form-group-sm">
											<label>Mã đơn hàng<b style="color: red;"> *</b></label>
											<input type="text" name="madonhang" class="form-control" placeholder="Nhập mã đơn hàng">
											<div class="error_madh" style="color: red; margin-bottom: -10px;"></div>
										</div>
										<div class="form-group form-group-sm">
											<label>Email<b style="color: red;"> *</b></label>
											<input type="text" name="email" class="form-control" placeholder="Nhập email">
											<div class="error_email" style="color: red; margin-bottom: -15px;"></div>
										</div>
									</form>						
								</div>
								<div class="modal-footer">
									<button id="btnKTDonHang" type="button" class="btntim btn btn-block">KIỂM TRA</button>
								</div>
							</div>
						</div>
					</div> <!-- end modal kiểm tra đơn hàng -->


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

								<div class="sai_dl" style="color: red; margin-bottom: -10px; margin-left: 20px;"></div>

								<div class="modal-body">
									<form id="form-dangnhap" name="form-dangnhap" method="post" action="{{ action('TaiKhoanKhachHangController@postDangNhap')}}">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<div class="form-group form-group-sm">
											<label>Email<b style="color: red;"> *</b></label>
											<input type="text" name="email" class="form-control" placeholder="Nhập địa chỉ email">
											<div class="mail_dn" style="color: red; margin-bottom: -10px;"></div>
										</div>
										<div class="form-group form-group-sm">
											<label>Mật khẩu<b style="color: red;"> *</b></label>
											<input type="password" name="matkhau" class="form-control" placeholder="Vui lòng nhập mật khẩu">
											<div class="mk_dn" style="color: red; margin-bottom: -10px;"></div>
										</div>
									</form>						
								</div>
								<div class="modal-footer">
									<button id="btnDangNhap" type="button" class="btntim btn btn-block">ĐĂNG NHẬP</button>
								</div>
							</div>
						</div>
					</div> <!-- end modal đăng nhập -->

					<!-- Modal Đăng Kí -->
					<div class="modal" id="modalRegister" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close1" data-dismiss="modal">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<h4 class="modal-title">ĐĂNG KÍ TÀI KHOẢN</h4>
								</div>
								<div class="modal-body">
									<form id="form-dangki" name="form-dangki" method="post" action="{{ action('TaiKhoanKhachHangController@postDangKi') }}">

										<input type="hidden" name="_token" value="{{csrf_token()}}">

										<div class="form-group form-group-sm">
											<label>Họ và Tên<b style="color: red;"> *</b></label>
											<input type="text" name="hoten" class="form-control" placeholder="Nhập họ tên">
											<div id="errHT" style="color: red; margin-bottom: -10px;"></div>
										</div>
										<div class="form-group form-group-sm">
											<label>Email<b style="color: red;"> *</b></label>
											<input type="text" name="email" class="form-control" placeholder="Nhập địa chỉ email muốn đăng kí">
											<div id="errEmail" style="color: red; margin-bottom: -10px;"></div>
										</div>
										<div class="form-group form-group-sm">
											<label>Mật khẩu<b style="color: red;"> *</b></label>
											<input type="password" name="matkhau1" class="form-control" placeholder="Vui lòng nhập mật khẩu">
											<div id="errMK1" style="color: red; margin-bottom: -10px;"></div>
										</div>
										<div class="form-group form-group-sm">
											<label>Nhập lại mật khẩu<b style="color: red;"> *</b></label>
											<input type="password" name="matkhau2" class="form-control" placeholder="Vui lòng nhập lại mật khẩu">
											<div id="errMK2" style="color: red; margin-bottom: -10px;"></div>
										</div>
									</form>						
								</div>
								<div class="modal-footer">
									<button id="btnDangKi" type="button" class="btntim btn btn-block">ĐĂNG KÍ</button>
								</div>
							</div>
						</div>
					</div> <!-- end modal đăng kí -->
				</ul>
			</div> <!--end row-->		
		</div>
	</header>
	<div class="clearfix"></div>


	<!--Modal giỏ hàng -->
	<div class="modal" id="modalCart" tabindex="-1" role="dialog">
		<?php 
			if(!isset($_SESSION['content'])){ ?>
				<div class="modal-dialog">
				    <div id="ndGioHang" class="modal-content">
				      	<div class="modal-footer">
				      	 	<button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				      	 	<br>
				       		<div class="text-center" style="margin-bottom: 40px;">
				       			<img src="{{asset('public/img/Cart.png')}}">
				       			<h4><b>Giỏ hàng của bạn hiện đang trống</b></h4>
				       			<p>Hãy nhanh tay sở hữu những sản phẩm yêu thích của bạn</p>
				       			<button type="button" class="btn btn-danger" data-dismiss="modal">
				       				Tiếp tục mua sắm&nbsp;&nbsp;
				       				<span class="fa fa-long-arrow-right"></span>
				       			</button>
				       		</div>
				      	</div>
				    </div>
				</div><!-- /.modal-dialog -->
			<?php } else { ?>
				<div class="modal-dialog">
					<div id="ndGioHang" class="modal-content">
						<div class="modal-header">
							<button type="button" class="close1" data-dismiss="modal">
							  	<span aria-hidden="true">&times;</span>
							  	<span class="sr-only">Close</span>
							</button>
							<h5 class="modal-title">
							  	<span class="fa fa-shopping-cart"></span>
							  	&nbsp;<b style="font-size: 14px; text-align: center; color: blue">GIỎ HÀNG </b>
							  	( <b style="color: #DA0000" id="numCart">
							  		<?php
							          	if(isset($_SESSION['soluong'])){
							          		echo $_SESSION['soluong'];
							          	} else{
							          		echo "0";
							          	}
							        ?>
							  	</b> sản phẩm )
							</h5>	  				
						</div>

						<div id="erroCart" class="alert alert-danger hide" style="margin:15px;">
							
						</div>

						<div class="modal-body">
							<div class="container-fluid list-cart">
							  	<div class="title-cart">
								  	<div class="row">
									  	<div class="col-md-6">Sản phẩm</div>
									  	<div class="col-md-2" style="text-align: center;">Giá thành</div>
									  	<div class="col-md-2" style="text-align: center;">Số lượng</div>
									  	<div class="col-md-2">Thành tiền</div>
								  	</div> 
							  	</div>
							  	<div class="box-scroll">
							  		@foreach($_SESSION['content'] as $item)
							  			<div class="row detail-cart">
										  	<div class="col-md-6">
										  		<img id="imageProduct" src="{{asset('public/anh-sanpham/'.$item['options']['img'])}}" alt="imageProduct">
										  		<div class="ten-sp">
											  		<label>{{$item['name']}}</label>
											  		<div class="xoasp-cart">
											  			<button class="XoaSP" id="{{$item['rowid']}}"><span class="fa fa-trash-o"></span>&nbsp;Bỏ sản phẩm</button>
										  			</div>
										  		</div>
										  	</div>
										  	<div class="col-md-2 gia-cart">
										  		<label>{{number_format($item['price'],0,'.','.')}} đ</label>
										  	</div>
										  	<div class="col-md-2 sl-cart" id="{{$item['id']}}">
										  		<input type="number" class="inputSL" min="1" max="100" value="{{$item['qty']}}" id="{{$item['rowid']}}">
										  	</div>				
										  	<div class="col-md-2 tong-cart">
										  		<label>{{number_format($item['price']*$item['qty'],0,'.','.')}} đ</label>
										  	</div>
										</div>
							  		@endforeach				  				 				
								</div>	
							</div>
						</div>
						<div class="modal-footer">
							<label class="label-thanhtien">Thành tiền:</label>
							<label class="label-tong"> 
								<?php
									if(isset($_SESSION['tongtien'])){
										echo number_format($_SESSION['tongtien'],0,'.','.');
									}
								?> VND</label>
							<div class="label-vat">(Đã bao gồm VAT)</div>
							<div class="footer-cart">
							  	<a class="tieptuc-cart" data-dismiss="modal" class="btn" type="button" style="cursor: pointer;">
							  		<span class="fa fa-long-arrow-left">&nbsp;&nbsp;Tiếp tục mua hàng</span></a>
							  	<form action="{{url('nhap-thongtin-donhang')}}" method="get">
							  		<button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button>
							  	</form>
							</div>
						</div>
					</div>
				</div>
			<?php }
		?>
		
	</div>  <!-- end modal giỏ hàng -->




	<!-- header menu -->
	<div data-spy="affix" data-offset-top="100">
		<div class="container">
			<div class="row">
				<nav id="top-nav" class="navbar col-md-12 col-sm-12" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainnav">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="{{asset('home')}}">
				      	<img id="logo" src="{{asset('public/img/logo2.png')}}" alt="logoMobileStore">
				      </a>
				    </div>

				    
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div id="mainnav" class="collapse navbar-collapse">
				      <form name="formSearch" class="navbar-form navbar-left" role="search" method="get" action="{{url('timkiem')}}">
				        <div class="input-group">
				          <input type="search" name="keysearch" placeholder="Nhập từ khóa tìm kiếm ...">
				          <select name="searchdanhmuc" id="select-danhmuc">
				          	<?php
				          		$dmselect = DB::table('danhmuc_sanpham')->get();	
				          	?>
				          	<option value="">Tất cả danh mục</option>
				          	@foreach($dmselect as $val)
				          		<option value="{{$val->madm}}">{{$val->tendanhmuc}}</option>
				          	@endforeach
				          </select>
				          <span class="input-group-btn">
				          	<button type="submit" class="btn btn-search">
				          		&nbsp;<span class="fa fa-search"></span>
				          	</button>
				          </span>
				        </div>
				      </form>
				      <ul class="nav-right nav navbar-nav navbar-right">
				        <li>
				        	<button class="btn-cart navbar-btn" data-toggle="modal" data-target="#modalCart" data-backdrop="static">
					          	<span class="fa fa-shopping-cart"></span>&nbsp;&nbsp;Giỏ hàng&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					          	<span id="btnCart" class="badge">
					          		<?php
					          			if(isset($_SESSION['soluong'])){
					          				echo $_SESSION['soluong'];
					          			} else{
					          				echo "0";
					          			}
					          		?>
					          	</span>
					        </button> 
				        </li>
				      </ul>	      
				    </div><!-- /.navbar-collapse -->


				    <!-- Modal Giỏ hàng -->
					<!-- end modal giỏ hàng -->
				</nav>	
			</div>		
		</div>	
	</div> <!-- end header menu -->






	@yield('noidung')








	<!-- Footer -->
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<h4>Mobile Store</h4>
					<div>
						<a href="">Giới thiệu về Mobile Store</a>
						<a href="">Quy chế hoạt động</a>
						<a href="">Liên hệ với Mobile Store</a>
						<a href="">Trung tâm hỗ trợ khách hàng</a>
						<a href="">Đăng kí mở gian hàng</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<h4>Chăm sóc khách hàng</h4>
					<div>
						<a href="">Kiểm tra đơn hàng</a>
						<a href="">Hướng dẫn mua hàng</a>
						<a href="">Phương thức vận chuyển</a>
						<a href="">Chính sách đổi trả</a>
						<a href="">Câu hỏi thường gặp</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<h4>Hỗ trợ thanh toán online</h4>
					<div>
						<img src="{{asset('public/img/stripe.png')}}" alt="logonganluong" style="width: 190px; height: 45px;">
					</div>
					<h4>Đối tác vận chuyển</h4>
					<img src="{{asset('public/img/vietnampost.png')}}" alt="logovnpost">
					<img src="{{asset('public/img/logo-ghtk.png')}}" alt="logoghtk">
					<img src="{{asset('public/img/ghn.jpg')}}" alt="logoghn" style="padding-top: 10px;">
				</div>
				<div class="col-md-3 col-sm-3">
					<h5>Được chứng nhận</h5>
					<img src="{{asset('public/img/bocongthuong.gif')}}" alt="logobocongthuong">
				</div>
			</div>

			<div class="diachi row">
				<b>Copyright &copy; 2014 MobileStore.vn</b>
					<div>Công ty cổ phần công nghệ Mobile</div>
					<div>Địa chỉ: Số 108, Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Tp. Cần Thơ.</div>
			</div>
		</div>
	</div>

</body>
</html>