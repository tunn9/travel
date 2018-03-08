<?php
function jazzcash_config() {
  $configarray = array("FriendlyName" => array("Type" => "System", "Value" => "JazzCash"), "merchantid" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "20"), "password" => array("FriendlyName" => "Password", "Type" => "text", "Size" => "20"), "secret" => array("FriendlyName" => "Shared Secret", "Type" => "text", "Size" => "20"), "voucherExpiry" => array("FriendlyName" => "Voucher Expiry", "Type" => "text", "Size" => "20"), "mode" => array("FriendlyName" => "Mode", "Type" => "text", "Description" => "TEST or LIVE"));
  return $configarray;
}
function jazzcash_link($params) {
  $f = fopen('jazzcash_link.txt', 'w');
// Gateway Specific Variables
// Apply service charges
  if ($params['invoiceData']->module == "bus") {
    $params['amount'] = $params['invoiceData']->subtotal_fare;
// Apply coupon
// if( ! empty($params['invoiceData']->couponCode) ) {
//   $couponData = getBusCouponByCode($params['invoiceData']->couponCode);
//   if(strtolower($couponData->coupontype) == 'fixed') {
//     $params['amount'] = $params['amount'] - $couponData->value;
//   } else {
//     $params['amount'] = $params['amount'] - (($params['amount'] * $couponData->value) / 100);
//   }
// }
  }
  fwrite($f, json_encode($params));
  fclose($f);
  $SALT = $params['secret'];
  $password = $params['password'];
  $gatewaymode = $params['mode'];
  $dateTime = date("YmdHis");
// $expDateTime =  date("YmdHis", time() + 1800);
// https://stackoverflow.com/questions/20557059/php-adding-15-minutes-to-time-value
  $minute = (!empty($params['voucherExpiry'])) ? (int) $params['voucherExpiry'] : 30; // default 30 minute
  $expDateTime = date("YmdHis", (time() + ($minute * 60)));
// Invoice Variables
  $txnid = time() . "Trx" . $params['invoiceid'];
  $invoice = "invoice" . $params['invoiceid'];
  $productinfo = $params["description"];
  $amount = $params['amount'] * 100; // booking_deposit amount in pt_bookings table
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
// $hashSequence = $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||';
//
// $hashSequence .= $SALT;
// $hash = strtolower(hash('sha512', $hashSequence));
  $systemurl = $params['systemurl'];
  $returnUrl = base_url() . "invoice/notifyUrl/jazzcash";
  if ($gatewaymode == 'LIVE') {
    $PostURL = "https://payments.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform";
    $key = $params['merchantid'];
  }
  else {
    $PostURL = "http://testpayments.jazzcash.com.pk/PayAxisCustomerPortal/transactionmanagement/merchantform";
    $key = "Test" . $params['merchantid'];
  }
  $hashString = $SALT . "&" . $amount . "&" . $invoice . "&Booking&EN&" . $key . "&" . $password . "&" . $returnUrl . "&PKR&" . $dateTime . "&" . $expDateTime . "&" . $txnid . "&1.1";
  $secureHash = hash_hmac('sha256', $hashString, $SALT);
  $code = '<form method="post" action=' . $PostURL . ' name="frmTransaction" id="frmTransaction" >

<input type="hidden" name="pp_Amount" value="' . $amount . '" />
<input type="hidden" name="pp_BillReference" value="' . $invoice . '" />
<input type="hidden" name="pp_Description" value="Booking" />
<input type="hidden" name="pp_Language" value="EN" />
<input type="hidden" name="pp_MerchantID" value="' . $key . '" />
<input type="hidden" name="pp_Password" value="' . $password . '" />
<input type="hidden" name="pp_ReturnURL" value="' . $returnUrl . '" />
<input type="hidden" name="pp_TxnCurrency" value="PKR" />
<input type="hidden" name="pp_TxnDateTime" value="' . $dateTime . '" />
<input type="hidden" name="pp_TxnExpiryDateTime" value="' . $expDateTime . '" />
<input type="hidden" name="pp_TxnRefNo" value="' . $txnid . '" />
<input type="hidden" name="pp_Version" value="1.1" />
<input type="hidden" name="pp_SecureHash" value="' . strtoupper($secureHash) . '" />
<input type="submit" value="Pay Now" />
</form>';
  return $code;
}
//function for verification of payment. It will be used in notify url
function jazzcash_verifypayment($params) {
  $f = fopen('jazzcash_verifypayment.txt', 'w');
  fwrite($f, json_encode($params));
  fwrite($f, json_encode($_POST));
  $_IntegritySalt = $params['secret'];
  $Response = "";
  $comment = "";
  $_SecureHash = $_POST['pp_SecureHash'];
  $sortedResponseArray = array();
  if (!empty($_POST)) {
    foreach ($_POST as $key => $val) {
      $comment .= $key . "[" . $val . "],<br/>";
      $sortedResponseArray[$key] = $val;
    }
  }
  ksort($sortedResponseArray);
  unset($sortedResponseArray['pp_SecureHash']);
  $Response = $_IntegritySalt;
  foreach ($sortedResponseArray as $key => $val) {
    if ($val != null and $val != "") {
      $Response .= '&' . $val;
    }
  }
  fwrite($f, json_encode($Response));
  $CalSecureHash = hash_hmac('sha256', $Response, $_IntegritySalt);
  fwrite($f, json_encode($CalSecureHash));
  fwrite($f, json_encode($_SecureHash));
  $response = $_POST;
  $respCode = $response['pp_ResponseCode'];
  $tid = explode("invoice", $response['pp_BillReference']);
  $invoiceid = $tid[1];
  if (strtolower($CalSecureHash) == strtolower($_SecureHash)) {
//Your Code goes here
    $transactionid = $response["pp_RetreivalReferenceNo"];
    $amount = $response["pp_Amount"] / 100;
    if ($respCode == '000' || $respCode == '121' || $respCode == '200') {
      $result = array("status" => "success", "invoiceid" => $invoiceid, "paid" => $amount, "transactionid" => $transactionid, "logs" => json_encode($response));
    }
    else
      if ($respCode == '124' || $respCode == '210') {
        $result = array("status" => "reserved", "invoiceid" => $invoiceid, "paid" => $amount, "transactionid" => $transactionid, "logs" => json_encode($response));
      }
      else {
        $result = array("status" => "fail", "invoiceid" => $invoiceid, "paid" => 0, "transactionid" => $transactionid, "logs" => json_encode($response));
    }
  }
  else {
    $result = array("status" => "fail", "invoiceid" => $invoiceid, "paid" => 0, "transactionid" => $transactionid, "logs" => "mismatched marked it suspicious or reject it");
  }
  fwrite($f, json_encode($result));
  fclose($f);
  return $result;
}
function jazzcash_ipn($params) {
  $f = fopen('jazzcash_ipn.txt', 'w');
  fwrite($f, json_encode($params));
  fwrite($f, json_encode($_POST));
  $_IntegritySalt = $params['secret'];
  $Response = "";
  $comment = "";
  $_SecureHash = $_POST['pp_SecureHash'];
  $sortedResponseArray = array();
  if (!empty($_POST)) {
    foreach ($_POST as $key => $val) {
      $comment .= $key . "[" . $val . "],<br/>";
      $sortedResponseArray[$key] = $val;
    }
  }
  ksort($sortedResponseArray);
  unset($sortedResponseArray['pp_SecureHash']);
  $Response = $_IntegritySalt;
  foreach ($sortedResponseArray as $key => $val) {
    if ($val != null and $val != "") {
      $Response .= '&' . $val;
    }
  }
  $CalSecureHash = hash_hmac('sha256', $Response, $_IntegritySalt);
  $response = $_POST;
  $respCode = $response['pp_ResponseCode'];
  $tid = explode("invoice", $response['pp_BillReference']);
  $invoiceid = $tid[1];
  if (strtolower($CalSecureHash) == strtolower($_SecureHash)) {
//Your Code goes here
    $transactionid = $response["pp_RetreivalReferenceNo"];
    $amount = $response["pp_Amount"] / 100;
    if ($respCode == '000' || $respCode == '121' || $respCode == '200') {
      $result = array("status" => "success", "invoiceid" => $invoiceid, "paid" => $amount, "transactionid" => $transactionid, "logs" => json_encode($response));
    }
    else
      if ($respCode == '124' || $respCode == '210') {
        $result = array("status" => "reserved", "invoiceid" => $invoiceid, "paid" => $amount, "transactionid" => $transactionid, "logs" => json_encode($response));
      }
      else {
        $result = array("status" => "fail", "invoiceid" => $invoiceid, "paid" => 0, "transactionid" => $transactionid, "logs" => json_encode($response));
    }
  }
  else {
    $result = array("status" => "fail", "invoiceid" => $invoiceid, "paid" => 0, "transactionid" => $transactionid, "logs" => "mismatched marked it suspicious or reject it");
  }
  fwrite($f, json_encode($result));
  fclose($f);
  return $result;
}