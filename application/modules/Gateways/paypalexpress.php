<?php


function paypalexpress_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "PayPal Express Checkout" ), "apiusername" => array( "FriendlyName" => "API Username", "Type" => "text", "Size" => "50", "Description" => "" ), "apipassword" => array( "FriendlyName" => "API Password", "Type" => "text", "Size" => "30" ), "apisignature" => array( "FriendlyName" => "API Signature", "Type" => "text", "Size" => "75" ), "sandbox" => array( "FriendlyName" => "Sandbox", "Type" => "yesno", "Description" => "Tick to enable test mode" ) );
	return $configarray;
}


function paypalexpress_link($params) {

		$postfields = array();
		$postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";
		$postfields['PAYMENTREQUEST_0_AMT'] = $params['amount'];
		$postfields['PAYMENTREQUEST_0_CURRENCYCODE'] = $params['currency'];
		$postfields['PAYMENTREQUEST_0_CUSTOM'] = $params['invoiceid'];
		$postfields['PAYMENTREQUEST_0_DESC'] = "This is description";
		$postfields['L_PAYMENTREQUEST_0_AMT0'] = $params['amount'];
		$postfields['L_PAYMENTREQUEST_0_NAME0'] = $params['description'];
		$postfields['L_PAYMENTREQUEST_0_QTY0'] = "1";
		$postfields['RETURNURL'] = base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref'];
		$postfields['CANCELURL'] = base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref'];
		$results = paypalexpress_api_call( $params, "SetExpressCheckout", $postfields );
		$ack = strtoupper( $results['ACK'] );

		if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$token = $results['TOKEN'];
			$payerid = $results['PayerID'];
		/*	$_SESSION['paypalexpress']['token'] = $token;
			$_SESSION['paypalexpress']['paymentAmount'] = $params['amount'];
			$_SESSION['paypalexpress']['invoiceid'] = $params['invoiceid'];*/

			$isMobile = isMobile();
			$target = "";
			if($isMobile){
				$target = "target = '_blank'";
			}

			$PAYPAL_URL = ($params['sandbox'] ? "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=" : "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");
				$code = "<form action=\"" . $PAYPAL_URL . $token . "\" method=\"post\" " . $target . ">
<input type=\"hidden\" name=\"paypalcheckout\" value=\"1\" />
<input type=\"image\" class=\"paybtn\" name=\"submit\" src=\"https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif\" border=\"0\" align=\"top\" alt=\"Check out with PayPal\" />
</form>";

			return $code;
		}
		else {
			
			return print_r($results);
		}



}


function paypalexpress_orderformcheckout($params) {
	$orderid = get_query_val( "tblorders", "id", array( "invoiceid" => $params['invoiceid'] ) );
	update_query( "tblhosting", array( "paymentmethod" => "paypal" ), array( "orderid" => $orderid, "paymentmethod" => "paypalexpress" ) );
	update_query( "tblhostingaddons", array( "paymentmethod" => "paypal" ), array( "orderid" => $orderid, "paymentmethod" => "paypalexpress" ) );
	update_query( "tbldomains", array( "paymentmethod" => "paypal" ), array( "orderid" => $orderid, "paymentmethod" => "paypalexpress" ) );
	$finalPaymentAmount = $_SESSION['Payment_Amount'];
	$postfields = array();
	$postfields['TOKEN'] = $_SESSION['paypalexpress']['token'];
	$postfields['PAYERID'] = $_SESSION['paypalexpress']['payerid'];
	$postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = "SALE";
	$postfields['PAYMENTREQUEST_0_AMT'] = $params['amount'];
	$postfields['PAYMENTREQUEST_0_CURRENCYCODE'] = $params['currency'];
	$postfields['IPADDRESS'] = $_SERVER['SERVER_NAME'];
	$results = paypalexpress_api_call( $params, "DoExpressCheckoutPayment", $postfields );
	$ack = strtoupper( $results['ACK'] );

	if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
		$transactionId = $results['PAYMENTINFO_0_TRANSACTIONID'];
		$transactionType = $results['PAYMENTINFO_0_TRANSACTIONTYPE'];
		$paymentType = $results['PAYMENTINFO_0_PAYMENTTYPE'];
		$orderTime = $results['PAYMENTINFO_0_ORDERTIME'];
		$amt = $results['PAYMENTINFO_0_AMT'];
		$currencyCode = $results['PAYMENTINFO_0_CURRENCYCODE'];
		$feeAmt = $results['PAYMENTINFO_0_FEEAMT'];
		$settleAmt = $results['PAYMENTINFO_0_SETTLEAMT'];
		$taxAmt = $results['PAYMENTINFO_0_TAXAMT'];
		$exchangeRate = $results['PAYMENTINFO_0_EXCHANGERATE'];
		$paymentStatus = $results['PAYMENTINFO_0_PAYMENTSTATUS'];

		if ($paymentStatus == "Completed") {
			return array( "status" => "success", "transid" => $transactionId, "fee" => $feeAmt, "rawdata" => $results );
		}


		if ($paymentStatus == "Pending") {
			return array( "status" => "payment pending", "rawdata" => $results );
		}

		return array( "status" => "invalid status", "rawdata" => $results );
	}

	return array( "status" => "error", "rawdata" => $results );
}


function paypalexpress_api_call($params, $methodName, $postfields) {

	$API_UserName = $params['apiusername'];
	$API_Password = $params['apipassword'];
	$API_Signature = $params['apisignature'];
	$API_Endpoint = ($params['sandbox'] ? "https://api-3t.sandbox.paypal.com/nvp" : "https://api-3t.paypal.com/nvp");
	$postfields['METHOD'] = $methodName;
	$postfields['VERSION'] = 64;//$version;
	$postfields['PWD'] = $API_Password;
	$postfields['USER'] = $API_UserName;
	$postfields['SIGNATURE'] = $API_Signature;
	

	$nvpreq = "";
	foreach ($postfields as $k => $v) {
		$nvpreq .= "" . $k . "=" . urlencode( $v ) . "&";
	}

	
	//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);

		//convrting NVPResponse to an Associative Array
		$nvpResArray = paypalexpress_deformatNVP($response);
		$nvpReqArray = paypalexpress_deformatNVP($nvpreq);
		//$_SESSION['nvpReqArray'] = $nvpReqArray;

		/*if (curl_errno($ch)) 
		{
			// moving to display page to display curl errors
			  $_SESSION['curl_error_no']=curl_errno($ch) ;
			  $_SESSION['curl_error_msg']=curl_error($ch);

			  //Execute the Error handling module to display errors. 
		} 
		else 
		{
			 //closing the curl
		  	curl_close($ch);
		}*/

		//return $response;
		//return $postfields;
	return paypalexpress_deformatNVP( $response );
	//return $API_UserName;
}


function paypalexpress_deformatNVP($nvpstr) {
	$intial=0;
	 	$nvpArray = array();

		while(strlen($nvpstr))
		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
	     }
		return $nvpArray;
}

//function for verification of payment. It will be used in notify url
function paypalexpress_verifypayment($params, $extraFields = null){

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

	$postfields = array();
	if(empty($extraFields)){
	$postfields['TOKEN'] = $_SESSION['paypalexpress']['token'];	
}else{
	$postfields['TOKEN'] = $extraFields['token'];
}
	

	

	$results = paypalexpress_api_call( $params, "GetExpressCheckoutDetails", $postfields );
	$ack = strtoupper( $results['ACK'] );

	if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {


		$postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = "SALE";
		$postfields['PAYMENTREQUEST_0_AMT'] = $results['PAYMENTREQUEST_0_AMT'];
		$postfields['PAYMENTREQUEST_0_CURRENCYCODE'] = $results['PAYMENTREQUEST_0_CURRENCYCODE'];
		$postfields['IPADDRESS'] = $_SERVER['SERVER_NAME'];

			if(empty($extraFields)){
			$postfields['PAYERID'] = $results['PAYERID'];
			}else{
			$postfields['PAYERID'] = $extraFields['payerid'];
			}

		
		$results2 = paypalexpress_api_call( $params, "DoExpressCheckoutPayment", $postfields );
		$ack2 = strtoupper( $results2['ACK'] );
		
		if($ack2 == "SUCCESS" || $ack2 == "SUCCESSWITHWARNING"){

			$txn_id = $results2['PAYMENTINFO_0_TRANSACTIONID'];
			$transactionType = $results2['PAYMENTINFO_0_TRANSACTIONTYPE'];
			$paymentType = $results2['PAYMENTINFO_0_PAYMENTTYPE'];
			$orderTime = $results2['PAYMENTINFO_0_ORDERTIME'];
			$amt = $results2['PAYMENTINFO_0_AMT'];
			$currencyCode = $results2['PAYMENTINFO_0_CURRENCYCODE'];
			$feeAmt = $results2['PAYMENTINFO_0_FEEAMT'];
			$settleAmt = $results2['PAYMENTINFO_0_SETTLEAMT'];
			$taxAmt = $results2['PAYMENTINFO_0_TAXAMT'];
			$exchangeRate = $results2['PAYMENTINFO_0_EXCHANGERATE'];
			$paymentStatus = $results2['PAYMENTINFO_0_PAYMENTSTATUS'];
			$invoiceid = $params['invoiceid'];

			if ($paymentStatus == "Completed") {

			$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $amt,"transactionid" => $txn_id);
			return $result;
			}else{

				return $result;
			}

		}else{

			return $results2;

		}
	}else{
			$r = array("Error" => "GetExpressCheckoutDetails", "result" => $results);
			return $results;

		}


}

function isMobile(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	return TRUE;
}else{
	return FALSE;
}

}