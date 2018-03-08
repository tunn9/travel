<?php

require_once(dirname(__FILE__) . '/paytm-sdk/encdec_paytm.php');

function paytm_config(){
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"Paytm"),
	 "merchant_id" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "20", ),
     "merchant_key" => array("FriendlyName" => "Merchant Key", "Type" => "text", "Size" => "16", ),
     "environment" => array("FriendlyName" => "Environment", "Type" => "dropdown", "Options" =>"TEST,LIVE", "Description" => "TEST or LIVE", ),
	 "website" => array("FriendlyName" => "Website name", "Type" => "text", "Size" => "20", ),
	 "industry_type" => array("FriendlyName" => "Industry Name", "Type" => "text", "Size" => "20", ),
	);
	return $configarray;
}

function paytm_link($params) {

	$merchant_id = $params['merchant_id'];
	$secret_key=$params['merchant_key'];
	$order_id = $params['invoiceid'];
	$website= $params['website'];
	$industry_type= $params['industry_type'];
	$channel_id="WEB";
	$gateway_mode = $params['environment'];
	$amount = $params['amount'];
	$email = $params['clientdetails']['email'];


	$post_variables = Array(
          "MID" => $merchant_id,
          "ORDER_ID" => $order_id ,
          "CUST_ID" => $email,
          "TXN_AMOUNT" => $amount,
          "CHANNEL_ID" => $channel_id,
          "INDUSTRY_TYPE_ID" => $industry_type,
          "WEBSITE" => $website
          );
	$checksum = getChecksumFromArray($post_variables, $secret_key);

	$companyname = 'paytm';
	$pg_url = "https://pguat.paytm.com/oltp-web/processTransaction";
	if($gateway_mode == 'LIVE'){
		$pg_url = "https://secure.paytm.in/oltp-web/processTransaction";
	}
	$code = '
	<form method="post" action='. $pg_url .'>
		<input type="hidden" name="MID" value="'.  $merchant_id . '"/>
	    <input type="hidden" name="ORDER_ID" value="'. $order_id . '"/>
	    <input type="hidden" name="WEBSITE" value="'. $website . '"/>
	    <input type="hidden" name="INDUSTRY_TYPE_ID" value="'. $industry_type . '"/>
	    <input type="hidden" name="CHANNEL_ID" value="'. $channel_id . '"/>
	    <input type="hidden" name="TXN_AMOUNT" value="'. $amount . '"/>
	    <input type="hidden" name="CUST_ID" value="'. $email . '"/>
	    <input type="hidden" name="txnDate" value="'. date("Y-m-d H:i:s") . '"/>
	    <input type="hidden" name="CHECKSUMHASH" value="'. $checksum . '"/>
			<input type="submit" value="Pay with Paytm" />
	</form>';
	return $code;
}
