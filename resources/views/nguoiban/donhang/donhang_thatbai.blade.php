@extends('nguoiban.donhang')

@section('title','Giao hàng thất bại')


@section('chitiet')

<h2>Giao hàng thất bại</h2>

				

				<table id="table-donhang" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã ĐH</th>
				        <th>Ngày đặt</th>
				        <th>Thông tin giao hàng</th>
				        <th>Tên sản phẩm</th>
				        <th>Hình thức thanh toán</th>
				        <th>Tình trạng</th>
				        <th>Tổng tiền</th>
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($dh_thatbai) == 0)
				    		<tr>
				    			<td align="center" colspan="8" style="color: red"><h4>Không có đơn hàng mới !</h4></td>
				    		</tr>
				    	@else
				    		<?php
				    			foreach ($dh_thatbai as $val) { ?>
				    				<tr>
								        <td>{{$val->madh}}</td>
								        <td>{{date('d/m/Y', strtotime($val->ngaydat))}}</td>
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
							        					->where('ct.manb', $_SESSION['manb'])
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

								        					<?php 
								        					break; } else{
								        						$t +=1;
								        					}
								        				}
								        				if($t == count($km)){ ?>
								        					<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia,0,'.','.')}}
				        									<br>
								        				<?php 
								        				}
								        			}else{ ?>
								        				<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia,0,'.','.')}}
				        								<br>
								        			<?php 
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
								        <td>
								        	@if($val->mattdh == 1)
										       	<label class="label label-warning">Đang xử lí</label>
										    @elseif($val->mattdh == 2)
										        <label class="label label-info">Đang giao đi</label>
										    @elseif($val->mattdh == 3)
										    	<label class="label label-danger">Giao hàng thất bại</label>
										    @elseif($val->mattdh == 4)
										    	<label class="label label-success">Giao hàng thành công</label>
										    @endif
								        </td>
								        <td class="tongtien">{{number_format($val->tongtien,0,'.','.')}}</td>
								        <td>
								        	<a href="{{asset('nguoiban/donhang/chitiet-donhang/'.$val->madh)}}" class="btn btn-info">Chi tiết</a>
								        </td>
								    </tr>
				    			<?php }
				    		?>
				    	@endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="9">{!! $dh_thatbai->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>


@stop