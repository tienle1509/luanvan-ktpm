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
			    <i>Đã có tài khoản ? </i><a href="dangnhap-ban.php">Đăng nhập</a>
			    <div><span class="fa fa-question-circle"></span>&nbsp;19008088 (8h-21h hằng ngày)</div>
			</div>
		</div>
	</div>


	<div class="container panel-diachi">
		<h2>Chào shop Ahihi</h2>
		<form id="form-diachi" role="form">
			<div class="form-group">
			    <label>Số nhà, tên đường</label>
			    <input id="hoten">
			  </div>
			  <div class="form-group">
			    <label>Tỉnh, thành phố</label>
			    <select>
			    	<option value=""> Tỉnh/Thành phố</option>
			    	<option value="1">Hồ Chí Minh</option>
			    	<option value="2">Hà Nội</option>
			    	<option value="3">An Giang</option>
			    	<option value="5">Bắc Kạn</option>
			    	<option value="6">Bắc Giang</option>
			    	<option value="7">Bạc Liêu</option>
			    	<option value="8">Bắc Ninh</option>
			    	<option value="9">Bến Tre</option>
			    	<option value="11">Bình Định</option>
			    	<option value="12">Bình Phước</option>
			    	<option value="13">Bình Thuận</option>
			    	<option value="14">Cà Mau</option>
			    	<option value="15">Cần Thơ</option>
			    	<option value="16">Cao Bằng</option>
			    	<option value="17">Đà Nẵng</option>
			    	<option value="18">Đắk Lắk</option>
			    	<option value="19">Điện Biên</option>
			    	<option value="20">Đồng Nai</option>
			    	<option value="21">Gia Lai</option>
			    	<option value="22">Hà Giang</option>
			    	<option value="23">Hà Nam</option>
			    	<option value="24">Hậu Giang</option>
			    	<option value="25">Hà Tĩnh</option>
			    	<option value="26">Hải Dương</option>
			    	<option value="27">Hải Phòng</option>
			    	<option value="28">Hòa Bình</option>
			    	<option value="30">Khánh Hòa</option>
			    	<option value="32">Lai Châu</option>
			    	<option value="33">Lâm Đồng</option>
			    	<option value="34">Lạng Sơn</option>
			    	<option value="35">Lào Cai</option>
			    	<option value="36">Long An</option>
			    	<option value="37">Nam Định</option>
			    	<option value="38">Nghệ An</option>
			    	<option value="39">Ninh Thuận</option>
			    	<option value="40">Phú Thọ</option>
			    	<option value="41">Phú Yên</option>
			    	<option value="42">Quảng Bình</option>
			    	<option value="43">Quảng Nam</option>
			    	<option value="44">Quảng Ngãi</option>
			    	<option value="45">Quảng Ninh</option>
			    	<option value="46">Quảng Trị</option>
			    	<option value="47">Sóc Trăng</option>
			    	<option value="48">Tây Ninh</option>
			    	<option value="49">Thái Bình</option>
			    	<option value="50">Thái Nguyên</option>
			    	<option value="51">Thanh Hóa</option>
			    	<option value="52">Huế</option>
			    	<option value="53">Tiền Giang</option>
			    	<option value="54">Trà Vinh</option>
			    	<option value="55">Tuyên Quang</option>
			    	<option value="56">Kiên Giang</option>
			    	<option value="57">Vĩnh Phúc</option>
			    	<option value="58">Bà Rịa-Vũng Tàu</option>
			    	<option value="59">Yên Bái</option>
			    	<option value="60">Vĩnh Long</option>
			    	<option value="61">Bình Dương</option>
			    	<option value="62">Đắk Nông</option>
			    	<option value="63">Đồng Tháp</option>
			    	<option value="64">Hưng Yên</option>
			    	<option value="65">Kon Tum</option>
			    	<option value="66">Ninh Bình</option>
			    	<option value="67">Sơn La</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label>Quận, huyện</label>
			    <input type="text">
			  </div>
			  <div class="form-group">
			    <label>Phường, xã</label>
			    <input type="text">
			  </div>		  
			  <button type="submit" class="btn btn-danger btn-lg">VÀO SHOP</button>
		</form>
	</div>

	<div class="footer text-center">
		<b>Copyright &copy; 2014 MobileStore.vn</b>
		<div>Công ty cổ phần công nghệ Mobile. Địa chỉ: Số 108, Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Tp. Cần Thơ.</div>
	</div>

</body>
</html>