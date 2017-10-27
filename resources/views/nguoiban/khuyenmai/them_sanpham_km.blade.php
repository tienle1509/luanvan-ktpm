@extends('nguoiban_home')

@section('khuyenmai','active')

@section('noidung')

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnThem').click(function(){
			var url = "http://localhost/luanvan-ktpm/nguoiban/khuyenmai/them-spkm";
			var masp = $(this).closest('tr').find('td:nth-child(1)').text();
			var makm = $('#idMaKM').text();
			

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"masp":masp, "makm":makm},
				success : function(result){
					if(result.success){
						$('#successThemSP').removeClass('hide');
						$('#successThemSP').html('Thêm sản phẩm thành công !');
						setTimeout("location.reload()",1900);
					}
				}
			}); 
		});
	});
</script>


<div class="container-fluid">
				<h1>Thêm sản phẩm khuyến mãi</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/khuyenmai')}}">Khuyến mãi</a></li>
						  <li><a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai/'.$km->makm)}}">Chi tiết khuyến mãi</a></li>
						  <li class="active">Thêm sản phẩm khuyến mãi</li>
						</ol>
					</div>
				</div>

				<div class="alert alert-success hide" role="alert" id="successThemSP">
					
				</div>

				<div class="row" style="margin-bottom: 15px;">
					<div class="col-md-8 col-sm-8">
						<h3>{{$km->tenkm}}</h3><div class="hide" id="idMaKM">{{$km->makm}}</div>
					</div>
					<div class="col-md-4 col-sm-4 text-right">
						<a href="{{asset('nguoiban/khuyenmai/dssanphamkm/'.$km->makm)}}" type="button" class="btn btn-primary">
							<span class="fa fa-list"></span>&nbsp;&nbsp;Danh sách sản phẩm khuyến mãi
						</a>
					</div>
				</div>


				<table id="table-listProduct" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th>Tên sản phẩm</th>
				        <th>Giá hiện tại</th>
				        <th>Giá khuyến mãi</th>
				        <th>Số lượng</th>
				        <th>Giảm giá</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($sp) == 0)
				    		<tr>
				    			<td align="center" colspan="8" style="color: red"><h4>Nhà bán hàng chưa có sản phẩm, vui lòng thêm sản phẩm để tham gia khuyến mãi !</h4></td>
				    		</tr>
				    	@else
				    		@foreach($sp as $valsp)
				    			@if(in_array($valsp->masp, $spkm) == false)
				    				<tr>
								        <td>{{$valsp->masp}}</td>
								        <td class="img-pro">
								        	<img src="{{asset('public/anh-sanpham/'.$valsp->anh)}}">
								        </td>
								        <td class="name-pro">{{$valsp->tensp}}</td>
								        <td class="price-pro">{{number_format($valsp->dongia)}}</td>
								        <td>
								        	{{number_format($valsp->dongia-($valsp->dongia*$km->chietkhau*0.01))}}
								        </td>
								        <td>{{$valsp->soluong}}</td>
								        <td>{{$km->chietkhau}}%</td>
								        <td>
								        	<button type="button" class="btn btn-success btnThem">
								        		<span class="fa fa-plus"></span>&nbsp;Thêm
								        	</button>
								        </td>
								    </tr>
				    			@endif
				    		@endforeach
				    	@endif
				    </tbody>
				  </table>

			</div>



@stop