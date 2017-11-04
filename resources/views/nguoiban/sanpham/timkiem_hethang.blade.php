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

				<div style="margin-top: 10px; font-size: 15px;">Tìm thấy : <b>{{count($result_search)}}</b> sản phẩm</div>


				@if(count($result_search) != 0)

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
				    	<?php 
				    		foreach ($result_search as $value) {
				    			$db = DB::table('san_pham as sp')
				    					->join('danhmuc_sanpham as dm', 'dm.madm', '=','sp.madm')
				    					->where('sp.masp',$value)
				    					->first();
				    			//Kiểm tra sản phẩm có khuyến mãi hay không
				    			$km = DB::table('khuyen_mai as km')
										->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
										->where('ctkm.masp', $value)
										->get();
				    		if(count($km) == 0) { ?>
					    		<tr>
							      	<td>{{$db->tendanhmuc}}</td>
							        <td>{{$db->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$db->anh)}}">
							        </td>
							        <td class="name-pro">{{$db->tensp}}</td>
							        <td class="price-pro">{{$db->dongia}}</td>
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
							<?php } else { ?>
								<tr>
							      	<td>{{$db->tendanhmuc}}</td>
							        <td>{{$db->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$db->anh)}}">
							        </td>
							        <td class="name-pro">{{$db->tensp}}</td>
							        <td class="price-pro">{{$db->dongia}}</td>
							        <td>
							        	<?php
							        	$t = 0;
							        		foreach ($km as $valkm) {
							        			if((strtotime($ngayht) > strtotime($valkm->ngaybd)) && (strtotime($ngayht) < strtotime($valkm->ngaykt))){
							        			echo number_format($db->dongia-($db->dongia*$valkm->chietkhau*0.01));
							        				break;
							        			} else {
							        				$t+=1;
							        			}
							        		}
							        		if($t == count($km)){
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
				    	<?php }
				    		}
				    	?>
				   
				    </tbody>
				</table>

				@endif
@stop