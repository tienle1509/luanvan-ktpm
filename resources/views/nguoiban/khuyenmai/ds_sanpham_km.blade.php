@extends('nguoiban_home')


@section('khuyenmai','active')


@section('noidung')

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnXoa').click(function(){
			var url = "http://localhost/luanvan-ktpm/nguoiban/khuyenmai/xoa-spkm";
			var masp = $(this).closest('tr').find('td:nth-child(1)').text();
			var makm = $('#idMaKM').text();

			$.ajax({
				url : url,
				type : "GET", 
				dataType : "JSON",
				data : {"masp": masp, "makm":makm},
				success : function(result){
					if(result.success){
						$('#successXoaSP').removeClass('hide');
						$('#successXoaSP').html('Xóa sản phẩm thành công !');
						setTimeout("location.reload()",1000);						
					}
				}
			});
		});
	});
</script>

<div class="container-fluid">
				<h1>Danh sách sản phẩm khuyến mãi</h1>
				<hr>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('nguoiban/khuyenmai')}}">Khuyến mãi</a></li>
						  <li><a href="{{asset('nguoiban/khuyenmai/chitiet-khuyenmai/'.$km->makm)}}">Chi tiết khuyến mãi</a></li>
						  <li><a href="{{asset('nguoiban/khuyenmai/themspkm/'.$km->makm)}}">Thêm sản phẩm khuyến mãi</a></li>
						  <li class="active">Danh sách sản phẩm khuyến mãi</li>
						</ol>
					</div>
				</div>

				<div class="alert alert-success hide" role="alert" id="successXoaSP">
					
				</div>

				<h3>{{$km->tenkm}}</h3><div class="hide" id="idMaKM">{{$km->makm}}</div>


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
				    			@if(in_array($valsp->masp, $spkm))
				    				<tr>
								        <td>{{$valsp->masp}}</td>
								        <td class="img-pro">
								        	<img src="{{asset('public/anh-sanpham/'.$valsp->anh)}}">
								        </td>
								        <td class="name-pro">{{$valsp->tensp}}</td>
								        <td class="price-pro">{{number_format($valsp->dongia,0,'.','.')}}</td>
								        <td>
								        	{{number_format($valsp->dongia-($valsp->dongia*$km->chietkhau*0.01),0,'.','.')}}
								        </td>
								        <td>{{$valsp->soluong}}</td>
								        <td>{{$km->chietkhau}}%</td>
								        <td>
								        	<button type="button" class="btn btn-danger btnXoa">
								        		<span class="fa fa-trash"></span>&nbsp;&nbsp;Xóa
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