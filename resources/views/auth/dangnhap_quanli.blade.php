<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="icon" type="text/css" href="{{asset('public/img/icon.png')}}">
	<title>Admin - Mobile Store</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">

	<style>
	    #wrapper {
	        padding-left: 0px !important;
	    }
	    body {
	        background-color: #f8f8f8;
	    }
	    #form-login{
	        margin-top: 20px;
	        margin-bottom: 10px;       
	    }
	    .navbar {
	    	border-radius: 0px;
	    }
	    .panel-login {
	    	margin-top: 20px;
	    	width: 380px;
	    	padding: 20px 10px 30px 10px;
	    	background-color: #F2F2F2;
	    	box-shadow: 0px 1px 5px rgba(0,0,0,0.5);
	    }

	    
	</style>

</head>

<body>

	<div id="wrapper">
		<nav class="navbar navbar-inverse" role="navigation">
		  	<div class="navbar-header">
		      <a class="navbar-brand" target="_blank" href="{{asset('')}}">Hệ Thống Quản Lí - Website Thương Mại Điện Tử Mobile Store</a>
		    </div>		   
		</nav>


		<div class="container-fluid">
			<div class="panel-login container">
				<div class="text-center"><img src="{{asset('public/img/iconuser.png')}}"></div>
				<form id="form-login" role="form">
				  <div class="form-group">
				    <label>Tên người dùng</label>
				    <input type="email" class="form-control" id="" placeholder="Nhập địa chỉ email">
				  </div>
				  <div class="form-group">
				    <label>Mật khẩu</label>
				    <input type="password" class="form-control" id="" placeholder="Nhập mật khẩu">
				  </div>
				  <button type="submit" class="btn btn-primary btn-block btn-lg">Đăng nhập</button>
				</form>
			</div>
		</div>



	</div>


</body>
</html>