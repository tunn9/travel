<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wegoflightsback extends MX_Controller {

	function __construct(){
	$seturl =  $this->uri->segment(3);
    if($seturl != "settings"){
    $chk = modules::run('Home/is_main_module_enabled','wegoflights');
    if(!$chk){
    backError_404();
    }
    }
    $checkingadmin = $this->session->userdata('pt_logged_admin');
    if(!empty($checkingadmin)){
    $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
    }else{
    $this->data['userloggedin'] = $this->session->userdata('pt_logged_agent');
    }
    if(empty($this->data['userloggedin'])){
    redirect("admin");
    }
    if(!empty($checkingadmin)){
    $this->data['adminsegment'] = "admin";
    }else{
    $this->data['adminsegment'] = "agent";
    }

    $this->load->helper('settings');
    $this->load->model('Wegoflights/Wegoflights_model');
    $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
    $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
    }
    function index(){
    }

    function settings(){
    $updatesett = $this->input->post('updatesettings');
    if(!empty($updatesett)){
    $this->Wegoflights_model->update_front_settings();
    redirect('admin/wegoflights/settings');
    }
    $this->data['settings'] = $this->Wegoflights_model->get_front_settings();
    $this->data['main_content'] = 'Wegoflights/settings';
	$this->data['page_title'] = 'Wego Flights Settings';
	$this->load->view('Admin/template',$this->data);
    }
    }
