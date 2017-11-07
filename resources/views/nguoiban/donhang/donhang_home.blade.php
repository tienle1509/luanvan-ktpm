@extends('nguoiban.donhang')

@section('chitiet')

<h2>Đơn hàng mới</h2>
				<table id="table-donhang" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã ĐH</th>
				        <th>Ngày đặt</th>
				        <th>Thông tin giao hàng</th>
				        <th>Tên sản phẩm</th>
				        <th>Hình thức thanh toán</th>				        
				        <th>Tổng tiền</th>
				        <th>Tình trạng</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($dhmoi) == 0)
				    		<tr>
				    			<td align="center" colspan="7" style="color: red"><h4>Không có đơn hàng mới !</h4></td>
				    		</tr>
				    	@else
				    		@foreach($dhmoi as $val)
				    			<tr>
							        <td class="madh">{{$val->madh}}</td>
							        <td class="ngaydat">{{date('d/m/Y',strtotime($val->ngaydat))}}</td>
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
							        					->where('sp.manb', $_SESSION['manb'])
							        					->get();

							        		$thanhtien = 0;
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

								        					<?php 
								        						$thanhtien += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
								        					break; } else{
								        						$t +=1;
								        					}
								        				}
								        				if($t == count($km)){ ?>
								        					<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia,0,'.','.')}}
				        									<br>
								        				<?php 
								        					$thanhtien += $valct->soluongct*$valct->dongia;
								        				}
								        			}else{ ?>
								        				<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia,0,'.','.')}}
				        								<br>
								        			<?php 
								        				$thanhtien += $valct->soluongct*$valct->dongia;
								        			}
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
							        <td class="tongtien">
							        	<?php						        		
											if($thanhtien >= 300000){
												echo number_format($thanhtien,0,'.','.');
											}
								        	else{
								        		if($val->tongtien-27500 >= 300000)
								        			echo number_format($thanhtien,0,'.','.');
								        		else
								        			echo number_format($val->tongtien,0,'.','.');
								        	}
							        	?>
							        </td>
							        <td class="tinhtrangdh">
							        	<label class="label label-warning">Đang xử lí</label>
							        </td>	
							    </tr>
				    		@endforeach
				    	@endif				      
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="7">{!! $dhmoi->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>

@stop