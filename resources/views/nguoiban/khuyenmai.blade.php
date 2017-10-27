@extends('nguoiban_home')

@section('khuyenmai', 'active')


@section('noidung')
<div class="container-fluid">
				<h1>Khuyến mãi</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/khuyenmai')}}">Khuyến mãi</a></li>
						  <li class="active"></li>
						</ol>
					</div>
				</div>


				@if(count($dskm) == 0)
					<h4 style="color: red">Chưa có chương trình khuyến mãi trên hệ thống !</h4>
				@else
					<h3>Khuyến mãi - Tham gia ngay trước khi hết hạn</h3>
					@foreach($dskm as $val)
						<!-- panel khuyến mãi -->	
						<div class="col-md-4 col-sm-4 panel-promotion">
							<div class="row">
								<img src="{{asset('public/anh-khuyenmai/'.$val->anhkm)}}" width="351" height="156">
							</div>					
							<h4><b>{{$val->tenkm}}</b></h4>
							<div><b>Thời gian:</b> {{date('d/m/Y', strtotime($val->ngaybd))}} -  {{date('d/m/Y', strtotime($val->ngaykt))}}</div>
							<div>Giảm giá: {{$val->chietkhau}}%.</div>
							<div class="row">
								<div class="col-sm-7">
									Hạn đăng kí:  {{date('d/m/Y', strtotime($val->handangki))}}
								</div>
								<div class="col-sm-5 text-right" style="margin-top: -20px">

									@if(strtotime($val->handangki) < strtotime($ngayht))
										<button type="button" class="btn btn-default btn-block">Hết hạn</button>
									@else
										<a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai/'.$val->makm)}}" type="button" class="btn btn-warning btn-block">Tham gia</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				@endif

@stop