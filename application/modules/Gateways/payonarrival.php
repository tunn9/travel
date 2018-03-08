<?php

function payonarrival_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Pay On Arrival" ));
	return $configarray;
}


function payonarrival_link($params) {
	
	$code = "<p>" . nl2br( $params['instructions'] ). "</p>";
	return $code;
}