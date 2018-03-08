<?php

function paypalpaymentspro_config() {
	$configarray = array("FriendlyName" => array("Type" => "System", "Value" => "PayPal Website Payments Pro"), "apiusername" => array("FriendlyName" => "API Username", "Type" => "text", "Size" => "20"), "apipassword" => array("FriendlyName" => "API Password", "Type" => "text", "Size" => "20"), "apisignature" => array("FriendlyName" => "API Signature", "Type" => "text", "Size" => "20"), "merchantid" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "20"), "transpw" => array("FriendlyName" => "Transaction PW", "Type" => "text", "Size" => "20"), "sandbox" => array("FriendlyName" => "Test Mode", "Type" => "yesno"));
	return $configarray;
}

function paypalpaymentspro_capture($params, $auth = "") {
	if ($params['sandbox']) {
		$url = "https://api-3t.sandbox.paypal.com/nvp";
	}
	else {
		$url = "https://api-3t.paypal.com/nvp";
	}

	$cardtype = $params['cardtype'];

	if ($cardtype == "American Express") {
		$cardtype = "Amex";
	}


	if ($cardtype == "Maestro" || $cardtype == "Solo") {
		$cardtype = "Mastercard";
	}

	$paymentvars = array();
	$paymentvars['METHOD'] = "DoDirectPayment";
	$paymentvars['VERSION'] = "3.0";
	$paymentvars['PWD'] = $params['apipassword'];
	$paymentvars['USER'] = $params['apiusername'];
	$paymentvars['SIGNATURE'] = $params['apisignature'];
	$paymentvars['PAYMENTACTION'] = "Sale";
	$paymentvars['AMT'] = $params['amount'];
	$paymentvars['CREDITCARDTYPE'] = $cardtype;
	$paymentvars['ACCT'] = $params['cardnum'];
	$paymentvars['EXPDATE'] = substr($params['cardexp'], 0, 2) . "20" . substr($params['cardexp'], 2, 2);
	$paymentvars['CVV2'] = $params['cccvv'];

	if ($params['cardissuenum']) {
		$paymentvars['ISSUENUMBER'] = $params['cardissuenum'];
	}


	if ($params['cardstart']) {
		$paymentvars['STARTDATE'] = substr($params['cardstart'], 0, 2) . "20" . substr($params['cardstart'], 2, 2);
	}

	$paymentvars['FIRSTNAME'] = $params['firstname'];
	$paymentvars['LASTNAME'] = $params['lastname'];
	$paymentvars['STREET'] = $params['address1'];
	$paymentvars['CITY'] = $params['city'];
	$paymentvars['STATE'] = $params['state'];
	$paymentvars['ZIP'] = $params['postcode'];
	$paymentvars['COUNTRYCODE'] = $params['country'];
	$paymentvars['CURRENCYCODE'] = $params['currency'];
	$paymentvars['INVNUM'] = $params['invoiceid'];

	if (is_array($auth)) {
		$paymentvars['VERSION'] = "59.0";
		$paymentvars['AUTHSTATUS3DS'] = $auth['paresstatus'];
		$paymentvars['MPIVENDOR3DS'] = "Y";
		$paymentvars['CAVV'] = $auth['cavv'];
		$paymentvars['ECI3DS'] = $auth['eciflag'];
		$paymentvars['XID'] = $auth['xid'];
	}

	$response = curlCall($url, $paymentvars);
	$resArray = paypalpaymentspro_deformatNVP($response);
	$ack = strtoupper($resArray['ACK']);

	if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
		return array("status" => "success", "transid" => $resArray['TRANSACTIONID'], "rawdata" => $resArray);
	}

	return array("status" => "declined", "rawdata" => $resArray);
}

function paypalpaymentspro_refund($params) {
	if ($params['sandbox']) {
		$url = "https://api-3t.sandbox.paypal.com/nvp";
	}
	else {
		$url = "https://api-3t.paypal.com/nvp";
	}

	$postfields = array();
	$postfields['VERSION'] = "3.0";
	$postfields['METHOD'] = "RefundTransaction";
	$postfields['USER'] = $params['apiusername'];
	$postfields['PWD'] = $params['apipassword'];
	$postfields['SIGNATURE'] = $params['apisignature'];
	$postfields['TRANSACTIONID'] = $params['transid'];
	$postfields['REFUNDTYPE'] = "Partial";
	$postfields['AMT'] = $params['amount'];
	$postfields['CURRENCYCODE'] = $params['currency'];
	$result = curlCall($url, $postfields);
	$resultsarray2 = explode("&", $result);
	foreach ($resultsarray2 as $line) {
		$line = explode("=", $line);
		$resultsarray[$line[0]] = urldecode($line[1]);
	}


	if (strtoupper($resultsarray['ACK']) == "SUCCESS") {
		return array("status" => "success", "rawdata" => $resultsarray, "transid" => $resultsarray['REFUNDTRANSACTIONID'], "fees" => $resultsarray['FEEREFUNDAMT']);
	}

	return array("status" => "Error", "rawdata" => $resultsarray);
}

function paypalpaymentspro_deformatNVP($nvpstr) {
	$intial = 0;
	$nvpArray = array();

	while (strlen($nvpstr)) {
		$keypos = strpos($nvpstr, "=");
		$valuepos = (strpos($nvpstr, "&") ? strpos($nvpstr, "&") : strlen($nvpstr));
		$keyval = substr($nvpstr, $intial, $keypos);
		$valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
		$nvpArray[urldecode($keyval)] = urldecode($valval);
		$nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
	}

	return $nvpArray;
}