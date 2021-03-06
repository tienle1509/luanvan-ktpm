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
							errorSL = item;
						});
						//Hiện lỗi ra
						$.notify({
								// options
								title: 'Lỗi: ',
								message: errorSL
							},{
								// settings
								element: 'body',
								position: null,
								type: "danger",
								allow_dismiss: true,
								placement: {
									from: "top",
									align: "right"
								},
								offset: 100,
								spacing: 10,
								z_index: 1031,
								delay: 1000,
								timer: 800,
							});
					} else { //Thành công
						$.notify({
								// options
								message: 'Cập nhật số lượng sản phẩm thành công !'
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
								offset: 100,
								spacing: 10,
								z_index: 1031,
								delay: 1000,
								timer: 800,
							});

						setTimeout(function(){
							location.reload();
						}, 1500);						
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
							        <td class="price-pro">{{number_format($db->dongia,0,'.','.')}}</td>
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
							        <td class="price-pro">{{number_format($db->dongia,0,'.','.')}}</td>
							        <td>
							        	<?php
							        	$t = 0;
							        		foreach ($km as $valkm) {
							        			if((strtotime(date('Y-m-d',strtotime($ngayht))) >= strtotime($valkm->ngaybd)) && strtotime(date('Y-m-d',strtotime($ngayht))) <= strtotime($valkm->ngaykt)){
							        			echo number_format($db->dongia-($db->dongia*$valkm->chietkhau*0.01),0,'.','.');
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