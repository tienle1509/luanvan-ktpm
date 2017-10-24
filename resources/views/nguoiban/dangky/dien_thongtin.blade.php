<?php
	if(!isset($_SESSION['tenshop'])){
		header("Location: http://localhost/luanvan-ktpm/nguoiban/dangnhap");	
		exit;
	} else {
		$tenshop = $_SESSION['tenshop'];
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
	<title>Mobile Store-Kênh người bán</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-dangki-ban3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">


</head>
<body>

	<div class="header">
		<div class="container container-header">
			<img src="{{asset('public/img/logo2.png')}}" alt="logoMobileStore">
			<div class="text-right">
			    <i>Mọi thắc mắc xin vui lòng liên hệ</i>
			    <div><span class="fa fa-question-circle"></span>&nbsp;19008088 (8h-21h hằng ngày)</div>
			</div>
		</div>
	</div>


	<div class="container panel-diachi">
		<h2>Chào shop <b style="color: red; font-weight: normal;">{{ $tenshop }}</b></h2>
		<form id="form-diachi" role="form" action="{{ url('nguoiban/postdien-thongtin') }}" method="post">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
			    <label>Họ tên</label>
			    <input type="text" value="{{$_SESSION['hoten']}}" readonly="">
			  </div>
			  <div class="form-group">
			    <label>Email</label>
			   	<input type="text" value="{{$_SESSION['email']}}" readonly="">
			  </div>
			  <div class="form-group">
			    <label>Số điện thoại</label>
			    <input type="text" value="{{$_SESSION['sdt']}}" readonly="">
			  </div>
			  <div class="form-group">
			    <label>Địa chỉ shop</label>
			    <textarea placeholder="Nhập địa chỉ shop tại đây"  class="form-control" rows="3" autofocus="" name="textareaDiaChi"></textarea>
			  </div>
			  <div style="color: red; margin-top: -5px; margin-bottom: -3px;">{{$errors->first('textareaDiaChi')}}</div>		  
			  <button type="submit" class="btn btn-danger btn-lg">VÀO SHOP</button>
		</form>
	</div>

	<div class="footer text-center">
		<b>Copyright &copy; 2014 MobileStore.vn</b>
		<div>Công ty cổ phần công nghệ Mobile. Địa chỉ: Số 108, Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Tp. Cần Thơ.</div>
	</div>

</body>
</html>