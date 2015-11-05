<?php
require_once('const.php');



class Transaction {

	public $sale_type;
	public $utc_time;
	public $method;
	public $version_number;
	public $total_amount;
	public $order_number;
	public $customer_token;
	public $paymethod_token;


    public function hmac ($key, $data) {
	// RFC 2104 HMAC implementation for php.
	// Creates an md5 HMAC.
	// Eliminates the need to install mhash to compute a HMAC
	// Hacked by Lance Rushing

	$b = 64; // byte length for md5
	if (strlen($key) > $b) {
	$key = pack("H*",md5($key));
	}
	$key = str_pad($key, $b, chr(0x00));
	$ipad = str_pad('', $b, chr(0x36));
	$opad = str_pad('', $b, chr(0x5c));
	$k_ipad = $key ^ $ipad ;
	$k_opad = $key ^ $opad;

	return md5($k_opad . pack("H*",md5($k_ipad . $data)));
	}
	



	public function __construct($total_amount = "", $method = "sale", $order_number) {

		$unixtime = strtotime(gmdate('Y-m-d H:i:s'));
		$millitime = microtime(true) * 1000;
		$this->utc_time = number_format(($millitime * 10000) + 621355968000000000 , 0, '.', '');

		$this->total_amount = $total_amount;
		$this->method = $method;
		$this->order_number = $order_number;
	}

	public function create_signature() {


		# FOR ONE-TIME TRANSACTIONS
		if($this->method == "sale") {

			$sale_signature = Array(
					"api_login_id" => APIKEY,
					"method" => "sale",
					"version_number" => "1.0",
					"total_amount" => $this->total_amount,
					"utc_time" => $this->utc_time,
					"order_number" => $this->order_number,
					"customer_token" => "",
					"paymethod_token" => ""
				);


			$sale_signature  = implode("|", $sale_signature);
			$hmac_hash  = $this->hmac(TKEY, $sale_signature); # CREATE SIGNATURE FROM STRING 
			return $hmac_hash;
		}

		# FOR RECURRING TRANSACTIONS
		elseif ($this->method == "schedule") {
			
			$schedule_signature = Array(
				"api_login_id" => APIKEY,
				"method" => "schedule",
				"version_number" => "1.0",
				"total_amount" => $this->total_amount,
				"utc_time" => $this->utc_time,
				"order_number" => $this->order_number,
				"customer_token" => "",
				"paymethod_token" => ""
			);

			$schedule_signature = implode("|", $schedule_signature);
			$hmac_hash = $this->hmac(TKEY, $schedule_signature); # CREATE SIGNATURE FROM STRING 
			return $hmac_hash;

		}

		else {
			return "Invalid Transaction Type - Please use sale or schedule";
		}

	} 



}

class ScheduledTransaction extends Transaction {
 # For this new class you can only selected certain time periods. Weekly, Bi-Weekly and Monthly. For me I can override and say in the next minute
}


# =============== # Transaction buttons # ================= #

$quick_pay = new Transaction("", "sale", "A1234");
$annual_realtor = new Transaction("297.00", "sale", "A1238");
$annual_tech = new Transaction("385.00", "sale", "A1239");
$annual_legal = new Transaction("407.00", "sale", "A1240");
$annual_cma = new Transaction("109.45", "sale", "A1241");

$plan_basic = new Transaction("72.00", "schedule", "A1235");
$plan_premium = new Transaction("99.00", "schedule", "A1236");
$plan_custom = new Transaction("", "schedule", "A1237");

$schedule_begin = gmdate("m/d/Y", strtotime("today"));


# =================== # End # ===================== #







?>