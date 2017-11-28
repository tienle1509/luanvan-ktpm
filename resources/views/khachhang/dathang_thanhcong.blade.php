@extends('khachhang_home')

@section('title-page','Mobile Store-Đặt hàng thành công')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-dathang-thanhcong.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-donhang.css')}}">



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
				</ul>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>



	<?php
		$kh = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->first();
	?>

	<!-- Body -->
	<div class="container">
		<div class="tieude">
			<h3><span class="fa fa-check-circle"></span>&nbsp;&nbsp;ĐẶT HÀNG THÀNH CÔNG</h3>

			<p>Cảm ơn quý khách đã tin tưởng và giao dịch tại <a href="{{asset('home')}}">www.mobilestore.vn</a></p>
			<p>Ban quản trị Mobile Store.</p>
			<div class="label-lienhe">
				<label>Mọi thắc mắc vui lòng liên hệ: &nbsp;&nbsp;</label><label class="label-sdt"> 19008088</label>
			</div>
		</div>


		<div class="col-md-6 col-sm-6">
			<div class="panel-vanchuyen row">
				<h4><b>THÔNG TIN ĐƠN HÀNG</b></h4>
				<div class="col-md-3 col-sm-3"> 
					<div class="row">Mã đơn hàng:</div>
					<div class="row">Ngày đặt:</div>
				</div>
				<div class="col-md-9 col-sm-9">
					<div class="row"><b>
					<?php
						$ngaydat = '';
						if(isset($_SESSION['madh_thanhvien'])){
							foreach ($_SESSION['madh_thanhvien'] as $val) {
								echo $val.', ';
								$ngaydat = DB::table('don_hang')->where('madh',$val)->first();
							}						
						}else{
							$ct = DB::table('don_hang')
									->where('makh', $_SESSION['makh'])
									->get();
							foreach ($ct as $val) {
								echo $val->madh.', ';
								$ngaydat = $val->ngaydat;
							}
						}
					?>
					</b></div>	
					<div class="row">
						<?php
							if(isset($_SESSION['madh_thanhvien'])){
								echo date('d/m/Y',strtotime($ngaydat->ngaydat));					
							}else{
								echo date('d/m/Y',strtotime($ngaydat));
							}
						?>
					</div>
				</div>
			</div>		
		</div>
		

		<div class="col-md-5 col-sm-5">
			<div class="panel-thongtinnhan row">
				<h4><b>THÔNG TIN NGƯỜI NHẬN</b></h4>
				<b>{{$kh->tenkh}}</b>
				<div>{{$kh->diachigiaohang}}.</div>
				<div>Số điện thoại: {{$kh->sodienthoai}}</div>
			</div>
		</div>
	</div>

	<?php
		if(isset($_SESSION['madh_thanhvien'])){
			foreach ($_SESSION['madh_thanhvien'] as $valmadh){ 
				$ctdh = DB::table('don_hang')->where('madh', $valmadh)->first(); ?>				
				<div class="container">
					<h4>Đơn hàng #{{$ctdh->madh}}</h4>
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
			<?php }					
		}else{
			$ct = DB::table('don_hang')
					->where('makh', $_SESSION['makh'])
					->get();
			foreach ($ct as $ctdh) { ?>
				<div class="container">
					<h4>Đơn hàng #{{$ctdh->madh}}</h4>
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
			<?php }
		}
	?>
	



	<?php
		$khachvanglai = DB::table('khach_hang')->where('makh',$_SESSION['makh'])->where('thanhvien',0)->first();
		if(count($khachvanglai) == 1){
			unset($_SESSION['makh']);
		}

		if(isset($_SESSION['madh_thanhvien'])){
			unset($_SESSION['madh_thanhvien']);
		}
	?>

@stop