<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Credimaxinvoice extends MX_Controller 
{
	public function __construct() 
	{
		parent::__construct();	
	}

	public function complete()
	{
		/**
		 * You can determine the success of the payment by comparing the resultIndicator and the successIndicator parameters. 
		 * A match indicates that the payment has been successful. 
		 * @href: https://credimax.gateway.mastercard.com/api/documentation/integrationGuidelines/hostedCheckout/integrationModelHostedCheckout.html?locale=en_US#x_obtainThePaymentResult
		 */
		if($_GET['resultIndicator'] == $_SESSION['successIndicator']) 
		{
			$this->db->set('booking_status', 'paid');
			$this->db->where('booking_id', $_SESSION['order.id']);
			$this->db->update('pt_bookings');	
		}

		unset($_SESSION['successIndicator']);
		unset($_SESSION['order.id']);

		redirect(base_url($_SESSION['paymentGatewayAfterCompleteRedirect']));
	}
}