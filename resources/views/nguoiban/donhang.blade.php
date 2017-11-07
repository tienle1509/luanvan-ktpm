@extends('nguoiban_home')

@section('donhang','active')

@section('noidung')
<div class="container-fluid">
				<h1>Đơn hàng</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/donhang')}}">Đơn hàng</a></li>
						  <li class="active">@yield('title')</li>
						</ol>
					</div>
				</div>


				<!-- Panel -->
				<div class="row">
					<!-- Tất cả đơn hàng -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-green">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/icondonhang.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">
							  			<?php
							  				$tatca_dh = DB::table('don_hang as dh')
							  							->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
							  							->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							  							->where('dh.trangthai',1)
							  							->where('sp.manb',$_SESSION['manb'])
							  							->distinct()
							  							->count('dh.madh');
							  				echo $tatca_dh;
							  			?>
							  		</div>
							  		Tất cả <br> Đơn hàng
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/tatca-donhang')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end tất cả đơn hàng -->	

					<!-- Đơn hàng trong ngày -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-red1">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/donhangtrongngay.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">
							  		<?php
							  			$today = date('d'); //lấy ngày hiện tại
                                        $month = date('m'); //lấy tháng hiện tại
                                        $year = date('Y'); //lấy năm hiện tại

                                        $count_trongngay = 0;
                                        $donhang = DB::table('don_hang as dh')
                                        			->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
                                        			->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
                                        			->where('dh.trangthai',1)
                                        			->where('sp.manb', $_SESSION['manb'])
                                        			->select('dh.ngaydat')
                                        			->distinct()
                                        			->get();
                                        foreach ($donhang as $val) {
                                        	if(date('d',strtotime($val->ngaydat)) == $today && date('m',strtotime($val->ngaydat)) == $month && date('Y',strtotime($val->ngaydat)) == $year){
                                        		$count_trongngay +=1;
                                        	}
                                        }
                                        echo $count_trongngay;
                                    ?>
							  		</div>
							  		Đơn hàng<br> Trong ngày
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-trongngay')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end đơn hàng trong ngày -->					

					<!-- Đơn hàng đang xử lí -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-orange">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/icondangxuli.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">
							  			<?php
							  				$donhang_xl = DB::table('don_hang as dh')
							  								->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
							  								->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							  								->where('dh.trangthai',1)
							  								->where('dh.mattdh',1)
							  								->where('sp.manb',$_SESSION['manb'])
							  								->distinct()
							  								->count('dh.madh');
							  				echo $donhang_xl;
							  			?>
							  		</div>
							  		Đơn hàng <br> Đang xử lí
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-dangxuli')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end đơn hàng đang xử lí -->


					<!-- Đơn hàng đang giao đi -->
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-blue">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/icondanggiao.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">
							  			<?php
							  				$donhang_danggiao = DB::table('don_hang as dh')
							  								->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
							  								->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							  								->where('dh.trangthai',1)
							  								->where('dh.mattdh',2)
							  								->where('sp.manb',$_SESSION['manb'])
							  								->distinct()
							  								->count('dh.madh');
							  				echo $donhang_danggiao;
							  			?>
							  		</div>
							  		Đơn hàng<br> Đang giao đi
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-danggiaodi')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div>
					 <!-- end đơn hàng đang giao đi-->


					<!-- Đơn hàng giao hàng thất bại -->					
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-red">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/iconhuydonhang.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">
							  			<?php
							  				$donhang_thatbai = DB::table('don_hang as dh')
							  								->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
							  								->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							  								->where('dh.trangthai',1)
							  								->where('dh.mattdh',3)
							  								->where('sp.manb',$_SESSION['manb'])
							  								->distinct()
							  								->count('dh.madh');
							  				echo $donhang_thatbai;
							  			?>
							  		</div>
							  		Giao hàng <br> Thất bại
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-thatbai')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end Đơn hàng giao hàng thất bại -->

					<!-- Đã giao hàng -->					
					<div class="col-md-2 col-sm-2">
						<div class="panel panel-violet">
						  <div class="panel-heading">
						  	<div class="row">
							  	<div class="col-md-3 col-sm-3">
							  		<img src="{{asset('public/img/iconhoanthanh.png')}}">
							  	</div>
							  	<div class="col-md-9 col-sm-9 text-right">
							  		<div class="huge">
							  			<?php
							  				$donhang_thanhcong = DB::table('don_hang as dh')
							  								->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
							  								->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
							  								->where('dh.trangthai',1)
							  								->where('dh.mattdh',4)
							  								->where('sp.manb',$_SESSION['manb'])
							  								->distinct()
							  								->count('dh.madh');
							  				echo $donhang_thanhcong;
							  			?>
							  		</div>
							  		Đơn hàng<br> Đã giao
							  	</div>
							  	<div class="clearfix"></div>
							</div>
						  </div>
						  <a href="{{asset('nguoiban/donhang/donhang-dagiao')}}">
							  <div class="panel-footer">
							   	<span class="pull-left">
							   		Chi tiết
							   	</span>
							   	<span class="pull-right">
							   		<i class="fa fa-arrow-circle-right"></i>
							   	</span>
							   	<div class="clearfix"></div>
							  </div>
						  </a>
						</div>
					</div> <!-- end đã giao hàng -->				
				</div> <!--end panel -->


				@yield('chitiet')

				
			</div>


@stop