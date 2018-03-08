<?php
class Ivisa_model extends CI_Model{
    public $jsonfile;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->jsonfile =  APPPATH.'modules/integrations/Ivisa/settings.json';
    }

     // update front settings
       function update_front_settings(){
        $fdata = new stdClass;
        $fdata->showHeaderFooter = $this->input->post('showheaderfooter');
        $fdata->aid = $this->input->post('aid');
        $fdata->headerTitle = $this->input->post('headertitle');
        $fdata->from = $this->input->post('from');
        $fdata->to = $this->input->post('to');

        file_put_contents($this->jsonfile, json_encode($fdata,JSON_PRETTY_PRINT));
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");

      }

      function get_front_settings(){
        $fileData = json_decode(file_get_contents($this->jsonfile));
        return $fileData;
      }

}
