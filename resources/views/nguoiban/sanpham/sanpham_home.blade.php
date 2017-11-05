@extends('nguoiban.sanpham')

@section('chitiet')
<h2>Sản phẩm mới</h2>				

				<table id="table-listProduct" class="table table-bordered table-hover">
				    <thead>
					  <tr>
					  	<th>Danh mục</th>
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
				    	@if($num_masp == 0)
				    		<tr>
				    			<td align="center" colspan="8" style="color: red"><h4>Không có sản phẩm mới !</h4></td>
				    		</tr>
				    	@else
				    		@foreach($list_spMoi as $val)
				    			<tr>
				    				<td>{{$val->tendanhmuc}}</td>
					    			<td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="name-pro">{{$val->tensp}}</td>
							        <td class="price-pro">{{number_format($val->dongia,0,'.','.')}}</td>
							        <td>-</td>
							        <td>{{$val->soluong}}</td>
							        <td>
							        	<span class="label label-warning">Chờ duyệt</span>
							        </td>
							    </tr>
							@endforeach
				    	@endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="8">{!! $list_spMoi->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>


@stop