@extends('nguoiban.donhang')

@section('chitiet')

<h2>Đơn hàng mới</h2>
				<table id="table-donhang" class="table table-bordered table-hover">
				    <thead>
				      <tr>
				        <th>Mã ĐH</th>
				        <th>Ngày đặt</th>
				        <th>Ngày giao</th>
				        <th>Thông tin giao hàng</th>
				        <th>Tên sản phẩm</th>
				        <th>Hình thức thanh toán</th>
				        <th>Tình trạng</th>
				        <th>Tổng tiền</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <td class="madh">123456</td>
				        <td class="ngaydat">12/03/2017</td>
				        <td class="ngaygiao">18/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td class="tinhtrangdh">
				        	<label class="label label-warning">Đang xử lí</label>
				        </td>				        
				        <td class="tongtien">12,057,000</td>
				      </tr>
				      
				      <tr>
				        <td class="madh">123456</td>
				        <td class="ngaydat">12/03/2017</td>
				        <td class="ngaygiao">18/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td class="tinhtrangdh">
				        	<label class="label label-warning">Đang xử lí</label>
				        </td>			        
				        <td class="tongtien">12,057,000</td>
				      </tr>

				      <tr>
				        <td class="madh">123456</td>
				        <td class="ngaydat">12/03/2017</td>
				        <td class="ngaygiao">18/03/2017</td>
				        <td class="guiden">
				        	<label>Nguyễn Văn A</label><br> đường 3/2, phường Xuân Khánh, quận Ninh Kiều, Cần Thơ
				        	<br>0964873862
				        </td>
				        <td class="chitietdh">
				        	<label>Điện thoại samsung galaxy j7 32GB</label><br>1x12,075,000
				        	<br><label>Điện thoại samsung galaxy j7 32GB</label> <br> 1x12,075,000
				        </td>
				        <td class="httt">Thanh toán khi nhận hàng</td>
				        <td class="tinhtrangdh">
				        	<label class="label label-warning">Đang xử lí</label>
				        </td>			        
				        <td class="tongtien">12,057,000</td>
				      </tr>
				    </tbody>
				</table>

@stop