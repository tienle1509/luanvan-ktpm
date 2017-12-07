@extends('nguoiban.sanpham')

@section('title','Sản phẩm bán chạy')

@section('chitiet')


<h2>Top 5 sản phẩm bán chạy của shop</h2>
				
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
				        <th>Đã bán</th>
				        <th>Trạng thái</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($mang_masp) == 0)
				    		<tr>
				    			<td align="center" style="color: red" colspan="10"><h4>Không có sản phẩm !</h4></td>
				    		</tr>
				    	@else
				    		<?php 
				    			$count_sosp = 0;
				    			foreach ($mang_masp as $masp => $sl) { 
				    				$sp = DB::table('san_pham as sp')
											->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
											->where('sp.masp', $masp)
											->first();
									$count_sosp += 1;
									if($count_sosp > 5){
										break;
									}
				    			?>
				    				<tr>
										<td>{{$sp->tendanhmuc}}</td>
								        <td>{{$sp->masp}}</td>
								        <td>
								        	<img src="{{asset('public/anh-sanpham/'.$sp->anh)}}">
								        </td>
								        <td class="name-pro">{{$sp->tensp}}</td>
								        <td class="price-pro">{{number_format($sp->dongia,0,'.','.')}}</td>
								        <?php
								        	//Kiểm tra sản phẩm có khuyến mãi hay không
				    						$km = DB::table('khuyen_mai as km')
			                                   			->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
			                                   			->where('ctkm.masp', $sp->masp)
			                                   			->get();
			                                if(count($km) != 0){
			                                	$t = 0;
			                                	foreach ($km as $valkm) {
			                                		if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd)) && (strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt))){
			                                				echo '<td>'.number_format($sp->dongia-($sp->dongia*$valkm->chietkhau*0.01),0,'.','.').'</td>';
			                                			break;
			                                		}else{
			                                			$t +=1;
			                                		}
			                                	}
			                                	if($t == count($km)){
			                                		echo '<td>-</td>';
			                                	}
			                                }else{
			                                	echo '<td>-</td>';
			                                }
								        ?>
								        <td>{{$sp->soluong}}</td>
								        <td style="color: red; font-weight: bold; font-size: 18px">{{$sl}}</td>
								        <td>
								      	@if($sp->trangthai == 0)
									   		<span class="label label-warning">Chờ duyệt</span>
									   	@else
									   		<span class="label label-success">Đã duyệt</span>
									   	@endif
									    </td>
									    <td>
									       	<a href="chitiet-sanpham/{{$sp->masp}}" type="btn" class="btn btn-info">
									  		Chi tiết
									       	</a>
									    </td>
									</tr>
								<?php } ?>
				    	@endif
				    </tbody>
				  </table>


@stop