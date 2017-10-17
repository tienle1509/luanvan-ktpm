@extends('nguoiban_home')

@section('sanpham','active')

@section('noidung')
<div class="container-fluid">
				<h1>Sản phẩm</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/ql-sanpham')}}">Sản phẩm</a></li>
						  <li class="active">@yield('title')</li>
						</ol>
					</div>
				</div>

				<!-- Panel -->
				<div class="row">
					<!-- Sản phẩm chờ duyêt -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-red">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/waiting.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">4</div>
							  		Sản phẩm chờ duyệt
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/ql-sanpham/sanpham-choduyet')}}">
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
					</div> <!-- end sản phẩm chờ duyêt -->					

					<!-- Sản phẩm bán chạy -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-orange">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/banchay.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">12</div>
							  		Sản phẩm bán chạy
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/ql-sanpham/sanpham-banchay')}}">
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
					</div> <!-- end sản phẩm bán chạy -->


					<!-- Sản phẩm hết hàng -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-green">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/iconhethang.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">2</div>
							  		Sản phẩm hết hàng
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/ql-sanpham/sanpham-hethang')}}">
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
					 <!-- end sản phẩm hết hàng -->


					<!-- Tất cả sản phẩm -->					
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-blue">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/tonkho.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">43</div>
							  		Tất cả sản phẩm
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/ql-sanpham/tatca-sanpham')}}">
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
					</div> <!-- end tất cả sản phẩm -->
				</div> <!--end panel -->

				<a href="{{asset('nguoiban/ql-sanpham/them-sanpham')}}" type="button" class="btn btn-success btn-lg"><span class="fa fa-plus-circle"></span>&nbsp;&nbsp;Thêm sản phẩm</a>
				

				@yield('chitiet')
				
			</div>

@stop