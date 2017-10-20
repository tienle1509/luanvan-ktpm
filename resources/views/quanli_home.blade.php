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
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-home-admin.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/fileinput.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/jquery-ui.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/ckeditor/ckeditor.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/fileinput.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/jquery-ui.js')}}"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">

	<script type="text/javascript">
		// datepicker		
		$(function () {
                $("#Sdate").datepicker();
                 $("#Edate").datepicker();
        });
	</script>

</head>

<body>
	<!-- Modal editPass -->
			<div id="modalEditPass" class="modal fade">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" align="center"><b>Cài đặt tài khoản</b></h4>
			      </div>
			      <div class="modal-body">
			        <form id="formEditPass" role="form">
					  <div class="form-group">
					    <label>Mã quản lí</label>
					    <input type="text" class="form-control" readonly="" value="NB001">
					  </div>
					  <div class="form-group">
					    <label>Địa chỉ email</label>
					    <input type="text" class="form-control" value="nguyenvana0947@gmail.com">
					  </div>
					  <div class="form-group">
					    <label>Mật khẩu</label>
					    <input type="password" class="form-control" placeholder="Nhập mật khẩu">
					  </div>
					  <div class="form-group">
					    <label>Xác nhận mật khẩu</label>
					    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu">
					  </div>
					  <div class="text-center">
				        <button type="button" class="btn btn-primary">Lưu Thay Đổi</button>
				      </div>				  
					</form>
			      </div>		      
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal edit pass-->

	<div class="wrapper">
		<nav id="navbar" class="navbar">
		  <div class="row">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="{{asset('home')}}" target="_blank">Hệ Thống Quản Lí - Website Thương Mại Điện Mobile Store</a>
		    </div>
		    <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          <button class="btndrop dropdown-toggle" data-toggle="dropdown">
		          	<span class="fa fa-user"></span>&nbsp;&nbsp;Nguyễn Văn A&nbsp;
		          	<span class="caret"></span>
		          </button>
		          <ul class="dropdown-menu">
		           	<li><a href="#" data-toggle="modal" data-target="#modalEditPass"><span class="fa fa-plus"></span>&nbsp;&nbsp;Cài đặt tài khoản</a></li>
		            <li><a href="{{ asset('quanli/dangnhap') }}"><span class="fa fa-power-off"></span>&nbsp;&nbsp;Đăng xuất</a></li>
		          </ul>
		        </li>
		    </ul>
		    <div class="collapse navbar-collapse" id="myNavbar">
		     	<ul class="nav navbar-nav side-nav">	     		
		     		<li><a class="@yield('qlsanpham')" href="{{asset('quanli/ql-sanpham')}}">
		     			<span class="fa fa-mobile"></span>&nbsp;&nbsp;Quản lí sản phẩm</a>
		     		</li>
		     		<li><a class="@yield('qldonhang')" href="{{asset('quanli/ql-donhang')}}">
		     			<span class="fa fa-list-alt"></span>&nbsp;&nbsp;Quản lí đơn hàng</a>
		     		</li>
		     		<li><a class="@yield('qlnguoiban')" href="">
		     			<span class="fa fa-users"></span>&nbsp;&nbsp;Nhà bán hàng</a>
		     		</li>
		     		<li><a class="@yield('qlkhachhang')" href="">
		     			<span class="fa fa-users"></span>&nbsp;&nbsp;Khách hàng</a>
		     		</li>
		     		<li><a class="@yield('qlkhuyenmai')" href="{{asset('quanli/khuyenmai')}}">
		     			<span class="fa fa-bullhorn"></span>&nbsp;&nbsp;Quản lí khuyến mãi</a>
		     		</li>
		     	</ul>
		    </div>		    
		  </div>
		 </div>
		</nav>


		<div id="page-wrapper">
			@yield('noidung')
		</div>

	</div><!--end wrapper-->

</body>
</html>