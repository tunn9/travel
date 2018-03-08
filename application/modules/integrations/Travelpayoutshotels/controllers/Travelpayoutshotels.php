<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Travelpayoutshotels extends MX_Controller {

    function __construct() 
    {
      // $this->session->sess_destroy();
        parent::__construct();
        $this->load->model("Travelpayoutshotels_model");
        $this->data['lang_set'] = $this->session->userdata('set_lang');
        $chk = modules::run('Home/is_main_module_enabled', 'Travelpayoutshotels');
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

    public function index() 
    {
      $settings = $this->Travelpayoutshotels_model->get_front_settings();
      $this->data['iframeID'] = $settings->iframeID;
      $this->setMetaData($settings->headerTitle);
      $loadheaderfooter = $settings->showHeaderFooter;
      $isMobile = $_GET['mobile'];
      if ($loadheaderfooter == "no" || $isMobile == "yes") {
        $this->theme->partial('integrations/hotels/travelpayouts/index', $this->data);
      }
      else {
        $this->theme->view('integrations/hotels/travelpayouts/index', $this->data, $this);
      }
    }

    public function mobile()
    {
      $settings = $this->Travelpayoutshotels_model->get_front_settings();
      $this->data['WidgetURLMobile'] = $settings->WidgetURLMobile;
      $this->data['hidden'] = "hidden";
      $this->theme->view('integrations/hotels/travelpayouts/mobile', $this->data,$this);
    }
}
