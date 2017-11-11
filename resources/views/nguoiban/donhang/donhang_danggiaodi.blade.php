@extends('nguoiban.donhang')

@section('title','Đơn hàng đang giao đi')

@section('chitiet')

<script type="text/javascript">
	//Xóa đơn hàng
	$(document).ready(function(){
		$('.btnXoa').click(function(){
			var url = "http://localhost/luanvan-ktpm/nguoiban/donhang/xoa-donhang";
			var madh = $(this).closest('tr').find('td:nth-child(1)').text();			

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"madh":madh},
				success : function(result){
					if(result.success){
						alert('Xóa đơn hàng thành công !');
						setTimeout(function(){
							location.reload();
						}, 900);
					}
				}
			});
		});
	});


	//Cập nhật tình trạng đơn hàng
	$(document).ready(function(){
		$('.btnCapNhat').click(function(){
			var url = "http://localhost/luanvan-ktpm/nguoiban/donhang/capnhat-donhang";
			var mattdh = $(this).closest('tr').find('select[name=selectTTDH]').val();
			var madh = $(this).closest('tr').find('td:nth-child(1)').text();

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"madh":madh, "mattdh":mattdh},
				success : function(result){
					if(result.success){
						alert('Cập nhật tình trạng đơn hàng thành công !');
						setTimeout(function(){
							location.reload();
						}, 900);
					}
				}
			});
		});
	});

</script>




<h2>Đơn hàng đang giao đi</h2>
				

				@if(count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<strong>Lỗi ! </strong> {{$errors->first('txtkey')}}
					</div>
				@endif

				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="form-searchOrder" class="form-horizontal" role="form" method="get" action="{{url('nguoiban/donhang/timkiem-danggiao')}}">
							<div class="col-sm-5 form-group">
							  	<input type="text" class="form-control" name="txtkey" placeholder="Nhập mã đơn hàng, tên khách hàng cần tìm ...">
							</div>
							<div class="col-sm-3 ">
								<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
							</div>	
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
				        <th>Tình trạng</th>
				        <th>Tổng tiền</th>
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				      	@if(count($dh_danggiao) == 0)
				    		<tr>
				    			<td align="center" colspan="8" style="color: red"><h4>Không có đơn hàng mới !</h4></td>
				    		</tr>
				    	@else
				    		<?php
				    			foreach ($dh_danggiao as $val) { ?>
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
								        <td >
								        	<select name="selectTTDH" class="form-control" style="width: 164px">
								        		<?php 
								        			$ttdh = DB::table('tinhtrang_donhang')->get();
								        			foreach ($ttdh as $valttdh) {
								        				if($val->mattdh == $valttdh->mattdh){
								        					echo '<option value="'.$valttdh->mattdh.'" selected>'.$valttdh->tenttdh.'</option>';
								        				}else{
								        					echo '<option value="'.$valttdh->mattdh.'">'.$valttdh->tenttdh.'</option>';
								        				}
								        			}
								        		?>
								        	</select>
								        </td>	
								        <td class="tongtien">{{number_format($val->tongtien,0,'.','.')}}</td>
								        <td>
								        	<button type="button" class="btn btn-success btnCapNhat">Cập nhật</button>
								        	<button type="button" class="btn btn-danger btn-block btnXoa" style="margin-top: 5px;">Xóa</button>
								        </td>
								    </tr>
				    			<?php }
				    		?>
				    	@endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="9">{!! $dh_danggiao->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>


@stop