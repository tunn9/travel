<?php

function paypoint_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "PayPoint.net (SecPay)" ), "merchantid" => array( "FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "20" ), "remotepw" => array( "FriendlyName" => "Remote Password", "Type" => "text", "Size" => "30" ), "digestkey" => array( "FriendlyName" => "Digest Key", "Type" => "text", "Size" => "40" ), "testmode" => array( "FriendlyName" => "Test Mode", "Type" => "yesno" ) );
	return $configarray;
}


function paypoint_link($params) {
	$transid = $params['invoiceid'] . "-" . date( "Ymdhis" );
	
	$digest = md5( $transid . $params['amount'] . $params['remotepw'] );
	$code = "<form method=\"post\" action=\"https://www.secpay.com/java-bin/ValCard\">
<input type=\"hidden\" name=\"merchant\" value=\"" . $params['merchantid'] . "\" />
<input type=\"hidden\" name=\"trans_id\" value=\"" . $transid . "\" />
<input type=\"hidden\" name=\"amount\" value=\"" . $params['amount'] . "\" />
<input type=\"hidden\" name=\"currency\" value=\"" . $params['currency'] . "\" />
<input type=\"hidden\" name=\"repeat\" value=\"true\" />
<input type=\"hidden\" name=\"callback\" value=\""  . base_url(). "invoice/notifyUrl/paypoint\" />
<input type=\"hidden\" name=\"options\" value=\"cb_post=true,md_flds=trans_id:amount:callback\">
<input type=\"hidden\" name=\"digest\" value=\"" . $digest . "\" />";

	if ($params['testmode']) {
		$code .= "<input type=\"hidden\" name=\"test_status\" value=\"true\">";
	}

	$code .= "<input type=\"submit\" value=\"Pay Now\">
</form>";
	return $code;
}

//function for verification of payment. It will be used in notify url
function paypoint_verifypayment($params){

$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");


$transid = $_REQUEST['trans_id'];
$valid = $_REQUEST['valid'];
$authcode = $_REQUEST['auth_code'];
$amount = $_REQUEST['amount'];
$code = $_REQUEST['code'];
$teststatus = $_REQUEST['test_status'];
$hash = $_REQUEST['hash'];
$expiry = $_REQUEST['expiry'];
$card_no = $_REQUEST['card_no'];
$customer = $_REQUEST['customer'];
$invoiceid = explode("-", $transid);
$invoice = $invoiceid[0];

if ($params['secretword']) {
	$string_to_hash = "transid=" . $transid . "&amount=" . $amount . "&callback=" . base_url() . "invoice/notifyUrl/paypoint&" . $params['digestkey'];
	$check_key = md5($string_to_hash);

	if ($check_key != $hash) {
		$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "","msg" => "MD5 Hash Failure");
		
	}
}


if ($code == "A" && $valid) {
	
$result = array("status" => "success","invoiceid" => $invoice,"paid" => $amount,"transactionid" => $transid,"msg" => "success");

	}


return $result;

}