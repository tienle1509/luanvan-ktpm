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
						<a href="{{asset('chitiet-danhmuc')}}">Apple</a>
						<a href="{{asset('chitiet-danhmuc')}}">Samsung</a>
						<a href="{{asset('chitiet-danhmuc')}}">Nokia</a>				
						<a href="{{asset('chitiet-danhmuc')}}">Oppo</a>
						<a href="{{asset('chitiet-danhmuc')}}">Sony</a>
						<a href="{{asset('chitiet-danhmuc')}}">HTC</a>
						<a href="{{asset('chitiet-danhmuc')}}">LG</a>								
						<a href="{{asset('chitiet-danhmuc')}}">Asus</a>
						<a href="{{asset('chitiet-danhmuc')}}">Masstel</a>				
						<a href="{{asset('chitiet-danhmuc')}}">Motorola</a>
						<a href="{{asset('chitiet-danhmuc')}}">Xiaomi</a>
						<a href="{{asset('chitiet-danhmuc')}}">MobiiStar</a>
						<a href="{{asset('chitiet-danhmuc')}}">Wiko</a>
						<a href="{{asset('chitiet-danhmuc')}}">Lenovo</a>
						<a href="{{asset('chitiet-danhmuc')}}">BlackBery</a>
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
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<div class="item active">
								<a href=""><img src="{{asset('public/anh-khuyenmai/2.jpg')}}" alt="slide1"></a>
							</div>

							<div class="item">
								<a href=""><img src="{{asset('public/anh-khuyenmai/note8.jpg')}}" alt="slide2"></a>
							</div>

							<div class="item">
								<a href=""><img src="{{asset('public/anh-khuyenmai/mia1.png')}}" alt="slide3"></a>
							</div>

							<div class="item">
								<a href=""><img src="{{asset('public/anh-khuyenmai/sony.png')}}" alt="slide3"></a>
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
						<a href=""><img src="{{asset('public/img/banner1.jpg')}}" alt="banner1"></a>
						<a href=""><img src="{{asset('public/img/banner2.jpg')}}" alt="banner1"></a>
						<a href=""><img src="{{asset('public/img/banner3.jpg')}}" alt="banner1"></a>
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
								      			<a data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
								      				<span class="fa fa-tag">1</span>
								      			</a>
								      			<a data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
								      				<span class="fa fa-eye">5</span>
								      			</a>
								      			<a data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
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
		</div> <!-- Panel sản phẩm mới nổi bật -->



		<!-- Panel sản phẩm giảm giá -->
		<div class="container">
			<div class="row panel-product">
				<div class="panel-title col-md-12 col-sm-12">
					<h4>Sản phẩm giảm giá</h4>
				</div>
				<div class="panel-img col-md-2 col-sm-2">
					<div class="row">
						<a href="khuyenmai.php">
							<img src="{{asset('public/anh-khuyenmai/giamgia.jpg')}}">
						</a>
					</div>
				</div>
				<div class="panel-slider col-md-10 col-sm-10">
					<div class="row">
						<!-- Slick slider -->
				    	<div class="slider slider-pricePro">
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
		</div> <!-- Panel sản phẩm giảm giá -->



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
					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>

					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>

					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>


					<div class="list-pro">
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
										<a href="chitietsanpham.php">ĐIỆN THOẠI IPHONE 4S-16GB CHÍNH HÃNG</a>
									</div>
									<div class="luotvote">
										<a href="#" data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a href="#" data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
										    <span class="fa fa-comment">0</span>
										</a>
									</div>
		  							<div class="ten-shop row">ANHDUY</div>
								</div>
							</div>
						</a>
					</div>
				</div> <!-- panel list -->
			</div>
		</div> <!-- end sản phẩm đặc trưng-->
	</div> <!-- end body -->

	<script type="text/javascript">
		//Carousel
	    $('#myCarousel').carousel({
		  	interval: 3000,
		});
	</script>

@stop