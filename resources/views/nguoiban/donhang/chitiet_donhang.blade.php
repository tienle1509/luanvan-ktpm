@extends('nguoiban_home')

@section('donhang','active')

@section('noidung')

<script src="{{asset('public/js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#btnPrint").click(function(){
		    $(".ndIn").printArea();
		});
	});
</script>

<div class="container-fluid">
				<h1>Chi tiết đơn hàng</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/donhang')}}">Đơn hàng</a></li>
						  <li class="active">Chi tiết đơn hàng</li>
						</ol>
					</div>
				</div>

	<div class="ndIn">				

				<div class="detailOrder-h3"><h3>ĐƠN HÀNG <label>#{{$ctdh->madh}}</label></h3></div>
				<hr style="border: 1px solid blue">
				<table width="100%" style="margin-bottom: 30px;">
					<tbody>
						<tr>
							<td width="35%">
								<span class="fa fa-clock-o"></span>&nbsp;&nbsp;Ngày đặt hàng: <b>{{date('d/m/Y',strtotime($ctdh->ngaydat))}}</b>
							</td>
							<td colspan="2">
								<span class="fa fa-money"></span>&nbsp;&nbsp;Hình thức thanh toán: 
								<?php
									$ht = DB::table('hinhthuc_thanhtoan')->where('mahttt',$ctdh->mahttt)->first();
									echo $ht->tenhttt;
								?>
							</td>
						</tr>
						<tr>
							<td width="35%" style="padding-top: 20px;">
								<span class="fa fa-user"></span>&nbsp;&nbsp;Người nhận: <b>{{$ctdh->tenkh}}</b>
							</td>
							<td width="35%" style="padding-top: 20px;">
								<span class="fa fa-mobile"></span>&nbsp;&nbsp;
								Số điện thoại: {{$ctdh->sodienthoai}}
							</td>
							<td style="padding-top: 20px;">
								<span class="fa fa-home"></span>&nbsp;&nbsp;
								Địa chỉ: {{$ctdh->diachigiaohang}}.
							</td>
						</tr>
					</tbody>
				</table>


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
							->where('sp.manb', $_SESSION['manb'])
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
						    		//Kiểm tra sản phẩm có khuyến mãi không
							        $km = DB::table('khuyen_mai as km')
							        		->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							        		->where('ctkm.masp',$valsp->masp)
							        		->get();							        
							        if(count($km) != 0){
							        	$t = 0;
								        foreach ($km as $valkm) {
								        	if(strtotime($ctdh->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($ctdh->ngaydat) <= strtotime($valkm->ngaykt)){ 
								        	echo number_format($valsp->dongia-($valsp->dongia*0.01*$valkm->chietkhau),0,'.','.');
								        	$thanhtien += $valsp->soluongct*($valsp->dongia-($valsp->dongia*0.01*$valkm->chietkhau));
								        	break; 
								        	} else{
								        		$t +=1;
								        	}
								        }
								        if($t == count($km)){ 
								        	echo number_format($valsp->dongia,0,'.','.');
								        	$thanhtien += $valsp->soluongct*$valsp->dongia;
				        				}
								    }else{ 
								        echo number_format($valsp->dongia,0,'.','.');
								        $thanhtien += $valsp->soluongct*$valsp->dongia;
				        			}
						    	?>
						    </td>
						    <td class="tong-detailOrder text-right">
						    	<?php
						    		//Kiểm tra sản phẩm có khuyến mãi không
							        $km = DB::table('khuyen_mai as km')
							        		->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
							        		->where('ctkm.masp',$valsp->masp)
							        		->get();
							        if(count($km) != 0){
							        	$t = 0;
								        foreach ($km as $valkm) {
								        	if(strtotime($ctdh->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($ctdh->ngaydat) <= strtotime($valkm->ngaykt)){ 
								        	echo number_format($valsp->dongia-($valsp->dongia*0.01*$valkm->chietkhau)*$valsp->soluongct,0,'.','.');
								        	break; 
								        	} else{
								        		$t +=1;
								        	}
								        }
								        if($t == count($km)){ 
								        	echo number_format($valsp->dongia*$valsp->soluongct,0,'.','.');
				        				}
								    }else{ 
								        echo number_format($valsp->dongia*$valsp->soluongct,0,'.','.');
				        			}
						    	?>
						    </td>
						</tr>
					<?php }
				  ?>
				</table>
				
				<hr>
				<table width="100%">
					<tbody>
						<tr>
							<td style="width: 80%" align="right">
								Phí vận chuyển:
							</td>
							<td align="right">
								<?php
								    if($thanhtien >= 300000){
								    	echo 'Miễn phí';
									}
									else{
										echo number_format($ctdh->tongtien-$thanhtien,0,'.','.');
									}
								?>
							</td>
						</tr>
						<tr>
							<td style="width: 80%; padding-top: 15px; font-weight: bold; font-size: 16px;" align="right">Tổng tiền:</td>
							<td align="right" style="color: red; font-size: 16px; padding-top: 15px;">
								<?php
								   echo '<b>'.number_format($ctdh->tongtien,0,'.','.');
								?>
							</td>
						</tr>
					</tbody>
				</table>
	</div>
				<div class="detailOrderRow2">
					<div class="text-right submit-detailOrder">
						<button id="btnPrint" type="button" class="btn btn-info btn-lg" style="width: 200px;"><span class="fa fa-print"></span>&nbsp;&nbsp;In đơn hàng</button>
						<a href="{{asset('nguoiban/donhang')}}" type="button" class="btn btn-primary btn-lg">Quay lại</a>	
					</div>
				</div>

				
			</div>



@stop