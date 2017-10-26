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
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($list_choduyet) == 0)
				    		<tr>
				    			<td align="center" colspan="9" style="color: red"><h4>Không có sản phẩm chờ duyệt</h4></td>
				    		</tr>
				    	@else
				    		@foreach($list_choduyet as $val)
				    			<tr>
							      	<td>{{$val->tendanhmuc}}</td>
							        <td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="name-pro">{{$val->tensp}}</td>
							        <td class="price-pro">{{$val->dongia}}</td>
							        <td>-</td>
							        <td>{{$val->soluong}}</td>
							        <td>
							        	<span class="label label-warning">Chờ duyệt</span>
							        </td>
							        <td>				        	
							        	<a href="chitiet-sanpham/{{$val->masp}}" type="btn" class="btn btn-info">
							        		Chi tiết
							        	</a>
							        </td>
							    </tr>	
				    		@endforeach
				    	@endif				      
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="9">{!! $list_choduyet->render() !!}</td>
				    	</tr>
				    </tfoot>
				  </table>
			</div>


@stop