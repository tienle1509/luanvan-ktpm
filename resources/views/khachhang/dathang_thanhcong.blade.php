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
							<?php
								$dmleft = DB::table('danhmuc_sanpham')->get();
							?>
							@foreach($dmleft as $val)
								<a href="{{asset('chitiet-danhmuc/'.$val->madm)}}">{{$val->tendanhmuc}}</a>
							@endforeach
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
		<p>Chào <label class="label-ten">
			<?php
				if(isset($_SESSION['makh'])){
					$kh = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();
					echo $kh->tenkh;
				}
			?>
		,</label></p>
		<p>
			Quý khách vừa đặt thành công, mã đơn hàng của quý khách là: 
			<label class="label-ma">
				<?php
					if(isset($_SESSION['madh'])){
						echo $_SESSION['madh'];
					}
				?>
			.</label>
		</p>
		<div class="link-btn">
			<a href="{{asset('donhang')}}">Chi tiết đơn hàng</a>
			<a href="{{asset('home')}}">Tiếp tục mua sắm</a>
		</div>
		<p>Nếu có nhu cầu xem lại thông tin mua hàng, vui lòng chọn click chọn kiểm tra đơn hàng và thực hiện các bước.</p>
		<p>Cảm ơn quý khách đã tin tưởng và giao dịch tại <a href="{{asset('home')}}">www.mobilestore.vn</a></p>
		<p>Ban quản trị Mobile Store.</p>
		<div class="label-lienhe">
			<label>Mọi thắc mắc vui lòng liên hệ: </label><label class="label-sdt"> 19008088</label>
		</div>
	</div>



@stop