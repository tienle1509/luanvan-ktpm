@extends('nguoiban_home')

@section('thongke','active')

@section('noidung')

{!! Charts::assets() !!}

<div class="container-fluid">
	<h1>Thống kê doanh thu năm {{date('Y')}}</h1>	

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