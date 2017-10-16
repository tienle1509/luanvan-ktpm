@extends('quanli.sanpham')


@section('chitiet')

<h2>Sản phẩm mới</h2>

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
				      </tr>
				    </tbody>
				</table>
@stop