@extends('quanli_home')

@section('qlkhuyenmai', 'active')

@section('noidung')
<div class="container-fluid">
				<h1>Khuyến mãi</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/khuyenmai')}}">Khuyến mãi</a></li>
						  <li class="active"></li>
						</ol>
					</div>
				</div>

				<a href="{{asset('quanli/khuyenmai/them-khuyenmai')}}" type="button" class="btn btn-success btn-lg">
					<span class="fa fa-plus"></span>&nbsp;&nbsp;Thêm khuyến mãi mới
				</a>

				<h2>Tất cả khuyến mãi</h2>
				<table id="table-Promotion" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã KM</th>
				        <th>Tên khuyến mãi</th>
				        <th>Ngày bắt đầu</th>
				        <th>Ngày kết thúc</th>
				        <th>Hạn đăng kí</th>
				        <th>Chiết khấu</th>
				      </tr>
				    </thead>
				    <tbody>
				     	@if(count($list_km) == 0)
				     		<tr>
				     			<td align="center" colspan="6" style="color: red"><h4>Chưa có chương trình khuyến mãi !</h4></td>
				     		</tr>
				     	@else
				     		@foreach($list_km as $valKm)
				     			<tr>
							        <td>{{$valKm->makm}}</td>
							        <td>
							        	<a href="{{asset('quanli/khuyenmai/chitiet-khuyenmai/'.$valKm->makm)}}">{{$valKm->tenkm}}</a>
							        </td>
							        <td>{{date('d-m-Y',strtotime($valKm->ngaybd))}}</td>
							        <td>{{date('d-m-Y',strtotime($valKm->ngaykt))}}</td>
							        <td>{{date('d-m-Y',strtotime($valKm->handangki))}}</td>
							        <td>{{$valKm->chietkhau}}%</td>
							    </tr>
				     		@endforeach
				     	@endif
				    </tbody>
				  </table>
			</div>

@stop