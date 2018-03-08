<?php
class Travelstart_model extends CI_Model{
    public $jsonfile;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
       // $this->jsonfile = APPPATH.'modules/integrations/travelstart/settings.json';
        $this->jsonfile =  APPPATH.'modules/integrations/Travelstart/settings.json';
    }

     // update front settings
       function update_front_settings(){
        $fdata = new stdClass;
        $fdata->showHeaderFooter = $this->input->post('showheaderfooter');
        $fdata->affid = $this->input->post('affid');
        $fdata->iframeID = $this->input->post('iframeid');
        $fdata->headerTitle = $this->input->post('headertitle');

        file_put_contents($this->jsonfile, json_encode($fdata,JSON_PRETTY_PRINT));
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");

      }

      function get_front_settings(){
        $fileData = json_decode(file_get_contents($this->jsonfile));
        return $fileData;
      }

}
