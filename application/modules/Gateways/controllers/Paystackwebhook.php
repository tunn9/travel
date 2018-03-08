<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Paystackwebhook extends MX_Controller{
    
    private $PAYSTACK_SECRET_KEY;

    public function __construct(){
        parent::__construct();
        
        $dataAdapter = $this->db->get_where('pt_paymentgateways', array(
          'gateway' => 'paystack',
          'setting' => 'paystack_secret'
        ));
        $this->PAYSTACK_SECRET_KEY = $dataAdapter->row()->value;
    }
    
    public function webhook(){
        $body = @file_get_contents("php://input");
        
        $signature = (isset($_SERVER['HTTP_X_PAYSTACK_SIGNATURE']) ? $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] : '');

        if (!$signature) {
            // only a post with paystack signature header gets our attention
            exit();
        }
        
        if (!$signature) {
            // only a post with paystack signature header gets our attention
            exit();
        }
        
        // confirm the event's signature
        if( $signature !== hash_hmac('sha512', $body, $this->PAYSTACK_SECRET_KEY) ){
          // silently forget this ever happened
          exit();
        }
        
        http_response_code(200);
        // parse event (which is json string) as object
        // Give value to your customer but don't give any output
        // Remember that this is a call from Paystack's servers and 
        // Your customer is not seeing the response here at all
        $event = json_decode($body);
        switch($event->event){
            // charge.success
            case 'charge.success':
                // TIP: you may still verify the transaction
            		// before giving value.
                break;
        }
        exit();

    }
    
    public function callback(){
        $curl = curl_init();
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if(!$reference){
          die('No reference supplied');
        }
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "Authorization: Bearer ".$this->PAYSTACK_SECRET_KEY,
            "cache-control: no-cache"
          ],
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        if($err){
        	// there was an error contacting the Paystack API
          die('Curl returned error: ' . $err);
        }
        
        $tranx = json_decode($response);
        
        if(!$tranx->status){
          // there was an error from the API
          die('API returned error: ' . $tranx->message);
        }
        
        if('success' == $tranx->data->status){
          // transaction was successful...
          // Save data and redirect user to invoice page.
          $this->db->set('booking_txn_id', $reference);
          $this->db->set('booking_payment_type', 'paystack');
          $this->db->set('booking_status', 'paid');
          $this->db->where('booking_id', $_SESSION['BOOKING_ID']);
          $this->db->update('pt_bookings');
          
          redirect(site_url($_SESSION['paymentGatewayAfterCompleteRedirect']));
          // please check other things like whether you already gave value for this ref
          // if the email matches the customer who owns the product etc
          // Give value
        }
    }
    
}