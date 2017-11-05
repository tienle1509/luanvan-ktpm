<?php
	if(!isset($_SESSION['tenkh'])){
		header("Location: http://localhost/luanvan-ktpm/home");	
		exit;
	}	
?>


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

	<script type="text/javascript">
		
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
	    			var donhang = '';

if(result.soluong == 0){
ndGioHang = '<div class="modal-footer"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><br><div class="text-center" style="margin-bottom: 40px;"><img src="{{asset('public/img/Cart.png')}}"><h4><b>Giỏ hàng của bạn hiện đang trống</b></h4><p>Hãy nhanh tay sở hữu những sản phẩm yêu thích của bạn</p><button type="button" class="btn btn-danger" data-dismiss="modal">Tiếp tục mua sắm&nbsp;&nbsp;<span class="fa fa-long-arrow-right"></span></button></div></div>';


$('#ndGioHang').html(ndGioHang);

setTimeout(function(){
	window.location = "http://localhost/luanvan-ktpm/home";
}, 1000);

} else {

	for (var i in result.content) {
	   //console.log(result.content[i]['qty']);
	   	masp = result.content[i]['id'];
	    rowid = result.content[i]['rowid'];
	    duongdan = 'public/anh-sanpham/'+result.content[i]['options']['img'];
	    ten = result.content[i]['name'];
	    gia = result.content[i]['price'];
	    soluong = result.content[i]['qty']
	    tongtien = result.tongtien;

box += '<div class="row detail-cart"><div class="col-md-6"><img id="imageProduct" src="'+ duongdan +'" alt="imageProduct"><div class="ten-sp"><label>'+ ten +'</label><div class="xoasp-cart"><button class="XoaSP" id="'+ rowid +'"><span class="fa fa-trash-o"></span>&nbsp;Bỏ sản phẩm</button></div></div></div><div class="col-md-2 gia-cart"><label>'+ gia.toLocaleString('de-DE') +' đ</label></div><div class="col-md-2 sl-cart" id="'+ masp +'"><input type="number" id="'+ rowid +'" class="inputSL" min="1" max="100" value="'+ soluong +'"></div><div class="col-md-2 tong-cart"><label>'+ (gia*soluong).toLocaleString('de-DE') +' đ</label></div></div>';
	
donhang += '<div class="row chitietsp"><div class="col-md-3 col-sm-3"><img src="'+ duongdan +'"></div><div class="col-md-5 col-sm-5"><div class="row">'+ ten +'</div></div><div class="col-md-4 col-sm-4"><div class="row">'+ soluong +' x '+ gia.toLocaleString('de-DE') +' đ</div></div></div>';

	}


ndGioHang = '<div class="modal-header"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h5 class="modal-title"><span class="fa fa-shopping-cart"></span>&nbsp;<b style="font-size: 14px; text-align: center; color: blue">GIỎ HÀNG </b>( <b style="color: #DA0000" id="numCart">'+ result.soluong +'</b> sản phẩm )</h5></div><div id="erroCart" class="alert alert-danger hide" style="margin:15px;"></div><div class="modal-body"><div class="container-fluid list-cart"><div class="title-cart"><div class="row"><div class="col-md-6">Sản phẩm</div><div class="col-md-2" style="text-align: center;">Giá thành</div><div class="col-md-2" style="text-align: center;">Số lượng</div><div class="col-md-2">Thành tiền</div></div></div><div class="box-scroll">'+ box +'</div></div></div><div class="modal-footer"><label class="label-thanhtien">Thành tiền:</label><label class="label-tong">'+ tongtien.toLocaleString('de-DE') +' VND</label><div class="label-vat">(Đã bao gồm VAT)</div><div class="footer-cart"><a class="tieptuc-cart" data-dismiss="modal" class="btn" type="button" style="cursor: pointer;"><span class="fa fa-long-arrow-left">&nbsp;&nbsp;Tiếp tục mua hàng</span></a><form action="{{url("nhap-thongtin-donhang")}}" method="get"><button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button></form></div></div>';

if(tongtien > 300000){
	$('.thanhtien').html(tongtien.toLocaleString('de-DE'));
	$('.gia-ship').html('Miễn phí');
}else{	
	$('.thanhtien').html((tongtien+<?php echo $phiship->giacuoc; ?>).toLocaleString('de-DE'));
	$('.gia-ship').html((<?php echo $phiship->giacuoc; ?>).toLocaleString('de-DE'));
}
$('.label-gia').html(tongtien.toLocaleString('de-DE'));
$('.sldonhang').html(result.soluong);
$('.content-donhang').html(donhang);
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

	    			//Panel đơn hàng
	    			var donhang = '';

for (var i in result.content) {
	  // console.log(result.content[i]['qty']);
	   	masp = result.content[i]['id'];
	    rowid = result.content[i]['rowid'];
	    duongdan = 'public/anh-sanpham/'+result.content[i]['options']['img'];
	    ten = result.content[i]['name'];
	    gia = result.content[i]['price'];
	    soluong = result.content[i]['qty']
	    tongtien = result.tongtien;

box += '<div class="row detail-cart"><div class="col-md-6"><img id="imageProduct" src="'+ duongdan +'" alt="imageProduct"><div class="ten-sp"><label>'+ ten +'</label><div class="xoasp-cart"><button class="XoaSP" id="'+ rowid +'"><span class="fa fa-trash-o"></span>&nbsp;Bỏ sản phẩm</button></div></div></div><div class="col-md-2 gia-cart"><label>'+ gia.toLocaleString('de-DE') +' đ</label></div><div class="col-md-2 sl-cart" id="'+ masp +'"><input type="number" id="'+ rowid +'" class="inputSL" min="1" max="100" value="'+ soluong +'"></div><div class="col-md-2 tong-cart"><label>'+ (gia*soluong).toLocaleString('de-DE') +' đ</label></div></div>';
	
donhang += '<div class="row chitietsp"><div class="col-md-3 col-sm-3"><img src="'+ duongdan +'"></div><div class="col-md-5 col-sm-5"><div class="row">'+ ten +'</div></div><div class="col-md-4 col-sm-4"><div class="row">'+ soluong +' x '+ gia.toLocaleString('de-DE') +' đ</div></div></div>';


	}


ndGioHang = '<div class="modal-header"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h5 class="modal-title"><span class="fa fa-shopping-cart"></span>&nbsp;<b style="font-size: 14px; text-align: center; color: blue">GIỎ HÀNG </b>( <b style="color: #DA0000" id="numCart">'+ result.soluong +'</b> sản phẩm )</h5></div><div id="erroCart" class="alert alert-danger hide" style="margin:15px;"></div><div class="modal-body"><div class="container-fluid list-cart"><div class="title-cart"><div class="row"><div class="col-md-6">Sản phẩm</div><div class="col-md-2" style="text-align: center;">Giá thành</div><div class="col-md-2" style="text-align: center;">Số lượng</div><div class="col-md-2">Thành tiền</div></div></div><div class="box-scroll">'+ box +'</div></div></div><div class="modal-footer"><label class="label-thanhtien">Thành tiền:</label><label class="label-tong">'+ tongtien.toLocaleString('de-DE') +' VND</label><div class="label-vat">(Đã bao gồm VAT)</div><div class="footer-cart"><a class="tieptuc-cart" data-dismiss="modal" class="btn" type="button" style="cursor: pointer;"><span class="fa fa-long-arrow-left">&nbsp;&nbsp;Tiếp tục mua hàng</span></a><form action="{{url("nhap-thongtin-donhang")}}" method="get"><button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button></form></div></div>';

if(tongtien > 300000){
	$('.thanhtien').html(tongtien.toLocaleString('de-DE'));
	$('.gia-ship').html('Miễn phí');
}else{	
	$('.thanhtien').html((tongtien+<?php echo $phiship->giacuoc; ?>).toLocaleString('de-DE'));
	$('.gia-ship').html((<?php echo $phiship->giacuoc; ?>).toLocaleString('de-DE'));
}
$('.label-gia').html(tongtien.toLocaleString('de-DE'));
$('.sldonhang').html(result.soluong);
$('.content-donhang').html(donhang);
$('#ndGioHang').html(ndGioHang); 

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
		<div class="col-md-8 col-sm-8">
			<div class="panel-thanhtoan row">
				<div class="title-thanhtoan">
					<h4>ĐỊA CHỈ NHẬN HÀNG</h4>
				</div>
				<div class="thongtingiao col-md-9 col-sm-9">
					<label>{{$_SESSION['tenkh']}}</label>
					<p>{{$_SESSION['diachi'].' , '.$_SESSION['tentinh']}}</p>
					Điện thoại di động: {{$_SESSION['sdt']}}
				</div>	
				<div class="thaydoi col-md-3 col-sm-3">
					<a href="{{asset('nhap-thongtin-donhang')}}">Thay đổi</a>
				</div>			
			</div>

		<form id="formThanhToan" action="{{url('dathang')}}" method="post">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="panel-thanhtoan row">
				<div class="title-thanhtoan"><h4>PHƯƠNG THỨC THANH TOÁN</h4></div>
				<div class="ht-thanhtoan">
					<div class="col-md-1 col-sm-1">
						<input id="cod" type="radio" name="httt" value="1" checked="">
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
						<input id="tructuyen" type="radio" name="httt" value="2">
					</div>
					<div class="col-md-11 col-sm-11">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="row-img"><img src="{{asset('public/img/iconthe.png')}}"></td>
									<td>
										<label>Thanh toán trực tuyến</label>
									</td>
								</tr>								
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="text-right">
				<button type="submit"  class="btn btn-danger">ĐẶT HÀNG</button>
			</div>
		</form>
		</div> <!-- end panel thanh toán -->

		<!-- Modal Giỏ hàng -->
			<div class="modal" id="modalCart" tabindex="-1" role="dialog">
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
							  		{{$sl}}
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
							  		@foreach($content as $item)
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
								{{number_format($_SESSION['tongtien'],0,'.','.')}}
								 VND</label>
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
			</div> <!-- end modal giỏ hàng -->


		<div class="panel-donhang col-md-4 col-sm-4">
			<div class="title-donhang row">
				ĐƠN HÀNG (Có <b class="sldonhang">{{$sl}}</b> sản phẩm)<a href="#" data-toggle="modal" data-target="#modalCart">Thay đổi</a>
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
							<div class="row">
								{{$item['qty']}} x {{number_format($item['price'],0,'.','.')}} đ</div>
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
					<div class="label-gia">
						{{number_format($tongtien,0,'.','.')}} đ
					</div>
					@if($tongtien > 300000)
						<div class="label-phi gia-ship">Miễn phí</div>
					@else
						<div class="label-phi gia-ship">
							<?php
								$phiship = DB::table('phi_vanchuyen as vc')
											->join('khu_vuc as kv', 'kv.makv', '=', 'vc.makv')
											->where('vc.matinh', $_SESSION['matinh'])
											->first();
								echo number_format($phiship->giacuoc,0, '.','.');
							?>
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
						@if($tongtien > 300000)
							<div class="thanhtien">{{number_format($tongtien,0,'.','.')}} đ</div>
						@else
							<div class="thanhtien">
								{{number_format($tongtien+$phiship->giacuoc,0,'.','.')}} đ
							</div>
						@endif
					</div>
				</div>
			</div>
		</div> <!-- end panel đơn hàng -->
	</div>




</body>
</html>