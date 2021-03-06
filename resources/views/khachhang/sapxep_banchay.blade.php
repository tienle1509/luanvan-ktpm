@extends('khachhang_home')

@section('title-page', 'Sản phẩm bán chạy')


@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-chitiet-danhmuc.css')}}">

<script type="text/javascript">
	//Bấm mua ngay thêm sản phẩm vào giỏ hàng
	    $(document).ready(function(){
	    	$('.btnMuaNgay').click(function(){
	    		var url = "http://localhost/luanvan-ktpm/muahang";
	    		var sl = 1;
	    		var masp = $(this).attr("id");

	    		$.ajax({
	    			url : url,
	    			type : "GET",
	    			dataType : "JSON",
	    			data : {"masp":masp, "sl":sl},
	    			success : function(result){
	    				if(!result.success){
	    					var loi_soluong = '';
	    					$.each(result.errors, function(key, item){
	    						loi_soluong += item;
	    					});
	    					$.notify({
								// options
								message: loi_soluong
							},{
								// settings
								element: 'body',
								position: null,
								type: "danger",
								allow_dismiss: true,
								placement: {
									from: "top",
									align: "right"
								},
								offset: 80,
								spacing: 10,
								z_index: 1031,
								delay: 1000,
								timer: 800,
							});
	    				}else{
	    					$('#numCart').html(result.soluong);
	    					$('#btnCart').html(result.soluong);
	    					var box = '';
	    					var duongdan = '';
	    					var ten = '';
	    					var gia = '';
	    					var soluong = '';
	    					var tongtien = '';
	    					var ndGioHang = '';
	    					var rowid = '';
	    					var masp = '';

	    					for (var i in result.content) {
	    						//console.log(result.content[i]);
	    						masp = result.content[i]['id'];
	    						rowid = result.content[i]['rowid'];
	    						duongdan = './public/anh-sanpham/'+result.content[i]['options']['img'];
	    						ten = result.content[i]['name'];
	    						gia = result.content[i]['price'];
	    						soluong = result.content[i]['qty']
	    						tongtien = result.tongtien;

box += '<div class="row detail-cart"><div class="col-md-6"><img id="imageProduct" src="'+ duongdan +'" alt="imageProduct"><div class="ten-sp"><label>'+ ten +'</label><div class="xoasp-cart"><button class="XoaSP" id="'+ rowid +'"><span class="fa fa-trash-o"></span>&nbsp;Bỏ sản phẩm</button></div></div></div><div class="col-md-2 gia-cart"><label>'+ gia.toLocaleString('de-DE') +' đ</label></div><div class="col-md-2 sl-cart" id="'+ masp +'"><input type="number" id="'+ rowid +'" class="inputSL" min="1" max="100" value="'+ soluong +'"></div><div class="col-md-2 tong-cart"><label>'+ (gia*soluong).toLocaleString('de-DE') +' đ</label></div></div>';




	    					}

ndGioHang = '<div class="modal-header"><button type="button" class="close1" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h5 class="modal-title"><span class="fa fa-shopping-cart"></span>&nbsp;<b style="font-size: 14px; text-align: center; color: blue">GIỎ HÀNG </b>( <b style="color: #DA0000" id="numCart">'+ result.soluong +'</b> sản phẩm )</h5></div><div id="erroCart" class="alert alert-danger hide" style="margin:15px;"></div><div class="modal-body"><div class="container-fluid list-cart"><div class="title-cart"><div class="row"><div class="col-md-6">Sản phẩm</div><div class="col-md-2" style="text-align: center;">Giá thành</div><div class="col-md-2" style="text-align: center;">Số lượng</div><div class="col-md-2">Thành tiền</div></div></div><div class="box-scroll">'+ box +'</div></div></div><div class="modal-footer"><label class="label-thanhtien">Thành tiền:</label><label class="label-tong">'+ tongtien.toLocaleString('de-DE') +' VND</label><div class="label-vat">(Đã bao gồm VAT)</div><div class="footer-cart"><a class="tieptuc-cart" data-dismiss="modal" class="btn" type="button" style="cursor: pointer;"><span class="fa fa-long-arrow-left">&nbsp;&nbsp;Tiếp tục mua hàng</span></a><form action="{{url("nhap-thongtin-donhang")}}" method="get"><button class="thanhtoan-cart btn btn-danger" type="submit">TIẾN HÀNH THANH TOÁN</button></form></div></div>';
							
							$('#ndGioHang').html(ndGioHang);
	    					
	    				}
	    			}
	    		});
	    	});
	    });


	    //Sắp xếp sản phẩm theo giá
	    $(document).ready(function(){
	    	$('.cbxSapXep').change(function(){
	    		var url = "http://localhost/luanvan-ktpm/sapxep-banchay";
	    		var sapxep = $(this).val();

	    		$.ajax({
	    			url : url,
	    			type : "GET",
	    			dataType : "JSON",
	    			data : {"sapxep":sapxep},
	    			success : function(result){
	    				if(!result.success){
	    					var loi_sapxep = '';
	    					$.each(result.errors, function(key,item){
	    						loi_sapxep += item;
	    					});
	    					$.notify({
								// options
								title: 'Lỗi : ',
								message: loi_sapxep
							},{
								// settings
								element: 'body',
								position: null,
								type: "danger",
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
	    				}else{
	    					window.location = "http://localhost/luanvan-ktpm/kq-sapxep-banchay";
	    				}	
	    			}
	    		});
	    	});
	    });

</script>



<!-- Nav bottom-->
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
	<div class="body">
		<div class="duongdan">
			<div class="container">
				<div class="row">
					<ol class="breadcrumb">
					  <li><a href="{{asset('home')}}">TRANG CHỦ</a></li>
					  <li class="active">SẢN PHẨM BÁN CHẠY</li>
					</ol>
				</div>
			</div>
		</div>

		<?php 
			//Lấy ra danh sách sản phẩm bán chạy
			$sp_banchay = DB::table('san_pham as sp')->select('sp.masp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							 ->where('sp.soluong', '>', 0)
							->where('sp.trangthai',1)
							->get();

			$mang_masp = array(); 
				foreach ($sp_banchay as $val) {
					$sl_ma = DB::table('chitiet_donhang')->where('masp',$val->masp)->sum('soluongct');
					$mang_masp[$val->masp] = $sl_ma;
				}
			//Sắp xếp sản phẩm bán chạy
			arsort($mang_masp);

			$mang_ma = array();
			$i = 0;
			foreach ($mang_masp as $masp => $luotban) {
				$i += 1;
				if($i > 30){
					break;
				}
				$mang_ma[] = $masp;
			}

			if($_SESSION['sapxep_banchay'] == 1){
				$sapxep_gia = DB::table('san_pham as sp')->select('sp.masp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							 ->where('sp.soluong', '>', 0)
							->where('sp.trangthai',1)
							->orderBy('dongia','desc')
							->get();
				$kq_sapxep = array();
				foreach ($sapxep_gia as $val) {
					if(in_array($val->masp, $mang_ma)){
						$kq_sapxep[] = $val->masp;
					}
				}				
			}else{
				$sapxep_gia = DB::table('san_pham as sp')->select('sp.masp')
							->join('danhmuc_sanpham as dm', 'dm.madm', '=', 'sp.madm')
							 ->where('sp.soluong', '>', 0)
							->where('sp.trangthai',1)
							->orderBy('dongia','asc')
							->get();
				$kq_sapxep = array();
				foreach ($sapxep_gia as $val) {
					if(in_array($val->masp, $mang_ma)){
						$kq_sapxep[] = $val->masp;
					}
				}
			}


		?>


		<div class="panel-category container">
				<div class="row title-panelCate">
					<div class="col-md-6 col-sm-6">
						<label class="label-numPro"> TOP 30 SẢN PHẨM BÁN CHẠY</label>
					</div>
					<div class="col-md-6 col-sm-6 text-right">
						<?php
							if($_SESSION['sapxep_banchay'] == 1){ ?>
								<select class="cbxSapXep">
									<option value="">-- Sắp xếp theo --</option>
									<option value="1" selected="">Giá giảm dần</option>
									<option value="2">Giá tăng dần</option>
								</select>
							<?php }
							if($_SESSION['sapxep_banchay'] == 2){ ?>
								<select class="cbxSapXep">
									<option value="">-- Sắp xếp theo --</option>
									<option value="1">Giá giảm dần</option>
									<option value="2" selected="">Giá tăng dần</option>
								</select>
							<?php }
						?>			
					</div>
				</div>

				<div class="row panel-product">
					<div class="panel-list col-md-12 col-sm-12">
						<?php
							foreach ($kq_sapxep as $masp) {
								$sp = DB::table('san_pham')->where('masp',$masp)->first();

								$dskm = DB::table('khuyen_mai as km')
			                                ->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
			                                ->where('ctkm.masp', $masp)
			                                ->get(); ?>
		                        <div class="list-pro">
									<a id="sanpham" href="{{asset('chitiet-sanpham/'.$sp->masp)}}">
									<div class="thumbnail">
										<img src="{{asset('public/anh-sanpham/'.$sp->anh)}}">
											<?php
												if(count($dskm) != 0){
													foreach ($dskm as $valkm) {
														if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd)) && (strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt))){ ?>
															<div class="chietkhau">
																{{$valkm->chietkhau}}%
															</div>
														<?php }
													}
												} 
											?>
											<div class="caption">
											<?php
												if(count($dskm) != 0){
													$t = 0;
													foreach ($dskm as $valkm) {
														if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd)) && (strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt))){ 
															echo '<div class="gia">
																<label class="giakm">'.number_format($sp->dongia-($sp->dongia*0.01*$valkm->chietkhau),0,'.','.').' đ
																</label>
																<del class="giagoc">'.number_format($sp->dongia,0,'.','.').' đ
																</del>
															</div>';
															break; 
														} else {
															$t +=1;
														}
													}
													if($t == count($dskm)){ ?>
									        			<div class="gia">
											      			<label class="giakm">
											      				{{number_format($sp->dongia,0,'.','.')}} đ
											      			</label>
											      		</div>
									        		<?php }
													} else { ?>
														<div class="gia">
															<label class="giakm">
																{{number_format($sp->dongia,0,'.','.')}} đ
															</label>
														</div>
													<?php }
												?>							
												<div class="tendt">
													<a href="{{asset('chitiet-sanpham/'.$sp->masp)}}">{{$sp->tensp}}</a>
												</div>
												<div class="luotvote row">
													<?php
														$luotmua = DB::table('chitiet_donhang')->where('masp',$sp->masp)->sum('soluongct');
													?>
													@if($luotmua != 0)
														<a data-toggle="tooltip" title="Đã có <b>{{$luotmua}}</b> lượt mua" data-html="true" data-placement="top">
														<span class="fa fa-tag"> {{$luotmua}}</span>
														</a>
													@endif
												<form action="{{action('GioHangController@getMuaHang')}}" method="get">
													<button id="{{$sp->masp}}" type="button" class="pull-right btnMuaNgay">Mua ngay</button>
												</form>
												</div>
						  						<div class="ten-shop row">
						  							<?php
										  				$nguoiban = DB::table('nguoi_ban')->where('manb',$sp->manb)->first();
										  					echo $nguoiban->tengianhang;
										  				?>
						  						</div>
											</div>
										</div>
									</a>
								</div>
							<?php }
						?>	
					</div> <!-- panel list -->
				</div>
		</div>
	</div>


@stop