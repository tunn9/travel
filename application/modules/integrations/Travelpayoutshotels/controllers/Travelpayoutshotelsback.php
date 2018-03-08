<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Travelpayoutshotelsback extends MX_Controller {
  
  function __construct() 
  {
      $seturl = $this->uri->segment(3);
      if ($seturl != "settings") {
        $module = $this->getModuleStatus();
        if ( ! $module ) { Module_404(); }
      }

      $checkingadmin = $this->session->userdata('pt_logged_admin');
      if (!empty($checkingadmin)) {
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
      }
      else {
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_agent');
      }
      if (empty($this->data['userloggedin'])) {
        redirect("admin");
      }
      if (!empty($checkingadmin)) {
        $this->data['adminsegment'] = "admin";
      }
      else {
        $this->data['adminsegment'] = "agent";
      }
      if ($this->data['adminsegment'] == "admin") {
        $chkadmin = modules::run('Admin/validadmin');
        if (!$chkadmin) {
          redirect('admin');
        }
      }
      else {
        $chkagent = modules::run('agent/validagent');
        if (!$chkagent) {
          redirect('agent');
        }
      }
      if (!pt_permissions('Travelpayouts', $this->data['userloggedin'])) {
        redirect('admin');
      }
      $this->load->helper('settings');
      $this->load->model('Travelpayoutshotels/Travelpayoutshotels_model');
      $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
      $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
  }

  function index() 
  {
      $abstractClass = new ReflectionClass('Travelpayoutshotelsback');
      echo dirname($abstractClass->getFileName());
  }

    function settings() 
    {
        $updatesett = $this->input->post('updatesettings');
        if (!empty($updatesett)) {
          $this->Travelpayoutshotels_model->update_front_settings();
          redirect('admin/travelpayoutshotels/settings');
        }
        $this->data['settings'] = $this->Travelpayoutshotels_model->get_front_settings();
        $this->data['main_content'] = 'Travelpayoutshotels/settings';
        $this->data['page_title'] = 'Travelpayouts Settings';
        $this->load->view('Admin/template', $this->data);
    }

    public static function getModuleStatus()
    {
        $settings_file = fopen(__DIR__ . '/../settings.json', "r") or die("Unable to open settings file!");
        $settings = fread($settings_file, filesize(__DIR__ . '/../settings.json'));
        fclose($settings_file);
        $settings = json_decode($settings);
        
        if(empty($settings)) 
        {
          die("Settings file is empty!"); 
        }
        
        return $settings->status;
    }
}