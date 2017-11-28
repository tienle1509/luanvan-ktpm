@extends('khachhang_home')

@section('title-page','Mobile Store')

@section('noidung')

	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-home.css')}}">


	<script>
	    
	    /* Slider fast pro */
	    $(document).ready(function(){
	    	$('.slider-fastPro').slick({
	    		slidesToShow: 5,
	    		slidesToScroll: 1,
	    		infinite: false
	    	});
	    });

	    /* Slider new pro, price pro */
	    $(document).ready(function(){
	    	$('.slider').slick({
	    		slidesToShow: 4,
	    		slidesToScroll: 1,
	    		infinite: false,
	    	});
	    });

	    

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



<!-- Nav bottom -->
	<div class="nav-bottom">
		<div class="container">
			<div class="row">
				<ul class="nav nav-pills">
					<li>
						<button type="button" class="btn-danhmuc">
							<span class="fa fa-navicon"></span>&nbsp;&nbsp;&nbsp;DANH MỤC SẢN PHẨM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="fa fa-angle-down"></span>
						</button>
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



	<!-- Body -->
	<div class="body">
		<!-- Danh mục và carousel khuyến mãi -->
		<div class="container">
			<div class="row">
				<!-- Danh mục -->
				<div class="col-md-3 col-sm-3 danhmuc">
					<div class="row">
						<?php
							$dmleft = DB::table('danhmuc_sanpham')->get();
						?>
						@foreach($dmleft as $val)
							<a href="{{asset('chitiet-danhmuc/'.$val->madm)}}">{{$val->tendanhmuc}}</a>
						@endforeach
					</div>
				</div>


				<!-- panel right -->
				<div class="col-md-9 col-sm-9">
					<!-- Carousel -->
					<div id="myCarousel" class="carousel slide row" data-rice="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators" style="z-index: 1">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
							<li data-target="#myCarousel" data-slide-to="3"></li>
							<li data-target="#myCarousel" data-slide-to="4"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<div class="item active">
								<img src="{{asset('public/img/panel1.jpg')}}" alt="slide1">
							</div>

							<div class="item">
								<img src="{{asset('public/img/panel2.jpg')}}" alt="slide2">
							</div>

							<div class="item">
								<img src="{{asset('public/img/panel3.png')}}" alt="slide3">
							</div>

							<div class="item">
								<img src="{{asset('public/img/panel4.png')}}" alt="slide4">
							</div>

							<div class="item">
								<img src="{{asset('public/img/panel5.png')}}" alt="slide5">
							</div>
						</div>

						<!-- Left and right controls -->
						<a href="#myCarousel" class="left carousel-control" data-slide="prev">
							<span class="fa fa-angle-left"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a href="#myCarousel" class="right carousel-control" data-slide="next">
							<span class="fa fa-angle-right"></span>
							<span class="sr-only">Next</span>
						</a>
					</div> <!-- end carousel -->

					<div class="row panel-ship ">
						<img src="{{asset('public/img/banner1.jpg')}}" alt="banner1">
						<img src="{{asset('public/img/banner2.jpg')}}" alt="banner1">
						<img src="{{asset('public/img/banner3.jpg')}}" alt="banner1">
					</div>
				</div> <!-- end panel right -->
			</div>
		</div><!-- end danh mục và carousel khuyến mãi -->

		
		<!-- Panel sản phẩm mới nổi bật -->
		<div class="container">
			<div class="row panel-product">
				<div class="panel-title col-md-12 col-sm-12">
					<h4>Mới & nổi bật</h4>
				</div>				
				<div class="col-md-12 col-sm-12">
					<div class="row">
						<!-- Slick slider -->
				    	<div class="slider-fastPro">
				    		<?php
				    			$sosp = 0;
				    			foreach ($list_sp as $val) {
				    				$sosp += 1;
				    				if($sosp == 11){
				    					break;
				    				}else{
				    					//Kiểm tra sản phẩm có khuyến mãi hay không
				    					$listKM = DB::table('khuyen_mai as km')
		                                   			->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                                   			->where('ctkm.masp', $val->masp)
		                                   			->get(); ?>
		                                <div>
										    <a id="sanpham" href="{{asset('chitiet-sanpham/'.$val->masp)}}">
									    	<div class="thumbnail">
										      	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
										      	<?php 
										      		if(count($listKM) != 0){
											      		foreach ($listKM as $valkm) {
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
										      		if(count($listKM) != 0){
										      			$t = 0;
											      		foreach ($listKM as $valkm) {
											      			if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd)) && (strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt))){ 
											      				echo '<div class="gia">
													      			<label class="giakm">'.number_format($val->dongia-($val->dongia*0.01*$valkm->chietkhau),0,'.','.').' đ
													      			</label>
													      			<del class="giagoc">'.number_format($val->dongia,0,'.','.').' đ</del>
														      		</div>';
											      				break;
											      			} else {
											      				$t +=1;
											      			}
											      		}
											      		if($t == count($listKM)){ ?>
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
									<?php }
									?>
								</div>
				   			<?php
				   			}
				   		?>
				    	</div><!-- Slick slider -->
					</div>
				</div>
			</div>
		</div> <!-- Panel sản phẩm mới nổi bật -->


		<!-- Các sản phẩm đặc trưng -->
		<div class="container">
			<div class="row panel-product">
				<div class="panel-list col-md-12 col-sm-12">
					<?php
						$sosp_dt = 0;
						foreach ($list_sp as $val) {
							$sosp_dt += 1;
							if($sosp_dt >= 11){
							//Kiểm tra sản phẩm có khuyến mãi hay không
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
						<?php }
						}
					?>		
					
				</div> <!-- panel list -->
			</div>
		</div> <!-- end sản phẩm đặc trưng-->
	</div> <!-- end body -->

	<script type="text/javascript">
		//Carousel
	    $('#myCarousel').carousel({
		  	interval: 2500,
		});
	</script>

@stop