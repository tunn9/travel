<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class GroupAirlines extends MX_Controller {
	public $accType = "";
	public $langdef;
	public $editpermission = true;
	public $deletepermission = true;
	public $role;

	function __construct() {
		modules :: load('Admin');
		$chkadmin = modules :: run('Admin/validadmin');
		if (!$chkadmin) {
			$this->session->set_userdata('prevURL', current_url());
			redirect('admin');
		}
		// $seturl = $this->uri->segment(3);
		// if ($seturl != "settings") {
		// 	$chk = modules :: run('Home/is_main_module_enabled', 'blog');
		// 	if (!$chk) {
		// 		redirect("admin");
		// 	}
		// }
		$checkingadmin = $this->session->userdata('pt_logged_admin');
		$this->accType = $this->session->userdata('pt_accountType');
		$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
    	$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');

		$this->role = $this->session->userdata('pt_role');
		$this->data['role'] = $this->role;

		if (!empty ($checkingadmin)) {
			$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
		}
		else {
			$this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
		}
		if (empty ($this->data['userloggedin'])) {
			redirect("admin");
		}
		if (!empty ($checkingadmin)) {
			$this->data['adminsegment'] = "admin";
		}
		if (empty($this->data['isSuperAdmin'])) {
			redirect('admin');
		}


		$this->data['c_model'] = $this->countries_model;
		$this->data['addpermission'] = true;
		$this->load->model('Admin/Group_airline_model');
		$this->langdef = DEFLANG;
	}

	function index() {
		$this->load->helper('xcrud');
		$updategroup = $this->input->post('updategroup');
		if(!empty($updategroup)){
			$this->Group_airline_model->update_group_airline();
			redirect('admin/groupairlines');
		}

		$addgroup = $this->input->post('addgroup');
		if(!empty($addgroup)){
			$this->Group_airline_model->add_group_airline();
			redirect('admin/groupairlines');
		}
		$xcrud = xcrud_get_instance();
		$xcrud->language('vi');
		$xcrud->table('pt_group_airlines');
		$xcrud->order_by('g_airline_id','desc');
		$xcrud->columns('g_airline_name,g_airline_status');
		$xcrud->label('g_airline_name','Tên liên minh')->label('g_airline_status','Trạng thái');
		$xcrud->button('#group{g_airline_id}', 'Chỉnh sửa', 'fa fa-edit', 'btn btn-warning', array('data-toggle' => 'modal'));
		$delurl = base_url().'admin/ajaxcalls/delGroupAir';
		$xcrud->button("javascript: delfunc('{g_airline_id}','$delurl')",'Xóa','fa fa-times', 'btn-danger',array('target'=>'_self'));
		$xcrud->search_columns('g_airline_name,g_airline_status');
		$xcrud->column_callback('g_airline_status', 'create_status_icon');

		$xcrud->unset_add();
		$xcrud->unset_view();
		$xcrud->unset_edit();
		$xcrud->unset_remove();
		$this->data['groupairs'] = $this->Group_airline_model->get_all_group_airlines();

		//$xcrud->multiDelUrl = base_url().'blog/blogajaxcalls/delMultiplePosts';
		$this->data['content'] = $xcrud->render();
		$this->data['page_title'] = 'Liên minh hàng không';
		$this->data['main_content'] = 'groupairlines/group_airline_view';
		$this->data['header_title'] = 'Liên minh hàng không';
		$this->load->view('template', $this->data);
	}
}
