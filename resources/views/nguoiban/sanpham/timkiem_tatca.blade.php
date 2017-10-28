@extends('nguoiban.sanpham')

@section('title','Tất cả sản phẩm')

@section('chitiet')
<h2>Danh sách sản phẩm của shop</h2>
				@if(count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<strong>Lỗi ! </strong>{{$errors->first('key')}}	
					</div>
				@endif
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="row">
							<form id="form-searchProduct" class="form-horizontal" role="form" method="get" action="{{ url('nguoiban/ql-sanpham/tim-kiem-tatca') }}">
								<div class="col-sm-4">
								  	<input type="text" class="form-control" placeholder="Nhập tên danh mục, tên sản phẩm" name="key">
								</div>	
								<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
							</form>
						</div>
					</div>
				</div>

				<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{count($result_search)}}</b> sản phẩm</div>


				@if(count($result_search) != 0)

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
				        <th>Lượt mua</th>
				        <th>Trạng thái</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php
				    		foreach ($result_search as $valSearch) {
				    			//Lấy dòng dữ liệu đầu tiên
				    			$db = DB::table('san_pham as sp')
				    					->join('danhmuc_sanpham as dm', 'dm.madm', '=','sp.madm')
				    					->where('sp.masp',$valSearch)
				    					->first();
				    			//Kiểm tra sản phẩm có khuyến mãi hay không
				    			$km = DB::table('khuyen_mai as km')
										->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
										->join('san_pham as sp', 'sp.masp', '=', 'ctkm.masp')
										->where('sp.masp', $valSearch)
										->first();
								if(count($km) == 0){ ?>
									<tr>
								    	<td>{{$db->tendanhmuc}}</td>
										<td>{{$db->masp}}</td>
										<td>
											<img src="{{asset('public/anh-sanpham/'.$db->anh)}}">
										</td>
										<td class="name-pro">{{$db->tensp}}</td>
										<td class="price-pro">{{number_format($db->dongia)}}</td>
										<td>-</td>
										<td>
											{{$db->soluong}}
										</td>
										<td>
											<?php 
											    $count_luotmua = DB::table('chitiet_donhang')->where('masp', $db->masp)->sum('soluong');
											        echo $count_luotmua;
											?>
										</td>
										<td>
											@if($db->trangthai == 0)
											    <span class="label label-warning">Chờ duyệt</span>
											@else
											    <span class="label label-success">Đã duyệt</span>
											@endif
										</td>
										<td>
											<a href="chitiet-sanpham/{{$db->masp}}" type="btn" class="btn btn-info">Chi tiết</a>
										</td>
									</tr>
								<?php }
								else { ?>
									<tr>
								    	<td>{{$db->tendanhmuc}}</td>
										<td>{{$db->masp}}</td>
										<td>
											<img src="{{asset('public/anh-sanpham/'.$db->anh)}}">
										</td>
										<td class="name-pro">{{$db->tensp}}</td>
										<td class="price-pro">{{number_format($db->dongia)}}</td>
										<td>
											@if((strtotime($ngayht) > strtotime($km->ngaybd)) && (strtotime($ngayht) < strtotime($km->ngaykt)))
												{{number_format($db->dongia-($db->dongia*$km->chietkhau*0.01))}}
											@else
												-
											@endif
										</td>
										<td>
											{{$db->soluong}}
										</td>
										<td>
											<?php 
											    $count_luotmua = DB::table('chitiet_donhang')->where('masp', $db->masp)->sum('soluong');
											        echo $count_luotmua;
											?>
										</td>
										<td>
											@if($db->trangthai == 0)
											    <span class="label label-warning">Chờ duyệt</span>
											@else
											    <span class="label label-success">Đã duyệt</span>
											@endif
										</td>
										<td>
											<a href="chitiet-sanpham/{{$db->masp}}" type="btn" class="btn btn-info">Chi tiết</a>
										</td>
									</tr>
								<?php }
				    		}
				    	?>
				    </tbody>
				  </table>
				@endif

@stop