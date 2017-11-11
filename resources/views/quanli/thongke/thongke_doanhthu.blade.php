@extends('quanli_home')

@section('qldoanhthu', 'active')

@section('noidung')


{!! Charts::assets() !!}

<div class="container-fluid">
	<h1>Thống kê doanh thu năm {{date('Y')}}</h1>
	<hr style="border: 1px solid #F9F9FF">

	<select class="form-control" style="width: 250px;">
		<option value="">-- Chọn nhà bán hàng --</option>
		@foreach($nhabanhang as $val)
			<option value="{{$val->manb}}">{{$val->tengianhang}}</option>
		@endforeach
	</select>


</div>


@stop