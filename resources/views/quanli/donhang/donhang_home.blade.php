@extends('quanli.donhang')

@section('chitiet')
<h2>Đơn hàng mới</h2>

				<table id="table-donhang-admin" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã ĐH</th>
				        <th>Ngày đặt</th>
				        <th class="guiden">Thông tin giao hàng</th>
				        <th>Tên sản phẩm</th>
				        <th>Hình thức thanh toán</th>
				        <th>Nhà bán hàng</th>
				        <th>Tổng tiền</th>				        
				        <th>Trạng thái</th>			        
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($ordernew) == 0)
				    		<tr>
				    			<td align="center" colspan="7" style="color: red"><h4>Không có đơn hàng mới !</h4></td>
				    		</tr>
				    	@else
				    		@foreach($ordernew as $val)
				    			<tr>
							        <td>{{$val->madh}}</td>
							        <td>{{date('d/m/Y',strtotime($val->ngaydat))}}</td>
							        <td class="guiden">
							        	<label>{{$val->tenkh}}</label><br> {{$val->diachigiaohang}}
							        	<br>{{$val->sodienthoai}}
							        </td>
							        <td class="chitietdh">
							        	<?php						        		
											//Chi tiết đơn hàng
							        		$ctdh = DB::table('chitiet_donhang as ct')
							        					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							        					->where('ct.madh',$val->madh)
							        					->get();
							        		foreach ($ctdh as $valct) { 
							        			//Kiểm tra sản phẩm có khuyến mãi không
							        				$km = DB::table('khuyen_mai as km')
							        					->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							        					->where('ctkm.masp',$valct->masp)
							        					->get();
							        				if(count($km) != 0){
							        					$t = 0;
								        				foreach ($km as $valkm) {
								        					if(strtotime($val->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($val->ngaydat) <= strtotime($valkm->ngaykt)){ ?>

								        						<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia-($valct->dongia*0.01*$valkm->chietkhau),0,'.','.')}}
				        										<br>
								        					<?php break; } else{
								        						$t +=1;
								        					}
								        				}
								        				if($t == count($km)){ ?>
								        					<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia,0,'.','.')}}
				        									<br>
								        				<?php }
								        			}else{ ?>
								        				<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia,0,'.','.')}}
				        								<br>
								        			<?php }
							        		?>
							        		<?php }
							        	?>							        	
							        </td>
							        <td class="httt">
							        	<?php
							        		$ht_thanhtoan = DB::table('hinhthuc_thanhtoan')->where('mahttt',$val->mahttt)->first();
							        		echo $ht_thanhtoan->tenhttt;
							        	?>
							        </td>
							        <td>
							        	<?php						        		
											//Chi tiết đơn hàng
							        		$ctdh = DB::table('chitiet_donhang as ct')
							        					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							        					->join('nguoi_ban as nb', 'nb.manb', '=', 'sp.manb')
							        					->where('ct.madh',$val->madh)
							        					->select('nb.tengianhang')
							        					->distinct()
							        					->get();
							        		foreach ($ctdh as $valct) {
							        			echo $valct->tengianhang;
							        		}
							        	?>
							        </td>
							        <td class="tongtien">{{number_format($val->tongtien,0,'.','.')}}</td>							        
							        <td>
							        	<label class="label label-warning">Chờ duyệt</label>
							        </td>
							    </tr>
				    		@endforeach
				    	@endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="7">{!! $ordernew->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>

@stop