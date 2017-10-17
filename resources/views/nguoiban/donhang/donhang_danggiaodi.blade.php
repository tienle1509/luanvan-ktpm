@extends('nguoiban.donhang')

@section('title','Đơn hàng đang giao đi')

@section('chitiet')

<h2>Đơn hàng đang giao đi</h2>

				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="form-searchOrder" class="form-horizontal" role="form">
							<div class="col-sm-2 form-group">
							  	<input type="text" class="form-control" id="" placeholder="Mã đơn hàng">
							</div>
							<div class="col-sm-3">
							  	<input type="text" class="form-control" id="" placeholder="Tên khách hàng">
							</div>	
							<div class="col-sm-3 form-group">
							  	<div class="input-group">
							        <input class="form-control" type="text" id="Sdate" name="txtSDate" placeholder="Từ ngày" />
							        	<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							    </div>
							</div>
							<div class="col-sm-3">
							  	<div class="input-group">
							        <input class="form-control" type="text" id="Edate" name="txtEDate" placeholder="Đến ngày" />
							        	<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							    </div>
							</div>				    
							<button type="button" class="btn btn-default"><span class="fa fa-search"></span>&nbsp;Tìm kiếm</button>
						</form>
					</div>
				</div>


				<table id="table-donhang" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã ĐH</th>
				        <th>Ngày đặt</th>
				        <th>Thông tin giao hàng</th>
				        <th>Tên sản phẩm</th>
				        <th>Hình thức thanh toán</th>
				        <th>Tình trạng</th>
				        <th>Tổng tiền</th>
				        <th>Thao tác</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td>
				        	<select class="form-control" style="width: 165px">
				        		<option>Đang xử lí</option>
				        		<option>Đang giao đi</option>
				        		<option>Giao hàng thất bại</option>
				        		<option>Đã giao hàng</option>
				        	</select>
				        </td>			        
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<button type="button" class="btn btn-success">Cập nhật</button>
				        </td>
				      </tr>
				      
				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td>
				        	<select class="form-control" style="width: 165px">
				        		<option>Đang xử lí</option>
				        		<option>Đang giao đi</option>
				        		<option>Giao hàng thất bại</option>
				        		<option>Đã giao hàng</option>
				        	</select>
				        </td>			        
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<button type="button" class="btn btn-success">Cập nhật</button>
				        </td>
				      </tr>

				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td>
				        	<select class="form-control" style="width: 165px">
				        		<option>Đang xử lí</option>
				        		<option>Đang giao đi</option>
				        		<option>Giao hàng thất bại</option>
				        		<option>Đã giao hàng</option>
				        	</select>
				        </td>			        
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<button type="button" class="btn btn-success">Cập nhật</button>
				        </td>
				      </tr>

				      <tr>
				        <td>123456</td>
				        <td>12/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td>
				        	<select class="form-control" style="width: 165px">
				        		<option>Đang xử lí</option>
				        		<option>Đang giao đi</option>
				        		<option>Giao hàng thất bại</option>
				        		<option>Đã giao hàng</option>
				        	</select>
				        </td>			        
				        <td class="tongtien">12,057,000</td>
				        <td>
				        	<button type="button" class="btn btn-success">Cập nhật</button>
				        </td>
				      </tr>
				    </tbody>
				</table>


@stop