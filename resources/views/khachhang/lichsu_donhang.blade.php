@extends('khachhang_home')

@section('title-page','Quản lí đơn hàng')

@section('noidung')

<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-qltaikhoan.css')}}">

<?php
	if(!isset($_SESSION['makh'])){
		header("Location: http://localhost/luanvan-ktpm/home");	
		exit;
	}else{
		$kh = DB::table('khach_hang')->where('makh', $_SESSION['makh'])->first();
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
			<h4>Đơn đặt hàng</h4>
			<table id="table-donhang" class="table">			  
			  <?php
			  	$dh = DB::table('don_hang as dh')
			  			->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
			  			->where('dh.makh', $_SESSION['makh'])
			  			->where('kh.thanhvien',1)
			  			->where('dh.trangthai',1)
			  			->orderBy('dh.madh','desc')
			  			->get();
			  	if(count($dh) == 0){ ?>
			  		<tr>
			  			<td colspan="5">
			  				<br><br>
			  				Bạn chưa có đơn đặt hàng <br><br>
			  				<a href="{{asset('home')}}" type="button" class="btn btn-md btn-warning">Tiếp tục mua sắm</a>
			  				<br><br>
			  			</td>
			  		</tr>
			  	<?php }else{	?>
			  		<tr>
					    <th>Mã đơn hàng</th>
					    <th>Ngày đặt</th> 
					    <th>Tổng tiền</th>
					    <th>Tình trạng</th>
					    <th>Thao tác</th>
					  </tr>		  		
				  	<?php foreach ($dh as $valdh) { ?>
				  		<tr>
						    <td>{{$valdh->madh}}</td>
						    <td>{{date('d/m/Y',strtotime($valdh->ngaydat))}}</td> 
						    <td>{{number_format($valdh->tongtien,0,'.','.')}}</td>
						    <td>
						    	<?php 
						    		$tinhtrang = DB::table('tinhtrang_donhang')
						    						->where('mattdh', $valdh->mattdh)
						    						->first();
						    		echo $tinhtrang->tenttdh;
						    	?>
						    </td> 
						    <td>
						    	<a href="{{asset('quanli-donhang/chitiet-donhang/'.$valdh->madh)}}" type="button" class="btn btn-info">Chi tiết</a>
						    </td>
						</tr>
				  	<?php }
				}
			  ?>
			</table>			
		</div>
		

		
	</div>


	


@stop