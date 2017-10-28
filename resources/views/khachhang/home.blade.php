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
					<li><a class="nav-bottom-hangmoi" href="#"><span class="fa fa-tag"></span>&nbsp;&nbsp;&nbsp;HÀNG MỚI</a></li>	
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
					<div id="myCarousel" class="carousel slide row" data-rice="carousel" >
						<!-- Indicators -->
						<ol class="carousel-indicators">
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
				    			for ($i=0; $i <10 ; $i++) { 
				    				foreach ($list_sp as $val) {
				    					if($val->masp == $ma_giam[$i]){
				    						//Kiểm tra sản phẩm có khuyến mãi hay không
				    						$today = date('d'); //lấy ngày hiện tại
		                                    $month_cur = date('m'); //lấy tháng hiện tại
		                                    $year = date('Y'); //lấy năm hiện tại

		                                    $listKM = DB::table('khuyen_mai as km')
		                                    			->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                                    			->where('ctkm.masp', $val->masp)
		                                    			->first(); ?>

		                                    <div>
											    <a id="sanpham" href="{{asset('chitiet-sanpham/'.$val->masp)}}">
											    	<div class="thumbnail">
												      	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
												      	@if(count($listKM) != 0)
												      		@if((strtotime($ngayht) > strtotime($listKM->ngaybd)) && (strtotime($ngayht) < strtotime($listKM->ngaykt)))
												      			<div class="chietkhau">
												      				{{$listKM->chietkhau}}%
												      			</div>
												      		@endif
												      	@endif
												      	<div class="caption">
												      		@if(count($listKM) != 0)
													      		@if((strtotime($ngayht) > strtotime($listKM->ngaybd)) && (strtotime($ngayht) < strtotime($listKM->ngaykt)))
													      			<div class="gia">
														      			<label class="giakm">{{number_format($val->dongia-($val->dongia*0.01*$listKM->chietkhau),0,'.','.')}} đ
														      			</label>
														      			<del class="giagoc">{{number_format($val->dongia,0,'.','.')}} đ</del>
														      		</div>
													      		@endif
													      	@else
													      		<div class="gia">
													      			<label class="giakm">
													      				{{number_format($val->dongia,0,'.','.')}} đ
													      			</label>
													      		</div>
													      	@endif									
													      	<div class="tendt">
												      			<a href="{{asset('chitiet-sanpham/'.$val->masp)}}">{{$val->tensp}}</a>
												      		</div>
												      		<div class="luotvote row">
												      			<?php
																	$luotmua = DB::table('chitiet_donhang')->where('masp',$val->masp)->count('soluong');
																?>
												      			@if($luotmua != 0)
																	<a data-toggle="tooltip" title="Đã có <b>{{$luotmua}}</b> lượt mua" data-html="true" data-placement="top">
																	    <span class="fa fa-tag"> {{$luotmua}}</span>
																	</a>
																@endif
												      		<!--	<a data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
												      				<span class="fa fa-eye">5</span>
												      			</a>
												      			<a data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
												      				<span class="fa fa-comment">0</span>
												      			</a>  -->
												      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
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
				    				unset($ma_giam[$i]);//Xóa mã sản phẩm
				    			}
				    		?>
				    	</div><!-- Slick slider -->
					</div>
				</div>
			</div>
		</div> <!-- Panel sản phẩm mới nổi bật -->


		<!-- Panel Sản phẩm bán chạy -->
		<div class="container">
			<div class="row panel-product">
				<div class="panel-title col-md-12 col-sm-12">
					<h4>Sản phẩm bán chạy</h4>
				</div>
				<div class="col-md-12 col-sm-12">
					<div class="row">
						<!-- Slick slider -->
				    	<div class="slider-fastPro">
				    		<div>
							     <a id="sanpham" href="detailpro.php">
							    	<div class="thumbnail">
								      	<img src="{{asset('public/anh-sanpham/iphone4s.jpg')}}">
								      	<div class="chietkhau">15%</div>
								      	<div class="caption">
								      		<div class="gia">
								      			<label class="giakm">1.700.000 đ</label>
								      			<del class="giagoc">2.500.000 đ</del>
								      		</div>
								      		<div class="tendt">
								      			<a href="detailpro.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
								      		</div>
								      		<div class="luotvote row">
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
								      				<span class="fa fa-comment">0</span>
								      			</a>
								      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
								      		</div>
  											<div class="ten-shop row">ANHDUY</div>
								      	</div>
								    </div>
							    </a>
							</div>
							

							<div>
							     <a id="sanpham" href="detailpro.php">
							    	<div class="thumbnail">
								      	<img src="{{asset('public/anh-sanpham/iphone4s.jpg')}}">
								      	<div class="chietkhau">15%</div>
								      	<div class="caption">
								      		<div class="gia">
								      			<label class="giakm">1.700.000 đ</label>
								      			<del class="giagoc">2.500.000 đ</del>
								      		</div>
								      		<div class="tendt">
								      			<a href="detailpro.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
								      		</div>
								      		<div class="luotvote row">
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
								      				<span class="fa fa-comment">0</span>
								      			</a>
								      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
								      		</div>
  											<div class="ten-shop row">ANHDUY</div>
								      	</div>
								    </div>
							    </a>
							</div>


							<div>
							     <a id="sanpham" href="detailpro.php">
							    	<div class="thumbnail">
								      	<img src="{{asset('public/anh-sanpham/iphone4s.jpg')}}">
								      	<div class="chietkhau">15%</div>
								      	<div class="caption">
								      		<div class="gia">
								      			<label class="giakm">1.700.000 đ</label>
								      			<del class="giagoc">2.500.000 đ</del>
								      		</div>
								      		<div class="tendt">
								      			<a href="detailpro.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
								      		</div>
								      		<div class="luotvote row">
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
								      				<span class="fa fa-comment">0</span>
								      			</a>
								      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
								      		</div>
  											<div class="ten-shop row">ANHDUY</div>
								      	</div>
								    </div>
							    </a>
							</div>


							<div>
							     <a id="sanpham" href="detailpro.php">
							    	<div class="thumbnail">
								      	<img src="{{asset('public/anh-sanpham/iphone4s.jpg')}}">
								      	<div class="chietkhau">15%</div>
								      	<div class="caption">
								      		<div class="gia">
								      			<label class="giakm">1.700.000 đ</label>
								      			<del class="giagoc">2.500.000 đ</del>
								      		</div>
								      		<div class="tendt">
								      			<a href="detailpro.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
								      		</div>
								      		<div class="luotvote row">
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
								      				<span class="fa fa-comment">0</span>
								      			</a>
								      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
								      		</div>
  											<div class="ten-shop row">ANHDUY</div>
								      	</div>
								    </div>
							    </a>
							</div>


							<div>
							     <a id="sanpham" href="detailpro.php">
							    	<div class="thumbnail">
								      	<img src="{{asset('public/anh-sanpham/iphone4s.jpg')}}">
								      	<div class="chietkhau">15%</div>
								      	<div class="caption">
								      		<div class="gia">
								      			<label class="giakm">1.700.000 đ</label>
								      			<del class="giagoc">2.500.000 đ</del>
								      		</div>
								      		<div class="tendt">
								      			<a href="detailpro.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
								      		</div>
								      		<div class="luotvote row">
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
								      				<span class="fa fa-comment">0</span>
								      			</a>
								      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
								      		</div>
  											<div class="ten-shop row">ANHDUY</div>
								      	</div>
								    </div>
							    </a>
							</div>


							<div>
							     <a id="sanpham" href="detailpro.php">
							    	<div class="thumbnail">
								      	<img src="{{asset('public/anh-sanpham/iphone4s.jpg')}}">
								      	<div class="chietkhau">15%</div>
								      	<div class="caption">
								      		<div class="gia">
								      			<label class="giakm">1.700.000 đ</label>
								      			<del class="giagoc">2.500.000 đ</del>
								      		</div>
								      		<div class="tendt">
								      			<a href="detailpro.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
								      		</div>
								      		<div class="luotvote row">
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
								      				<span class="fa fa-comment">0</span>
								      			</a>
								      			<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
								      		</div>
  											<div class="ten-shop row">ANHDUY</div>
								      	</div>
								    </div>
							    </a>
							</div>
				    	</div><!-- Slick slider -->
					</div>
				</div>
			</div>
		</div> <!-- Panel sản bán chạy-->


		<!-- Các sản phẩm đặc trưng -->
		<div class="container">
			<div class="row panel-product">
				<div class="panel-list col-md-12 col-sm-12">
					<?php
						foreach ($list_sp as $val) {
							if(in_array($val->masp, $ma_giam)){
								//Kiểm tra sản phẩm có khuyến mãi hay không
				    			$today = date('d'); //lấy ngày hiện tại
		                        $month_cur = date('m'); //lấy tháng hiện tại
		                        $year = date('Y'); //lấy năm hiện tại

		                        $dskm = DB::table('khuyen_mai as km')
		                                    ->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                                    ->where('ctkm.masp', $val->masp)
		                                    ->first(); ?>

		                        <div class="list-pro">
									<a id="sanpham" href="{{asset('chitiet-sanpham/'.$val->masp)}}">
									<div class="thumbnail">
										<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
										@if(count($dskm) != 0)
											@if((strtotime($ngayht) > strtotime($dskm->ngaybd)) && (strtotime($ngayht) < strtotime($dskm->ngaykt)))
												<div class="chietkhau">
													{{$dskm->chietkhau}}%
												</div>
											@endif
										@endif
										<div class="caption">
										@if(count($dskm) != 0)
											@if((strtotime($ngayht) > strtotime($dskm->ngaybd)) && (strtotime($ngayht) < strtotime($dskm->ngaykt)))
											<div class="gia">
												<label class="giakm">
													{{number_format($val->dongia-($val->dongia*0.01*$dskm->chietkhau),0,'.','.')}} đ
												</label>
												<del class="giagoc">
													{{number_format($val->dongia,0,'.','.')}} đ
												</del>
											</div>
											@endif
										@else
											<div class="gia">
												<label class="giakm">
													{{number_format($val->dongia,0,'.','.')}} đ
												</label>
											</div>
										@endif									
										<div class="tendt">
											<a href="{{asset('chitiet-sanpham/'.$val->masp)}}">{{$val->tensp}}</a>
										</div>
										<div class="luotvote row">
											<?php
												$luotmua = DB::table('chitiet_donhang')->where('masp',$val->masp)->count('soluong');
											?>
											@if($luotmua != 0)
												<a data-toggle="tooltip" title="Đã có <b>{{$luotmua}}</b> lượt mua" data-html="true" data-placement="top">
												<span class="fa fa-tag"> {{$luotmua}}</span>
												</a>
											@endif
											<!--	<a data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
												<span class="fa fa-eye">5</span>
											</a>
											<a data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
												<span class="fa fa-comment">0</span>
											</a>  -->
												<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static"">Mua ngay</button>
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