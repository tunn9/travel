<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'modules/Api/libraries/REST_Controller.php';

class Ivisa extends REST_Controller {

    public function __construct()
    {
        parent::__construct();

        if( ! $this->isValidApiKey) {
            $this->response($this->invalidResponse, 400);
        }

        $this->load->model("Ivisa/Ivisa_model");
    }

    public function frame_get()
    {
        $settings        = $this->Ivisa_model->get_front_settings();
        $countries_json  = file_get_contents('./application/json/countries.json');
        $countries_array = json_decode($countries_json, TRUE);
        $parameters      = $this->input->get();
        $response_status = NULL;
        
        if (empty($parameters)) 
        {
            $parameters['nationality_country'] = $settings->from;
            $parameters['destination_country'] = $settings->to;
        }

        $data = array();
        foreach($countries_array as $countries_object)
        {
            if(strtolower($parameters['nationality_country']) == strtolower($countries_object['iso2']) || 
                strtolower($parameters['nationality_country']) == strtolower($countries_object['short_name']))
            {
                $data['nationality_country'] = $countries_object;
            }
            else if(strtolower($parameters['destination_country']) == strtolower($countries_object['iso2']) || 
                strtolower($parameters['destination_country']) == strtolower($countries_object['short_name']))
            {
                $data['destination_country'] = $countries_object;
            }
        }

        // Now i have the codes of both countries
        $affiliate_code = $settings->aid;
        $api_params = array(
            'nationality_country' => $data['nationality_country']['iso2'], 
            'destination_country' => $data['destination_country']['iso2'], 
            'utm_source'=> $affiliate_code
        );
        $api_resp = json_decode(file_get_contents('http://www.ivisa.com/api/visa_required?' . http_build_query($api_params)), true);
        // NOTE: use bootstrap=0, jquery=0, jquery_ui=0 if these libaries are already loaded on your page
        if(isset($api_resp['ivisa_supported']) && $api_resp['ivisa_supported'] == 1) {
            $response = file_get_contents($api_resp['application_url'] . 'mode=embed&utm_source='.$affiliate_code);
            $this->session->set_userdata(array('ivisa_frame_html' => base64_encode($response)));
            $response_return = array(
                'status' => 'success',
                'data' => array(
                    'frame_url' => site_url('api/ivisa/frame_view')
                )
            );
        }
        else if(isset($api_resp['ivisa_supported']) && $api_resp['ivisa_supported'] == 0) {
            $str =  str_replace('\\', '', $api_resp['error_msg']);
            preg_match_all('/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/s', $str, $matches);
            
            $response_return = array(
                'status' => 'fail',
                'error' => array(
                    'next_url' => $matches[0][0]
                )
            );
        }
        else {
            $response_return = array(
                'status' => 'error',
                'error' => array(
                    'message' => $api_resp['error_msg']
                )
            );
        }

        $this->response($response_return, 200);
    }

    public function frame_view_get()
    {
        $this->output->set_content_type('text/html');
        $response = $this->session->userdata('ivisa_frame_html');
        $this->response(base64_decode($response), 200);
    }

    /**
     * This function is for android, the above method is working in ios but gives issue 
     * in android, in android session was regenerated in next ios release this function will be used.
     */
    public function ivisaframe_get()
    {
        $settings        = $this->Ivisa_model->get_front_settings();
        $countries_json  = file_get_contents('./application/json/countries.json');
        $countries_array = json_decode($countries_json, TRUE);
        $parameters      = $this->input->get();
        $response_status = NULL;
        
        if (empty($parameters)) 
        {
            $parameters['nationality_country'] = $settings->from;
            $parameters['destination_country'] = $settings->to;
        }

        $data = array();
        foreach($countries_array as $countries_object)
        {
            if(strtolower($parameters['nationality_country']) == strtolower($countries_object['iso2']) || 
                strtolower($parameters['nationality_country']) == strtolower($countries_object['short_name']))
            {
                $data['nationality_country'] = $countries_object;
            }
            else if(strtolower($parameters['destination_country']) == strtolower($countries_object['iso2']) || 
                strtolower($parameters['destination_country']) == strtolower($countries_object['short_name']))
            {
                $data['destination_country'] = $countries_object;
            }
        }

        // Now i have the codes of both countries
        $affiliate_code = $settings->aid;
        $api_params = array(
            'nationality_country' => $data['nationality_country']['iso2'], 
            'destination_country' => $data['destination_country']['iso2'], 
            'utm_source'=> $affiliate_code
        );
        $api_resp = json_decode(file_get_contents('http://www.ivisa.com/api/visa_required?' . http_build_query($api_params)), true);
        // NOTE: use bootstrap=0, jquery=0, jquery_ui=0 if these libaries are already loaded on your page
        if(isset($api_resp['ivisa_supported']) && $api_resp['ivisa_supported'] == 1) {
            $response_return = array(
                'status' => 'success',
                'data' => array(
                    'frame_url' => $api_resp['application_url'] . 'mode=embed&utm_source='.$affiliate_code
                )
            );
        }
        else if(isset($api_resp['ivisa_supported']) && $api_resp['ivisa_supported'] == 0) {
            $str =  str_replace('\\', '', $api_resp['error_msg']);
            preg_match_all('/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/s', $str, $matches);
            
            $response_return = array(
                'status' => 'fail',
                'error' => array(
                    'next_url' => $matches[0][0]
                )
            );
        }
        else {
            $response_return = array(
                'status' => 'error',
                'error' => array(
                    'message' => $api_resp['error_msg']
                )
            );
        }

        $this->response($response_return, 200);
    }
}