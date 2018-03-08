<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Hotelscombined extends MX_Controller {
  function __construct() {
// $this->session->sess_destroy();
    parent::__construct();
    $this->frontData();
    $this->load->model("Hotelscombined_model");
    $this->data['lang_set'] = $this->session->userdata('set_lang');
    $chk = modules::run('Home/is_main_module_enabled', 'hotelscombined');
    if (!$chk) {
      Error_404($this);
    }
    $this->data['phone'] = $this->load->get_var('phone');
    $this->data['contactemail'] = $this->load->get_var('contactemail');
    $defaultlang = pt_get_default_language();
    if (empty($this->data['lang_set'])) {
      $this->data['lang_set'] = $defaultlang;
    }
    $this->lang->load("front", $this->data['lang_set']);
  }
  public function index() {
    $settings = $this->Hotelscombined_model->get_front_settings();
    $this->data['aid'] = $settings->aid;
    $this->data['brandID'] = $settings->brandID;
    $this->data['searchBoxID'] = $settings->searchBoxID;
    $this->setMetaData($settings->headerTitle);
    $loadheaderfooter = $settings->showHeaderFooter;
    if ($loadheaderfooter == "no") {
      $this->theme->partial('integrations/hotels/hotelscombined/index', $this->data);
    }
    else {
      $this->theme->view('integrations/hotels/hotelscombined/index', $this->data, $this);
    }
  }
}