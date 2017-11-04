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
				    	@if(count($list_tatca) == 0)
				    		<tr>
				    			<td align="center" style="color: red" colspan="10"><h4>Không có sản phẩm !</h4></td>
				    		</tr>
				    	@else
				    		<?php
				    			foreach ($list_tatca as $all) {
				    				if(count($masp_khuyenmai) == 0){ ?>
				    					<tr>
								    				<td>{{$all->tendanhmuc}}</td>
											        <td>{{$all->masp}}</td>
											        <td>
											        	<img src="{{asset('public/anh-sanpham/'.$all->anh)}}">
											        </td>
											        <td class="name-pro">{{$all->tensp}}</td>
											        <td class="price-pro">{{number_format($all->dongia)}}</td>
											        <td>-</td>
											        <td>
											        	{{$all->soluong}}
											        </td>
											        <td>
											        	<?php 
											        		$count_luotmua = DB::table('chitiet_donhang')->where('masp', $all->masp)->sum('soluong');
											        		echo $count_luotmua;
											        	?>
											        </td>
											        <td>
											        	@if($all->trangthai == 0)
											        		<span class="label label-warning">Chờ duyệt</span>
											        	@else
											        		<span class="label label-success">Đã duyệt</span>
											        	@endif
											        </td>
											        <td>
											        	<a href="chitiet-sanpham/{{$all->masp}}" type="btn" class="btn btn-info">
											        		Chi tiết
											        	</a>
											        </td>
											      </tr>
				    				<?php
				    				}
				    				else {
				    					if(in_array($all->masp, $masp_khuyenmai)){ ?>
				    						<tr>
								    				<td>{{$all->tendanhmuc}}</td>
											        <td>{{$all->masp}}</td>
											        <td>
											        	<img src="{{asset('public/anh-sanpham/'.$all->anh)}}">
											        </td>
											        <td class="name-pro">{{$all->tensp}}</td>
											        <td class="price-pro">{{number_format($all->dongia)}}</td>
											        <td>
											        	<?php
											        		$giamgia = DB::table('khuyen_mai as km')
											        					->join('chitiet_khuyenmai as ctkm','ctkm.makm', '=', 'km.makm')->where('ctkm.masp', $all->masp)->get();
											        		$t = 0;
												        	foreach ($giamgia as $valkm) {
												        		if((strtotime($ngayht) > strtotime($valkm->ngaybd)) && (strtotime($ngayht) < strtotime($valkm->ngaykt))){
												        			echo number_format($all->dongia-($valkm->chietkhau*$all->dongia*0.01));
												        			break;
												        		} else{
												        			$t+=1;
												        		}
												        	}
												        	if($t == count($giamgia)){
											        			echo "-";
											        		}
											        	?>		       	
											        </td>
											        <td>
											        	{{$all->soluong}}	        	
											        </td>
											        <td>
											        	<?php 
											        		$count_luotmua = DB::table('chitiet_donhang')->where('masp', $all->masp)->sum('soluong');
											        		echo $count_luotmua;
											        	?>
											        </td>
											        <td>
											        	@if($all->trangthai == 0)
											        		<span class="label label-warning">Chờ duyệt</span>
											        	@else
											        		<span class="label label-success">Đã duyệt</span>
											        	@endif
											        </td>
											        <td>
											        	<a href="chitiet-sanpham/{{$all->masp}}" type="btn" class="btn btn-info">
											        		Chi tiết
											        	</a>
											        </td>
											      </tr>
				    					<?php } else { ?>
				    						<tr>
								    				<td>{{$all->tendanhmuc}}</td>
											        <td>{{$all->masp}}</td>
											        <td>
											        	<img src="{{asset('public/anh-sanpham/'.$all->anh)}}">
											        </td>
											        <td class="name-pro">{{$all->tensp}}</td>
											        <td class="price-pro">{{number_format($all->dongia)}}</td>
											        <td>-</td>
											        <td>
											        	{{$all->soluong}}	        	
											        </td>
											        <td>
											        	<?php 
											        		$count_luotmua = DB::table('chitiet_donhang')->where('masp', $all->masp)->sum('soluong');
											        		echo $count_luotmua;
											        	?>
											        </td>
											        <td>
											        	@if($all->trangthai == 0)
											        		<span class="label label-warning">Chờ duyệt</span>
											        	@else
											        		<span class="label label-success">Đã duyệt</span>
											        	@endif
											        </td>
											        <td>
											        	<a href="chitiet-sanpham/{{$all->masp}}" type="btn" class="btn btn-info">
											        		Chi tiết
											        	</a>
											        </td>
											      </tr>
				    					<?php }
				    				}
				    			}	
				    		?>
				    	@endif
				    </tbody>
				  </table>


@stop