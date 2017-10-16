@extends('quanli.sanpham')

@section('title','Sản phẩm mới trong ngày')

@section('chitiet')

<h2>Sản phẩm mới trong ngày</h2>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="form-searchProduct" class="form-horizontal" role="form">
							<div class="col-sm-2 form-group">
							  	<input type="text" class="form-control" id="" placeholder="Mã sản phẩm">
							</div>
							<div class="col-sm-4">
							  	<input type="text" class="form-control" id="" placeholder="Tên sản phẩm">
							</div>	
							<div class="col-sm-4 form-group" style="margin-right: 2px;">
							  	<input type="text" class="form-control" id="" placeholder="Nhà bán hàng">
							</div>	
							<button type="button" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
						</form>
					</div>
				</div>


				<table id="table-product" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th class="th-tensp">Tên sản phẩm</th>
				        <th>Đơn giá</th>
				        <th>Số lượng</th>
				        <th>Nhà bán hàng</th>
				        <th>Trạng thái</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td>SP0028</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/hotwav.jpg')}}">
				        </td>
				        <td class="tensp">Điện thoại Hotwav đen chính hãng</td>
				        <td class="dongia">2,400,000</td>
				        <td>10</td>
				        <td class="tenshop">ANHDUYSHOP</td>
				        <td>
				        	<label class="label label-warning">Chờ duyệt</label>
				        </td>
				        <td>
				        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham')}}" type="button" class="btn btn-info">Chi tiết</a>
				        </td>
				      </tr>

				      <tr>
				        <td>SP0028</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/hotwav.jpg')}}">
				        </td>
				        <td class="tensp">Điện thoại Hotwav đen chính hãng</td>
				        <td class="dongia">2,400,000</td>
				        <td>10</td>
				        <td class="tenshop">ANHDUYSHOP</td>
				        <td>
				        	<label class="label label-success">Đã duyệt</label>
				        </td>
				        <td>
				        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham')}}" type="button" class="btn btn-info">Chi tiết</a>
				        </td>
				      </tr>

				      <tr>
				        <td>SP0028</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/hotwav.jpg')}}">
				        </td>
				        <td class="tensp">Điện thoại Hotwav đen chính hãng</td>
				        <td class="dongia">2,400,000</td>
				        <td>10</td>
				        <td class="tenshop">ANHDUYSHOP</td>
				        <td>
				        	<label class="label label-warning">Chờ duyệt</label>
				        </td>
				        <td>
				        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham')}}" type="button" class="btn btn-info">Chi tiết</a>
				        </td>
				      </tr>

				      <tr>
				        <td>SP0028</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/hotwav.jpg')}}">
				        </td>
				        <td class="tensp">Điện thoại Hotwav đen chính hãng</td>
				        <td class="dongia">2,400,000</td>
				        <td>10</td>
				        <td class="tenshop">ANHDUYSHOP</td>
				        <td>
				        	<label class="label label-success">Đã duyệt</label>
				        </td>
				        <td>
				        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham')}}" type="button" class="btn btn-info">Chi tiết</a>
				        </td>
				      </tr>
				    </tbody>
				</table>



@stop