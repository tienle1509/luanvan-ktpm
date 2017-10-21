@extends('khachhang_home')

@section('title-page','Mobile Store-Đặt hàng thành công')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-dathang-thanhcong.css')}}">




<div class="nav-bottom ">
		<div class="container">
			<div class="row">
				<ul class="nav nav-pills">
					<li class="danhmuc">
						<button type="button" class="btn-danhmuc">
							<span class="fa fa-navicon"></span>&nbsp;&nbsp;&nbsp;DANH MỤC SẢN PHẨM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="fa fa-angle-down"></span>
						</button>
						<div class="dropdown-content">
							<a href="{{asset('chitiet-danhmuc')}}">Apple</a>
							<a href="{{asset('chitiet-danhmuc')}}">Samsung</a>
							<a href="{{asset('chitiet-danhmuc')}}">Nokia</a>				
							<a href="{{asset('chitiet-danhmuc')}}">Oppo</a>
							<a href="{{asset('chitiet-danhmuc')}}">Sony</a>
							<a href="{{asset('chitiet-danhmuc')}}">HTC</a>
							<a href="{{asset('chitiet-danhmuc')}}">LG</a>								
							<a href="{{asset('chitiet-danhmuc')}}">Asus</a>
							<a href="{{asset('chitiet-danhmuc')}}">Masstel</a>				
							<a href="{{asset('chitiet-danhmuc')}}">Motorola</a>
							<a href="{{asset('chitiet-danhmuc')}}">Xiaomi</a>
							<a href="{{asset('chitiet-danhmuc')}}">MobiiStar</a>
							<a href="{{asset('chitiet-danhmuc')}}">Wiko</a>
							<a href="{{asset('chitiet-danhmuc')}}">Lenovo</a>
							<a href="{{asset('chitiet-danhmuc')}}">BlackBery</a>
						</div>
					</li>
					<li>
						<a class="nav-bottom-km" href="#">
						<span class="fa fa-gift"></span>&nbsp;&nbsp;&nbsp;KHUYẾN MÃI
						</a>
					</li>
					<li><a class="nav-bottom-banchay" href="#"><span class="fa fa-tags"></span>&nbsp;&nbsp;&nbsp;BÁN CHẠY</a></li>
					<li><a class="nav-bottom-hangmoi" href="#"><span class="fa fa-tag"></span>&nbsp;&nbsp;&nbsp;HÀNG MỚI</a></li>	
				</ul>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>



	<!-- Body -->
	<div class="container panel-thongbao">
		<h3><span class="fa fa-check-circle"></span>&nbsp;&nbsp;ĐẶT HÀNG THÀNH CÔNG</h3>
		<p>Chào <label class="label-ten">Nguyễn Văn A,</label></p>
		<p>
			Quý khách vừa đặt thành công sản phẩm của shop <label class="label-shop">ANHDUY</label>, mã đơn hàng của quý khách là: 
			<label class="label-ma">1423567.</label>
		</p>
		<p>
			Sau khi xác nhận, sản phẩm sẽ được giao hàng đến địa chỉ của quý khách tại 
			<label>Hồ Chí Minh</label> trong 1-2 ngày.
		</p>
		<div class="link-btn">
			<a href="{{asset('donhang')}}">Chi tiết đơn hàng</a>
			<a href="{{asset('home')}}">Tiếp tục mua sắm</a>
		</div>
		<p>Mọi thông tin về đơn hàng sẽ được gửi tới email của quý khách, vui lòng kiểm tra email để biết thêm chi tiết.</p>
		<p>Cảm ơn quý khách đã tin tưởng và giao dịch tại <a href="{{asset('home')}}">www.mobilestore.vn</a></p>
		<p>Ban quản trị Mobile Store.</p>
		<div class="label-lienhe">
			<label>Mọi thắc mắc vui lòng liên hệ: </label><label class="label-sdt"> 19008088</label>
		</div>
	</div>



@stop