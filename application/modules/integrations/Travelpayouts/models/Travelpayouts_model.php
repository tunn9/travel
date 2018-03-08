<?php
class Travelpayouts_model extends CI_Model{
    public $jsonfile;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
       // $this->jsonfile = APPPATH.'modules/integrations/Travelpayouts/settings.json';
        $this->jsonfile =  APPPATH.'modules/integrations/Travelpayouts/settings.json';
    }

     // update front settings
       function update_front_settings(){
        $fdata = new stdClass;
        $fdata->showHeaderFooter = $this->input->post('showheaderfooter');

        $fdata->iframeID = $this->input->post('iframeid');
        $fdata->headerTitle = $this->input->post('headertitle');
        $fdata->WidgetURL = $this->input->post('WidgetURL');
        $fdata->WidgetURLMobile = $this->input->post('WidgetURLMobile');

        file_put_contents($this->jsonfile, json_encode($fdata,JSON_PRETTY_PRINT));
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");

      }

      function get_front_settings(){
        $fileData = json_decode(file_get_contents($this->jsonfile));
        return $fileData;
      }

}
