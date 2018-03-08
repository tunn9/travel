<?php

function encryptData($plainText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}

	function decryptData($encryptedText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	//*********** Padding Function *********************

	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0)
		    {
				$binString=$packedString;
		    } 
        	    
		    else 
		    {
				$binString.=$packedString;
		    } 
        	    
		    $count+=2; 
        	} 
  	        return $binString; 
    	  }

function ccavenue_config() {
    $ccavenue_configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"CCAvenue Payment Gateway"),
     "merchantid" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "40", "Description" => "CCAvenue Merchant ID", ),
     "accesscode" => array("FriendlyName" => "Access Code", "Type" => "text", "Size" => "40", ),  
     "workingkey" => array("FriendlyName" => "Working Key", "Type" => "text", "Size" => "40", ),       
	 "cclang" => array("FriendlyName" => "Language", "Type" => "text", "Size" => "20", "Value"=>"EN", ),
    );
	return $ccavenue_configarray;
}

function ccavenue_link($params) {

	$isMobile = detectMobileDevice();
	$target = "";
	if($isMobile){
	$target = "target = '_blank'";
	}else{
		$target ="";
	}


	$merchantid = $params['merchantid'];
	$accesscode = $params['accesscode'];
	$workingkey = $params['workingkey'];
	$cclang = $params['cclang'];

	$bookingid = $params['invoiceid'];
	$bookingCode = $params['invoiceref'];
	$description = $params["description"];
    $amount = $params['amount'];
    $currency = $params['currency']; 

	$company = $params['companyname'];
	$returnUrl = base_url(). "invoice/notifyUrl/ccavenue";
	$cancelUrl = base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref'];

	$merchantdata = 'merchant_id='.$merchantid.'&order_id='.$bookingid.'&amount='.$amount.'&currency='.$currency.'&redirect_url='.$returnUrl.
				'&cancel_url='.$cancelUrl.'&language='.$cclang;

	$encrypted_data = encryptData($merchantdata,$workingkey);


	$payform = '<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction" '.$target.'>
				<input type=hidden name="encRequest" value="'.$encrypted_data.'">
				<input type=hidden name="access_code" value="'.$accesscode.'">
				<input type="submit" class="paybtn" value="Pay Now" />
				</form>';

    
	return $payform;
}


//function for verification of payment. It will be used in notify url
function ccavenue_verifypayment($params){

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

$workingkey = $params['workingkey'];
$encResponse = $_POST["encResp"];
$rcvdString = decryptData($encResponse,$workingkey);
$decryptValues = explode("&", $rcvdString);

$dataSize = sizeof($decryptValues);

for($ik = 0; $ik < $dataSize; $ik++) {
$information = explode('=',$decryptValues[$ik]);
if($ik == 0) $invoiceid = $information[1];
if($ik == 1) $transid = $information[1];
if($ik == 3) $orderStatus = $information[1];
if($ik == 9) $paidcurrency = $information[1];
if($ik == 10) $paidamount = $information[1];
}

if ($orderStatus == "Success") {

$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $paidamount,"transactionid" => $transid);

} else {

$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");

}

return $result;

}

function detectMobileDevice(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	return TRUE;
}else{
	return FALSE;
}

}