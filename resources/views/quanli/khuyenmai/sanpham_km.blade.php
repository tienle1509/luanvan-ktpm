@extends('quanli_home')

@section('qlkhuyenmai', 'active')

@section('noidung')
<style type="text/css">
	body {
		background-color: #FFFFFF;
	}
</style>





<div class="container-fluid">
				<h1>Danh sách sản phẩm khuyến mãi</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/khuyenmai')}}">Khuyến mãi</a></li>
						  <li><a href="{{asset('quanli/khuyenmai/chitiet-khuyenmai')}}">Chi tiết khuyến mãi</a></li>
						  <li class="active">Danh sách sản phẩm khuyến mãi</li>
						</ol>
					</div>
				</div>

				<h2>{{$tenkm->tenkm}}</h2>


				<table id="table-listProduct" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th>Tên sản phẩm</th>
				        <th>Giá hiện tại</th>
				        <th>Giá khuyến mãi</th>
				        <th>Số lượng</th>
				        <th>Chiết khấu</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($dsspkm) == 0)
				    		<tr>
				    			<td align="center" colspan="7" style="color: red"><h4>Chưa có sản phẩm tham gia khuyến mãi</h4></td>
				    		</tr>
				    	@else
				    		@foreach($dsspkm as $val)
				    			<tr>
							        <td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="name-pro">{{$val->tensp}}</td>
							        <td class="price-pro">{{number_format($val->dongia)}}</td>
							        <td>{{number_format($val->dongia-($val->dongia*$val->chietkhau*0.01))}}</td>
							        <td>{{$val->soluong}}</td>
							        <td>{{$val->chietkhau}}%</td>
							    </tr>
				    		@endforeach
				    	@endif
				    </tbody>
				  </table>
			</div>

@stop