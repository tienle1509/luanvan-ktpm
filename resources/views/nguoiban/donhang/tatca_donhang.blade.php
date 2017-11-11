@extends('nguoiban.donhang')

@section('title','Tất cả đơn hàng')

@section('chitiet')

<script type="text/javascript">
	// datepicker		
	$(function () {
        $("#startdate").datepicker({
               	dateFormat : 'dd-mm-yy',
                    onClose: function (selectedDate) {
           	        if (selectedDate != ""){ 
                       $("#Enddate").datepicker("option", "minDate", selectedDate); }
            	    }
                });
                $("#Enddate").datepicker({
                	dateFormat : 'dd-mm-yy',
                    minDate: 'selectedDate',
                });
        });
</script>


<h2>Tất cả đơn hàng</h2>

				@if(count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<strong>Lỗi ! </strong> {{$errors->first('txtkey')}}
					</div>
				@endif

				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="form-searchOrder" class="form-horizontal" role="form" method="get" action="{{url('nguoiban/donhang/timkiem-tatca')}}">
							<div class="col-sm-5 form-group">
							  	<input type="text" class="form-control" name="txtkey" placeholder="Nhập mã đơn hàng, tên khách hàng cần tìm ...">
							</div>
							<div class="col-sm-3 ">
							  	<div class="input-group">
							        <input class="form-control date" type="text" id="startdate" name="txtngaybd" placeholder="Từ ngày" />
							        	<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							    </div>
							</div>
							<div class="col-sm-3">
							  	<div class="input-group">
							        <input class="form-control date" type="text" id="Enddate" name="txtngaykt" placeholder="Đến ngày" />
							        	<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							    </div>
							</div>				    
							<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
						</form>
					</div>
				</div>


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
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($tatcadh) == 0)
				    		<tr>
					      		<td align="center" colspan="9" style="color: red"><h4>Không có đơn hàng !</h4></td>
					      	</tr>
				    	@else
				    		@foreach($tatcadh as $val)
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
									     			->where('sp.manb', $_SESSION['manb'])
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
							        <td class="tongtien">{{number_format($val->tongtien,0,'.','.')}}</td>
							        <td class="tinhtrangdh">
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
							        <td>
							        	<a href="{{asset('nguoiban/donhang/chitiet-donhang/'.$val->madh)}}" class="btn btn-info">Chi tiết</a>
							        </td>
							    </tr>
				    		@endforeach
				    	@endif				      
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="9">{!! $tatcadh->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>



@stop