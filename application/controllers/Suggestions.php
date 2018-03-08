<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'modules/integrations/Travelport_flight/libraries/travelport/ReferenceData.php';
/**
 * Suggestions controller
 *
 * This controller gives suggessions based on query used in search forms for autocomplete.
 */
class Suggestions extends CI_Controller 
{
    public function __constructor()
    {
        parent::__constructor();

        $this->output->set_content_type('application/json');
    }

    public function airports()
    {
        $query = $this->input->get('q');
        
        $file = APPPATH . "json/airports.json";
        $myfile = fopen($file, "r");
        $file_content = fread($myfile, filesize($file));
        fclose($myfile);
        
        $file_content = json_decode($file_content);
        $filterd_contents = array_filter($file_content, function($airport) use ($query) {
            return preg_match('/'.strtolower($query).'/', strtolower(sprintf('%s %s', $airport->fullname, $airport->code)));
        });
        
        $final_response = array();
        foreach($filterd_contents as $filterd_content) 
        {
            array_push($final_response, array(
                'id' => $filterd_content->code, 
                'text'=> sprintf('%s - (%s)', $filterd_content->fullname, $filterd_content->code)
            ));
        }

        $this->output->set_output(json_encode($final_response));
    }

}