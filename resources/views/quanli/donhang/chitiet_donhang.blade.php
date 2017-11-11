@extends('quanli_home')

@section('qldonhang','active')

@section('noidung')
<div class="container-fluid">
				<h1>Chi tiết đơn hàng</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-donhang')}}">Quản lí đơn hàng</a></li>
						  <li class="active">Chi tiết đơn hàng</li>
						</ol>
					</div>
				</div>

				<div class="panel-detailOrder col-md-12" >
					<div class="detailOrder-h3"><h3>ĐƠN HÀNG <label>#{{$ctdh->madh}}</label></h3></div>
					<hr style="border: 1px solid blue">
					<div class="detailOrderRow1 row">
						<div class="col-md-4 col-sm-4">
							<span class="fa fa-clock-o"></span>&nbsp;&nbsp;Ngày đặt hàng: <b>{{date('d/m/Y',strtotime($ctdh->ngaydat))}}</b>
						</div>
					<!--	<div class="col-md-3 col-sm-3">
							<span class="fa fa-clock-o"></span>&nbsp;&nbsp;Ngày giao hàng: <b>25/03/2017</b>
						</div>  -->
						<div class="col-md-5 col-sm-5">
							<span class="fa fa-money"></span>&nbsp;&nbsp;Hình thức thanh toán: <?php
								$ht = DB::table('hinhthuc_thanhtoan')->where('mahttt',$ctdh->mahttt)->first();
								echo $ht->tenhttt;
							?>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>

					<div class="detailOrderRow1 row">
						<div class="col-md-4 col-sm-4">
							<span class="fa fa-user"></span>&nbsp;&nbsp;Người nhận <b>{{$ctdh->tenkh}}</b>
						</div>
						<div class="col-md-3 col-sm-3">
							<span class="fa fa-mobile"></span>&nbsp;&nbsp;
							Số điện thoại: {{$ctdh->sodienthoai}}
						</div>
						<div class="col-md-5 col-sm-5">
							<span class="fa fa-home"></span>&nbsp;&nbsp;
							Địa chỉ: {{$ctdh->diachigiaohang}}
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>


					<table id="table-detailOrder" class="table">
					  <thead>
					    <th>Hình ảnh</th>
					    <th>Tên sản phẩm</th>				    
					    <th class="num-detailOrder">Số lượng</th>
					    <th class="text-center">Đơn giá</th>
					    <th class="text-right">Thành tiền</th>
					  </thead>
					  <?php
					  	$sp = DB::table('chitiet_donhang as ct')
					  				->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
					  				->where('ct.madh',$ctdh->madh)
					  				->get();
					  	$thanhtien = 0;
					  	foreach ($sp as $valsp) { ?>
					  		<tr>
							    <td class="img-detailOrder">
							    	<img src="{{asset('public/anh-sanpham/'.$valsp->anh)}}">
							    </td>
							    <td class="name-detailOrder">{{$valsp->tensp}}</td>
							    <td class="num-detailOrder">{{$valsp->soluongct}}</td>
							    <td class="price-detailOrder text-center">
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
							    <td class="tong-detailOrder text-right">
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
					</table>
					<hr>
					<div class="tongtien-detailOrder row">
						<div class="col-md-10 col-sm-10 text-right">
							Phí vận chuyển:
						</div>
						<div class="col-md-2 col-sm-2 text-right">
							@if($thanhtien >= 300000)
								Miễn phí
							@else
								{{number_format($ctdh->tongtien-$thanhtien, 0, '.', '.')}}
							@endif
						</div>
					</div>
					<div class="tongtien-detailOrder row" style="margin-top: 10px; font-size: 17px;">
						<div class="col-md-10 col-sm-10 text-right">
							<b style="color: black">Tổng tiền:</b>
						</div>
						<div class="col-md-2 col-sm-2 text-right">
							<b>{{number_format($ctdh->tongtien,0,'.','.')}} đ</b>
						</div>
					</div>

					<div class="detailOrderRow2">
						<div class="text-right submit-detailOrder">
							<a href="{{asset('quanli/ql-donhang')}}" type="button" class="btn btn-primary btn-lg">Quay lại</a>
						</div>
					</div>
				</div>

			</div>


@stop