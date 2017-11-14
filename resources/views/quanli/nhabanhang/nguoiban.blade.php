@extends('quanli_home')

@section('qlnguoiban', 'active')

@section('noidung')

<style type="text/css">
	.table{
		background-color: #FFFFFF;
		margin-top: 20px;
		margin-bottom: 30px;
	}
	.table thead {
		background-color: #C0C2FF;
	}
	.table .diachi {
		width: 15%;
	}
	.table td>a {
		text-decoration: none;
	}
	.table td>a:hover {
		color: #FF4D39;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('.Xoa').click(function(){
			var manb = $(this).closest('tr').find('td:nth-child(1)').text();
			alert(manb);
		});
	});
</script>


<div class="container-fluid">
	<h1>Quản lí nhà bán hàng</h1>
	<hr style="border: 1px solid #F9F9FF">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<ol class="breadcrumb">
			  <li><a href="{{asset('quanli/nhabanhang')}}">Quản lí bán hàng</a></li>
			  <li class="active"></li>
			</ol>
		</div>
	</div>


	@if(isset($_SESSION['updateTT']))
		<div class="alert alert-success" role="alert">
			<?php 
				echo $_SESSION['updateTT']; 
				unset($_SESSION['updateTT']);
			?>
		</div>
	@endif

	@if(isset($_SESSION['updateTK']))
		<div class="alert alert-success" role="alert">
			<?php 
				echo $_SESSION['updateTK']; 
				unset($_SESSION['updateTK']);
			?>
		</div>
	@endif

	@if(count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<strong>Lỗi ! </strong> {{$errors->first('key')}}
		</div>
	@endif

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="row">
				<form id="form-searchProduct" class="form-horizontal" role="form" action="{{url('quanli/')}}" method="get">
					<div class="col-sm-5">
					  	<input type="text" class="form-control" name="key" placeholder="Nhập mã, tên nhà bán hàng, email cần tìm ...">
					</div>
					<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
				</form>
			</div>
		</div>
	</div>

	<div style="margin-top: 10px; font-size: 15px;">Có : <b>{{count($ds_nguoiban)}}</b> nhà bán hàng</div>
	
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Mã NB</th>
				<th>Tên người bán</th>
				<th>Tên gian hàng</th>
				<th>Email</th>
				<th>Số điện thoại</th>
				<th class="diachi">Địa chỉ</th>
				<th>Ngày mở shop</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			@if(count($ds_nguoiban) == 0)
				<tr>
					<td align="center" colspan="8" style="color: red"><h4>Không có nhà bán hàng nào !</h4></td>
			   	</tr>
			@else
				@foreach($ds_nguoiban as $val)
					<tr>
						<td>{{$val->manb}}</td>
						<td>{{$val->tennb}}</td>
						<td style="color: red">{{$val->tengianhang}}</td>
						<td>{{$val->email}}</td>
						<td>{{$val->sodienthoai}}</td>
						<td>{{$val->diachi}}</td>
						<td>{{date('d/m/Y',strtotime($val->ngaytao))}}</td>
						<td>
							<a href="{{asset('quanli/nhabanhang/sua/'.$val->manb)}}">Sửa</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="" class="Xoa">Xóa</a>
							<br>
							<a href="{{asset('quanli/nhabanhang/thongke-doanhthu/'.$val->manb)}}">Xem doanh thu</a>
						</td>
					</tr>
				@endforeach
			@endif			
		</tbody>
		<tfoot>
		   	<tr>
		   		<td align="center" colspan="8">{!! $ds_nguoiban->render() !!}</td>
		   	</tr>
		</tfoot>
	</table>


</div>


@stop