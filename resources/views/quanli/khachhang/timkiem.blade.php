@extends('quanli_home')

@section('qlkhachhang', 'active')

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
		width: 20%;
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
			var url = "http://localhost/luanvan-ktpm/quanli/khachhang/xoa-khachhang";
			var makh = $(this).closest('tr').find('td:nth-child(1)').text();
			
			if(confirm('Bạn có chắc chắn xóa không ?')){
				$.ajax({
					url : url,
					type : "GET",
					dataType : "JSON",
					data : {"makh":makh},
					success : function(result){
						if(result.success){
							$.notify({
								// options
								message: 'Xóa tài khoản khách thành công !'
							},{
								// settings
								element: 'body',
								position: null,
								type: "success",
								allow_dismiss: true,
								placement: {
									from: "top",
									align: "right"
								},
								offset: 60,
								spacing: 10,
								z_index: 1031,
								delay: 1000,
								timer: 800,
							});

							setTimeout("location.reload(true);",2000);	
						}
					}
				});
			}
		});
	});
</script>



<div class="container-fluid">
	<h1>Quản lí khách hàng</h1>
	<hr style="border: 1px solid #F9F9FF">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<ol class="breadcrumb">
			  <li><a href="{{asset('quanli/khachhang')}}">Quản lí khách hàng</a></li>
			  <li class="active"></li>
			</ol>
		</div>
	</div>


	@if(isset($_SESSION['updateTT']))
		<div class="alert alert-success" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php 
				echo $_SESSION['updateTT']; 
				unset($_SESSION['updateTT']);
			?>
		</div>
	@endif

	@if(isset($_SESSION['updateTK']))		
		<div class="alert alert-success" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php 
				echo $_SESSION['updateTK']; 
				unset($_SESSION['updateTK']);
			?>
		</div>
	@endif

	@if(count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Lỗi ! </strong> {{$errors->first('key')}}
		</div>
	@endif

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="row">
				<form id="form-searchProduct" class="form-horizontal" role="form" action="{{url('quanli/khachhang/tim-kiem')}}" method="get">
					<div class="col-sm-5">
					  	<input type="text" class="form-control" name="key" placeholder="Nhập mã, tên khách hàng, email cần tìm ...">
					</div>
					<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
				</form>
			</div>
		</div>
	</div>

	<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{count($kq_timkiem)}}</b> nhà bán hàng</div>
	
	@if(count($kq_timkiem) != 0)
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Mã KH</th>
					<!-- <th>Tên người dùng</th> -->
					<th>Tên khách hàng</th>
					<th>Email</th>
					<th>Số điện thoại</th>
					<th class="diachi">Địa chỉ giao hàng</th>
					<th>Thành viên</th>
					<th>Ngày tạo</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
				@foreach($kq_timkiem as $val)
						<tr>
							<td>{{$val->makh}}</td>
							<!-- <td>{{$val->tennguoidung}}</td> -->
							<td style="color: red">{{$val->tenkh}}</td>
							<td>{{$val->email}}</td>
							<td>{{$val->sodienthoai}}</td>
							<td>{{$val->diachigiaohang}}</td>
							<td style="text-align: center;">
								@if($val->thanhvien == 0)
									-
								@else
									<span class="fa fa-check" style="color: #069F0E; font-size: 18px;"></span>
								@endif
							</td>
							<td>{{date('d/m/Y',strtotime($val->ngaytao))}}</td>
							<td>
								<a href="{{asset('quanli/khachhang/sua/'.$val->makh)}}">Sửa</a>&nbsp;&nbsp;|&nbsp;
								<a class="Xoa" style="cursor: pointer;">Xóa</a>
							</td>
						</tr>
					@endforeach		
			</tbody>
		</table>
	@endif

</div>


@stop