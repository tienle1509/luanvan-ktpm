<?php
	// if(!isset($_SESSION['tenkh'])){
	// 	header("Location: http://localhost/luanvan-ktpm/home");	
	// 	exit;
	// }	
?>


<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="icon" type="text/css" href="{{asset('public/img/icon.png')}}">
	<title>Hình thức thanh toán</title>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-hinhthucthanhtoan.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-theme.min.css')}}">

  	<!-- jQuery, Bootstrap JS -->
	<script type="text/javascript" src="{{asset('public/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap-select.min.js')}}"></script>
	

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">

	
</head>

<body>

	<div class="header">
		<div class="container container-header">
			<a href="{{asset('home')}}">
				<img src="{{asset('public/img/logo2.png')}}" alt="logoMobileStore">
			</a>
			<div class="text-right">
			    <div><span class="fa fa-question-circle"></span>&nbsp;19008088 (8h-21h hằng ngày)</div>
			</div>			
		</div>
	</div> <!-- end header -->


	<!-- Body -->
	<div class="container panel-step">
		<div class="step col-md-12 col-sm-12">
			<div class="col-md-4 col-sm-4 step1">
				<span class="badge">1</span>&nbsp;&nbsp;Thông tin giao hàng
			</div>			
			<div class="col-md-4 col-sm-4 step2"> 
				<span class="badge">2</span>&nbsp;&nbsp;Hình thức thanh toán
			</div>
			<div class="col-md-4 col-sm-4 step3">
				<span class="badge">3</span>&nbsp;&nbsp;Đặt hàng
			</div>
		</div>
	</div> <!-- end body -->


	<div class="body container">
		<div class="container" style="width: 500px; background-color: #DBECFF; padding: 20px 20px 40px 20px">
			<h2 class="text-center">Thanh toán trực tuyến</h2>


			<form action="{{url('thanhtoan-tructuyen')}}" method="post" id="payment-form" style="margin-top: 50px;">
			  <input type="hidden" name="_token" value="{{csrf_token()}}">

			  <div class="card-errors alert alert-danger hide" style="margin-top: -20px; margin-bottom: 20px;" ></div>

			  <div class="form-group">
			    <label>Mã số thẻ</label>
			    <input type="text" class="form-control" placeholder="Nhập mã số thẻ" data-stripe="number">
			  </div>

			  <div class="form-group">			    
			    <div class="row">
			    	<div class="col-md-6">
			    		<label>Tháng hết hạn</label>
			    		<input type="text" class="form-control" style="display: block;"  placeholder="MM" data-stripe="exp_month">
			    	</div>
			    	<div class="col-md-6">
			    		<label>Năm hết hạn</label>
			    		<input type="text" class="form-control"  placeholder="YYYY" data-stripe="exp_year">
			    	</div>
			    </div>			    
			  </div>

			  <div class="form-group">
			    <label>CVC</label>
			    <input type="text" class="form-control" placeholder="Nhập mã bảo mật" data-stripe="cvc">
			  </div>

			  <button style="margin-top: 50px; margin-left: 120px;" type="submit" class="btn btn-danger btn-lg col-md-6">Thanh toán</button>
			</form>
		</div>
	</div>

	<script src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_FnxMb1WwkEZVES0VxIw7kO4j');
		var stripeResponseHandler = function(status, response) {
		  // Grab the form:
		  var form = document.getElementById('payment-form');

		  if (response.error) { // Problem!
		    if(response.error.message == "Could not find payment information"){
		    	$('.card-errors').removeClass('hide');
				$('.card-errors').html('Vui lòng điền thông tin thẻ');
			}
			if(response.error.code == "invalid_expiry_year"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Năm hết hạn của thẻ không hợp lệ');
			}
			if(response.error.code == "invalid_expiry_month"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Tháng hết hạn của thẻ không hợp lệ');
			}
			if(response.error.code == "invalid_cvc"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Mã bảo mật của thẻ không hợp lệ');
			}			
			if(response.error.code == "incorrect_number"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Số thẻ không hợp lệ');
			}	
			if(response.error.code == "expired_card"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Thẻ hết hạn');
			}   
			if(response.error.code == "incorrect_cvc"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Mã bảo mật không chính xác');
			}
		  } else { // Token was created!
		    // Get the token ID:
		    var token = response.id;

		    // Insert the token ID into the form so it gets submitted to the server
		    var form = document.getElementById('payment-form');
		    var hiddenInput = document.createElement('input');
		    hiddenInput.setAttribute('type', 'hidden');
		    hiddenInput.setAttribute('name', 'stripeToken');
		    hiddenInput.setAttribute('value', token);
		    form.appendChild(hiddenInput);

		    // Submit the form
		    form.submit();
		  }
		};

		var form = document.getElementById('payment-form');
		form.addEventListener('change', function(event) {
		  var displayError = document.getElementById('card-errors');
		  if (event.error) {
		    if(response.error.message == "Could not find payment information"){
		    	$('.card-errors').removeClass('hide');
				$('.card-errors').html('Vui lòng điền thông tin thẻ');
			}
			if(response.error.code == "invalid_expiry_year"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Năm hết hạn của thẻ không hợp lệ');
			}
			if(response.error.code == "invalid_expiry_month"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Tháng hết hạn của thẻ không hợp lệ');
			}
			if(response.error.code == "invalid_cvc"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Mã bảo mật của thẻ không hợp lệ');
			}			
			if(response.error.code == "incorrect_number"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Số thẻ không hợp lệ');
			}	
			if(response.error.code == "expired_card"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Thẻ hết hạn');
			}   
			if(response.error.code == "incorrect_cvc"){
				$('.card-errors').removeClass('hide');
				$('.card-errors').html('Mã bảo mật không chính xác');
			}
		  } else {
		    $('.card-errors').addClass('hide');
		  }
		});

		// Create a token when the form is submitted
		var form = document.getElementById('payment-form');
		form.addEventListener('submit', function(e) {
		  e.preventDefault();
		  Stripe.card.createToken(form, stripeResponseHandler);
		});
	</script>


</body>
</html>