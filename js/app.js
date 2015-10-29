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

// Response returns certain codes based on how the transaction goes. 
// Error handle for these situations
// =============== PAYMENT DECLINED []
// =============== PAYMENT SUCCESS []
// =============== CONNECTION FAILURE []
// =============== INFORAMTION INVALID []
// Check the swp documentation for 