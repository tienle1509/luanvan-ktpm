@extends('khachhang_home')

@section('title-page','Đơn hàng')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-donhang.css')}}">



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
	<div class="container">
		<div class="tieude">
			<h4><label>Chào bạn, dưới đây là thông tin đơn hàng của bạn:</label></h4>
			<div>Mã đơn hàng: <label>#1423567.</label></div>
			<div>Đặt hàng: 20/09/2017.</div>
		</div>

		<div class="trangthai text-center">
			<div class="col-md-2 col-sm-2">				
				<div class="label-cho"><span class="fa fa-check-circle"></span>&nbsp;&nbsp;Chờ xác nhận</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="label-xacnhan">Đã xác nhận</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="label-vanchuyen">Đang vận chuyển</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="label-dagiao">Đã giao hàng</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="label-hoantat">Hoàn tất</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="col-md-6 col-sm-6">
			<div class="panel-vanchuyen row">
				<h4><b>TÌNH TRẠNG VẬN CHUYỂN</b></h4>
				<div class="col-md-3 col-sm-3">
					<div class="row">Nhà vận chuyển:</div> 
					<div class="row">Tình trạng:</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="row"><b>Giao hàng nhanh</b></div>
					<div class="row"><b>Đang vận chuyển</b></div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="thoigian">Dự kiến giao hàng từ 05/09 - 09/09</div>
				</div>
			</div>		
		</div>
		

		<div class="col-md-5 col-sm-5">
			<div class="panel-thongtinnhan row">
				<h4><b>THÔNG TIN NGƯỜI NHẬN</b></h4>
				<b>Nguyễn Văn A</b>
				<div>đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ.</div>
				<div>Số điện thoại: 0978593821</div>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="panel-donhang">
			<table class="table tbdonhang">
			    <thead>
			      <tr>
			        <th class="col-ten">Sản phẩm</th>
			        <th class="text-center">Đơn giá</th>
			        <th class="text-center">Số lượng</th>
			        <th class="text-right">Thành tiền</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <td>
			        	<div class="col-md-2 col-sm-2">
			        		<div class="row">
			        			<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
			        		</div>
			        	</div>
			        	<div class="col-md-10 col-sm-10">
			        		<div class="row"><label>Điện thoại samsung Galaxy J7 32GB chính hãng</label></div>
			        		<div>Bảo hành 12 tháng</div>
			        	</div>
			        </td>
			        <td class="text-center">1.390.000đ</td>
			        <td class="text-center">1</td>
			        <td class="text-right">1.390.000đ</td>
			      </tr>
			      <tr>
			        <td>
			        	<div class="col-md-2 col-sm-2">
			        		<div class="row">
			        			<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
			        		</div>
			        	</div>
			        	<div class="col-md-10 col-sm-10">
			        		<div class="row"><label>Điện thoại samsung Galaxy J7 32GB chính hãng</label></div>
			        		<div>Bảo hành 12 tháng</div>
			        	</div>
			        </td>
			        <td class="text-center">520.000đ</td>
			        <td class="text-center">1</td>
			        <td class="text-right">520.000đ</td>
			      </tr>
			    </tbody>
			    <tfoot class="tbfoot">
			    	<tr>
			    		<td colspan="3" class="text-right">
			    			<div class="row">Tổng tiền:</div>
			    			<div class="row">Phí vận chuyển:</div>
			    			<div class="row row-tong"><b>Tổng thanh toán</b</div>
			    		</td>
			    		<td class="text-right">
			    			<div>1.890.000đ</div>
			    			<div>52.000đ</div>
			    			<div class="row-tong"><b class="label-tong">1.942.000đ</b</div>
			    		</td>
			    	</tr>
			    </tfoot>
			</table>
		</div>
	</div>


@stop