@extends('nguoiban.sanpham')

@section('chitiet')
<h2>Sản phẩm mới</h2>				

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
				      </tr>
				      
				      <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk</td>
				        <td class="price-pro">18.483.000</td>
				        <td>-</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				      </tr>

				       <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk</td>
				        <td class="price-pro">18.483.000</td>
				        <td>-</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				      </tr>

				       <tr>
				        <td>AP002</td>
				        <td>
				        	<img src="{{asset('public/anh-sanpham/galaxyj7_1.jpg')}}">
				        </td>
				        <td class="name-pro">Điện thoại apple chính hãng sdfk dkjgh dfghk</td>
				        <td class="price-pro">18.483.000</td>
				        <td>-</td>
				        <td>5</td>
				        <td>
				        	<span class="label label-warning">Chờ duyệt</span>
				        </td>
				      </tr>
				    </tbody>
				</table>


@stop