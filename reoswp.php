<?php

	require_once('reoswp/includes/const.php');
	require_once('reoswp/includes/transaction.php'); 

	//                     Content based on user role                          //
// ======================================================================= //      

 require_once("templates/content-by-office.php");

// ======================================================================= //

?>




		<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head> 
		<title>REO Intranet</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content="REO" /> 
		<meta name="keywords" content="REO" />
		<link rel="stylesheet" type="text/css" href="css/sk_grid.css"> <!-- Docs. - http://getskeleton.com/ -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href="css/reo_05132015.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/vendor/parsley.min.js"></script>

		<title>REO Payment System</title>

		<link rel="stylesheet" type="text/css" href="reoswp/css/vendor/sk_grid.css" />
		<link rel="stylesheet" type="text/css" href="reoswp/css/main.css" />
		<script type="text/javascript" src="https://checkout.forte.net/v1/js"> </script>

	</head>

	<body>

	  	<!-- REO Header Template      
 		============================= -->
  		<?php require_once("templates/reo_header_05132015.html") ?>

		<div class="i_container">

		
			<div class="sk-container">

				<h1> REO Online Payment </h1>

				<div class="pay-flash-message"> <!-- When transaction is complete user will see flash message --> </div>


				<section class="pay_category">

					<h2 class="pay-section-header"> Quick Pay </h2>


					<p class="pay-section-description">
						Use this option to make a payment on account. 
						Enter the AMOUNT DUE, as shown on the Real Estate One Invoice/Statement, in the box below and click the Pay Now button. 
						Additionally, payments greater than the amount due are also accepted (pay in advance, carry a credit balance, and not worry about due dates, late fees and interest). 
						See additional terms and conditions below. 
					</p>


					<div class="row">

						<div class="twelve columns">

							<div class="pay-content-box">
								<!-- Pay Now -->
								<h3> Quick Pay </h3>
								<h3> [ Enter amount in checkout ] </h3>


								<button api_login_id="<?php echo APIKEY ?>"
									method="sale"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									version_number="1.0"
									test_field=""
									utc_time="<?php echo $quick_pay->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $quick_pay->create_signature() ?>"
									callback="oncallback_sale"
									total_amount=""
									order_number="<?php echo $quick_pay->order_number ?>">
								    <span>Pay Now</span> 
								</button>

							</div>

						</div>

					</div>

				</section>



				<section class="pay_category">

					<h2 class="pay-section-header"> Schedule Pay - Monthly </h2>

					<p class="pay-section-description">
						Why not take advantage of our convenient auto pay service?
						Select one of the options below and have the amount automatically deducted each month.
						Charges will recur approximately every 30 days from the date you sign up.  See additional terms and conditions below.
					</p>

					<div class="row">
							<!-- Subscribe -->
						<div class="one-third column">

							<div class="pay-content-box">

								<h3> Service Pack 1 </h3>

								<h3> $72.00<span>&#47;mo</span> </h3>

								<ul>
									<li> Tech Services </li>
									<li> Legal Defense </li>
								</ul>

								<!-- ====================== PAYMENT BUTTON ======================== -->


								<button api_login_id="<?php echo APIKEY ?>"
									method="schedule"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									save_token="true"
									customer_token=""
									payment_token=""
									version_number="1.0"
									utc_time="<?php echo $plan_basic->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $plan_basic->create_signature() ?>"
									callback="oncallback_sale"
									total_amount="<?php echo $plan_basic->total_amount ?>"
									schedule_start_date="<?php echo $schedule_begin ?>"
									schedule_frequency="monthly"
									schedule_continuous="true"
									order_number="<?php echo $plan_basic->order_number ?>" >
								    <span> Subscribe </span> 
								</button>


							<!-- ====================== PAYMENT BUTTON ======================== -->

							</div>

						</div>


						<div class="one-third column">

						
							<!-- Subscribe -->
							<div class="pay-content-box">

								<h3> Service Pack 2</h3>

								<h3> $99.00<span>&#47;mo</span> </h3>

								<ul>
									<li> Tech Services </li>
									<li> Legal Defense </li>
									<li> Realtor.com </li>
								</ul>


								<button api_login_id="<?php echo APIKEY ?>"
									method="schedule"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									save_token="true"
									customer_token=""
									payment_token=""
									version_number="1.0"
									utc_time="<?php echo $plan_premium->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $plan_premium->create_signature() ?>"
									callback="oncallback_sale"
									total_amount="<?php echo $plan_premium->total_amount ?>"
									schedule_start_date="<?php echo $schedule_begin ?>"
									schedule_frequency="monthly"
									schedule_continuous="true"
									order_number="<?php echo $plan_premium->order_number ?>" >
								    <span> Subscribe </span> 
							    </button>

							</div>
						</div>


						<div class="one-third column">

							<div class="pay-content-box">

								<h3> Custom Monthly Payment </h3>
								<h3> [ Enter amount in checkout ] </h3>


								<button api_login_id="<?php echo APIKEY ?>"
									method="schedule"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									save_token="true"
									customer_token=""
									payment_token=""
									version_number="1.0"
									utc_time="<?php echo $plan_custom->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $plan_custom->create_signature() ?>"
									callback="oncallback_schedule"
									total_amount=""
									schedule_start_date="<?php echo $schedule_begin ?>"
									schedule_frequency="monthly"
									schedule_continuous="true"
									order_number="<?php echo $plan_custom->order_number ?>">
								    <span> Subscribe </span>
								</button>

							</div>

						</div>

					</div> <!-- row end -->

				</section>


				<section class="pay_category">

					<h2 class="pay-section-header">  Annual Payment - Best Offer </h2>

					<p class="pay-section-description">
						Receive 12 months of service for the price of 11.  If your account is current and you have the resources to pay a year in advance, why not take advantage of this option?
						See terms and conditions below. We have recently changed the options below. 
						If you experience problems, please contact Joshua Lowry at jlowry@realestateone.com or 248-208-2929
					</p>

					<div class="row">

						<div class="three columns">

						
							<div class="pay-content-box">

								<h3> Realtor.com </h3>

								<h3> 11 x $27 </h3>

								<button api_login_id="<?php echo APIKEY ?>"
									method="sale"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									version_number="1.0"
									utc_time="<?php echo $annual_realtor->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $annual_realtor->create_signature() ?>"
									callback="oncallback_sale"
									total_amount="<?php echo $annual_realtor->total_amount ?>"
									order_number="<?php echo $annual_realtor->order_number ?>">
								    <span> Pay Now </span> 


								</button>

							</div>

						</div>

						<div class="three columns">

							<div class="pay-content-box">

								<h3> Annual Tech Service </h3>

								<h3> 11 x $35 </h3>

								<button api_login_id="<?php echo APIKEY ?>"
									method="sale"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									version_number="1.0"
									utc_time="<?php echo $annual_tech->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $annual_tech->create_signature() ?>"
									callback="oncallback_sale"
									total_amount="<?php echo $annual_tech->total_amount ?>"
									order_number="<?php echo $annual_tech->order_number ?>" >
								    <span> Pay Now </span>
								</button>

							</div>

						</div>

						<div class="three columns">

							<div class="pay-content-box">

								<h3> Annual Legal Defense </h3>

								<h3> 11 x $37 </h3>

								<button api_login_id="<?php echo APIKEY ?>"
									method="sale"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									version_number="1.0"
									utc_time="<?php echo $annual_legal->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $annual_legal->create_signature() ?>"
									callback="oncallback_sale"
									total_amount="<?php echo $annual_legal->total_amount ?>"
									order_number="<?php echo $annual_legal->order_number ?>">
								    <span> Pay Now </span>
								</button>

							</div>

						</div>

						<div class="three columns">

							<div class="pay-content-box">

								<h3> Annual CMA </h3>

								<h3> 11 x $9.95 </h3>

								<button api_login_id="<?php echo APIKEY ?>"
									method="sale"
									billing_company_name_attr="hide"
									billing_street_line2_attr="hide"
									version_number="1.0"
									utc_time="<?php echo $annual_cma->utc_time ?>"
									hash_method="md5"
									signature="<?php echo $annual_cma->create_signature() ?>"
									callback="oncallback_sale"
									total_amount="<?php echo $annual_cma->total_amount ?>"
									order_number="<?php echo $annual_cma->order_number ?>">
								    <span> Pay Now </span>
								</button>

							</div>

						</div>

					</div>

					<p>
						* Note that third party charges (advertising, board bills, etc.) are not eligible for the annual pay discount. 
					</p>

				</section>

				<section class="pay_category" id="terms-section">

					<h2 class="pay-section-header"> Terms and Conditions </h2>

					<ol class="terms-conditions-list">
						<li> All payments are processed through an independent third party pay system (PayPal).  Accordingly, Real Estate One does not retain any confidential credit card information. </li>
						<li> Payments will be applied to REO Sales Associate's A/R when received from third party pay system (generally the same day). <strong> Payments received by 3:00 p.m. Monday - Friday will be applied the same day. Payments received after 3:00 p.m. Monday - Friday or on weekends or holidays will be applied the following business day. </strong> </li>
						<li> Auto pays will occur on the same day each month. For example: if the first payment is setup on the 10th, all future auto pays will occur on the 10th. Accordingly, auto pays should be set up on the 1st through the 28th so that the payment is applied prior to the last business day of the month. Please note that Sales Associates may cancel the auto pay service at any time, through the PayPal website. </li>
						<li> Late fees and interest will be charged to past due accounts in accordance with Company policy.  While auto pay may reduce the risk of becoming past due, Sales Associates are responsible for reviewing monthly statements and ensuring that the account is paid current.  Real Estate One is not responsible for rejected credit card payments, NSF fees, or other costs. </li>
						<li> Any accounts receivable balance will be deducted at the time a commission check is issued, in accordance with Company policy, regardless of a scheduled auto pay later in the month.  This may result in a credit balance.  Any resulting credit balance will be refunded to Agents' Paypal account the same day (except weekends and holidays, when refund will occur on the next business day.) </li>
						<li> <strong> Annual payments are non-refundable </strong>, however the service is guaranteed for one year and not subject to any price increases. </li>
					</ol>

				</section>

			</div> <!-- Skeleton Container End -->

		</div>

    <div id="footer">
      <?php include('templates/footer.html'); ?>
    </div>

	</body>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"> </script>
	<script type="text/javascript" src="reoswp/js/app.js"> </script>

</html>