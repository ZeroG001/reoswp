function oncallback_sale(response) {
			window.onmessage = function(event){
				console.log(event.data);
				message = JSON.parse(event.data);

				if (message.event === "abort" ) {
					// Alert div element shows how the event went. Then closes
					$('.pay-flash-message').attr('class','pay-flash-message');
					$('.pay-flash-message').addClass('flash-message-notice');
					$('.pay-flash-message').text('Transaction Canceled');

					$('.pay-flash-message').css("opacity", "1");


					setTimeout(function(){
						$('.pay-flash-message').css("opacity", "0");
						
					}, 4000);

				}

				if (message.event === "success" ) {

					// Alert div element shows how the event went. Then closes
					$('.pay-flash-message').attr('class', 'pay-flash-message');
					$('.pay-flash-message').addClass('flash-message-success');
					$('.pay-flash-message').text('Thank You - Payment has been sent');

					$('.pay-flash-message').css("opacity", "1");


					setTimeout(function(){
						$('.pay-flash-message').css("opacity", "0");
						
					}, 4000);

				}

			}
		}

		function oncallback_schedule(response) {
			console.log(response);
		}

(function($) {


// ------------------- Payment Modal ------------------------
// Close modal when finished

// Each modal popup is going to have its own id
$('.swp-modal_close').click(function(){
	$('.swp-modal-popup').removeClass("fade-in");
});


// Use CSS to display and close the
// When Clicked. The modal next to the button is opened
$('.swp-modal-open').click(function(){
	$(this).next('.swp-modal-popup').addClass('fade-in');
});


// When the next button is clicked the payment page shows up.
$('.swp-modal-button').click(function(){
	$('.swp-modal-popup').removeClass("fade-in");
});


//----------------------------------------------------





})(jQuery)