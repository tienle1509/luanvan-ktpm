@extends('nguoiban_home')

@section('donhang','active')

@section('noidung')
<div class="container-fluid">
				<h1>Đơn hàng</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/donhang')}}">Đơn hàng</a></li>
						  <li class="active">@yield('title')</li>
						</ol>
					</div>
				</div>


				<!-- Panel -->
				<div class="row">
					<!-- Tất cả đơn hàng -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-green">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/icondonhang.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">40</div>
							  		Tất cả <br> Đơn hàng
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/tatca-donhang')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end tất cả đơn hàng -->	

					<!-- Đơn hàng trong ngày -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-red1">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/donhangtrongngay.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">4</div>
							  		Đơn hàng<br> Trong ngày
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-trongngay')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end đơn hàng trong ngày -->					

					<!-- Đơn hàng đang xử lí -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-orange">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/icondangxuli.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">12</div>
							  		Đơn hàng <br> Đang xử lí
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-dangxuli')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end đơn hàng đang xử lí -->


					<!-- Đơn hàng đang giao đi -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-blue">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/icondanggiao.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">2</div>
							  		Đơn hàng<br> Đang giao đi
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-danggiaodi')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div>
					 <!-- end đơn hàng đang giao đi-->


					<!-- Đơn hàng giao hàng thất bại -->					
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-red">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/iconhuydonhang.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">43</div>
							  		Giao hàng <br> Thất bại
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-thatbai')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end Đơn hàng giao hàng thất bại -->

					<!-- Đã giao hàng -->					
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-violet">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/iconhoanthanh.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">20</div>
							  		Đơn hàng<br> Đã giao
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-dagiao')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end đã giao hàng -->				
				</div> <!--end panel -->


				@yield('chitiet')

				
			</div>


@stop