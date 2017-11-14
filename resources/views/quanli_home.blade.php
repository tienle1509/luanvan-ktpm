<!-- Kiểm tra session -->
<?php
	if(!isset($_SESSION['maql'])){
		header("Location: http://localhost/luanvan-ktpm/quanli/dangnhap");	
		exit;
	} 
	$quanli = DB::table('nguoi_quanli')->where('maql',$_SESSION['maql'])->first();

?>


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
	/*	$(function () {
                $("#Sdate").datepicker({
                	dateFormat : 'dd-mm-yy',
                    minDate: 0,
                    onClose: function (selectedDate) {
                        if (selectedDate != ""){ 
                            $("#Edate").datepicker("option", "minDate", selectedDate); }
                    }
                });
                $("#Edate").datepicker({
                	dateFormat : 'dd-mm-yy',
                    minDate: 'selectedDate',
                });
        });  */

        //Thay đổi thông tin quản lí
        $(document).ready(function(){
        	$('#btn-EditAccount').click(function(){
        		var url = "http://localhost/luanvan-ktpm/quanli/sua-taikhoan";
        		var _token = $('form[name="formEditPass"]').find('input[name="_token"]').val();
        		var maql = $('#idMaQL').val();
        		var matkhau1 = $('#idMatKhau1').val();
        		var matkhau2 = $('#idMatKhau2').val();

        		$.ajax({
        			url : url,
        			type : "POST",
        			dataType : "JSON",
        			data : {"maql":maql, "matkhau1":matkhau1, "matkhau2":matkhau2, "_token":_token},
        			success : function(result){
        				if(!result.success){
        					var html = '';
        					$.each(result.errors, function(key, item){
        						html += '<li>'+item+'</li>';
        					});
        					//Hiển thông báo lỗi
							$('#alert-danger-edit').removeClass('hide');
							$('.errorModaledit').html(html);
							$('#alert-success-edit').addClass('hide');
        				} else { //Thành công
        					$('#alert-success-edit').removeClass('hide');
							$('.successModaledit').html('Cập nhật tài khoản thành công !');
							$('#alert-danger-edit').addClass('hide');

							//Tắt modal sau thời gian
							setTimeout(function(){
								$('#modalEditPass').modal('hide');

								//Ẩn thông báo lỗi
								$('#alert-danger-edit').addClass('hide');
                                $('#alert-success-edit').addClass('hide');
                                document.getElementById('idMatKhau1').value = "";
                                document.getElementById('idMatKhau2').value = "";
							}, 2000);
        				}
        			}
        		});
        	});
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

			      <div id="alert-danger-edit" class="alert alert-danger hide" role="alert" style="margin-top: 10px; margin-right: 15px; margin-left: 15px; margin-bottom: -8px">
				  	<strong>Lỗi !</strong> Đã xảy ra vui lòng kiểm tra lại<br>
				  	<ul>
				  		<div class="errorModaledit"></div>
				  	</ul>
				  </div>
				  <div id="alert-success-edit" class="alert alert-success hide" role="alert" style="margin-top: 10px; margin-right: 15px; margin-left: 15px;">
				  		<div class="successModaledit"></div>
				  </div>


			      <div class="modal-body">
			        <form id="formEditPass" role="form" name="formEditPass" action="{{action('EditAccountQuanLiController@postSuaTaiKhoan')}}" method="post">

			          <input type="hidden" name="_token" value="{{csrf_token()}}">

					  <div class="form-group">
					    <label>Mã quản lí</label>
					    <input type="text" class="form-control" id="idMaQL" readonly="" value="{{$quanli->maql}}">
					  </div>
					  <div class="form-group">
					    <label>Địa chỉ email</label>
					    <input type="text" class="form-control" value="{{$quanli->email}}" readonly="">
					  </div>
					  <div class="form-group">
					    <label>Mật khẩu</label>
					    <input type="password" class="form-control" id="idMatKhau1" placeholder="Nhập mật khẩu">
					  </div>
					  <div class="form-group">
					    <label>Xác nhận mật khẩu</label>
					    <input type="password" class="form-control" id="idMatKhau2" placeholder="Nhập lại mật khẩu">
					  </div>
					  <div class="text-center">
				        <button id="btn-EditAccount" type="button" class="btn btn-primary">Lưu Thay Đổi</button>
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
		          	<span class="fa fa-user"></span>&nbsp;&nbsp;{{ $quanli->tenql }}&nbsp;
		          	<span class="caret"></span>
		          </button>
		          <ul class="dropdown-menu">
		           	<li><a href="#" data-toggle="modal" data-target="#modalEditPass"><span class="fa fa-plus"></span>&nbsp;&nbsp;Cài đặt tài khoản</a></li>
		            <li><a href="{{ asset('quanli/dangxuat') }}"><span class="fa fa-power-off"></span>&nbsp;&nbsp;Đăng xuất</a></li>
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
		     		<li><a class="@yield('qlnguoiban')" href="{{asset('quanli/nhabanhang')}}">
		     			<span class="fa fa-users"></span>&nbsp;&nbsp;Nhà bán hàng</a>
		     		</li>
		     		<li><a class="@yield('qlkhachhang')" href="{{asset('quanli/khachhang')}}">
		     			<span class="fa fa-users"></span>&nbsp;&nbsp;Khách hàng</a>
		     		</li>
		     		<li><a class="@yield('qlkhuyenmai')" href="{{asset('quanli/khuyenmai')}}">
		     			<span class="fa fa-bullhorn"></span>&nbsp;&nbsp;Quản lí khuyến mãi</a>
		     		</li>
		     		<li><a class="@yield('thongketaikhoan')" href="{{asset('quanli/thongke-taikhoan')}}">
		     			<span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Thống kê tài khoản</a>
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