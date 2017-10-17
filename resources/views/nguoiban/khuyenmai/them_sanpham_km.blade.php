@extends('nguoiban_home')

@section('khuyenmai','active')

@section('noidung')
<div class="container-fluid">
				<h1>Thêm sản phẩm khuyến mãi</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/khuyenmai')}}">Khuyến mãi</a></li>
						  <li><a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai')}}">Chi tiết khuyến mãi</a></li>
						  <li class="active">Thêm sản phẩm khuyến mãi</li>
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
							<div class="col-sm-3 text-right">
								<a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai/dssanphamkm')}}" type="button" class="btn btn-primary">
									<span class="fa fa-list"></span>&nbsp;&nbsp;Danh sách sản phẩm khuyến mãi
								</a>
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
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<button type="button" class="btn btn-success">
				        		<span class="fa fa-plus"></span>&nbsp;Thêm
				        	</button>
				        </td>
				      </tr>
				      
				      <tr>
				        <td>AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<button type="button" class="btn btn-success">
				        		<span class="fa fa-plus"></span>&nbsp;Thêm
				        	</button>
				        </td>
				      </tr>

				      <tr>
				        <td>AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<button type="button" class="btn btn-success">
				        		<span class="fa fa-plus"></span>&nbsp;Thêm
				        	</button>
				        </td>
				      </tr>

				      <tr>
				        <td>AP002</td>
				        <td class="img-pro">
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh</td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<button type="button" class="btn btn-success">
				        		<span class="fa fa-plus"></span>&nbsp;Thêm
				        	</button>
				        </td>
				      </tr>
				    </tbody>
				  </table>

			</div>



@stop