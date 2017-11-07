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
						<form id="form-searchOrder" class="form-horizontal" role="form" method="get" action="">
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

				<!-- Tìm kiếm theo tên khách hàng, mã đơn hàng -->
				@if(isset($result_arr))
					<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{count($result_arr)}}</b> sản phẩm</div>


					@if(count($result_arr) != 0)
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
						    	<?php
						    		foreach ($result_arr as $valsearch) {
						    			//Lấy dòng dữ liệu đầu tiên
						    			$dh_theoma = DB::table('don_hang as dh')
						    							->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')		
														->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
														->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
														->where('dh.madh',$valsearch)
														->first();
									?>
										<tr>
									        <td class="madh">{{$dh_theoma->madh}}</td>
									        <td class="ngaydat">{{date('d/m/Y',strtotime($dh_theoma->ngaydat))}}</td>
									        <td class="guiden">
									        	<label>{{$dh_theoma->tenkh}}</label><br> {{$dh_theoma->diachigiaohang}}
									        	<br>{{$dh_theoma->sodienthoai}}
									        </td>
									        <td class="chitietdh">
									        	<?php						        		
													//Chi tiết đơn hàng
										       		$ctdh = DB::table('chitiet_donhang as ct')
										       				->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
										       				->where('ct.madh',$dh_theoma->madh)
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
										        					if(strtotime($dh_theoma->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($dh_theoma->ngaydat) <= strtotime($valkm->ngaykt)){ ?>

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
											    	$ht_thanhtoan = DB::table('hinhthuc_thanhtoan')->where('mahttt',$dh_theoma->mahttt)->first();
											    	echo $ht_thanhtoan->tenhttt;
											    ?>
									        </td>				        			        
									        <td class="tongtien">
									        	<?php						        		
													if($thanhtien >= 300000){
														echo number_format($thanhtien,0,'.','.');
													}
										        	else{
										        		if($dh_theoma->tongtien-27500 >= 300000)
										        			echo number_format($thanhtien,0,'.','.');
										        		else
										        			echo number_format($dh_theoma->tongtien,0,'.','.');
										        	}
								        		?>
									        </td>
									        <td class="tinhtrangdh">
									        	@if($dh_theoma->mattdh == 1)
											       	<label class="label label-warning">Đang xử lí</label>
											    @elseif($dh_theoma->mattdh == 2)
											        <label class="label label-info">Đang giao đi</label>
											    @elseif($dh_theoma->mattdh == 3)
											    	<label class="label label-danger">Giao hàng thất bại</label>
											    @elseif($dh_theoma->mattdh == 4)
											    	<label class="label label-success">Giao hàng thành công</label>
											    @endif
									        </td>
									        <td>
									        	<a href="{{asset('nguoiban/donhang/chitiet-donhang/'.$dh_theoma->madh)}}" class="btn btn-info">Chi tiết</a>
									        </td>
									      </tr>									
						    		<?php }
						    	?>
						    </tbody>
						</table>
					@endif
				@endif




				<!-- Tìm kiếm theo thời gian -->
				@if(isset($result_thoigian))
					<?php
						$t = 0;
						foreach ($result_thoigian as $val) {
							if(strtotime($val->ngaydat) >= strtotime(date('Y-m-d',strtotime($ngaybd))) && strtotime($val->ngaydat) <= strtotime(date('Y-m-d', strtotime($ngaykt)))){
						    	$t +=1;
						    }
						}
					?>

					<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{$t}}</b> sản phẩm</div>


					@if($t != 0)
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
						    	<?php
						    		foreach ($result_thoigian as $dh_theoma) {
						    			if(strtotime($dh_theoma->ngaydat) >= strtotime(date('Y-m-d',strtotime($ngaybd))) && strtotime($dh_theoma->ngaydat) <= strtotime(date('Y-m-d', strtotime($ngaykt)))){
									?>
										<tr>
									        <td class="madh">{{$dh_theoma->madh}}</td>
									        <td class="ngaydat">{{date('d/m/Y',strtotime($dh_theoma->ngaydat))}}</td>
									        <td class="guiden">
									        	<label>{{$dh_theoma->tenkh}}</label><br> {{$dh_theoma->diachigiaohang}}
									        	<br>{{$dh_theoma->sodienthoai}}
									        </td>
									        <td class="chitietdh">
									        	<?php						        		
													//Chi tiết đơn hàng
										       		$ctdh = DB::table('chitiet_donhang as ct')
										       				->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
										       				->where('ct.madh',$dh_theoma->madh)
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
										        					if(strtotime($dh_theoma->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($dh_theoma->ngaydat) <= strtotime($valkm->ngaykt)){ ?>

										        						<label>{{$valct->tensp}}</label><br>{{$valct->soluongct}} x {{number_format($valct->dongia-($valct->dongia*0.01*$valkm->chietkhau),0,'.','.')}}
							        									<br>

										        					<?php 
										        						$thanhtien += $valct->soluongct*($valct->dongia-($valct->dongia*0.01*$valkm->chietkhau));
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
											    	$ht_thanhtoan = DB::table('hinhthuc_thanhtoan')->where('mahttt',$dh_theoma->mahttt)->first();
											    	echo $ht_thanhtoan->tenhttt;
											    ?>
									        </td>				        			        
									        <td class="tongtien">
									        	<?php						        		
													if($thanhtien >= 300000){
														echo number_format($thanhtien,0,'.','.');
													}
										        	else{
										        		if($dh_theoma->tongtien-27500 >= 300000)
										        			echo number_format($thanhtien,0,'.','.');
										        		else
										        			echo number_format($dh_theoma->tongtien,0,'.','.');
										        	}
								        		?>
									        </td>
									        <td class="tinhtrangdh">
									        	@if($dh_theoma->mattdh == 1)
											       	<label class="label label-warning">Đang xử lí</label>
											    @elseif($dh_theoma->mattdh == 2)
											        <label class="label label-info">Đang giao đi</label>
											    @elseif($dh_theoma->mattdh == 3)
											    	<label class="label label-danger">Giao hàng thất bại</label>
											    @elseif($dh_theoma->mattdh == 4)
											    	<label class="label label-success">Giao hàng thành công</label>
											    @endif
									        </td>
									        <td>
									        	<a href="{{asset('nguoiban/donhang/chitiet-donhang/'.$dh_theoma->madh)}}" class="btn btn-info">Chi tiết</a>
									        </td>
									      </tr>									
						    		<?php }
						    		}
						    	?>
						    </tbody>
						</table>
					@endif
				@endif
@stop