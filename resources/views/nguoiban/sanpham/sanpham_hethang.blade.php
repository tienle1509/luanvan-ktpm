@extends('nguoiban.sanpham')

@section('title','Sản phẩm hết hàng')

@section('chitiet')

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnCapNhat').click(function(){
			var url = "http://localhost/luanvan-ktpm/nguoiban/ql-sanpham/sanpham-hethang/capnhat-soluong";
			var masp = $(this).closest('tr').find('td:nth-child(2)').text();
			var soluong = $(this).closest('tr').find('input[name=soluong]').val();
			
			$.ajax({
				url : url,
				type : "get",
				dataType : "JSON",
				data : {"masp":masp, "soluong":soluong},
				success : function(result){
					if(!result.success){
						var errorSL = '';
						$.each(result.errors, function(index, item){
							errorSL += '<li>'+item+'</li>';
						});
						//Hiện lỗi ra
						$('#alert-danger').removeClass('hide');
						$('#errorSoLuong').html(errorSL);
					} else { //Thành công
						$('#alert-danger').addClass('hide');
						$('#alert-success').removeClass('hide');
						$('#successSoLuong').html('Cập nhật số lượng sản phẩm thành công !');

						setTimeout(function(){
							location.reload();
						}, 1000);						
					}
				}
			}); 
		});
	});
</script>

<h2>Danh sách sản phẩm hết hàng</h2>
				@if(count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<strong>Lỗi ! </strong>{{$errors->first('key')}}	
					</div>
				@endif
				<div class="alert alert-danger hide" id="alert-danger" role="alert">
					<strong>Lỗi ! </strong>Đã xảy ra vui lòng kiểm tra lại<br>
					<ul>
						<div id="errorSoLuong"></div>
					</ul>
				</div>
				<div class="alert alert-success hide" id="alert-success" role="alert">
					<div id="successSoLuong"></div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="row">
							<form id="form-searchProduct" class="form-horizontal" role="form" method="get" action="{{ url('nguoiban/ql-sanpham/sanpham-hethang/tim-kiem') }}">
								<div class="col-sm-4">
								  	<input type="text" class="form-control" placeholder="Nhập tên danh mục, tên sản phẩm" name="key">
								</div>	
								<button type="submit" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
							</form>
						</div>
					</div>
				</div>


				<table id="table-listProduct" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				      	<th>Danh mục</th>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th class="th-name-pro">Tên sản phẩm</th>
				        <th>Giá bán lẻ</th>
				        <th>Giá khuyến mãi</th>
				        <th>Số lượng</th>
				        <th>Hành động</th>
				      </tr>
				    </thead>
				    <tbody>			     

				      @if(count($list_hethang) == 0)
				      	<tr>
				      		<td align="center" style="color: red" colspan="8"><h4>Không có sản phẩm hết hàng</h4></td>
				      	</tr>
				      @else
				      	@foreach($list_hethang as $val)
				      		@if(in_array($val->masp, $masp_khuyenmai))
					      		<tr>
							      	<td>{{$val->tendanhmuc}}</td>
							        <td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="name-pro">{{$val->tensp}}</td>
							        <td class="price-pro">{{number_format($val->dongia)}}</td>
							        <td>
							        	<?php
							        		$giamgia = DB::table('khuyen_mai as km')
							        					->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')->where('ctkm.masp',$val->masp)->get();
							        		$t = 0;
							        		foreach ($giamgia as $valkm) {
							        			if((strtotime($ngayht) > strtotime($valkm->ngaybd)) &&(strtotime($ngayht))< strtotime($valkm->ngaykt)){
								        			echo number_format($val->dongia-($val->dongia*$valkm->chietkhau*0.01));
								        			break;
								        		}else {
								        			$t+=1;
								        		}
							        		}
							        		if($t != 0){
							        			echo "-";
							        		}
							        	?>
							        </td>
							        <td width="130px;">
							        	<input type="text" name="soluong" class="form-control" value="0">
							        </td>
							        <td>
							        	<button type="btn" class="btn btn-success btnCapNhat">
							        		<span class="fa fa-refresh"></span>&nbsp;&nbsp;Cập nhật
							        	</button>
							        </td>
							    </tr>
							@else
								<tr>
							      	<td>{{$val->tendanhmuc}}</td>
							        <td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="name-pro">{{$val->tensp}}</td>
							        <td class="price-pro">{{$val->dongia}}</td>
							        <td>-</td>
							        <td width="130px;">
							        	<input type="text" name="soluong" class="form-control" value="0">
							        </td>
							        <td>
							        	<button type="btn" class="btn btn-success btnCapNhat">
							        		<span class="fa fa-refresh"></span>&nbsp;&nbsp;Cập nhật
							        	</button>
							        </td>
							    </tr>
							@endif
				      	@endforeach
				      @endif
				    </tbody>
				  </table>


@stop