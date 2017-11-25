@extends('khachhang_home')

@section('title-page','Đơn hàng')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-donhang.css')}}">

<?php
	if(!isset($_SESSION['ctdh'])){
		header("Location: http://localhost/luanvan-ktpm/home");	
		exit;
	}
	$ctdh = $_SESSION['ctdh'];
	$ngayht = $_SESSION['ngayht'];
?>

<div class="nav-bottom ">
		<div class="container">
			<div class="row">
				<ul class="nav nav-pills">
					<li class="danhmuc">
						<button type="button" class="btn-danhmuc">
							<span class="fa fa-navicon"></span>&nbsp;&nbsp;&nbsp;DANH MỤC SẢN PHẨM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="fa fa-angle-down"></span>
						</button>
						<div class="dropdown-content">
							<?php
								$dmleft = DB::table('danhmuc_sanpham')->get();
							?>
							@foreach($dmleft as $val)
								<a href="{{asset('chitiet-danhmuc/'.$val->madm)}}">{{$val->tendanhmuc}}</a>
							@endforeach
						</div>
					</li>
					<li>
						<a class="nav-bottom-km" href="#">
						<span class="fa fa-gift"></span>&nbsp;&nbsp;&nbsp;KHUYẾN MÃI
						</a>
					</li>
					<li><a class="nav-bottom-banchay" href="#"><span class="fa fa-tags"></span>&nbsp;&nbsp;&nbsp;BÁN CHẠY</a></li>	
				</ul>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>


	<!-- Body -->
	<div class="container">
		<div class="tieude">
			<h3><label>Chào bạn, dưới đây là thông tin đơn hàng của bạn:</label></h3>
		</div>

		<div class="trangthai text-center">
			<?php
				$ttdh = DB::table('tinhtrang_donhang')->get();
				$t = 0;
				foreach ($ttdh as $valttdh) {
					if($ctdh->mattdh == 1){
						echo '<div class="col-md-3 col-sm-3">				
								<div class="label-tinhtrang" style="background-color: #28A502; color: #FFFFFF;">
								<span class="fa fa-check-circle"></span>
								&nbsp;&nbsp;'.$valttdh->tenttdh.'</div>
							 </div>';
						echo '<div class="col-md-3 col-sm-3">
								<div class="label-tinhtrang">Đang giao đi</div>
							  </div>';
						echo '<div class="col-md-3 col-sm-3">
								<div class="label-tinhtrang">Giao hàng thành công</div>
							  </div>';
						break;
					}

					if($ctdh->mattdh == 2){
						if($valttdh->mattdh <= $ctdh->mattdh){
							$t = 1;
							echo '<div class="col-md-3 col-sm-3">				
								<div class="label-tinhtrang" style="background-color: #28A502; color: #FFFFFF;">
								<span class="fa fa-check-circle"></span>
								&nbsp;&nbsp;'.$valttdh->tenttdh.'</div>
							 </div>';
							 continue;
						}
					}

					if($ctdh->mattdh == 3){
						if($valttdh->mattdh <= $ctdh->mattdh){	
							$t = 2;						
							echo '<div class="col-md-3 col-sm-3">				
									<div class="label-tinhtrang" style="background-color: #28A502; color: #FFFFFF;">
									<span class="fa fa-check-circle"></span>
									&nbsp;&nbsp;'.$valttdh->tenttdh.'</div>
								 </div>';
						}
					}

					if($ctdh->mattdh == 4){
						if($valttdh->mattdh <= $ctdh->mattdh){	
							$t = 2;			
							if($valttdh->mattdh == 3 && $ctdh->mattdh == 4){
								$t = 1;
								continue;
							}			
							echo '<div class="col-md-3 col-sm-3">				
									<div class="label-tinhtrang" style="background-color: #28A502; color: #FFFFFF;">
									<span class="fa fa-check-circle"></span>
									&nbsp;&nbsp;'.$valttdh->tenttdh.'</div>
								 </div>';
						}
					}
				}
				if($t == 0){
					echo '<div class="col-md-3 col-sm-3">
							<div class="label-tinhtrang">Hoàn tất</div>
						  </div>';
				}
				if($t == 1){
					echo '<div class="col-md-3 col-sm-3">
							<div class="label-tinhtrang">Giao hàng thành công</div>
						  </div>';
					echo '<div class="col-md-3 col-sm-3">
							<div class="label-tinhtrang">Hoàn tất</div>
						  </div>';
				}
				if($t == 2){
					echo '<div class="col-md-3 col-sm-3">				
							<div class="label-tinhtrang" style="background-color: #28A502; color: #FFFFFF;">
							<span class="fa fa-check-circle"></span>
							&nbsp;&nbsp;Hoàn tất</div>
						 </div>';	
				}
			?>
		</div>
		<div class="clearfix"></div>

		<div class="col-md-6 col-sm-6">
			<div class="panel-vanchuyen row">
				<h4><b>THÔNG TIN ĐƠN HÀNG</b></h4>
				<div class="col-md-3 col-sm-3"> 
					<div class="row">Mã đơn hàng:</div>
					<div class="row">Ngày đặt:</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="row"><b>#{{$ctdh->madh}}.</b></div>
					<div class="row">{{date('d/m/Y',strtotime($ctdh->ngaydat))}}.</div>
				</div>
			</div>		
		</div>
		

		<div class="col-md-5 col-sm-5">
			<div class="panel-thongtinnhan row">
				<h4><b>THÔNG TIN NGƯỜI NHẬN</b></h4>
				<b>{{$ctdh->tenkh}}</b>
				<div>{{$ctdh->diachigiaohang}}.</div>
				<div>Số điện thoại: {{$ctdh->sodienthoai}}</div>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="panel-donhang">
			<table class="table tbdonhang">
			    <thead>
			      <tr>
			        <th class="col-ten">Sản phẩm</th>
			        <th class="text-center">Đơn giá</th>
			        <th class="text-center">Số lượng</th>
			        <th class="text-right">Thành tiền</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php
			    		$sp = DB::table('chitiet_donhang as ct')
			    				->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
			    				->where('ct.madh', $ctdh->madh)
			    				->get();
			    		$thanhtien = 0;
			    		foreach ($sp as $valsp) { ?>
			    			<tr>
						        <td>
						        	<div class="col-md-2 col-sm-2">
						        		<div class="row">
						        			<img src="{{asset('public/anh-sanpham/'.$valsp->anh)}}">
						        		</div>
						        	</div>
						        	<div class="col-md-10 col-sm-10">
						        		<div class="row"><label>{{$valsp->tensp}}</label></div>
						        		<div>Bảo hành {{$valsp->baohanh}} tháng</div>
						        	</div>
						        </td>
						        <td class="text-center">
						        <?php
						        	//Kiểm tra sản phẩm có đang khuyến mãi hay không
						        	$km = DB::table('khuyen_mai as km')
							        			->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							        				->where('ctkm.masp',$valsp->masp)
							        				->get();

							        	if(count($km) != 0){
							        		$count = 0;
							        		foreach ($km as $valkm) {
							        			if(strtotime($ctdh->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($ctdh->ngaydat) <= strtotime($valkm->ngaykt)){
							        				echo number_format($valsp->dongia-($valsp->dongia*0.01*$valkm->chietkhau),0,'.','.');
							        				break;
							        			}else{
							        				$count +=1;
							        			}
							        		}
							        		if($count == count($km)){
							        			echo number_format($valsp->dongia,0,'.','.');
							        		}
							        	}else{
							        		echo number_format($valsp->dongia,0,'.','.');
							        	}
						        ?>
						        </td>
						        <td class="text-center">{{$valsp->soluongct}}</td>
						        <td class="text-right">
						        	<?php
							    		//Kiểm tra sản phẩm có đang khuyến mãi hay không
							    		$km = DB::table('khuyen_mai as km')
							        			->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							        				->where('ctkm.masp',$valsp->masp)
							        				->get();							        	
							        	if(count($km) != 0){
							        		$count = 0;
							        		foreach ($km as $valkm) {
							        			if(strtotime($ctdh->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($ctdh->ngaydat) <= strtotime($valkm->ngaykt)){
							        				echo number_format(($valsp->dongia-($valsp->dongia*0.01*$valkm->chietkhau))*$valsp->soluongct,0,'.','.');
							        				$thanhtien += $valsp->dongia-($valsp->dongia*0.01*$valkm->chietkhau)*$valsp->soluongct;
							        				break;
							        			}else{
							        				$count +=1;
							        			}
							        		}
							        		if($count == count($km)){
							        			echo number_format($valsp->dongia*$valsp->soluongct,0,'.','.');
							        			$thanhtien += $valsp->dongia*$valsp->soluongct;
							        		}
							        	}else{
							        		echo number_format($valsp->dongia*$valsp->soluongct,0,'.','.');
							        		$thanhtien += $valsp->dongia*$valsp->soluongct;
							        	}
							    	?>
						        </td>
						    </tr>
			    		<?php }
				  	?>
			    </tbody>
			    <tfoot class="tbfoot">
			    	<tr>
			    		<td colspan="3" class="text-right">
			    			<div class="row">Tổng tiền:</div>
			    			<div class="row">Phí vận chuyển:</div>
			    			<div class="row row-tong"><b>Tổng thanh toán</b</div>
			    		</td>
			    		<td class="text-right">
			    			<div>
			    				{{number_format($thanhtien, 0, '.', '.')}}
			    			</div>
			    			<div>
			    				@if($thanhtien >= 300000)
									Miễn phí
								@else
									{{number_format($ctdh->tongtien-$thanhtien, 0, '.', '.')}}
								@endif
			    			</div>
			    			<div class="row-tong"><b class="label-tong">
			    				{{number_format($ctdh->tongtien,0,'.','.')}} đ
			    			</b</div>
			    		</td>
			    	</tr>
			    </tfoot>
			</table>
		</div>
	</div>


@stop