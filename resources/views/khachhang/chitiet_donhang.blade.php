@extends('khachhang_home')

@section('title-page')
	Đơn hàng {{$madh}}
@stop

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-qltaikhoan.css')}}">

<?php
	if(!isset($_SESSION['makh'])){
		header("Location: http://localhost/luanvan-ktpm/home");	
		exit;
	}else{
		$kh = DB::table('khach_hang')->where('makh', $_SESSION['makh'])->first();
		$ctdh = DB::table('don_hang')
				->where('madh',$madh)
				->first();
	}
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
						<a class="nav-bottom-km" href="{{asset('khuyenmai')}}">
						<span class="fa fa-gift"></span>&nbsp;&nbsp;&nbsp;KHUYẾN MÃI
						</a>
					</li>
					<li><a class="nav-bottom-banchay" href="{{asset('sanpham-banchay')}}"><span class="fa fa-tags"></span>&nbsp;&nbsp;&nbsp;BÁN CHẠY</a></li>	
				</ul>
			</div>
		</div>
</div>
	<div class="clearfix"></div>


	<!-- Body -->
	<div class="container">	
		<div class="col-md-3 panel-left">
			<h3><b>{{$kh->tennguoidung}}</b></h3>
			<a href="{{asset('quanli-taikhoan')}}">Quản lí tài khoản</a>
			<br>
			<a href="{{asset('quanli-donhang')}}">Quản lí đơn hàng</a>
		</div>	
		<div class="col-md-9 panel-donhang">
			<h4>Đơn hàng {{$madh}}</h4>
			<div class="panel-chitietdonhang"> 
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
			</div>
		</div>
		

		
	</div>


	


@stop