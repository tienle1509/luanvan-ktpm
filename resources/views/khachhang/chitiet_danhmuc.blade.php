@extends('khachhang_home')

@section('title-page','TÊN SẢN PHẨM ĐƯỢC CHỌN')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-chitiet-danhmuc.css')}}">






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
	<div class="clearfix"></div>



	<!-- Body -->
	<div class="body">
		<div class="duongdan">
			<div class="container">
				<div class="row">
					<ol class="breadcrumb">
					  <li><a href="trangchu.php">TRANG CHỦ</a></li>
					  <li class="active">IPHONE 6</li>
					</ol>
				</div>
			</div>
		</div>


		<div class="panel-category container">
			<div class="row title-panelCate">
				<div class="col-md-6 col-sm-6">
					<label>Samsung </label>
					<label class="label-numPro"> | Tìm thấy 90 sản phẩm</label>
				</div>
				<div class="col-md-6 col-sm-6 text-right">
					<select>
						<option value="">-- Sắp xếp theo --</option>
						<option value="1">Giá giảm dần</option>
						<option value="2">Giá tăng dần</option>
					</select>
				</div>
			</div>

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
										<a data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
										    <span class="fa fa-tag">1</span>
										</a>
										<a data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
										    <span class="fa fa-eye">5</span>
										</a>
										<a data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
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
										<a data-toggle="tooltip" title="Đã có <b>1</b> lượt mua" data-html="true" data-placement="top">
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
		</div>
	</div>


@stop