<?php

if (!function_exists("tco_config")) {

	function tco_config() {
		
		$configarray = array("FriendlyName" => array("Type" => "System", "Value" => "2CheckOut"), "UsageNotes" => array("Type" => "System", "Value" => "For the automation to work, you need to enable INS Notifications inside your 2CheckOut account by going to Notifications > Global Settings > Global URL and entering the URL '" . base_url(). "invoice/notifyUrl/tco', enabling all notifications and clicking save"), "vendornumber" => array("FriendlyName" => "Vendor Account Number", "Type" => "text", "Size" => "10", "Description" => ""), "apiusername" => array("FriendlyName" => "API Username", "Type" => "text", "Size" => "20", "Description" => "Setup in Account > User Management section of 2CheckOut's Panel"), "apipassword" => array("FriendlyName" => "API Password", "Type" => "text", "Size" => "20", "Description" => ""), "secretword" => array("FriendlyName" => "Secret Word", "Type" => "text", "Size" => "15", "Description" => "Used to validate callbacks, found in Account > Site Management of 2CheckOut's Panel (must leave blank for demo mode testing)"),  "purchaseroutine" => array("FriendlyName" => "Purchase Routine", "Type" => "yesno", "Description" => "Tick to use 2CheckOut's New Cart Checkout Routine (Includes showing PayPal Option)"), "demomode" => array("FriendlyName" => "Demo Mode", "Type" => "yesno"));
		return $configarray;
	}

	function tco_link($params) {

		$code = "";

		
		if (!$params['purchaseroutine']) {
			$purchaseroutine = "s";
		}
		 // <input type=\"hidden\" name=\"x_First_Name\" value=\"" . $params['clientdetails']['firstname'] . "\">

		$code .= "<form action=\"https://www.2checkout.com/checkout/" . $purchaseroutine . "purchase\" method=\"post\">
    <input type=\"hidden\" name=\"x_login\" value=\"" . $params['vendornumber'] . "\">
    <input type=\"hidden\" name=\"x_invoice_num\" value=\"" . $params['invoiceid'] . "\">
    <input type=\"hidden\" name=\"x_amount\" value=\"" . $params['amount'] . "\">
    <input type=\"hidden\" name=\"tco_currency\" value=\"" . $params['currency'] . "\">
    <input type=\"hidden\" name=\"c_name\" value=\"" . $params['description'] . "\">
    <input type=\"hidden\" name=\"c_description\" value=\"" . $params['description'] . "\">
    <input type=\"hidden\" name=\"c_price\" value=\"" . $params['amount'] . "\">
    <input type=\"hidden\" name=\"c_tangible\" value=\"N\">
    <input type=\"hidden\" name=\"fixed\" value=\"Y\">
    <input type=\"hidden\" name=\"return_url\" value=\"" .base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref']."\">
    <input type=\"hidden\" name=\"x_receipt_link_url\" value=\""  . base_url(). "invoice/notifyUrl/tco\">";

		if ($params['demomode'] == "on") {
			$code .= "
    <input type=\"hidden\" name=\"demo\" value=\"Y\">";
		}

		$code .= "<input type=\"submit\" class=\"paybtn\" value=\"Pay Now\" />
    </form>";
		return $code;
	}


	//function for verification of payment. It will be used in notify url
function tco_verifypayment($params){

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

$string_to_hash = $params['secretword'] . $params['vendornumber'] . $_REQUEST['x_trans_id'] . $_REQUEST['x_amount'];
	$check_key = strtoupper(md5($string_to_hash));

	if ($check_key == $_REQUEST['x_MD5_Hash']){
		$result = array("status" => "success","invoiceid" => $_POST['x_invoice_num'],"paid" => $_REQUEST['x_amount'],"transactionid" => $_REQUEST['x_trans_id']);
	}

	return $result;

}



}