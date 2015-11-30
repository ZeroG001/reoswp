function oncallback_sale(response) {
			
				console.log( event.data );
				message = JSON.parse( response.data );

				if ( message.event === "abort" ) {
					// Alert div element shows how the event went. Then closes
					// $('.pay-flash-message').attr('class','pay-flash-message');
					$('.pay-flash-message').css('display', 'inline');
					$('.pay-flash-message').addClass('flash-message-notice');
					$('.pay-flash-message').text('Transaction Canceled');

					// Fancy Fade Animation
					setTimeout(function(){
						$('.pay-flash-message').css("opacity", "1");
					},150);

					setTimeout(function(){
						$('.pay-flash-message').css("opacity", "0");
					}, 4000);

					setTimeout(function(){
						$('.pay-flash-message').css("display", "none");
					}, 5000);

				}

				if ( message.event === "success" ) {

					// Alert div element shows how the event went. Then closes
					// $('.pay-flash-message').attr('class', 'pay-flash-message');
					$('.pay-flash-message').css('display', 'inline');
					$('.pay-flash-message').addClass('flash-message-success');
					$('.pay-flash-message').html('<img src="img/checkmark_green.png" alt="success" /> <p> Thank You - Payment has been sent </p>');

					// Fancy Fade Animation
					setTimeout(function(){
						$('.pay-flash-message').css("opacity", "1");
					},150);

					setTimeout(function(){
						$('.pay-flash-message').css("opacity", "0");
					}, 4000);

					setTimeout(function(){
						$('.pay-flash-message').css("display", "none");
					}, 5000);

				}

		} //oncallback_sale End

		function oncallback_schedule(response) {
			console.log(response);
		}

(function($) {

	// ----------- Mini Validation ------------- //
	// Ensures the users are actually entering numbers

	var validate = {
		"paynumFormat" : /\d{5}/i,
		"paynumber" : function(string) {
				//Ensure that we deal with a string
				string = string.toString();
				return string.match(this.paynumFormat) ? true : false;
		},

		"licenseFormat" : /\d{6}/i,
		"license_number" : function(string) {
			//Convert input to string 
			string = string.toString();
			return string.match(this.licenseFormat) ? true : false;
		},

		"enableButton" : function() {
			$('.swp-modal-button').attr('disabled', false);
			$('.swp-modal-button').css('cursor', 'pointer');
		},

		"disableButton" : function() {
			$('.swp-modal-button').attr('disabled', true);
			$('.swp-modal-button').css('cursor', 'not-allowed');
		}


	}


// ------------------- Payment Modal ------------------------



// ---- Modal Open ----
$('.swp-modal-open').click(function(){
	$(this).next('.swp-modal-popup').addClass('fade-in');
});


// ---- Modal Close ---
$('.swp-modal_close').click(function(){
	$('.swp-modal-popup').removeClass("fade-in");

	// Clear all form fields
	$('.modal-input-field.xdata_1').val("");
	$('.modal-input-field.xdata_2').val("");
	$('.modal-input-field.xdata_3').val("");

	//Disabled the Buy now button
	$('.swp-modal-button').attr('disabled', true);
	$('.swp-modal-button').css('cursor','not-allowed');
});

// ---- Modal Next Step ----
// When the next or buy button is clicked. Forte's modal shows
// Clean up the form before switching over
$('.swp-modal-button').click(function(){

	$('.swp-modal-popup').removeClass("fade-in");

	$('.swp-modal-button').attr('disabled', true);
	$('.swp-modal-button').css('cursor','not-allowed');
	$('.modal-input-field.xdata_1').val("");
	$('.modal-input-field.xdata_2').val("");
	$('.modal-input-field.xdata_3').val("");
});


// --- Modal Validation ----
// When you enter text in modal popup, that info is carried over to the forte button
$('.modal-input-field.xdata_1').one('focus', function() {

	$(this).keyup(function( e ) {

		$('.swp-modal-button').attr('xdata_1', $(this).val());

		if(validate.paynumber($(this).next('.modal-input-field.xdata_2').val()) && validate.license_number($(this).val()) ) {

			validate.enableButton();
			
		} else {
			validate.disableButton();
		}

		

	});

});


$('.modal-input-field.xdata_2').one('focus', function() {

	$(this).keyup(function( e ) {

		$('.swp-modal-button').attr('xdata_2', $(this).val());

		if(validate.paynumber($(this).val()) && validate.license_number($(this).prev('.modal-input-field.xdata_1').val()) ) {

			validate.enableButton();
			
		} else {
			validate.disableButton();
		}

		
	});

});

$('.modal-input-field.xdata_3').keyup(function(e) {
	$('.swp-modal-button').attr('xdata_3', $(this).val());
});


//----------------------------------------------------

})(jQuery)