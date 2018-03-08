<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ivisa extends MX_Controller {


      function __construct()
      {
          // $this->session->sess_destroy();
          parent::__construct();
          $this->load->model("Ivisa_model");

          $this->data['lang_set'] = $this->session->userdata('set_lang');
          $chk = modules::run('Home/is_main_module_enabled','ivisa');
          
          if(!$chk){
            Error_404($this);
          }

          $this->data['phone'] = $this->load->get_var('phone');
          $this->data['contactemail'] = $this->load->get_var('contactemail');
          $defaultlang = pt_get_default_language();
          
          if(empty($this->data['lang_set']))
          {
            $this->data['lang_set'] = $defaultlang;
          }
          
          $this->lang->load("front",$this->data['lang_set']);
      }


    public function index()
    {
        $settings = $this->Ivisa_model->get_front_settings();

        $countries_json  = file_get_contents('./application/json/countries.json');
        $countries_array = json_decode($countries_json, TRUE);
        $parameters      = $this->input->get();
        
        if (empty($parameters)) 
        {
            $parameters['nationality_country'] = $settings->from;
            $parameters['destination_country'] = $settings->to;
        }

        $this->data['filteredCountires'] = array();
        foreach($countries_array as $countries_object)
        {
            if($parameters['nationality_country'] == $countries_object['iso2'] || $parameters['nationality_country'] == $countries_object['short_name'])
            {
                $this->data['filteredCountires']['nationality_country'] = $countries_object;
            }
            else if($parameters['destination_country'] == $countries_object['iso2'] || $parameters['destination_country'] == $countries_object['short_name'])
            {
                $this->data['filteredCountires']['destination_country'] = $countries_object;
            }
        }
        
        $this->data['url'] = $settings->url;
        $this->data['affiliate_code'] = $settings->aid;
        
        $this->setMetaData($settings->headerTitle);
        $loadheaderfooter = $settings->showHeaderFooter;

        if($loadheaderfooter == "no")
        {
            $this->theme->partial('integrations/visa/ivisa/index',$this->data);
        }
        else
        {
            $this->theme->view('integrations/visa/ivisa/index',$this->data, $this);
        }
    }
}
