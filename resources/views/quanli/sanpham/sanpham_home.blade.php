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
				    	@if(count($list_spmoi) == 0)
				    		<tr>
				    			<td align="center" colspan="7" style="color: red"><h4>Không có sản phẩm mới !</h4></td>
				    		</tr>
				    	@else
				    		@foreach($list_spmoi as $val)
				    			<tr>
							        <td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="tensp">{{$val->tensp}}</td>
							        <td class="dongia">{{number_format($val->dongia,0,'.','.')}}</td>
							        <td>{{$val->soluong}}</td>
							        <td class="tenshop">{{$val->tengianhang}}</td>
							        <td>
							        	<label class="label label-warning">Chờ duyệt</label>
							        </td>
							    </tr>
				    		@endforeach
				    	@endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="7">{!! $list_spmoi->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>
@stop