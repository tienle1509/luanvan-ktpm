@extends('quanli_home')

@section('qldonhang','active')

@section('noidung')
<div class="container-fluid">
				<h1>Duyệt đơn hàng</h1>
				<hr style="border: 1px solid #F9F9FF">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<ol class="breadcrumb">
						  <li><a href="{{asset('quanli/ql-donhang')}}">Quản lí đơn hàng</a></li>
						  <li class="active">Duyệt đơn hàng</li>
						</ol>
					</div>
				</div>

				<h2>Đơn hàng đang chờ duyệt</h2>			



				<table id="table-donhang-admin" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã ĐH</th>
				        <th>Ngày đặt</th>
				        <th>Ngày giao</th>
				        <th class="guiden">Thông tin giao hàng</th>
				        <th>Tên sản phẩm</th>
				        <th>Hình thức thanh toán</th>
				        <th>Tổng tiền</th>
				        <th>Trạng thái</th>
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td>18/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<label class="label label-warning">Chờ duyệt</label>
				        </td>	
				        <td>
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
				        </td>			        				        
				      </tr>
				      
				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td>18/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<label class="label label-warning">Chờ duyệt</label>
				        </td>
				        <td>
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
				        </td>
				      </tr>

				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td>18/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<label class="label label-warning">Chờ duyệt</label>
				        </td>
				        <td>
				        	<button type="button" class="btn btn-success">Phê duyệt</button>
				        </td>
				      </tr>
				    </tbody>
				</table>
			</div>


@stop