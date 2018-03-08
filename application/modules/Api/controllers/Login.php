<?php
header('Access-Control-Allow-Origin: *');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/Api/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent :: __construct();
        if(!$this->isValidApiKey){
        $this->response($this->invalidResponse, 400);
        }
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['list_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key

        //Error Response Array
        //array('response' => '', 'error' => array('status' => TRUE,'code' => "101",'msg' => 'Invalid App Key'));
    }

     function check_post() {
                $email = $this->post('email');
                $password = $this->post('password');

                $data = $this->verify($email, $password);
                if($data->status){
                    if($data->isVerified){
                      $message = array('response' => TRUE, 'error' => array('status' => FALSE,'msg' => ''), 'userInfo' => $data->userData );
                    }else{
                      $message = array('response' => FALSE, 'error' => array('status' => TRUE,'msg' => 'Account Inactive'));
                    }
                }else{
                      $message = array('response' => FALSE, 'error' => array('status' => TRUE,'msg' => 'Invalid Login'));
                }


                $this->response($message, 200); // 200 being the HTTP response code
        }

    function verify($email, $password){
        $this->db->select('accounts_email as email,accounts_id as id,ai_first_name as firstName, ai_last_name as lastName,accounts_status as status');
        $this->db->where('accounts_email', $email);
        $this->db->where('accounts_password', sha1($password));
        $this->db->where('accounts_type', 'customers');
        //$this->db->where('accounts_status', 'yes');
        $q = $this->db->get('pt_accounts');
        $user = $q->result();
        $num = $q->num_rows();
        $response = new stdClass;
        if ($num > 0) {

            if($user[0]->status == "yes"){
                $response->status = TRUE;
                $response->isVerified = TRUE;
                $response->userData = (object)$user[0];

            }else{

                $response->status = TRUE;
                $response->isVerified = FALSE;
            }

        }
        else {

            $response->status = FALSE;
            $response->userData = "";
        }

        return $response;

    }


    function signup_post(){

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $errormsg = "Email Already Registered";
        $fieldsValid = TRUE;
        $signedup = FALSE;

        if(empty($email)){
            $errormsg = "Email is Invalid";

        }else if(empty($password)){
            $errormsg = "Password is Required";
            $fieldsValid = FALSE;
        }else{

            $fieldsValid = TRUE;
        }

        if($fieldsValid){

        $this->load->model('Admin/Accounts_model');
        $result = $this->Accounts_model->apisignup_account($this->post(),'customers');

        if($result > 0){
            $this->load->model('Admin/Emails_model');
            $fullname = $this->input->post('first_name') . " " . $this->input->post('last_name');
            $edata = array("email" => $this->input->post('email'), "fullname" => $fullname, "mobile" => $this->input->post('phone'), "password" => $this->input->post('password'));

            $this->Emails_model->new_customer_email($edata);
            $this->Emails_model->customer_signup($edata);
            $signedup = TRUE;
        }

        }



        if($signedup){

             $message = array('response' => TRUE, 'error' => array('status' => FALSE,'msg' => ''));

        }else{

             $message = array('response' => FALSE, 'error' => array('status' => TRUE,'msg' => $errormsg));
        }

        $this->response($message, 200); // 200 being the HTTP response code

    }

    function profile_get(){

        $id = $this->get('id');
        $this->load->model('Admin/Accounts_model');
        $profile = $this->Accounts_model->get_profile_details($id);
        unset($profile[0]->accounts_password);
        unset($profile[0]->accounts_last_login);
        unset($profile[0]->facebook_id);
        unset($profile[0]->accounts_permissions);
        unset($profile[0]->accounts_updated_at);
        unset($profile[0]->accounts_created_at);
        unset($profile[0]->accounts_is_admin);
        unset($profile[0]->accounts_type);
        unset($profile[0]->ai_image);
        unset($profile[0]->ai_passport);
        unset($profile[0]->ai_website);
        unset($profile[0]->appliedfor);
        $p = (object) $profile[0];
        if(!empty($p)){
          $this->response(array('response' => $p, 'error' => array('status' => FALSE,'msg' => '')), 200);
        }else{
          $this->response(array('response' => $p, 'error' => array('status' => TRUE,'msg' => 'Invalid ID')), 200);
        }


    }


    function updateprofile_post(){

        $id = $this->post('id');
        $this->load->model('Admin/Accounts_model');
        $this->Accounts_model->update_profile_customer($id);

        $message = array('response' => TRUE, 'error' => array('status' => FALSE,'msg' => ''));

        $this->response($message, 200);

        }
}
