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
				      <tr>
				        <td>KM001</td>
				        <td>
				        	<a href="{{asset('quanli/khuyenmai/chitiet-khuyenmai')}}">Deal giá sốc - Khuyến mãi chỉ duy nhất 2 ngày</a>
				        </td>
				        <td>12/04/2017</td>
				        <td>14/04/2017</td>
				        <td>10/04/2017</td>
				        <td>8%</td>
				      </tr>

				      <tr>
				        <td>KM001</td>
				        <td>
				        	<a href="{{asset('quanli/khuyenmai/chitiet-khuyenmai')}}">Deal giá sốc - Khuyến mãi chỉ duy nhất 2 ngày</a>
				        </td>
				        <td>12/04/2017</td>
				        <td>14/04/2017</td>
				        <td>10/04/2017</td>
				        <td>8%</td>
				      </tr>

				      <tr>
				        <td>KM001</td>
				        <td>
				        	<a href="{{asset('quanli/khuyenmai/chitiet-khuyenmai')}}">Deal giá sốc - Khuyến mãi chỉ duy nhất 2 ngày</a>
				        </td>
				        <td>12/04/2017</td>
				        <td>14/04/2017</td>
				        <td>10/04/2017</td>
				        <td>8%</td>
				      </tr>
				    </tbody>
				  </table>
			</div>

@stop