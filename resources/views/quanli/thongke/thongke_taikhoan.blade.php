@extends('quanli_home')

@section('thongketaikhoan', 'active')

@section('noidung')


{!! Charts::assets() !!}

<div class="container-fluid">
	<!-- Thống kê nhà bán hàng -->
	<h1>Thống kê nhà bán hàng năm {{date('Y')}}</h1>
	<hr style="border: 1px solid #F9F9FF">	

	@if(count($nguoiban) == 0)
		<div class="alert alert-warning" role="alert" style="margin-top: 30px;">
			Chưa có dữ liệu để thống kê !
		</div>
	@else
	<!--	<h3 style="margin-bottom: 10px;">Tổng : {{count($nguoiban)}} nhà bán hàng</h3> -->
		<center>
			{!! $chart_nguoiban->render() !!}
		</center>	
	@endif			

	<br><br>

	<!-- Thống kê khách hàng -->
	<h1>Thống kê khách hàng năm {{date('Y')}}</h1>
	<hr style="border: 1px solid #F9F9FF">	

	@if(count($khachhang) == 0)
		<div class="alert alert-warning" role="alert" style="margin-top: 30px;">
			Chưa có dữ liệu để thống kê !
		</div>
	@else
	<!--	<h3 style="margin-bottom: 10px;">Tổng : {{count($nguoiban)}} nhà bán hàng</h3> -->
		<center>
			{!! $chart_khachhang->render() !!}
		</center>	
	@endif	


	<br><br>
</div>


@stop