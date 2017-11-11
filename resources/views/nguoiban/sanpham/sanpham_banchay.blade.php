@extends('nguoiban.sanpham')

@section('title','Sản phẩm bán chạy')

@section('chitiet')

{!! Charts::assets() !!}

<h2>Sản phẩm bán chạy tháng {{date('m', strtotime($ngayht))}}</h2>
				
	<center>

	</center>	


@stop