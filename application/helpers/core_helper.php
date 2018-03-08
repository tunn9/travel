<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sms_api_loader'))
{
    function sms_api_loader($api_name)
    {
        $path = APPPATH . "json/" . $api_name . ".json";
        $f    = fopen($path, 'r');
        $data = fread($f, filesize($path));
        $data = json_decode($data);
        fclose($f);

        return $data;
    }
}

if ( ! function_exists('update_sms_api'))
{
    function update_sms_api($api_name, $data)
    {
        $path = APPPATH . "json/" . $api_name . ".json";
        $f    = fopen($path, 'w');
        fwrite($f, json_encode($data, JSON_PRETTY_PRINT));
        fclose($f);
    }
}

if ( ! function_exists('send_sms'))
{
    function send_sms($recepient, $message)
    {
        $CI =& get_instance();
        $CI->load->library('Sms_notification');
        $smsNotification = new Sms_notification();
        $smsNotification->recepient = $recepient;
        $smsNotification->message   = $message;
        return $smsNotification->send();
    }
}

if ( ! function_exists('get_sms_template')) 
{
	function get_sms_template($template_name_id) 
	{
        $CI =& get_instance();
        $CI->load->library('SmsTemplateManager');
        $smsTemplate = new SmsTemplateManager();
        return $smsTemplate->get($template_name_id);
	}
}