@extends('nguoiban_home')


@section('khuyenmai','active')


@section('noidung')
<div class="container-fluid">
				<h1>Danh sách sản phẩm khuyến mãi</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/khuyenmai')}}">Khuyến mãi</a></li>
						  <li><a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai')}}">Chi tiết khuyến mãi</a></li>
						  <li><a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai/themspkm')}}">Thêm sản phẩm khuyến mãi</a></li>
						  <li class="active">Danh sách sản phẩm khuyến mãi</li>
						</ol>
					</div>
				</div>

				<h3>Deal Giá Sốc - Khuyến mãi chỉ duy nhất 2 ngày</h3>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="form-searchProduct" class="form-horizontal" role="form">
							<div class="col-sm-2 form-group">
							  	<input type="text" class="form-control" id="" placeholder="Mã sản phẩm">
							</div>
							<div class="col-sm-5">
							  	<input type="text" class="form-control" id="" placeholder="Tên sản phẩm">
							</div>
							<div class="col-sm-2 form-group">	
								<button type="button" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
							</div>
						</form>
					</div>
				</div>


				<table id="table-listProduct" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th>Tên sản phẩm</th>
				        <th>Giá hiện tại</th>
				        <th>Giá khuyến mãi</th>
				        <th>Số lượng</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td>AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<button type="button" class="btn btn-danger">
				        		<span class="fa fa-trash"></span>&nbsp;&nbsp;Xóa
				        	</button>
				        </td>
				      </tr>
				      
				      <tr>
				        <td>AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh d</td>
				        <td class="price-pro">18.483.000</td>
				        <td>-</td>
				        <td >5</td>
				        <td>
				        	<button type="button" class="btn btn-danger">
				        		<span class="fa fa-trash"></span>&nbsp;&nbsp;Xóa
				        	</button>
				        </td>
				      </tr>

				      <tr>
				        <td class="ma-pro">AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td class="prom-pro">17.905.000</td>
				        <td class="num-pro">5</td>
				        <td class="duyet-pro">
				        	<button type="button" class="btn btn-danger">
				        		<span class="fa fa-trash"></span>&nbsp;&nbsp;Xóa
				        	</button>
				        </td>
				      </tr>

				      <tr>
				        <td class="ma-pro">AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td class="prom-pro">-</td>
				        <td class="num-pro">5</td>
				        <td class="duyet-pro">
				        	<button type="button" class="btn btn-danger">
				        		<span class="fa fa-trash"></span>&nbsp;&nbsp;Xóa
				        	</button>
				        </td>
				      </tr>
				    </tbody>
				  </table>

			</div>



@stop