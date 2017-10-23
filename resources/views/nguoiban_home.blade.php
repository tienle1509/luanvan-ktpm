<!-- Bắt session khi đăng nhập -->
<?php
	session_start();
	if(!isset($_SESSION['manb'])){
		header("Location: http://localhost/luanvan-ktpm/nguoiban/dangnhap");	
		exit;
	} else {
		$nguoiban = DB::table('nguoi_ban')->where('manb',$_SESSION['manb'])->first();
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
	<title>Kênh người bán</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-home-ban.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/fileinput.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/ckeditor/ckeditor.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/fileinput.js')}}"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">

	<script type="text/javascript">
		//Thay đổi thông tin nhà bán hàng
		$(document).ready(function(){
			$('#btnSave-modalProfile').click(function(){
				var url = "http://localhost/luanvan-ktpm/nguoiban/sua-thongtin";
				var _token = $("form[name='formProfile']").find("input[name='_token']").val();
				var manb = $('#manbProfile').val();
				var tennb = $('#tennbProfile').val();
				var sdt = $('#sdtProfile').val();
				var diachi = $('#diachiProfile').val();

				$.ajax({
					url : url,
					type : "POST",
					dataType : "JSON",
					data : {"_token":_token, "manb":manb, "tennb":tennb, "sdt":sdt, "diachi":diachi},
					success : function(result){
						if(!result.success){
							var html = '';

							$.each(result.errors, function(key, item){
								html += '<li>'+ item + '</li>';
							});
							//Hiển thị lỗi ra
							$('#alert-danger-profile').removeClass('hide');
							$('.errorModalProfile').html(html);
							$('#alert-success-profile').addClass('hide');
						} else { //Thành công
							$('#alert-success-profile').removeClass('hide');
							$('.successModalProfile').html('Chỉnh sửa thông tin thành công !');
							$('#alert-danger-profile').addClass('hide');

							//Tắt modal sau thời gian
							setTimeout(function(){
								$('#modalProfile').modal('hide');

								//Ẩn thông báo lỗi
								$('#alert-danger-profile').addClass('hide');
                                $('#alert-success-profile').addClass('hide');
							}, 2000);
						}
					}
				});
			});			
		});

		//Thay đổi thông tin tài khoản
		$(document).ready(function(){
			$('#btnEdit-modalEdit').click(function(){
				var url = "http://localhost/luanvan-ktpm/nguoiban/sua-taikhoan";
				var _token = $("form[name='formEditPass']").find("input[name='_token']").val();
				var manb = $('#manbEdit').val();
				//var email = $('#mailEdit').val();
				var matkhau1 = $('#pass1Edit').val();
				var matkhau2 = $('#pass2Edit').val();

				$.ajax({
					url : url,
					type : "POST",
					dataType : "JSON",
					data : {"_token":_token, "manb":manb, "matkhau1":matkhau1, "matkhau2":matkhau2},
					success : function(result){
						if(!result.success){
							var html1 = '';

							$.each(result.errors, function(key, item){
								html1 += '<li>'+ item + '</li>';
							});

							//Hiển thông báo lỗi
							$('#alert-danger-Edit').removeClass('hide');
							$('.errorModalEdit').html(html1);
							$('#alert-success-edit').addClass('hide');
						} 
						else {//Thành công
							$('#alert-success-edit').removeClass('hide');
							$('.successModalEdit').html('Cập nhật tài khoản thành công !');
							$('#alert-danger-Edit').addClass('hide');

							//Tắt modal sau thời gian
							setTimeout(function(){
								$('#modalEditPass').modal('hide');

								//Ẩn thông báo lỗi
								$('#alert-danger-Edit').addClass('hide');
                                $('#alert-success-edit').addClass('hide');
							}, 2000);
						}
					}
				});
			});
		});

	</script>

</head>

<body>

	<div class="wrapper">

		<!-- Modal profile-->
		    <div id="modalProfile" class="modal fade">
			  <div class="modal-dialog modal-md">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" align="center"><b>Thông tin nhà bán hàng</b></h4>
			      </div>


			      <div id="alert-danger-profile" class="alert alert-danger hide" role="alert" style="margin-top: 10px; margin-right: 15px; margin-left: 15px;"">
				  	<strong>Lỗi !</strong> Đã xảy ra vui lòng kiểm tra lại<br>
				  	<ul>
				  		<div class="errorModalProfile"></div>
				  	</ul>
				  </div>
				  <div id="alert-success-profile" class="alert alert-success hide" role="alert" style="margin-top: 10px; margin-right: 15px; margin-left: 15px;">
				  		<div class="successModalProfile"></div>
				  </div>


			      <div class="modal-body">
			    	<form id="formProfile" name="formProfile" class="form-horizontal" role="form" action="{{ action('EditProfileNguoiBanController@postSuaThongTin') }}" method="post">

			    	  <input type="hidden" name="_token" value="{{ csrf_token() }}">

					  <div class="form-group">
					    <label class="col-md-4 control-label">Mã nhà bán hàng:</label>
					    <div class="col-md-8">
					      <input type="text" id="manbProfile" class="form-control" readonly="" value="{{$nguoiban->manb}}">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-md-4 control-label">Họ và tên:</label>
					    <div class="col-md-8">
					      <input type="text" id="tennbProfile" class="form-control" value="{{$nguoiban->tennb}}">
					    </div>
					  </div>				  
					  <div class="form-group">
					    <label class="col-md-4 control-label">Số điện thoại:</label>
					    <div class="col-md-8">
					      <input type="text" id="sdtProfile" class="form-control" value="{{$nguoiban->sodienthoai}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-md-4 control-label">Tên gian hàng:</label>
					    <div class="col-md-8">
					      <input type="text" id="tenghProfile" class="form-control" readonly="" value="{{$nguoiban->tengianhang}}">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-md-4 control-label">Địa chỉ:</label>
					    <div class="col-md-8">
					      <textarea class="form-control" id="diachiProfile" cols="2">{{$nguoiban->diachi}}</textarea>
					    </div>
					  </div>
					  <div class="text-center">
					  	<button id="btnSave-modalProfile" type="button" class="btn btn-primary">Lưu lại</button>
					  </div>
					</form>
			      </div>		      
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal profile -->


			<!-- Modal editPass -->
			<div id="modalEditPass" class="modal fade">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" align="center"><b>Cài đặt tài khoản</b></h4>
			      </div>

			      	<div id="alert-danger-Edit" class="alert alert-danger hide" role="alert" style="margin-top: 10px; margin-right: 15px; margin-left: 15px;"">
					  	<strong>Lỗi !</strong> Đã xảy ra vui lòng kiểm tra lại<br>
					  	<ul>
					  		<div class="errorModalEdit" style="margin-left: -10px;"></div>
					  	</ul>
					</div>
					<div id="alert-success-edit" class="alert alert-success hide" role="alert" style="margin-top: 10px; margin-right: 15px; margin-left: 15px;">
					  	<div class="successModalEdit"></div>
					</div>

			      <div class="modal-body">
					<form id="formEditPass" name="formEditPass" role="form">

			          <input type="hidden" name="_token" value="{{ csrf_token() }}">

					  <div class="form-group">
					    <label>Mã nhà bán hàng</label>
					    <input type="text" class="form-control" id="manbEdit" readonly="" value="{{$nguoiban->manb}}">
					  </div>
					  <div class="form-group">
					    <label>Địa chỉ email</label>
					    <input type="text" id="mailEdit" class="form-control" value="{{$nguoiban->email}}" readonly="">
					  </div>
					  <div class="form-group">
					    <label>Mật khẩu</label>
					    <input type="password" id="pass1Edit" class="form-control" placeholder="Nhập mật khẩu">
					  </div>
					  <div class="form-group">
					    <label>Xác nhận mật khẩu</label>
					    <input type="password" id="pass2Edit" class="form-control" placeholder="Nhập lại mật khẩu">
					  </div>
					  <div class="text-center">
				        <button id="btnEdit-modalEdit" type="button" class="btn btn-primary">Lưu Thay Đổi</button>
				      </div>				  
					</form>
			      </div>		      
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal edit pass-->
	
		<nav id="navbar" class="navbar">
		  <div class="row">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="{{asset('home')}}" target="_blank">
		      	<img src="{{asset('public/img/logo-home-ban.png')}}">
		      </a>
		    </div>
		    <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          <button class="btndrop dropdown-toggle" data-toggle="dropdown">
		          	<span class="fa fa-user"></span>&nbsp;&nbsp;{{ $nguoiban->tengianhang }}&nbsp;
		          	<span class="caret"></span>
		          </button>
		          <ul class="dropdown-menu">
		            <li><a href="#" data-toggle="modal" data-target="#modalProfile"><span class="fa fa-user"></span>&nbsp;&nbsp;Thông tin</a></li>
		            <li><a href="#" data-toggle="modal" data-target="#modalEditPass"><span class="fa fa-plus"></span>&nbsp;&nbsp;Cài đặt tài khoản</a></li>
		            <li class="divider"></li>
		            <li><a href="{{ asset('nguoiban/dangxuat') }}"><span class="fa fa-power-off"></span>&nbsp;&nbsp;Đăng xuất</a></li>
		          </ul>
		        </li>
		    </ul>
		    <div class="collapse navbar-collapse" id="myNavbar">
		     	<ul class="nav navbar-nav side-nav">	     		
		     		<li><a class="@yield('sanpham')" href="{{asset('nguoiban/ql-sanpham')}}">
		     			<span class="fa fa-mobile"></span>&nbsp;&nbsp;Sản phẩm</a>
		     		</li>
		     		<li><a class="@yield('donhang')" href="{{asset('nguoiban/donhang')}}">
		     			<span class="fa fa-list-alt"></span>&nbsp;&nbsp;Đơn hàng</a>
		     		</li>
		     		<li><a class="@yield('cauhoi')" href="">
		     			<span class="fa fa-comments-o"></span>&nbsp;&nbsp;Phản hồi câu hỏi</a>
		     		</li>
		     		<li><a class="@yield('khuyenmai')" href="{{asset('nguoiban/khuyenmai')}}">
		     			<span class="fa fa-bullhorn"></span>&nbsp;&nbsp;Khuyến mãi</a>
		     		</li>	     		
		     		<li><a class="@yield('thongke')" href="">
		     			<span class="fa fa-flag"></span>&nbsp;&nbsp;Thống kê</a>
		     		</li>
		     	</ul>
		    </div>		    
		  </div>
		 </div>
		</nav>


		<div id="page-wrapper">
			@yield('noidung')
		</div>


	</div> <!-- end wrapper -->

</body>
</html>