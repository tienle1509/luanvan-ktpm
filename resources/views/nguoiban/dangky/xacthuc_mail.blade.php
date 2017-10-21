<?php  
	session_start();
	if(!isset($_SESSION['email'])){
		header("Location: http://localhost/luanvan-ktpm/nguoiban/dangnhap");	
		exit;
	} else {
		$email = $_SESSION['email'];
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
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-dangki-ban2.css')}}">
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
			    <i>Không nhận được mã?</i>
			    <div><span class="fa fa-question-circle"></span>&nbsp;19008088 (8h-21h hằng ngày)</div>
			</div>
		</div>
	</div>

	<div class="container panel-xacthuc">
		<h2><b>XÁC THỰC EMAIL</b></h2>
		<P>Mã xác thực vừa gửi đến email {{ $email }}.<br>Bạn vui lòng mở email để nhận mã xác thực để tiếp tục</P>
		<form id="form-xacthuc" role="form" action="{{ url('nguoiban/postxacthuc-mail') }}" method="post">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
		  		<input class="form-control input-lg" name="txtMaXacNhan" placeholder="Mã xác thực gồm 6 chữ số" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
		  	</div>
		  	<div style="color: red;">{!! $errors->first('txtMaXacNhan'); !!}</div>
		  	<button type="submit" class="btn btn-danger btn-lg">TIẾP TỤC</button>
		</form>
		<form id="form-guilaimail" role="form" action="{{ url('nguoiban/postguilaimail') }}" method="post">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		  	<button type="submit">Gửi lại mã xác thực</button>

		  	<?php
		  		if(isset($_SESSION['success_guima']))
		  			echo "<script>alert('".$_SESSION['success_guima']."');</script>";
		  			unset($_SESSION['success_guima']);
		  	?>

		</form>
	</div>

	<div class="footer text-center">
		<b>Copyright &copy; 2014 MobileStore.vn</b>
		<div>Công ty cổ phần công nghệ Mobile. Địa chỉ: Số 108, Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Tp. Cần Thơ.</div>
	</div>

</body>
</html>