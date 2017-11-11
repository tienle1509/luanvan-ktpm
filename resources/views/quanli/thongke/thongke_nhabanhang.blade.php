@extends('quanli_home')

@section('qlnguoiban', 'active')

@section('noidung')


{!! Charts::assets() !!}

<div class="container-fluid">
	<h1>Thống kê nhà bán hàng năm {{date('Y')}}</h1>
	<hr style="border: 1px solid #F9F9FF">

	@if(count($nguoiban) == 0)
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