<?php

//Start Faturah Classes

    /*
    * Represents the faturah client
    *
    * @author Hisham Bin Ateya
    */
    class Faturah{
	   public $merchantCode;
	   public $secureKey;
	   public $token;
	   public $order;
	   public $message;
	   public $hash;
    }
    /*
    * Wapper for Faturah web service
    *
    * @author Hisham Bin Ateya
    */
    class FaturahService{
	   const URL= 'https://Services.faturah.com/TokenGeneratorWS.asmx?wsdl';
	   private static $client;

	   private function __construct(){
		  //self::$client= new SoapClient(self::URL);
	   }

	   public static function call($name,$params)
	   {
		  self::$client= new SoapClient(self::URL);
		  return self::$client->__soapCall($name, $params);
	   }
    }
    /*
    * Utility class that facilitates the communication with other components
    *
    * @author Hisham Bin Ateya
    */
    class FaturahUtility{
	   public static function generateToken($code){
		  $params = array('GenerateNewMerchantToken'=>array('merchantCode'=>$code));
		  return FaturahService::call('GenerateNewMerchantToken', $params)->GenerateNewMerchantTokenResult;
	   }

	   public static function isSecureMerchant($code){
		  $params = array('IsSecuredMerchant'=>array("merchantCode"=>$code));
		  return FaturahService::call('IsSecuredMerchant', $params)->IsSecuredMerchantResult;
	   }

	   public static function generateSecureHash($message){
		  $params = array('GenerateSecureHash'=>array("message"=>$message));
		  return FaturahService::call('GenerateSecureHash', $params)->GenerateSecureHashResult;
	   }

	   public static function constructMessage($key, $code, $token, $order){
		  $productIDs=implode('|', $order->productIDs);
		  $productQuantities=implode('|', $order->productQuantities);
		  $productPrices=implode('|', $order->productPrices);
		  return $key.$code.$token.$order->totalPrice.$order->deliveryCharge.$productIDs.$productQuantities.$productPrices.$order->email.$order->lang;
	   }

	   public static function convertCurrency($from_Currency, $to_Currency='SAR'){

		    $amount=1;
		    $amount = urlencode($amount);
			$from_Currency = urlencode($from_Currency);
			$to_Currency = urlencode($to_Currency);

			$url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

			$ch = curl_init();
			$timeout = 0;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

			curl_setopt ($ch, CURLOPT_USERAGENT,
						 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$rawdata = curl_exec($ch);
			curl_close($ch);
			$data = explode('bld>', $rawdata);
			$data = explode($to_Currency, $data[1]);

			return round($data[0], 2);


	   }

	   public function alert($msg){
		  echo '<script type="text/javascript">alert("'.$msg.'");</script>';
	   }
    }
    /*
    * Represents the customer order
    *
    * @author Hisham Bin Ateya
    */
    class Order{
	   public $products=array();
	   public $productIDs=array();
	   public $productNames=array();
	   public $productDescriptions=array();
	   public $productQuantities=array();
	   public $productPrices=array();
	   public $deliveryCharge;
	   public $totalPrice;
	   public $customerName;
	   public $date;
	   public $customerEmail;
	   public $customerPhoneNumber;
	   public $lang;

	   function __construct(){
		  $this->date = date('m/d/Y h:i:s A');
		  $this->totalPrice=0;
	   }

	   public function addItem($id, $name, $description, $qunatity, $price){
		  $product=new Product();
		  $product->id=$id;
		  $product->name=$name;
		  $product->description=$description;
		  $product->quantity=$qunatity;
		  $product->price=$price;
		  $this->totalPrice += $product->price*$product->quantity;
		  array_push($this->products, $product);
		  array_push($this->productIDs, $product->id);
		  array_push($this->productNames, $product->name);
		  array_push($this->productDescriptions, $product->description);
		  array_push($this->productQuantities, $product->quantity);
		  array_push($this->productPrices, $product->price);
	   }
    }
    /*
    * Represents the product
    *
    * @author Hisham Bin Ateya
    */
    class Product{
	   public $id;
	   public $name;
	   public $description;
	   public $quantity;
	   public $price;
    }

// End Faturah Classes


function faturah_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Faturah Payment Gateway" ), "merchantCode" => array( "FriendlyName" => "Merchant Code", "Type" => "text", "Size" => "50", "Description" => "" ), "secureKey" => array( "FriendlyName" => "Secure Key", "Type" => "text", "Size" => "50" ), "test" => array( "FriendlyName" => "Test Environment", "Type" => "yesno", "Description" => "Tick to enable test environment" ) );
	return $configarray;
}


function faturah_link($params) {


	$faturah = new Faturah();
    $faturah->merchantCode = $params['merchantCode'];//please add merchant code here
    $faturah->secureKey = $params['secureKey'];//please add secure key here
    // Initialize the cutomer orders
    $rate = 1; // Remove the commented line if you are using other than (SAR) FaturahUtility::convertCurrency('USD');
    $order = new Order();
    $order->addItem($params['invoiceid'], $params['description'], 'Booking', '1', $params['amount']);
    $order->deliveryCharge = 0;
    $order->customerName= '';
    $order->customerEmail= '';
    $order->customerPhoneNumber = '';
    $order->lang = 'ar';
    $faturah->order=$order;
    $faturah->order->totalPrice+=$order->deliveryCharge;
    $faturah->token = FaturahUtility::generateToken($faturah->merchantCode);
    // Concatenates the product IDs, names .. etc
    $productIDs = implode('|', $faturah->order->productIDs);
    $productNames = implode('|', $faturah->order->productNames);
    $productDescriptions ='';// implode('|', $faturah->order->productDescriptions);
    $productQuantities = implode('|', $faturah->order->productQuantities);
    $productPrices = implode('|', $faturah->order->productPrices);
    // Constructs the transaction handler url
    $url = sprintf("https://gateway.faturah.com/TransactionRequestHandler.aspx?mc=%s&mt=%s&dt=%s&a=%s&ProductID=%s&ProductName=%s&ProductDescription=%s&ProductQuantity=%s&ProductPrice=%s&DeliveryCharge=%s&CustomerName=%s&EMail=%s&PhoneNumber=%s",$faturah->merchantCode, $faturah->token, $faturah->order->date, $faturah->order->totalPrice, $productIDs, $productNames, $productDescriptions, $productQuantities, $productPrices, $faturah->order->deliveryCharge, $faturah->order->customerName, $faturah->order->customerEmail, $faturah->order->customerPhoneNumber);
    // Checks whether the merchant is secure
    if(FaturahUtility::isSecureMerchant($faturah->merchantCode))
    {
	   $faturah->message = $faturah->secureKey.$faturah->merchantCode.$faturah->token.$faturah->order->totalPrice;
	   $faturah->hash = FaturahUtility::generateSecureHash($faturah->message);
	   //$url .= sprintf("&vpc_SecureHash=%s&securemessage=%s",$faturah->hash,$faturah->message);
	   $url .= "&vpc_SecureHash=".$faturah->hash;
    }
    $target = "";

    Faturah_updateTokenForInvoice($params['invoiceid'], $faturah->token);

		$PAY_URL = base_url().'invoice/callGatewayFunc/faturah/payRedirect';
	$code = "<form action=\"" . $PAY_URL . "\" method=\"post\" " . $target . ">
	<input type=\"hidden\" name=\"url\" value=\"".$url."\" />
<input type=\"submit\" class=\"paybtn\" value=\"Pay Now\" />
</form>";

			return $code;



}

function faturah_payRedirect(){
	$url = $_POST['url'];
	header("location: $url");
  // exit($url);
}


//function for verification of payment. It will be used in notify url
function faturah_verifypayment($params){
$getData = $_GET;
$getData['paymentGateway'] = "faturah";


//funciton should return an array of result with status = success/fail, invoiceid, amount paid, transaction id if any
$result = array("status" => "fail","invoiceid" => "","paid" => 0,"transactionid" => "");
$successStatus = array(15,30);
$rejectStatus = array(22,6);
$invoice =	Faturah_invoiceDetails($getData['token']);
if($getData['Response'] == 1){
		$faturah = new Faturah();
		$faturah->merchantCode = $params['merchantCode'];//please add merchant code here
		$faturah->secureKey = $params['secureKey'];//please add secure key here
		$hash = "";

		// Checks whether the merchant is secure
		if(FaturahUtility::isSecureMerchant($faturah->merchantCode))
		{
		$message=sprintf("%s&Response=%s&status=%s&code=%s&token=%s&lang=%s&ignore=%s",
		$params['secureKey'],$getData["Response"],$getData["status"],
		$getData["code"],$getData['token'],$getData["lang"],
		$getData["ignore"]);
		$hash = FaturahUtility::generateSecureHash($message);

		}

	$transactionid = $getData['code'];

	if(in_array($getData['status'], $successStatus) && $getData['vpc_SecureHash'] == $hash){

		$result = array("status" => "success","invoiceid" => $invoice->id,"paid" => $invoice->checkoutAmount,"transactionid" => $transactionid,"logs" => json_encode($getData));

	}else{

	$result = array("status" => "fail","invoiceid" => $invoice->id,"paid" => 0,"transactionid" => "","logs" => json_encode($getData));

	}

	}else{

	$result = array("status" => "fail","invoiceid" => $invoice->id,"paid" => 0,"transactionid" => "","logs" => json_encode($getData));


	}

return $result;

}

function Faturah_invoiceDetails($token){

	$ci = get_instance();
	$ci->load->helper('invoice');
	$ci->db->select('booking_id,booking_ref_no');
	$ci->db->where('book_token',$token);
	$info = $ci->db->get('pt_bookings')->result();
	$invoiceDetails = "";

	if(!empty($info)){
		$invoiceid = $info[0]->booking_id;
		$bookingref = $info[0]->booking_ref_no;
		$invoiceDetails = invoiceDetails($invoiceid, $bookingref);
	}


	//$amountPaid = $invoiceDetails->checkoutAmount;
	return $invoiceDetails;

}

function Faturah_updateTokenForInvoice($id, $token){
	$ci = get_instance();
	$data = array('book_token' => $token);
	$ci->db->where('booking_id',$id);
	$ci->db->update('pt_bookings',$data);

}
