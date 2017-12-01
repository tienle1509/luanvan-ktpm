@extends('quanli_home')

@section('qldonhang','active')

@section('noidung')

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnDuyetDH').click(function(){
			var url = "http://localhost/luanvan-ktpm/quanli/ql-donhang/duyet";
			var madh = $(this).closest('tr').find('td:nth-child(1)').text();
			var maql = '<?php echo $_SESSION['maql']; ?>';

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"madh":madh, "maql":maql},
				success : function(result){
					if(result.success){
						$.notify({
								// options
								message: 'Duyệt sản phẩm thành công !'
							},{
								// settings
								element: 'body',
								position: null,
								type: "success",
								allow_dismiss: true,
								placement: {
									from: "top",
									align: "right"
								},
								offset: 100,
								spacing: 10,
								z_index: 1031,
								delay: 1000,
								timer: 800,
							});
						setTimeout("location.reload(true);",1500);	
					}
				}
			}); 
		});
	});
</script>



<div class="container-fluid">
				<h1>Duyệt đơn hàng</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-donhang')}}">Quản lí đơn hàng</a></li>
						  <li class="active">Duyệt đơn hàng</li>
						</ol>
					</div>
				</div>

				

				<h2>Đơn hàng đang chờ duyệt</h2>			

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
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				      @if(count($duyet_donhang) == 0)
				      	<tr>
				    		<td align="center" colspan="8" style="color: red"><h4>Không có đơn hàng mới !</h4></td>
				    	</tr>
				      @else
					    @foreach($duyet_donhang as $val)
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
						        <td>
						        	<button type="button" class="btn btn-success btnDuyetDH">Phê duyệt</button>
						        </td>			        				        
						    </tr>
					    @endforeach
				      @endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="8">{!! $duyet_donhang->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>
			</div>


@stop