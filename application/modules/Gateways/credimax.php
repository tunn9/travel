<?php 

/**
 * This function get register the gateway into payment gateways section of admin panel. 
 * The script read this function get registered the gateway.
 */
function credimax_config() 
{
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"Credimax"),
     "merchantId" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "40", ),
     "apiusername" => array("FriendlyName" => "API Username", "Type" => "text", "Size" => "40", ),
     "apipassword" => array("FriendlyName" => "API Password", "Type" => "text", "Size" => "40", ) 
    );

	return $configarray;
}

function credimax_link($params)
{
    $response = create_checkout_session($params);
    $params['response'] = $response;

    $CI = get_instance();
	return $CI->load->view('paymentgateway/credimax', compact('params'), TRUE);
}

function create_checkout_session($params)
{
    $data_string = json_encode(array(
        "apiOperation"=> "CREATE_CHECKOUT_SESSION",
        "interaction"=> array(
            "returnUrl"=> "https://departure24.bh/Gateways/Credimaxinvoice/complete"
        ),
        "order"=> array(
            "id"=> $params['invoiceid'],
            "amount"=> $params['amount'],
            "currency"=> $params['currency']
        )
    ));

    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => $params["apiusername"].':'.$params["apipassword"],
        CURLOPT_HTTPHEADER => array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string)
        ),
        CURLOPT_URL => 'https://credimax.gateway.mastercard.com/api/rest/version/43/merchant/'.$params["merchantId"].'/session',
        CURLOPT_USERAGENT => 'Credimax create checkout session request',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data_string
    ));

    $resp = curl_exec($curl);
    $response = array();

    // Send the request & save response to $resp
    if( ! $resp ) {
        $response = curl_error($curl);
    }
    else
    {
        $response = json_decode($resp);
        $_SESSION['successIndicator'] = $response->successIndicator;
        $_SESSION['order.id'] = $params['invoiceid'];
    }

    // Close request to clear up some resources
    curl_close($curl);
    
    return $response;
}