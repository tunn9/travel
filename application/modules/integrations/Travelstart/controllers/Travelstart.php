<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Travelstart extends MX_Controller {

  function __construct(){
   // $this->session->sess_destroy();
    parent::__construct();


   $this->load->model("Travelstart_model");

  $this->data['lang_set'] = $this->session->userdata('set_lang');
 $chk = modules::run('Home/is_main_module_enabled','travelstart');
   if(!$chk){
       Error_404($this);

   }
     $this->data['phone'] = $this->load->get_var('phone');
         $this->data['contactemail'] = $this->load->get_var('contactemail');

      $defaultlang = pt_get_default_language();
   if(empty($this->data['lang_set'])){

      $this->data['lang_set'] = $defaultlang;
   }
   $this->lang->load("front",$this->data['lang_set']);
 }

	public function index()
	{

    $settings =  $this->Travelstart_model->get_front_settings();

  $this->data['affid'] = $settings->affid;
  $this->data['iframeID'] = $settings->iframeID;
 $this->setMetaData($settings->headerTitle);
 $loadheaderfooter = $settings->showHeaderFooter;
 $isMobile = $_GET['mobile'];
 if ($loadheaderfooter == "no" || $isMobile == "yes") {

  $this->theme->partial('integrations/flights/travelstart/index',$this->data);
  }else{
  $this->theme->view('integrations/flights/travelstart/index',$this->data, $this);
  }

}


   }
