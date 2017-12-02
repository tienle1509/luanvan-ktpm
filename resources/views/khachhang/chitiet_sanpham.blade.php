@extends('khachhang_home')

@section('title-page')
	{{$chitietsp->tensp}}
@stop

@section('noidung')


	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-chitiet-sanpham.css')}}">
	


	<script language="javascript">	  
	    /* Show hide nội dung mô tả */
	    $(document).ready(function(){
	    	$('#showhiddenMota').click(function(){
	    		if(ndMota.style.overflow === "hidden" && ndMota.style.height ==="600px"){
		    		ndMota.style.overflow = "visible";
			    	ndMota.style.height = "auto";
			    	document.getElementById("showhiddenMota").innerHTML = "Thu gọn&nbsp;&nbsp;&nbsp;<span class='fa fa-angle-double-up'></span>";
			    }
			    else if(ndMota.style.overflow === "visible" && ndMota.style.height === "auto"){
			    	ndMota.style.overflow = "hidden";
		    		ndMota.style.height="600px";
		    		document.getElementById("showhiddenMota").innerHTML = "Xem thêm&nbsp;&nbsp;<span class='fa fa-angle-double-down'></span>";
			    }
	    	});	    	
	    });

	    /* Show collapse nhập đánh giá khi ấn button đánh giá*/
	    $(document).ready(function(){
	    	$('#btn-danhgia').click(function(){
	    		$('#panel-danhgia').collapse('show');
	    	});
	    });



	    //Bấm button thêm sản phẩm vào giỏ hàng
	    $(document).ready(function(){
	    	$('.btn-addCart').click(function(){
	    		var url = "http://localhost/luanvan-ktpm/muahang";
	    		var sl = $('input[name="soluong"]').val();
	    		var masp = $(this).attr('id');

	    		$.ajax({
	    			url : url,
	    			type : "GET",
	    			dataType : "JSON",
	    			data : {"masp":masp, "sl":sl},
	    			success : function(result){
	    				if(!result.success){
	    					var loi_soluong = '';
	    					$.each(result.errors, function(key,item){
	    						loi_soluong += item;
	    					});
	    					$('#error_soluong').removeClass('hide');
	    					$('#error_soluong').html(loi_soluong);
	    				}else{
	    					$('#error_soluong').addClass('hide');

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
	    						duongdan = '../public/anh-sanpham/'+result.content[i]['options']['img'];
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

	    //Lưu nhận xét đánh giá
	    $(document).ready(function(){
	    	$('.btnGuiNhanXet').click(function(){
	    		var url = "http://localhost/luanvan-ktpm/gui-nhanxet";
	    		var sosao = $('form[name="form-danhgia"]').find('input[name="txtSao"]').val();
	    		var tieude = $('form[name="form-danhgia"]').find('input[name="txtTieuDe"]').val();
	    		var mota = $('form[name="form-danhgia"]').find('textarea[name="txtMoTa"]').val();
	    		var _token = $('form[name="form-danhgia"]').find('input[name="_token"]').val();
	    		var masp = $(this).attr('id');

	    		$.ajax({
	    			url : url,
	    			type : "POST",
	    			dataType : "JSON",
	    			data : {"sosao":sosao, "tieude":tieude, "mota":mota, "_token":_token, "masp":masp},
	    			success : function(result){
	    				if(!result.success){
	    					var sosao = '';
	    					var tieude = '';
	    					var mota = '';
	    					$.each(result.errors,function(key,item){
	    						if(key == 'sosao'){
	    							sosao += item;
	    						}
	    						if(key == 'tieude'){
	    							tieude += item;
	    						}
	    						if(key == 'mota'){
	    							mota += item;
	    						}
	    					});	    					
	    					$('.txtSao').html(sosao);
	    					$('.txtTieuDe').html(tieude);
	    					$('.txtMoTa').html(mota);
	    				}else{	    					
	    					$.notify({
								// options
								icon: 'fa fa-check-circle',
								message: 'Nhận xét sản phẩm thành công'
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
								offset: 50,
								spacing: 30,
								z_index: 1031,
								delay: 5000,
								timer: 1000,
							});
							setTimeout("location.reload(true);", 2000);
	    				}
	    			}
	    		});
	    	});
	    });


    </script>


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
					  <li>
					  	<a href="{{asset('chitiet-danhmuc/'.$chitietsp->madm)}}">
					  		{{mb_strtoupper($chitietsp->tendanhmuc)}}
					  	</a>
					  </li>
					<!--  <li class="active">{{strtoupper($chitietsp->tensp)}}</li> -->
					</ol>
				</div>
			</div>
		</div>

		
		<!-- Thông tin sản phẩm -->
		<div class="container box-detail">
			<div class="row">
				<div class="img-product col-md-4 col-sm-4">
				  <div class="slider-for">
				  	<img id="zoom_01" src="{{asset('public/anh-sanpham-trungbinh/'.$chitietsp->anh)}}" data-zoom-image="{{asset('public/anh-sanpham/'.$chitietsp->anh)}}"/>
				  </div>
				  <div id="gallery" class="slider-nav" >
				  	<a href="#" data-image="{{asset('public/anh-sanpham-trungbinh/'.$chitietsp->anh)}}" data-zoom-image="{{asset('public/anh-sanpham/'.$chitietsp->anh)}}">
				  		<img id="img_01" src="{{asset('public/anh-sanpham-nho/'.$chitietsp->anh)}}">
				  	</a>
				  	<?php
				  		$anh_phu = DB::table('anh_sanpham')->where('masp',$chitietsp->masp)->get();
				  		if(count($anh_phu) > 0){
					  		foreach ($anh_phu as $val) { ?>
					  			<a href="#" data-image="{{asset('public/anh-sanpham-trungbinh/'.$val->tenanh)}}" data-zoom-image="{{asset('public/anh-sanpham/'.$val->tenanh)}}">
							  		<img id="img_01" src="{{asset('public/anh-sanpham-nho/'.$val->tenanh)}}">
							  	</a>
					  		<?php }
					  	}
				  	?>	
				  </div>
				</div>


				<div class="info-product col-md-5 col-sm-5">
					<h4><b>{{$chitietsp->tensp}}</b></h4>
					<div class="row">
						<?php
							$luotmua = DB::table('chitiet_donhang')
										->where('masp',$chitietsp->masp)
										->count('soluongct');
						?>
						@if($luotmua != 0)
							<label class="number-buy" data-toggle="tooltip" data-html="true" data-placement="top" title="Đã có {{$luotmua}} lượt mua"><span class="fa fa-tag">{{$luotmua}}</span></label>
						@endif
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<ul>
								<li>Kích thước màn hình: {{$chitietsp->kichthuocmanhinh}} inches</li>
								<li>Độ phân giải màn hình: {{$chitietsp->dophangiaimanhinh}} pixels</li>
								<li>Hệ điều hành: {{$chitietsp->hedieuhanh}}</li>
							</ul>
						</div>
						<div class="col-md-6 col-sm-6">
							<ul>
								<li>Bộ nhớ trong: {{$chitietsp->bonhotrong}}</li>					
								<li>Camera: {{$chitietsp->camerasau}} MP</li>
								<li>Dung lượng pin (mAh): {{$chitietsp->dungluongpin}} mAh</li>
								<li>Thời gian bảo hành {{$chitietsp->baohanh}} tháng</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="row label-soluong">
						<div class="col-md-3 col-sm-3">Số lượng:</div>
						<input type="number" name="soluong" value="1" min="1" style="width: 60px;">
						(Còn lại {{$chitietsp->soluong}} sản phẩm)
					</div>
					<hr>
					<?php 
						//Kiểm tra sản phẩm có khuyến mãi hay không
		                $checkKM = DB::table('khuyen_mai as km')
		                                ->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                                ->where('ctkm.masp', $chitietsp->masp)
		                                ->get();
		                if(count($checkKM) != 0){
		                	$t = 0;
		                	foreach ($checkKM as $valkm) {
		                		if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd)) && (strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt))){ ?>
			                		<div class="row label-gia">
										<h3>{{number_format($chitietsp->dongia-($chitietsp->dongia*$valkm->chietkhau*0.01),0,'.','.')}} đ</h3>
										<div class="col-md-8 col-sm-8">Giá trước đây: <del>{{number_format($chitietsp->dongia,0,'.','.')}} đ</del></div>
									</div>
								<?php 
									break;
								}else{
									$t +=1;
								}
		                	}
		                	if($t == count($checkKM)){ ?>
		                		<div class="row label-gia">
									<h3>{{number_format($chitietsp->dongia,0,'.','.')}} đ</h3>
								</div>
		                	<?php }
		                }else{ ?>
		                	<div class="row label-gia">
								<h3>{{number_format($chitietsp->dongia,0,'.','.')}} đ</h3>
							</div>
		                <?php }
					?>
					
					
					<div id="error_soluong" class="alert alert-danger hide" role="alert">
						
					</div>

					<div class="row list-btn">
						<button id="{{$chitietsp->masp}}" type="button" class="btn btn-addCart"><span class="fa fa-shopping-cart"></span>&nbsp;&nbsp;Thêm vào giỏ hàng</button>
					</div>
				</div>



				<div class="ship-product col-md-3 col-sm-3">
					<div class="row"><span class="fa fa-map-marker"></span>&nbsp;&nbsp;Giao hàng toàn quốc</div>
					<div class="row"><span class="fa fa-file-text-o"></span>&nbsp;&nbsp;Nhà cung cấp xuất hóa đơn cho sản phẩm này</div>
					<div class="row"><img src="{{asset('public/img/iconship.png')}}">&nbsp;&nbsp;Giao hàng bởi đối tác của Mobile Store</div>
					<hr>
					<div class="row noicungcap">
						<div class="col-md-3 col-sm-3"><img src="{{asset('public/img/marketplace.jpg')}}"></div>Sản phẩm được cung cấp bởi<br><b>&nbsp;&nbsp;{{$chitietsp->tengianhang}}</b>
					</div>
				</div>
			</div>
		</div> <!-- end box detail -->


		<!-- Panel Mô tả sản phẩm -->
		<nav id="navbar-list" class="navbar" data-spy="affix" data-offset-top="60"">
			<div class="collapse navbar-collapse container">
				<div class="row">
					<ul class="nav navbar-nav col-md-9 col-sm-8">
						<li><a id="link-mota" href="#mota">Mô tả</a></li>
						<li><a href="#thongso">Thông số kĩ thuật</a></li>						
						<li><a href="#danhgia">Đánh giá & nhận xét</a></li>					
					</ul>
				</div>
			</div>
		</nav>


		<div id="panel-thongtin" class="container">
			<div class="row">
				<div class="col-md-9 col-sm-9">	
					<div id="mota" class="row">
						<div class="tieude"><h3>Mô tả sản phẩm</h3></div>
						<div id="ndMota" class="col-md-12 col-sm-12" style="overflow: hidden; height: 600px;">
							{!!$chitietsp->mota!!}
						</div>

						<div class="clearfix"></div>
						<div id="showhidden">
							<button id="showhiddenMota">Xem thêm&nbsp;&nbsp;<span class="fa fa-angle-double-down"></span></button>	
						</div>					
					</div>
					
						


					<div class="row" id="thongso">
						<div class="tieude"><h3>Thông số kĩ thuật</h3></div>
						<div class="label-dacdiem">
							<label>Đặc điểm chính:</label>
						</div>
						<div class="table-dacdiem">
							<table class="table table-bordered">
							    <tbody>
							      <tr><td class="title-table">Tên sản phẩm</td><td>{{$chitietsp->tensp}}</td></tr>
							      <tr><td class="title-table">Màu sắc</td><td>{{$chitietsp->mausac}}</td></tr>
							      <tr><td class="title-table">Xuất xứ</td><td>{{$chitietsp->xuatxu}}</td></tr>
							      <tr><td class="title-table">Bộ nhớ trong</td><td>{{$chitietsp->bonhotrong}}</td></tr>
							      <tr><td class="title-table">Kích thước màn hình</td><td>{{$chitietsp->kichthuocmanhinh}} inches</td></tr>
							      <tr><td class="title-table">Độ phân giải màn hình</td><td>{{$chitietsp->dophangiaimanhinh}} pixels</td></tr>
							      <tr>
							      	<td class="title-table">Camera Trước</td>
							      	@if($chitietsp->cameratruoc == 0)
							      		<td>Không có</td>
							      	@else
							      		<td>{{$chitietsp->cameratruoc}} MP</td>
							      	@endif
							      </tr>
							      <tr>
							      	<td class="title-table">Camera Sau</td>
							      	@if($chitietsp->camerasau == 0)
							      		<td>Không có</td>
							      	@else
							      		<td>{{$chitietsp->camerasau}} MP</td>
							      	@endif
							      </tr>
							      <tr><td class="title-table">Hệ điều hành</td><td>{{$chitietsp->hedieuhanh}}</td></tr>
							      <tr><td class="title-table">Dung lượng pin</td><td>{{$chitietsp->dungluongpin}} mAh</td></tr>
							      <tr><td class="title-table">Thời gian bảo hành</td><td>{{$chitietsp->baohanh}} tháng</td></tr>
							    </tbody>
							</table>
						</div>
					</div>			

					<div class="row" id="danhgia">
						<div class="tieude">
							<h3>Đánh giá & nhận xét cho sản phẩm {{$chitietsp->tensp}}</h3>
						</div>
						<div class="label-diem">
							<p>Điểm đánh giá trung bình của sản phẩm</p>
						</div>						
						<div class="table-danhgia">
							<table class="table table-bordered tbdanhgia">
							    <tbody>
							      <tr>
							      	<?php
							        	$saodanhgia = DB::table('nhanxet_danhgia')
							        					->where('masp', $chitietsp->masp)
							        					->get();
							            if(count($saodanhgia) == 0){ ?>
							            	<td colspan="2" class="col-2">
							            		<div class="row" style="width: 400px;">
													<div class="col-md-3 col-sm-3"><div>5 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 0%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>0</div>						
													</div>
												</div>							
												
												<div class="row" style="width: 400px;">
													<div class="col-md-3 col-sm-3"><div>4 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 0%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>0</div>						
													</div>
												</div>	

												<div class="row" style="width: 400px;">
													<div class="col-md-3 col-sm-3"><div>3 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 0%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>0</div>						
													</div>
												</div>	

												<div class="row" style="width: 400px;">
													<div class="col-md-3 col-sm-3"><div>2 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 0%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>0</div>						
													</div>
												</div>	

												<div class="row" style="width: 400px;">
													<div class="col-md-3 col-sm-3"><div>1 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 0%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>0</div>						
												</div>
											</div>	
							            </td>
							            <td class="col-3">
									        	<label>Bạn đã sử dụng sản phẩm này ?</label>
												<button id="btn-danhgia" type="button" class="btn">GỬI ĐÁNH GIÁ CỦA BẠN</button>
									        </td>
							            <?php }else{ 
							            	$mot_sao = DB::table('nhanxet_danhgia')
							            				->where('masp', $chitietsp->masp)
							        					->where('saodg',1)
							        					->count('manxdg');
							        		$hai_sao = DB::table('nhanxet_danhgia')
							            				->where('masp', $chitietsp->masp)
							        					->where('saodg',2)
							        					->count('manxdg');
							        		$ba_sao = DB::table('nhanxet_danhgia')
							            				->where('masp', $chitietsp->masp)
							        					->where('saodg',3)
							        					->count('manxdg');
							        		$bon_sao = DB::table('nhanxet_danhgia')
							            				->where('masp', $chitietsp->masp)
							        					->where('saodg',4)
							        					->count('manxdg');
							        		$nam_sao = DB::table('nhanxet_danhgia')
							            				->where('masp', $chitietsp->masp)
							        					->where('saodg',5)
							        					->count('manxdg');
							        		$phantram = ($mot_sao*1 + $hai_sao*2 + $ba_sao*3 + $bon_sao*4 + $nam_sao*5)/count($saodanhgia);
							            ?>
							            	<td class="col-1">							        	
									        	<input class="rating rating-loading" data-star="5" data-show-clear="false" data-show-caption="false" data-readonly="true" data-size="xs" value="{{$phantram}}">
												<p>{{number_format($phantram,1)}} trên 5</p>
												<p>Có {{count($saodanhgia)}} nhận xét & đánh giá</p>
									        </td>
									        <td class="col-2">
									        	<div class="row">
													<div class="col-md-3 col-sm-3"><div>5 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{($nam_sao/count($saodanhgia))*100}}%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>{{$nam_sao}}</div>						
													</div>
												</div>							
												
												<div class="row">
													<div class="col-md-3 col-sm-3"><div>4 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: {{($bon_sao/count($saodanhgia))*100}}%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>{{$bon_sao}}</div>						
													</div>
												</div>	

												<div class="row">
													<div class="col-md-3 col-sm-3"><div>3 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{($ba_sao/count($saodanhgia))*100}}%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>{{$ba_sao}}</div>						
													</div>
												</div>	

												<div class="row">
													<div class="col-md-3 col-sm-3"><div>2 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: {{($hai_sao/count($saodanhgia))*100}}%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>{{$hai_sao}}</div>						
													</div>
												</div>	

												<div class="row">
													<div class="col-md-3 col-sm-3"><div>1 sao</div></div>
													<div class="col-md-6 col-sm-6">
														<div class="progress row" >
														  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100" style="width: {{($mot_sao/count($saodanhgia))*100}}%">
														  </div>
														</div>						
													</div>
													<div class="col-md-1 col-sm-1"><div>{{$mot_sao}}</div>						
													</div>
												</div>	

									        </td>
									        <td class="col-3">
									        	<label>Bạn đã sử dụng sản phẩm này ?</label>
												<button id="btn-danhgia" type="button" class="btn">GỬI ĐÁNH GIÁ CỦA BẠN</button>
									        </td>
							            <?php }
							        ?>							        
							      </tr>
							    </tbody>
							</table>
						</div>
						<div class="clearfix"></div>

						<!-- panel nhập đánh giá -->
						<div id="panel-danhgia" class="col-md-12 col-sm-12 collapse">
							<h5><b>Bạn chấm sản phẩm này bao nhiêu sao ?</b></h5>
							<form id="form-danhgia" name="form-danhgia" role="form" method="post" action="{{action('NhanXetDanhGiaController@postNhanXet')}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="form-group">
									<input id="ratingStar" name="txtSao" class="rating-loading">
									<div class="txtSao" style="color: red"></div>
								</div>
							  	<div class="form-group">
								    <label>Tiêu đề đánh giá (Tùy chọn)</label>
								    <input type="text" name="txtTieuDe" class="form-control" placeholder="Nhập tiêu đề nhận xét tại đây">
								    <div class="txtTieuDe" style="color: red"></div>
							  	</div>
							  	<div class="form-group">
								    <label>Mô tả đánh giá</label><br>
								    <textarea name="txtMoTa" placeholder="Nhập mô tả tại đây"  class="form-control" rows="3"></textarea>
								    <div class="txtMoTa" style="color: red"></div>
							  	</div>
							  <button type="button" id="{{$chitietsp->masp}}" class="btn btnGuiNhanXet">GỬI NHẬN XÉT</button>
							</form>
						</div>	

						<?php 
							if(count($saodanhgia) != 0){ ?>
								<!-- Hiển thị các nhận xét & đánh giá -->
								<div id="show-danhgia" class="col-md-12 col-sm-12">
									<div class="label-nhanxet">
										<h5>Nhận xét về sản phẩm</h5>
									</div>
									<?php
										foreach ($nhanxet as $val) { ?>
											<!-- Nội dung đánh giá của một người -->
											<div class="chitiet-danhgia">
												<div class="title-danhgia row">							
													<div class="col-md-2 col-sm-2">
														<img src="{{asset('public/img/'.$val->saodg.'sao.png')}}">
													</div>
													<div class="col-md-7 col-sm-7">
														<div class="row">{{$val->tieudenx}}</div>
													</div>
													<div class="col-md-3 col-sm-3">
														<div class="row text-right">{{date('d/m/Y',strtotime($val->thoigiannxdg))}}</div>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="nguoi-danhgia">
													@if($val->makh == '')
														Theo khách hàng Mobistore chưa đăng kí
													@else
														<?php 
															$kh = DB::table('khach_hang')
																	->where('makh',$val->makh)
																	->first();
															echo $kh->tennguoidung;
														?>
													@endif
												</div>
												<div class="nd-danhgia">
													{{$val->noidungnx}}
												</div>
											</div> <!-- end nội dung đánh giá của một người -->
											<hr>
										<?php }
									?>
									<div class="text-right">
										{!! $nhanxet->render() !!}
									</div>
								</div>								
							<?php }
						?>						
					</div> <!-- end đánh giá -->					
				</div> <!-- end col-md-9 -->
			

				<!-- panel phải các sản phẩm gợi ý-->
				<div id="panel-goiy" class="col-md-3 col-sm-3">
					<div class="tieude"><h3>Sản phẩm tương tự</h3></div>
					<div class="list-spgoiy">
						<?php
							$i = 0;
							$sp_tuongtu = DB::table('san_pham')
											->where('madm',$chitietsp->madm)
											->where('trangthai',1)
    										->where('soluong','>',0)
											->whereNotIn('masp',[$chitietsp->masp])
											->get();
							//Kiểm tra sản phẩm có khuyến mãi hay không
		                    foreach ($sp_tuongtu as $val) {
		                    	$i +=1;
		                    	if($i == 4){
		                    		break;
		                    	}
		                    	$kmtuongtu = DB::table('khuyen_mai as km')
		                                    ->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
		                                    ->where('ctkm.masp', $val->masp)
		                                    ->get(); ?>

		                        <a id="sanpham" href="{{asset('chitiet-sanpham/'.$val->masp)}}">
								<div class="thumbnail">
									<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
										<?php
											if(count($kmtuongtu) != 0){
												foreach ($kmtuongtu as $valkm) {
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
											if(count($kmtuongtu) != 0){
												$t = 0;
												foreach ($kmtuongtu as $valkm) {
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
												if($t == count($kmtuongtu)){ ?>
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
				</div> <!-- end panel phải các sản phẩm gợi ý-->
			</div>
		</div>


	</div> <!--end body -->




	<script>
		/* ElevateZoom */
    	$("#zoom_01").elevateZoom({gallery:'gallery', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true,
    								zoomWindowWidth:550, zoomWindowHeight:500, zoomWindowOffetx:20, zoomWindowOffety:5}); 


    	/* Star rating*/
	    $('#ratingStar').rating({
	        min: 0,
	        max: 5, 
	        step: 1, 
	        showClear: false,
	        size: "xs",
	        starCaptions: {
	                    1: '1 sao',
	                    2: '2 sao',
	                    3: '3 sao',
	                    4: '4 sao',
	                    5: '5 sao',
	                },
	        clearCaption: 'Nhấn vào đây để đánh giá',	        
	    }); 

	    $('#ratingStar').rating().change(function() {
	    	var value = $(this).rating().val();
        	//alert("Bạn chọn: " + value);
    	});

	</script>

@stop