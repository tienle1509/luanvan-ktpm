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
					  <li><a href="home">TRANG CHỦ</a></li>
					  <li class="active">
					  	@if(isset($searchdm))
							{{strtoupper($searchdm->tendanhmuc)}}
						@else
							CÁC SẢN PHẨM LIÊN QUAN ĐẾN {{strtoupper($keynhap)}}
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
							"{{strtoupper($keynhap)}}"
						@endif
					</label>
					<label class="label-numPro"> | Tìm thấy {{count($result_search)}} sản phẩm</label>
				</div>
			<!--	<div class="col-md-6 col-sm-6 text-right">
					<select id="selectSapXep" name="sapXep">
						<option value="">-- Sắp xếp theo --</option>
						<option value="1">Giá giảm dần</option>
						<option value="2">Giá tăng dần</option>
					</select>
				</div>  -->
			</div>

			<div class="row panel-product">
				<div class="panel-list col-md-12 col-sm-12">
					@foreach($result_search as $val)
							<div class="list-pro">
								<a id="sanpham" href="{{asset('chitiet-sanpham/'.$val->masp)}}">
									<div class="thumbnail">
										<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
										<?php
											$today = date('d'); //lấy ngày hiện tại
		                                    $month_cur = date('m'); //lấy tháng hiện tại
		                                    $year = date('Y'); //lấy năm hiện tại

		                                    $km = DB::table('khuyen_mai as km')
		                                        	->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                                        	->where('ctkm.masp',$val->masp)
		                                        	->first();
		                                    if(count($km) != 0){
		                                        if((strtotime($ngayht) > strtotime($km->ngaybd)) && (strtotime($ngayht)) < strtotime($km->ngaykt)){
		                                        	?>
		                                        		<div class="chietkhau">
		                                        			{{$km->chietkhau}}%
		                                        		</div>

		                                        <?php	}
		                                    }                                   
										?>										
										<div class="caption">
											<?php
												$today = date('d'); //lấy ngày hiện tại
			                                    $month_cur = date('m'); //lấy tháng hiện tại
			                                    $year = date('Y'); //lấy năm hiện tại

			                                    $km = DB::table('khuyen_mai as km')
			                                        	->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
			                                        	->where('ctkm.masp',$val->masp)
			                                        	->first();
			                                    if(count($km) != 0){
			                                        if((strtotime($ngayht) > strtotime($km->ngaybd)) && (strtotime($ngayht)) < strtotime($km->ngaykt)){
			                                        	?>
			                                        		<div class="gia">
																<label class="giakm">
																	{{number_format($val->dongia-($val->dongia*0.01*$km->chietkhau),0,'.','.')}} đ
																</label>
																<del class="giagoc">{{number_format($val->dongia,0,'.','.')}} đ</del>
															</div>
			                                        		
			                                        <?php	}
			                                        } else { ?>
			                                        	<div class="gia">
															<label class="giakm">{{number_format($val->dongia,0,".",'.')}} đ</label>
														</div>
			                                      <?php  }                                   
											?>		
											
											<div class="tendt">
												<a href="{{asset('chitiet-sanpham/'.$val->masp)}}">{{$val->tensp}}</a>
											</div>
											<div class="luotvote">										<?php
													$luotmua = DB::table('chitiet_donhang')->where('masp',$val->masp)->count('soluong');
												?>
												@if($luotmua != 0)
													<a data-toggle="tooltip" title="Đã có <b>{{$luotmua}}</b> lượt mua" data-html="true" data-placement="top">
													    <span class="fa fa-tag">{{$luotmua}}</span>
													</a>
												@endif
												<button type="button" class="pull-right" data-toggle="modal" data-target="#modalCart" data-backdrop="static">Mua ngay</button>
											<!--	<a data-toggle="tooltip" title="Đã có <b>5</b> lượt xem" data-html="true" data-placement="top">
												    <span class="fa fa-eye">5</span>
												</a>
												<a data-toggle="tooltip" title="Đã có <b>0</b> bình luận" data-html="true" data-placement="top">
												    <span class="fa fa-comment">0</span>
												</a> -->
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