<?php

function payu_config(){
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"Payu"),
     "MerchantKey" => array("FriendlyName" => "MerchantKey", "Type" => "text", "Size" => "20", ),
     "SALT" => array("FriendlyName" => "SALT", "Type" => "text", "Size" => "20",),
     "Mode" => array("FriendlyName" => "mode", "Type" => "text", "Description" => "TEST or LIVE", ),

    );
	return $configarray;
}

function payu_link($params) {

    // Gateway Specific Variables
	$key = $params['MerchantKey'];
	$SALT = $params['SALT'];
	$gatewaymode = $params['mode'];


	// Invoice Variables
	$txnid = "invoice_".$params['invoiceid'];
	$productinfo = $params["description"];
    $amount = $params['amount'];

	// Client Variables
	$firstname = $params['firstname'];
	$lastname = $params['lastname'];
	$email = $params['email'];
	$address1 = $params['address1'];
	$city = $params['city'];
	$state = $params['state'];
	$postcode = $params['postcode'];
	$country = $params['country'];
	$phone = $params['phonenumber'];
    $hashSequence = $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||';

    $hashSequence .= $SALT;
    $hash = strtolower(hash('sha512', $hashSequence));
	# System Variables
	$companyname = 'payu';
	$systemurl = $params['systemurl'];
    $PostURL = "https://test.payu.in/_payment";
    if($gatewaymode == 'LIVE')
      $PostURL = "https://secure.payu.in/_payment";
	// Enter your code submit to the Payu gateway...

	$code = '<form method="post" action='.$PostURL.' name="frmTransaction" id="frmTransaction" >
<input type="hidden" name="key" value="'.$key.'" />
<input type="hidden" name="productinfo" value="'.$productinfo.'" />
<input type="hidden" name="txnid" value="'.$txnid.'" />
<input type="hidden" name="firstname" value="'.$firstname.'" />
<input type="hidden" name="address1" value="'.$address1.'" />
<input type="hidden" name="city" value="'.$city.'" />
<input type="hidden" name="state" value="'.$state.'" />
<input type="hidden" name="country" value="'.$country.'" />
<input type="hidden" name="postal_code" value="'.$postcode.'" />
<input type="hidden" name="email" value="'.$email.'" />
<input type="hidden" name="phone" value="'.$phone.'" />
<input type="hidden" name="amount" value="'.$amount.'" />
<input type="hidden" name="hash" value="'.$hash.'" />
<input type="hidden" name="surl" value="'.base_url(). "invoice/notifyUrl/payu".'" />
<input type="hidden" name="furl" value="'.base_url(). "invoice/notifyUrl/payu".'" />
<input type="submit" value="Pay Now" />
</form>';

	return $code;


}

//function for verification of payment. It will be used in notify url
function payu_verifypayment($params){

 /* Start response verification */
 $response = $_POST;
$status=$response["status"];
$firstname=$response["firstname"];
$amount= $response["amount"];
$txnid =$response["txnid"];
$posted_hash = $response["hash"];
$key = $response["key"];
$productinfo = $response["productinfo"];
$email = $response["email"];
$transactionid = $response["mihpayid"];
$salt=$params["SALT"];
$tid = explode("invoice_",$txnid);
$invoiceid =  $tid[1];

  //Validating the reverse hash
  If (isset($response["additionalCharges"])) {
  $additionalCharges=$response["additionalCharges"];
  $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

  }
  else {

  $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

  }

   $hash = hash("sha512", $retHashSeq);
   if ($hash == $posted_hash && $response['status'] == 'success') {
	      	$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $amount,"transactionid" => $transactionid,"logs" => json_encode($response));


		}else{

		$result = array("status" => "fail","invoiceid" => $invoiceid,"paid" => 0,"transactionid" => $transactionid,"logs" => json_encode($response));


		}

 /* End response verification */

return $result;

}
