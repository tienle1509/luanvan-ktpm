@extends('quanli.donhang')

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
						<form id="form-searchOrder" class="form-horizontal" role="form" method="get" action="{{url('quanli/ql-donhang/timkiem-tatca')}}">
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

				<!--Tìm kiếm theo tên khách hàng, mã đơn hàng -->
				@if(isset($result))
					<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{count($result)}}</b> đơn hàng</div>

					@if(count($result) != 0)
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
						        <th>Tình trạng</th>
						        <th>Hành động</th>		        
						      </tr>
						    </thead>
						    <tbody>
						    	<?php 
						    		foreach ($result as $val) {  ?>
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
									        	@if($val->trangthai == 0)
										        	<label class="label label-warning">Chờ duyệt</label>
										        @else
										        	<label class="label label-success">Đã duyệt</label>
										        @endif
									        </td>
									        <td>
									        	@if($val->trangthai == 1 && $val->mattdh == 1)
										        	<label class="label label-warning">Đang xử lí</label>
										        @elseif($val->trangthai == 1 && $val->mattdh == 2)
										        	<label class="label label-info">Đang giao đi</label>
										        @elseif($val->trangthai == 1 && $val->mattdh == 3)
										       		<label class="label label-danger">Giao hàng thất bại</label>
										       	@elseif($val->trangthai == 1 && $val->mattdh == 4)
										       		<label class="label label-success">Giao hàng thành công</label>
										       	@endif
									        </td>
									        <td>
									        	<a href="{{asset('quanli/ql-donhang/chitiet-donhang/'.$val->madh)}}" type="button" class="btn btn-info">Chi tiết</a>
									        </td>
									    </tr>
						    		<?php }
						    	?>
						    </tbody>
						    <tfoot>
						    	<tr>
						    		<td align="center" colspan="9">{!! $result->render() !!}</td>
						    	</tr>
						    </tfoot>
						</table>
					@endif
				@endif


				<!--Tìm kiếm theo thời gian -->
				@if(isset($result_thoigian))
					<?php
						$t = 0;
						foreach ($result_thoigian as $val) {  
						    if(strtotime($val->ngaydat) >= strtotime(date('Y-m-d',strtotime($ngaybd))) && strtotime($val->ngaydat) <= strtotime(date('Y-m-d', strtotime($ngaykt)))){
						    	$t +=1;
						    }
						}
					?>
					<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{$t}}</b> đơn hàng</div>

					@if($t != 0)
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
						        <th>Tình trạng</th>
						        <th>Hành động</th>		        
						      </tr>
						    </thead>
						    <tbody>
						    	<?php 
						    		foreach ($result_thoigian as $val) {  
						    			if(strtotime($val->ngaydat) >= strtotime(date('Y-m-d',strtotime($ngaybd))) && strtotime($val->ngaydat) <= strtotime(date('Y-m-d', strtotime($ngaykt)))){
						    			?>
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
									        	@if($val->trangthai == 0)
										        	<label class="label label-warning">Chờ duyệt</label>
										        @else
										        	<label class="label label-success">Đã duyệt</label>
										        @endif
									        </td>
									        <td>
									        	@if($val->trangthai == 1 && $val->mattdh == 1)
										        	<label class="label label-warning">Đang xử lí</label>
										        @elseif($val->trangthai == 1 && $val->mattdh == 2)
										        	<label class="label label-info">Đang giao đi</label>
										        @elseif($val->trangthai == 1 && $val->mattdh == 3)
										       		<label class="label label-danger">Giao hàng thất bại</label>
										       	@elseif($val->trangthai == 1 && $val->mattdh == 4)
										       		<label class="label label-success">Giao hàng thành công</label>
										       	@endif
									        </td>
									        <td>
									        	<a href="{{asset('quanli/ql-donhang/chitiet-donhang/'.$val->madh)}}" type="button" class="btn btn-info">Chi tiết</a>
									        </td>
									    </tr>
						    		<?php }
						    		}
						    	?>
						    </tbody>
						    <tfoot>
						    	<tr>
						    		<td align="center" colspan="9">{!! $result_thoigian->render() !!}</td>
						    	</tr>
						    </tfoot>
						</table>
					@endif
				@endif

@stop