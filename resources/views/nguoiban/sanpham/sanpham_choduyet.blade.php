@extends('nguoiban_home')

@section('sanpham','active')

@section('noidung')
<div class="container-fluid">
				<h1>Sản phẩm chờ duyệt</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/ql-sanpham')}}">Sản phẩm</a></li>
						  <li class="active">Sản phẩm chờ duyệt</li>
						</ol>
					</div>
				</div>

				<h2>Danh sách sản phẩm chưa được duyệt</h2>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="form-searchProduct" class="form-horizontal" role="form">
							<div class="col-sm-2 form-group">
							  	<input type="text" class="form-control" id="" placeholder="Mã sản phẩm">
							</div>
							<div class="col-sm-5">
							  	<input type="text" class="form-control" id="" placeholder="Tên sản phẩm">
							</div>	
							<button type="button" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
						</form>
					</div>
				</div>


				<table id="table-listProduct" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th class="th-name-pro">Tên sản phẩm</th>
				        <th>Giá bán lẻ</th>
				        <th>Giá khuyến mãi</th>
				        <th>Số lượng</th>
				        <th>Trạng thái</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				        <td>				        	
				        	<a href="{{asset('nguoiban/ql-sanpham/chitiet-sanpham')}}" type="btn" class="btn btn-info">
				        		Chi tiết
				        	</a>
				        </td>
				      </tr>
				      
				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				        <td>				        	
				        	<a href="{{asset('nguoiban/ql-sanpham/chitiet-sanpham')}}" type="btn" class="btn btn-info">
				        		Chi tiết
				        	</a>
				        </td>
				      </tr>

				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				        <td>				        	
				        	<a href="{{asset('nguoiban/ql-sanpham/chitiet-sanpham')}}" type="btn" class="btn btn-info">
				        		Chi tiết
				        	</a>
				        </td>
				      </tr>

				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh </td>
				        <td class="price-pro">18.483.000</td>
				        <td>17.905.000</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				        <td>				        	
				        	<a href="{{asset('nguoiban/ql-sanpham/chitiet-sanpham')}}" type="btn" class="btn btn-info">
				        		Chi tiết
				        	</a>
				        </td>
				      </tr>
				    </tbody>
				  </table>
			</div>


@stop