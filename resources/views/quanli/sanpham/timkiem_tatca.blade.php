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

				<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{count($result_search)}}</b> sản phẩm</div>

				@if(count($result_search) != 0)
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
				      <?php
				      	foreach ($result_search as $valSearch) {
				      		//Kiểm tra có khuyến mãi hay không
				      		$km = DB::table('khuyen_mai as km')
				      				->join('chitiet_khuyenmai as ctkm', 'km.makm', '=', 'ctkm.makm')
				      				->where('ctkm.masp', $valSearch->masp)
				      				->get();
				      		if(count($km) == 0){ ?>
				      			<tr>
								        <td>{{$valSearch->tendanhmuc}}</td>
								        <td>{{$valSearch->masp}}</td>
								        <td>
								        	<img src="{{asset('public/anh-sanpham/'.$valSearch->anh)}}">
								        </td>
								        <td class="tensp">{{$valSearch->tensp}}</td>
								        <td class="dongia">{{number_format($valSearch->dongia,0,'.','.')}}</td>
								        <td>-</td>
								        <td>{{$valSearch->soluong}}</td>
								        <td>
								        	<?php 
								        		$count_mua = DB::table('chitiet_donhang')->where('masp', $valSearch->masp)->count('masp');
								        		echo $count_mua;
								        	?>
								        </td>
								        <td class="tenshop">{{$valSearch->tengianhang}}</td>
								        <td>
								        	@if($valSearch->trangthai == 0)
								        		<label class="label label-warning">Chờ duyệt</label>
								        	@else
								        		<label class="label label-success">Đã duyệt</label>
								        	@endif
								        </td>
								        <td>
								        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham/'.$valSearch->masp)}}" type="button" class="btn btn-info">Chi tiết</a>
								        </td>
								    </tr>
				      		<?php } else { ?>
				      			<tr>
										        <td>{{$valSearch->tendanhmuc}}</td>
										        <td>{{$valSearch->masp}}</td>
										        <td>
										        	<img src="{{asset('public/anh-sanpham/'.$valSearch->anh)}}">
										        </td>
										        <td class="tensp">{{$valSearch->tensp}}</td>
										        <td class="dongia">{{number_format($valSearch->dongia)}}</td>
										        <td>
										        	<?php
										        		$t = 0;
										        		foreach ($km as $valkm) {
										        			if(strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd) && strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt)){
										        				echo number_format($valSearch->dongia-($valSearch->dongia*$valkm->chietkhau*0.01),0,'.','.');
										        				break;
										        			} else {
										        				$t+=1;
										        			}
										        		}
										        		if($t == count($km)){
										        			echo "-";
										        		}
										        	?>
										        </td>
										        <td>{{$valSearch->soluong}}</td>
										        <td>
										        	<?php 
										        		$count_mua = DB::table('chitiet_donhang')->where('masp', $valSearch->masp)->count('masp');
										        		echo $count_mua;
										        	?>
										        </td>
										        <td class="tenshop">{{$valSearch->tengianhang}}</td>
										        <td>
										        	@if($valSearch->trangthai == 0)
										        		<label class="label label-warning">Chờ duyệt</label>
										        	@else
										        		<label class="label label-success">Đã duyệt</label>
										        	@endif
										        </td>
										        <td>
										        	<a href="{{asset('quanli/ql-sanpham/chitiet-sanpham/'.$valSearch->masp)}}" type="button" class="btn btn-info">Chi tiết</a>
										        </td>
										    </tr>
				      		<?php }
				      	}
				      ?>
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="8">{!! $result_search->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>
				@endif

@stop