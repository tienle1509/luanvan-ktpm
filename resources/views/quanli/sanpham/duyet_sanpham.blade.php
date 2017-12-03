@extends('quanli_home')

@section('qlsanpham', 'active')

@section('noidung')

<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-Duyet').click(function(){
			var url = "http://localhost/luanvan-ktpm/quanli/ql-sanpham/duyet";
			var masp = $(this).closest('tr').find('td:nth-child(1)').text();

			$.ajax({
				url : url,
				type : "GET",
				dataType : "JSON",
				data : {"masp":masp},
				success : function(result){
					if(result.success){
						$.notify({
								// options
								message: 'Duyệt sản phẩm thành công !'
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
								offset: 60,
								spacing: 10,
								z_index: 1031,
								delay: 1000,
								timer: 800,
							});
						setTimeout("location.reload(true);",1500);	
					}
				}
			});
		});
	});
</script>


<div class="container-fluid">
				<h1>Duyệt sản phẩm</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-sanpham')}}">Quản lí sản phẩm</a></li>
						  <li class="active">Duyệt sản phẩm</li>
						</ol>
					</div>
				</div>

				

				<h2>Sản phẩm đang chờ duyệt</h2>				


				<table id="table-product" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã SP</th>
				        <th>Hình ảnh</th>
				        <th class="th-tensp">Tên sản phẩm</th>
				        <th>Đơn giá</th>
				        <th>Số lượng</th>
				        <th>Nhà bán hàng</th>
				        <th>Trạng thái</th>
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@if(count($list_duyetsp) == 0)
				    		<tr>
				    			<td align="center" colspan="8" style="color: red"><h4>Không có sản phẩm chờ duyệt !</h4></td>
				    		</tr>
				    	@else
				    		@foreach($list_duyetsp as $val)
				    			<tr>
							        <td>{{$val->masp}}</td>
							        <td>
							        	<img src="{{asset('public/anh-sanpham/'.$val->anh)}}">
							        </td>
							        <td class="tensp">{{$val->tensp}}</td>
							        <td class="dongia">{{number_format($val->dongia,0,'.','.')}}</td>
							        <td>{{$val->soluong}}</td>
							        <td class="tenshop">{{$val->tengianhang}}</td>
							        <td>
							        	<label class="label label-warning">Chờ duyệt</label>
							        </td>
							        <td>
							        	<button type="button" class="btn btn-success btn-Duyet">Phê duyệt</button>
							        </td>
							    </tr>
				    		@endforeach
				    	@endif
				    </tbody>
				    <tfoot>
				    	<tr>
				    		<td align="center" colspan="8">{!! $list_duyetsp->render() !!}</td>
				    	</tr>
				    </tfoot>
				</table>


			</div>


@stop