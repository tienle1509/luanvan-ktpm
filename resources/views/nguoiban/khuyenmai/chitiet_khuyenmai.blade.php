@extends('nguoiban_home')

@section('khuyenmai','active')


@section('noidung')
<div class="container-fluid">
				<h1>Chi tiết khuyến mãi</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/khuyenmai')}}">Khuyến mãi</a></li>
						  <li class="active">Chi tiết khuyến mãi</li>
						</ol>
					</div>
				</div>

				<h3>Deal Giá Sốc - Khuyến mãi chỉ duy nhất 2 ngày</h3>
				<div class="panel-detailPromotion row">
					<div class="col-md-4 col-sm-4">
						<div class="row">
							<img src="{{asset('public/anh-khuyenmai/flashsale.png')}}" width="375" height="230">
						</div>					
					</div>
					<div class="col-md-8 col-sm-8">						
						<p>
							Tham gia ngay, chương trình khuyến mãi cùng Mobile Store kéo dài từ 30/04/2017 đến ngày 02/05/2017. 
							Để tham gia chương trình khuyến mãi, Nhà bán hàng cần giảm giá sản phẩm 5%.
							<br>Khi lựa chọn tham gia chương trình này, Mobile có quyền cập nhật giá sản phẩm như Nhà bán hàng đã cam
							kết và sử dụng mục đích chạy quản cáo cũng như chạy các chương trình khuyến mãi trên Mobile trong khoảng thời gian 2 ngày từ 30/04/2017 đến ngày 02/05/2017.
						</p>
						<div class="row">
							<div class="col-md-5 col-sm-5">
								<div><b>Thời gian:</b> 30/4/2017 - 02/05/2017</div>
								<div><b>Hạn đăng kí:</b> 28/04/2017</div>
								<p style="margin-top: 20px;">
									<a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai/themspkm')}}" type="button" class="btn btn-warning">Chọn sản phẩm để khuyến mãi</a>
								</p>
							</div>
							<div class="col-md-7 col-sm-7">
								<div><b>Sản phẩm khuyến mãi:</b> 43</div>
								<div><b>Giảm giá:</b> 5%.</div>
							</div>
						</div>
					</div>
				</div>
			</div>


@stop