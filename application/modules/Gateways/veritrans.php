<?php 

/**
 * This function get register the gateway into payment gateways section of admin panel. 
 * The script read this function get registered the gateway.
 */
function veritrans_config() 
{
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"Veritrans"),
     "merchantId" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "40", ),
     "clientKey" => array("FriendlyName" => "Client Key", "Type" => "text", "Size" => "40", ),
     "serverKey" => array("FriendlyName" => "Server Key", "Type" => "text", "Size" => "40", ), 
     "sandbox" => array("FriendlyName" => "Environment", "Type" => "dropdown", "Options" =>"TEST,LIVE", "Description" => "TEST or LIVE", ),
    );

	return $configarray;
}

function veritrans_link($params)
{
    $CI = get_instance();
    $response = create_veritrans_session($params);

    return $CI->load->view('paymentgateway/checkout_vtweb', compact('response', 'params'), TRUE);
}

function create_veritrans_session($params)
{
    $data_string = json_encode(array(
        'transaction_details' => array(
          'order_id' => $params['invoiceid'],
          'gross_amount' => $params['checkoutTotal'],
        )
      )
    );

    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string),
            'Authorization: Basic ' . base64_encode($params['serverKey'].':')
        ),
        CURLOPT_URL =>  trim($params['apiUrl'], '/') . '/snap/v1/transactions',
        CURLOPT_USERAGENT => 'PHPTravel',
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
    }

    // Close request to clear up some resources
    curl_close($curl);
    
    return $response;
}
