<?php

/*
You must use test company token and services types

Company ID: 085D01D6-5283-494D-A382-A19EE1FCC690

Services types:
506-Baggage
654-Airport Transfers
682-Flight
683-Safari Holiday
4813-Accommodation
4814-Meals
4815-Extras


Test card details:
Card number: 5424000000000015
Expiry date: 12/18
CVV: 123

*/

function directpay3g_config() {
    $dp_configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"3G Direct Pay"),
     "companyToken" => array("FriendlyName" => "Company Token", "Type" => "text", "Size" => "40", "Description" => "Company Token Provided by 3G Direct Pay Limited" )
    );
	return $dp_configarray;
}

function directpay3g_link($params) {

	/*$servicesType = array(
		'hotels' => '4813',
		'flights' => '682'
		);*/

	$servicesType = array(
		'hotels' => '4978',
		'tours' => '4980',
		'cars' => '4983',
		'flights' => '4979'
		);

	$isMobile = directpay3g_detectMobileDevice();
	$target = "";
	if($isMobile){
	$target = "target = '_blank'";
	}else{
		$target ="";
	}


	$companyToken = $params['companyToken'];
	$invoiceData = $params['invoiceData'];

	$bookingid = $params['invoiceid'];
	$bookingCode = $params['invoiceref'];
	$description = $invoiceData->module." Booking";
    $amount = $params['amount'];
    $currency = $params['currency']; 

	$company = $params['companyname'];
	$returnUrl = base_url(). "invoice/notifyUrl/directpay3g";
	$cancelUrl = base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref'];

	$param = array(
				'order_id'			  => $bookingid,
				'amount' 			  => '<PaymentAmount>'.$amount.'</PaymentAmount>',
				'currency'			  => $currency
				 );

	/*$param = array(
				'order_id'			  => $bookingid,
				'amount' 			  => '<PaymentAmount>'.$amount.'</PaymentAmount>',
				'first_name' 		  => '<customerFirstName>Irshad Ali</customerFirstName>',
				'last_name' 		  => '<customerLastName>Jan</customerLastName>',
				'email' 		      => '<customerEmail>test@gmail.com</customerEmail>',
				'country' 		      => '<customerCountry>US</customerCountry>',
				'currency'			  => $currency
			);*/

	
			$service = '<Service>
								<ServiceType>'.$servicesType[$invoiceData->module].'</ServiceType>
								<ServiceDescription>'.$description.'</ServiceDescription>
								<ServiceDate>'.date('Y/m/d H:i') .'</ServiceDate>
						</Service>';
			
			$input_xml = '<?xml version="1.0" encoding="utf-8"?>
					<API3G>
						<CompanyToken>'.$companyToken.'</CompanyToken>
						<Request>createToken</Request>
						<Transaction>'.$param["amount"].'
							<PaymentCurrency>'.$currency.'</PaymentCurrency>
							<CompanyRef>'.$param["order_id"].'</CompanyRef>
							<RedirectURL>'.htmlspecialchars ($returnUrl).'</RedirectURL>
							<BackURL>'.htmlspecialchars ($cancelUrl).'</BackURL>
							<CompanyRefUnique>0</CompanyRefUnique>
						</Transaction>
						<Services>'.$service.'</Services>
					</API3G>';


			$response = directpay3g_createCURL($input_xml);

		if ($response === FALSE){

	    $html = 'FAILED';

		}else{
			//convert the XML result into array
			$xml = new SimpleXMLElement($response);


			if ($xml->Result[0] != '000') {
				$html = "Error: ".$servicesType[$invoiceData->module].$xml->ResultExplanation[0];

			}else{

				  $html = '<a  class="paybtn" href="https://secure.3gdirectpay.com/pay.php?ID='.$xml->TransToken[0].'" '.$target.'> Pay Now	</a>';
			}

	  

		}

    
	return $html;
}


//function for verification of payment. It will be used in notify url
function directpay3g_verifypayment($params){

$transactionToken = $_GET['TransactionToken'];

$response =  directpay3g_verifytoken($transactionToken, $params['companyToken']);

$invoiceid = $_GET['CompanyRef'];

//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any 
		$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => $transactionToken,"logs" => json_encode($_GET));


		if ($response) {

		if ($response->Result[0] == '000') {

		$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $response->TransactionAmount[0],"transactionid" => $transactionToken,"logs" => json_encode($response));

 
		}else{

		$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => $transactionToken,"logs" => json_encode($response));
 	

		}
		

		}
		else{

		$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => $transactionToken,"logs" => json_encode($_GET));

		}

/*if ($orderStatus == "Success") {

$result = array("status" => "success","invoiceid" => $invoiceid,"paid" => $paidamount,"transactionid" => $transactionToken,"logs" => json_encode($_GET));

} else {

$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => $transactionToken,"logs" => json_encode($_GET));

}*/

return $result;

}

function directpay3g_detectMobileDevice(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	return TRUE;
}else{
	return FALSE;
}

}


//generate Curl and return response
function directpay3g_createCURL($input_xml){

			$url = "https://secure.3gdirectpay.com/API/v5/";
			
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);

			$response = curl_exec($ch);
		
			curl_close($ch);

			return $response;
		}

function directpay3g_verifytoken($transactionToken, $companyToken){

			$input_xml = '<?xml version="1.0" encoding="utf-8"?>
						<API3G>
						  <CompanyToken>'.$companyToken.'</CompanyToken>
						  <Request>verifyToken</Request>
						  <TransactionToken>'.$transactionToken.'</TransactionToken>
						</API3G>';

			$response = directpay3g_createCURL($input_xml);

			if ($response !==  FALSE) {
				//convert the XML result into array
        		$xml = new SimpleXMLElement($response);

        		return $xml;
        	}
			
			return false;
		}