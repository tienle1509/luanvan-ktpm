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
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-dangnhap-ban.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">


</head>

<body>

	<div class="container">
		<div class="row text-right link-dangnhap">
			<p>Bạn đã có shop ? <a href="" data-toggle="modal" data-target="#modalLogin" data-backdrop="static">Đăng nhập</a></p>
		</div>

		<!-- Modal đăng nhập -->
	    <div id="modalLogin" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-body">
		      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title">Đăng nhập</h4>
		        <form id="login" role="form">
				  <div class="form-group">
				    <label>Email</label>
				    <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email">
				  </div>
				  <div class="form-group">
				    <label>Mật khẩu</label>
				    <input type="password" class="form-control" id="matkhau" placeholder="Nhập mật khẩu">
				  </div>
				</form>
				<button type="submit" class="btn btn-danger btn-lg">ĐĂNG NHẬP</button>
		        Bạn chưa có shop? <a href="" data-dismiss="modal">Đăng kí</a>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
	<div class="clearfix"></div>


	<div class="panel-logan">
		<div class="container">
			<div class="row">
				<h2>BÁN HÀNG HOÀN TOÀN MIỄN PHÍ</h2>
				<p><h4>Đơn giản - Tiện lợi - Chuyên nghiệp</h4></p>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div id="panel-left" class="col-md-6 col-sm-6">
				<h2>Bán hàng chuyên nghiệp</h2>
				<p>Quản lí shop của bạn một cách hiệu quả hơn trên Mobile Store - Kênh người bán</p>
				<img src="{{asset('public/img/banerban.png')}}" alt="baner-ban">
			</div>
		
			<div id="panel-right" class="col-md-6 col-sm-6">
				<form id="register" role="form">
					<div class="form-group">
					    <label>Họ tên</label>
					    <input id="hoten" type="text">
					</div>
					<div class="form-group">
					    <label>Email</label>
					    <input type="text">
					</div>
					<div class="form-group">
					    <label>Số điện thoại</label>
					    <input type="text">
					</div>
					<div class="form-group">
					    <label>Mật khẩu</label>
					    <input type="password">
					</div>
					<div class="form-group">
					    <label>Tên shop</label>
					    <input type="text">
					</div>			  
					<button type="submit" class="btn btn-danger btn-lg">BÁN HÀNG NGAY</button>
					  <a href="dangki-ban2.php">Chuyển trang</a>
				</form>
			</div>
		</div>
	</div>


	<div class="footer text-center">
		<b>Copyright &copy; 2014 MobileStore.vn</b>
		<div>Công ty cổ phần công nghệ Mobile. Địa chỉ: Số 108, Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Tp. Cần Thơ.</div>
	</div>

</body>
</html>