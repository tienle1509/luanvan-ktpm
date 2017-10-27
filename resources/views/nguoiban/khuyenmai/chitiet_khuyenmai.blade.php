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

				<h3>{{$ctkm->tenkm}}</h3>
				<div class="panel-detailPromotion row">
					<div class="col-md-4 col-sm-4">
						<div class="row">
							<img src="{{asset('public/anh-khuyenmai/'.$ctkm->anhkm)}}" width="375" height="230">
						</div>					
					</div>
					<div class="col-md-8 col-sm-8">						
						<p>
							{!!$ctkm->mota!!}
						</p>
						<div class="row">
							<div class="col-md-5 col-sm-5">
								<div><b>Thời gian:</b> {{date('d/m/Y', strtotime($ctkm->ngaybd))}} - {{date('d/m/Y', strtotime($ctkm->ngaykt))}}</div>
								<div><b>Hạn đăng kí:</b> {{date('d/m/Y', strtotime($ctkm->handangki))}}</div>
								<p style="margin-top: 20px;">
									<a href="{{asset('nguoiban/khuyenmai/themspkm/'.$ctkm->makm)}}" type="button" class="btn btn-warning">Chọn sản phẩm để khuyến mãi</a>
								</p>
							</div>
							<div class="col-md-7 col-sm-7">
								<div><b>Sản phẩm tham gia khuyến mãi:</b> {{$num_pro}} sản phẩm</div>
								<div><b>Giảm giá:</b> {{$ctkm->chietkhau}}%.</div>
							</div>
						</div>
					</div>
				</div>
			</div>


@stop