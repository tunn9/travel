<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WegoFlights extends MX_Controller {


  function __construct(){
  // $this->session->sess_destroy();
  parent::__construct();
  $this->load->model("Wegoflights_model");

  $this->data['lang_set'] = $this->session->userdata('set_lang');
  $chk = modules::run('Home/is_main_module_enabled','wegoflights');
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
  $settings =  $this->Wegoflights_model->get_front_settings();
  $this->data['url'] = $settings->url;
  $this->data['aid'] = $settings->aid;
  $this->data['brandID'] = $settings->brandID;
  $this->setMetaData($settings->headerTitle);
  $this->data['searchBoxID'] = $settings->searchBoxID;
  $loadheaderfooter = $settings->showHeaderFooter;
  if($loadheaderfooter == "no"){
  $this->theme->partial('integrations/flights/wegoflights/index',$this->data);
  }else{
  $this->theme->view('integrations/flights/wegoflights/index',$this->data, $this);
  }
  }
  }
