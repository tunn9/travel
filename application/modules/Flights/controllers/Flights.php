<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Flights extends MX_Controller {

    public function __construct() 
	{
		parent :: __construct();

		$chk = modules::run('Home/is_main_module_enabled', 'flights');

		if ( ! $chk ) { Module_404(); }

		// For contact detail display in header.
		$this->data['phone'] = $this->load->get_var('phone');
		$this->data['contactemail'] = $this->load->get_var('contactemail');

		$this->data['usersession'] = $this->session->userdata('pt_logged_customer');
		$this->data['appModule'] = "flights";

		$languageid = $this->uri->segment(2);
		$this->validlang = pt_isValid_language($languageid);

		if( $this->validlang ) {
			$this->data['lang_set'] =  $languageid;
		} else {
			$this->data['lang_set'] = $this->session->userdata('set_lang');
		}

		$defaultlang = pt_get_default_language();
		if ( empty($this->data['lang_set']) ) {
			$this->data['lang_set'] = $defaultlang;
		}

		// For menu `HOME` and `My Account` link in header.
		$this->lang->load("front", $this->data['lang_set']);

		$user_id = $this->session->userdata('pt_logged_customer');
		$this->data['userAuthorization'] = (isset($user_id) && ! empty($user_id)) ? 1 : 0;

		$this->data['pageTitle'] = "Flights List";
    }

    public function index()
    {
        echo 'Flights';
    }
}