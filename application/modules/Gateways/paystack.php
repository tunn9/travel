<?php

	function paystack_config() 
	{
		$configarray = array(
		"FriendlyName" => array("Type" => "System", "Value"=>"PayStack"),
		"paystack_secret" => array("FriendlyName" => "PAYSTACK SECRET KEY", "Type" => "text", "Size" => "40", ),
		);

		return $configarray;
	}


	function paystack_link($params){
		return paystack_init($params);
	}

	function paystack_init($params){
		// The naira (sign: ₦; code: NGN) is the currency of Nigeria. It is subdivided into 100 Kobo.
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode([
				'amount' => $params['amount'] * 100, // Amount in kobo
				'email' => $params['invoiceData']->accountEmail,
			]),
			CURLOPT_HTTPHEADER => [
				"authorization: Bearer ".$params['paystack_secret'],
				"content-type: application/json",
				"cache-control: no-cache"
			],
		));

		$response = curl_exec($curl);

		if( ! $response ) {
			return array(
				'status' => 'error',
				'message' => 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl)
			);
		}

		$tranx = json_decode($response);

		if( ! $tranx->status ) {
			// there was an error from the API
			return array(
				'status' => 'fail',
				'message' => 'API returned error: ' . $tranx->message
			);
		} else {
			return array(
				'status' => 'success',
				'message' => $tranx->data->authorization_url
			);
		}
	}

?>