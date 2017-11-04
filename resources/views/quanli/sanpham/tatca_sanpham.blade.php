@extends('quanli.sanpham')

@section('title', 'Tất cả sản phẩm')

@section('chitiet')

<h2>Tất cả sản phẩm</h2>
				
				@if(count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<strong>Lỗi ! </strong> {{$errors->first('txtNull')}}
					</div>
				@endif

				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="row">
							<form id="form-searchProduct" class="form-horizontal" role="form" action="{{url('quanli/ql-sanpham/tim-kiem-sp')}}" method="get">
								<div class="col-sm-5">
								  	<input type="text" class="form-control" name="key" placeholder="Nhập danh mục, tên sản phẩm, nhà bán hàng cần tìm ...">
								</div>
								<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
							</form>
						</div>
					</div>
				</div>


				<table id="table-product" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				      	<th>Danh mục</th>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th class="th-tensp">Tên sản phẩm</th>
				        <th>Giá bán lẻ</th>
				        <th>Giá khuyến mãi</th>
				        <th>Số lượng</th>
				        <th>Lượt mua</th>
				        <th>Nhà bán hàng</th>
				        <th>Trạng thái</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				      @if(count($list_all) == 0)
				      	<tr>
				      		<td align="center" colspan="10" style="color: red"><h4>Không có sản phẩm !</h4></td>
				      	</tr>
				      @else
				      	<?php
				      		foreach ($list_all as $all) {
				      			if(count($masp_khuyenmai) == 0){ ?>
				      				<tr>
								        <td>{{$all->tendanhmuc}}</td>
								        <td>{{$all->masp}}</td>
								        <td>
								        	<img src="{{asset('public/anh-sanpham/'.$all->anh)}}">
								        </td>
								        <td class="tensp">{{$all->tensp}}</td>
								        <td class="dongia">{{number_format($all->dongia)}}</td>
								        <td>-</td>
								        <td>{{$all->soluong}}</td>
								        <td>
								        	<?php 
								        		$count_mua = DB::table('chitiet_donhang')->where('masp', $all->masp)->count('masp');
								        		echo $count_mua;
								        	?>
								        </td>
								        <td class="tenshop">{{$all->tengianhang}}</td>
								        <td>
								        	@if($all->trangthai == 0)
								        		<label class="label label-warning">Chờ duyệt</label>
								        	@else
								        		<label class="label label-success">Đã duyệt</label>
								        	@endif
								        </td>
								        <td>
								        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham/'.$all->masp)}}" type="button" class="btn btn-info">Chi tiết</a>
								        </td>
								    </tr>
				      			<?php } else {
				      				if(in_array($all->masp, $masp_khuyenmai)){ ?>
				      						<tr>
										        <td>{{$all->tendanhmuc}}</td>
										        <td>{{$all->masp}}</td>
										        <td>
										        	<img src="{{asset('public/anh-sanpham/'.$all->anh)}}">
										        </td>
										        <td class="tensp">{{$all->tensp}}</td>
										        <td class="dongia">{{number_format($all->dongia)}}</td>
										        <td>
										        	<?php
										        		$giam = DB::table('khuyen_mai as km')
										        				->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')->where('ctkm.masp',$all->masp)->get();
										        		$t = 0;
										        		foreach ($giam as $valkm) {
										        			if((strtotime($ngayht) > strtotime($valkm->ngaybd)) && (strtotime($ngayht) < strtotime($valkm->ngaykt))){
											        			echo number_format($all->dongia-($all->dongia*$valkm->chietkhau*0.01));
											        			break;
											        		} else {
											        			$t+=1;
											        		}
										        		}
										        		if($t == count($giam)){
										        			echo "-";
										        		}
										        	?>
										        </td>
										        <td>{{$all->soluong}}</td>
										        <td>
										        	<?php 
										        		$count_mua = DB::table('chitiet_donhang')->where('masp', $all->masp)->count('masp');
										        		echo $count_mua;
										        	?>
										        </td>
										        <td class="tenshop">{{$all->tengianhang}}</td>
										        <td>
										        	@if($all->trangthai == 0)
										        		<label class="label label-warning">Chờ duyệt</label>
										        	@else
										        		<label class="label label-success">Đã duyệt</label>
										        	@endif
										        </td>
										        <td>
										        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham/'.$all->masp)}}" type="button" class="btn btn-info">Chi tiết</a>
										        </td>
										    </tr>
				      					<?php } else { ?>
				      						<tr>
										        <td>{{$all->tendanhmuc}}</td>
										        <td>{{$all->masp}}</td>
										        <td>
										        	<img src="{{asset('public/anh-sanpham/'.$all->anh)}}">
										        </td>
										        <td class="tensp">{{$all->tensp}}</td>
										        <td class="dongia">{{number_format($all->dongia)}}</td>
										        <td>-</td>
										        <td>{{$all->soluong}}</td>
										        <td>
										        	<?php 
										        		$count_mua = DB::table('chitiet_donhang')->where('masp', $all->masp)->count('masp');
										        		echo $count_mua;
										        	?>
										        </td>
										        <td class="tenshop">{{$all->tengianhang}}</td>
										        <td>
										        	@if($all->trangthai == 0)
										        		<label class="label label-warning">Chờ duyệt</label>
										        	@else
										        		<label class="label label-success">Đã duyệt</label>
										        	@endif
										        </td>
										        <td>
										        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham/'.$all->masp)}}" type="button" class="btn btn-info">Chi tiết</a>
										        </td>
										    </tr>
				      					<?php }
				      				}
				      		}
				      	?>
				      @endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="8">{!! $list_all->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>

@stop