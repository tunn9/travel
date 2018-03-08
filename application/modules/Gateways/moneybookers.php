<?php

function moneybookers_config() {
	global $CONFIG;

	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Skrill" ),
		"merchantemail" => array( "FriendlyName" => "Merchant Email", "Type" => "text", "Size" => "50","Description" => "The email address used to identify you to Skrill" ), 
		"secretword" => array( "FriendlyName" => "Secret Word", "Type" => "text", "Size" => "20","Description" => "Must match what is set in the Merchant Tools section of your Skrill Account"), 
		
		);
	return $configarray;
}

function moneybookers_link($params) {

	
	$languagecode = "EN";
	// <input type=\"hidden\" name=\"firstname\" value=\"" . $params['clientdetails']['firstname'] . "\">


	$code = "<form action=\"https://www.moneybookers.com/app/payment.pl\">
<input type=\"hidden\" name=\"pay_to_email\" value=\"" . $params['merchantemail'] . "\">
<input type=\"hidden\" name=\"language\" value=\"" . $languagecode . "\">
<input type=\"hidden\" name=\"amount\" value=\"" . $params['amount'] . "\">
<input type=\"hidden\" name=\"currency\" value=\"" . $params['currency'] . "\">
<input type=\"hidden\" name=\"detail1_description\" value=\"" . $params['description'] . "\">
<input type=\"hidden\" name=\"detail1_text\" value=\"" . $params['invoiceid'] . "\">
<input type=\"hidden\" name=\"return_url\" value=\"" .base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref']."\">
<input type=\"hidden\" name=\"cancel_url\" value=\"" .base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref']."\">
<input type=\"hidden\" name=\"status_url\" value=\""  . base_url(). "invoice/notifyUrl/moneybookers\">
<input type=\"hidden\" name=\"transaction_id\" value=\"" . $params['invoiceid'] . "\">
<input type=\"hidden\" name=\"merchant_fields\" value=\"platform\">

<input type=\"submit\" class=\"paybtn\" value=\"Pay Now\" />
</form>";
	return $code;
}


//function for verification of payment. It will be used in notify url
function moneybookers_verifypayment($params){

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

$transid = $_POST['mb_transaction_id'];
$merchant_id = $_POST['merchant_id'];
$mb_amount = $_POST['mb_amount'];
$amount = $_POST['amount'];
$mb_currency = $_POST['mb_currency'];
$currency = $_POST['currency'];
$invoiceid = $_POST['md5sig'];
//$md5sig = header("Status: 200 OK");
$status = $_POST['status'];

// if ($params['secretword']) {
// 	if (strtoupper(md5($merchant_id . $invoiceid . strtoupper(md5($params['secretword'])) . $mb_amount . $mb_currency . $status)) != $md5sig) {
// 		logTransaction("Moneybookers", $_REQUEST, "MD5 Signature Failure");
// 		exit();
// 	}
// }



if ($_POST['status'] == "2") {
$result = array("status" => "success","invoiceid" => $_POST['transaction_id'],"paid" => $amount,"transactionid" => $transid);

}




	return $result;

}