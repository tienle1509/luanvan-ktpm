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

				<h2>Deal giá sốc - Khuyến mãi chỉ duy nhất 2 ngày</h2>


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
				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk dskfjgh zdg kjgf skj</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>8%</td>
				      </tr>
				      
				      <tr>
				        <td>AP002</td>
				       	<td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk dskfjgh zdg kjgf skj</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>8%</td>
				      </tr>

				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk dskfjgh zdg kjgf skj</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>8%</td>
				      </tr>

				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk dskfjgh zdg kjgf skj</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>8%</td>
				      </tr>
				    </tbody>
				  </table>
			</div>

@stop