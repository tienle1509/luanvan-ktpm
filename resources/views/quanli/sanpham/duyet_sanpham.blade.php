@extends('quanli_home')

@section('qlsanpham', 'active')

@section('noidung')
<div class="container-fluid">
				<h1>Duyệt sản phẩm</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-sanpham')}}">Quản lí sản phẩm</a></li>
						  <li class="active">Duyệt sản phẩm</li>
						</ol>
					</div>
				</div>

				<h2>Sản phẩm đang chờ duyệt</h2>				


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
				        <th>Thao tác</th>
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
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
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
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
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
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
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
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
				        </td>
				      </tr>
				    </tbody>
				</table>


			</div>


@stop