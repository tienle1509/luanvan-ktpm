@extends('quanli_home')

@section('qlsanpham','active')

@section('noidung')

	<div class="container-fluid">
				<h1>Quản lí sản phẩm</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-sanpham')}}">Quản lí sản phẩm</a></li>
						  <li class="active">@yield('title')</li>
						</ol>
					</div>
				</div>


				<!-- Panel -->
				<div class="row">
					<!-- Sản phẩm chờ duyêt -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-green">
						  <div class="panel-heading">
						  	<div class="row text-center">
							  	<img src="{{asset('public/img/iconproduct.png')}}">
							  	<div class="huge">29</div>
							</div>
						  </div>
						  <a href="{{asset('quanli/ql-sanpham/duyet-sanpham')}}">
							  <div class="panel-footer text-center">
							   	Sản phẩm chưa duyệt
							  </div>
						  </a>
						</div>
					</div> <!-- end sản phẩm chờ duyêt -->	

					<!-- Sản phẩm trong ngày -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-orange">
						  <div class="panel-heading">
						  	<div class="row text-center">
							  	<img src="{{asset('public/img/iconproductday.png')}}">
							  	<div class="huge">54</div>
							</div>
						  </div>
						  <a href="{{asset('quanli/ql-sanpham/sanpham-trongngay')}}">
							  <div class="panel-footer text-center">
							   	Sản phẩm mới trong ngày
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end sản phẩm trong ngày -->	

					<!-- Tất cả sản phẩm -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-red">
						  <div class="panel-heading">
						  	<div class="row text-center">
							  	<img src="{{asset('public/img/iconproductall.png')}}">
							  	<div class="huge">29</div>
							</div>
						  </div>
						  <a href="{{asset('quanli/ql-sanpham/tatca-sanpham')}}">
							  <div class="panel-footer text-center">
							   	Tất cả sản phẩm
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end tất cả sản phẩm -->	

				</div>
				<div class="clearfix"></div>					

				@yield('chitiet')
				
			</div>

@stop