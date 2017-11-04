<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  	
	<script src="https://js.stripe.com/v2/"></script>


</head>
<body>

	<form action="demo" method="post" id="payment-form">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
	  <div id="card-errors"></div>

	  <div class="form-row">
	    <label>
	      <span>Card number</span>
	      <input type="text" size="20" data-stripe="number">
	    </label>
	  </div>

	  <div class="form-row">
	    <label>
	      <span>Expiration (MM/YY)</span>
	      <input type="text" size="2" data-stripe="exp_month">
	    </label>
	    <span> / </span>
	    <input type="text" size="2" data-stripe="exp_year">
	  </div>

	  <div class="form-row">
	    <label>
	      <span>CVC</span>
	      <input type="text" size="4" data-stripe="cvc">
	    </label>
	  </div>

	  <div class="form-row">
	    <label>
	      <span>Billing Zip</span>
	      <input type="text" size="6" data-stripe="address_zip">
	    </label>
	  </div>

	  <input type="submit" class="submit" value="Submit Payment">
	</form>




	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_LyJ4pVYJuAVnevX0lILvCMlG');

		var stripeResponseHandler = function(status, response) {
		  // Grab the form:
		  var form = document.getElementById('payment-form');

		  if (response.error) { // Problem! //Hiện lỗi ra
		    $('#card-errors').html(response.error.message);

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

		// Create a token when the form is submitted
		var form = document.getElementById('payment-form');
		form.addEventListener('submit', function(e) {
		  e.preventDefault();
		  Stripe.card.createToken(form, stripeResponseHandler);
		});
	</script>



</body>
</html>