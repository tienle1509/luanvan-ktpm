@extends('quanli_home')

@section('qlnguoiban', 'active')

@section('noidung')

{!! Charts::assets() !!}

<div class="container-fluid">
	<h1>Quản lí nhà bán hàng</h1>
	<hr style="border: 1px solid #F9F9FF">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<ol class="breadcrumb">
			  <li><a href="{{asset('quanli/nhabanhang')}}">Quản lí nhà bán hàng</a></li>
			  <li class="active">Doanh thu</li>
			</ol>
		</div>
	</div>

	<h2 style="margin-top: -10px; margin-bottom: 20px;">Doanh thu của nhà bán hàng {{$tennb}}</h2>


	@if(count($dh_manb) == 0)
		<div class="alert alert-warning" role="alert" style="margin-top: 30px;">
			Chưa có dữ liệu để thống kê !
		</div>
	@else
		<center>
			{!! $chart->render() !!}
		</center>	
	@endif




</div>
@stop