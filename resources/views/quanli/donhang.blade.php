@extends('quanli_home')

@section('qldonhang','active')

@section('noidung')
<div class="container-fluid">
				<h1>Quản lí đơn hàng</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-donhang')}}">Quản lí đơn hàng</a></li>
						  <li class="active">@yield('title')</li>
						</ol>
					</div>
				</div>


				<div class="row">
					<!-- Đơn hàng chờ duyêt -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-blue">
						  <div class="panel-heading">
						  	<div class="row text-center">
							  	<img src="{{asset('public/img/icondonhang-admin.png')}}">
							  	<div class="huge">
							  		<?php
							  			$count_choduyet = DB::table('don_hang')->where('trangthai',0)->count('madh');
							  			echo $count_choduyet;
							  		?>
							  	</div>
							</div>
						  </div>
						  <a href="{{asset('quanli/ql-donhang/duyet-donhang')}}">
							  <div class="panel-footer text-center">
							   	Đơn hàng chưa duyệt
							  </div>
						  </a>
						</div>
					</div> <!-- end đơn hàng chờ duyêt -->	

					<!-- Đơn hàng trong ngày -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-yellow">
						  <div class="panel-heading">
						  	<div class="row text-center">
							  	<img src="{{asset('public/img/iconcartadmin.png')}}">
							  	<div class="huge">
							  		<?php
							  			$today = date('d'); //lấy ngày hiện tại
                                        $month = date('m'); //lấy tháng hiện tại
                                        $year = date('Y'); //lấy năm hiện tại

                                        $count_trongngay = 0;
                                        $donhang = DB::table('don_hang')->get();
                                        foreach ($donhang as $val) {
                                        	if(date('d',strtotime($val->ngaydat)) == $today && date('m',strtotime($val->ngaydat)) == $month && date('Y',strtotime($val->ngaydat)) == $year){
                                        		$count_trongngay +=1;
                                        	}
                                        }
                                        echo $count_trongngay;
							  		?>
							  	</div>
							</div>
						  </div>
						  <a href="{{asset('quanli/ql-donhang/donhang-trongngay')}}">
							  <div class="panel-footer text-center">
							   	Đơn hàng trong ngày
							  </div>
						  </a>
						</div>
					</div> <!-- end đơn hàng trong ngày -->	


					<!-- Tất cả đơn hàng -->
					<div class="col-md-3 col-sm-3">
						<div class="panel panel-blue2">
						  <div class="panel-heading">
						  	<div class="row text-center">
							  	<img src="{{asset('public/img/allorder-admin.png')}}">
							  	<div class="huge">
							  		<?php
							  			$count_tatca = DB::table('don_hang')->count('madh');
							  			echo $count_tatca;
							  		?>
							  	</div>
							</div>
						  </div>
						  <a href="{{asset('quanli/ql-donhang/tatca-donhang')}}">
							  <div class="panel-footer text-center">
							   	Tất cả đơn hàng
							  </div>
						  </a>
						</div>
					</div> <!-- end tất cả đơn hàng -->
				</div> <!-- end panel-->


				@yield('chitiet')
			</div>


@stop