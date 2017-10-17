@extends('quanli_home')

@section('qldonhang','active')

@section('noidung')
<div class="container-fluid">
				<h1>Chi tiết đơn hàng</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-donhang')}}">Quản lí đơn hàng</a></li>
						  <li class="active">Chi tiết đơn hàng</li>
						</ol>
					</div>
				</div>

				<div class="panel-detailOrder col-md-12" >
					<div class="detailOrder-h3"><h3>ĐƠN HÀNG <label>#123456</label></h3></div>
					<hr style="border: 1px solid blue">
					<div class="detailOrderRow1 row">
						<div class="col-md-3 col-sm-3">
							<span class="fa fa-clock-o"></span>&nbsp;&nbsp;Ngày đặt hàng: <b>20/03/2017</b>
						</div>
						<div class="col-md-3 col-sm-3">
							<span class="fa fa-clock-o"></span>&nbsp;&nbsp;Ngày giao hàng: <b>25/03/2017</b>
						</div>
						<div class="col-md-5 col-sm-5">
							<span class="fa fa-money"></span>&nbsp;&nbsp;Hình thức thanh toán: Thanh toán khi nhận hàng
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>

					<div class="detailOrderRow1 row">
						<div class="col-md-3 col-sm-3">
							<span class="fa fa-user"></span>&nbsp;&nbsp;Người nhận <b>Nguyễn Văn A</b>
						</div>
						<div class="col-md-3 col-sm-3">
							<span class="fa fa-mobile"></span>&nbsp;&nbsp;
							Số điện thoại: 01234567890
						</div>
						<div class="col-md-6 col-sm-6">
							<span class="fa fa-home"></span>&nbsp;&nbsp;
							Địa chỉ: KTX B, ĐH Cần Thơ, đường 3/2, phường Xuân Khánh, Ninh kiều, Cần Thơ.
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>


					<table id="table-detailOrder" class="table">
					  <thead>
					    <th>Hình ảnh</th>
					    <th>Tên sản phẩm</th>				    
					    <th class="num-detailOrder">Số lượng</th>
					    <th class="text-center">Đơn giá</th>
					    <th class="text-right">Thành tiền</th>
					  </thead>
					  <tr>
					    <td class="img-detailOrder">
					    	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
					    </td>
					    <td class="name-detailOrder">Điện thoại samsung galaxy j7 32GB chính hãng</td>
					    <td class="num-detailOrder">
					    	<input type="text" name="" value="1" class="form-control">
					    </td>
					    <td class="price-detailOrder text-center">12,394,000</td>
					    <td class="tong-detailOrder text-right">12,394,000</td>
					  </tr>
					  
					  <tr>
					    <td class="img-detailOrder">
					    	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
					    </td>
					    <td class="name-detailOrder">Điện thoại samsung galaxy j7 32GB chính hãng</td>
					    <td class="num-detailOrder">
					    	<input type="text" name="" value="1" class="form-control">
					    </td>
					    <td class="price-detailOrder text-center">12,394,000</td>
					    <td class="tong-detailOrder text-right">12,394,000</td>
					  </tr>
					</table>
					<hr>
					<div class="tongtien-detailOrder row">
						<div class="col-md-10 col-sm-10 text-right">
							Tổng tiền:
						</div>
						<div class="col-md-2 col-sm-2 text-right">
							<b>24,094,000 đ</b>
						</div>
					</div>

					<div class="detailOrderRow2">
						<div class="text-right submit-detailOrder">
							<button type="button" class="btn btn-primary btn-lg">Lưu lại</a>	
						</div>
					</div>
				</div>

			</div>


@stop