@extends('khachhang_home')

@section('title-page')
	@if(isset($searchdm))
		{{$searchdm->tendanhmuc}}
	@else
		Tìm kiếm
	@endif
@stop

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
	    						duongdan = 'public/anh-sanpham/'+result.content[i]['options']['img'];
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
	<div class="body">
		<div class="duongdan">
			<div class="container">
				<div class="row">
					<ol class="breadcrumb">
					  <li><a href="home">TRANG CHỦ</a></li>
					  <li class="active">
					  	@if(isset($searchdm))
							{{mb_strtoupper($searchdm->tendanhmuc)}}
						@else
							CÁC SẢN PHẨM LIÊN QUAN ĐẾN {{mb_strtoupper($keynhap)}}
						@endif
					  </li>
					</ol>
				</div>
			</div>
		</div>

		@if(count($result_search) == 0)
			<div class="container" style="margin-top: 40px;">
				<div class="alert alert-warning" role="alert">
					Rất tiếc ! Chúng tôi không tìm thấy sản phẩm. Có thể do danh mục chưa phục vụ tại khu vực của bạn hoặc không có sản phẩm phù hợp với điều kiện lọc. Vui lòng thử điều kiện lọc mới hoặc dùng công cụ tìm kiếm.
				</div>
			</div>
		@else
		<div class="panel-category container">
			<div class="row title-panelCate">
				<div class="col-md-6 col-sm-6">
					<label>
						@if(isset($searchdm))
							{{$searchdm->tendanhmuc}}
						@else
							"{{mb_strtoupper($keynhap)}}"
						@endif
					</label>
					<label class="label-numPro"> | Tìm thấy {{count($result_search)}} sản phẩm</label>
				</div>
			</div>

			<div class="row panel-product">
				<div class="panel-list col-md-12 col-sm-12">
					@foreach($result_search as $val)
						<?php
						$dskm = DB::table('khuyen_mai as km')
		                            ->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                            ->where('ctkm.masp', $val->masp)
		                            ->get(); ?>
						<div class="list-pro">
								<a id="sanpham" href="{{asset('chitiet-sanpham/'.$val->masp)}}">
								<div class="thumbnail">
									<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
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
															<label class="giakm">'.number_format($val->dongia-($val->dongia*0.01*$valkm->chietkhau),0,'.','.').' đ
															</label>
															<del class="giagoc">'.number_format($val->dongia,0,'.','.').' đ
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
										      				{{number_format($val->dongia,0,'.','.')}} đ
										      			</label>
										      		</div>
								        		<?php }
												} else { ?>
													<div class="gia">
														<label class="giakm">
															{{number_format($val->dongia,0,'.','.')}} đ
														</label>
													</div>
												<?php }
											?>							
											<div class="tendt">
												<a href="{{asset('chitiet-sanpham/'.$val->masp)}}">{{$val->tensp}}</a>
											</div>
											<div class="luotvote row">
												<?php
													$luotmua = DB::table('chitiet_donhang')->where('masp',$val->masp)->sum('soluongct');
												?>
												@if($luotmua != 0)
													<a data-toggle="tooltip" title="Đã có <b>{{$luotmua}}</b> lượt mua" data-html="true" data-placement="top">
													<span class="fa fa-tag"> {{$luotmua}}</span>
													</a>
												@endif
											<form action="{{action('GioHangController@getMuaHang')}}" method="get">
												<button id="{{$val->masp}}" type="button" class="pull-right btnMuaNgay">Mua ngay</button>
											</form>
											</div>
					  						<div class="ten-shop row">
					  							<?php
									  				$nguoiban = DB::table('nguoi_ban')->where('manb',$val->manb)->first();
									  					echo $nguoiban->tengianhang;
									  				?>
					  						</div>
										</div>
									</div>
								</a>
							</div>
					@endforeach
				</div> <!-- panel list -->
			</div>
		</div>
		@endif
	</div>


@stop