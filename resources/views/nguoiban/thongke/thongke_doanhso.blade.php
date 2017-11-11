@extends('nguoiban_home')

@section('thongke','active')

@section('noidung')

{!! Charts::assets() !!}

<div class="container-fluid">
	<h1>Thống kê doanh thu</h1>
	<hr>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<ol class="breadcrumb">
				<li><a href="{{asset('nguoiban/thongke')}}">Thống kê</a></li>
				<li class="active">@yield('title')</li>
			</ol>
		</div>
	</div>

	<center>
		{!! $chart->render() !!}
	</center>		
</div>

@stop