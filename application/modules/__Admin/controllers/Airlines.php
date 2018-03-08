<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class Airlines extends MX_Controller {
	public $accType = "";
	public $langdef;
	public  $editpermission = true;
	public  $deletepermission = true;
	public $role;

	function __construct() {
		modules :: load('Admin');
		$chkadmin = modules :: run('Admin/validadmin');
		if (!$chkadmin) {
			$this->session->set_userdata('prevURL', current_url());
			redirect('admin');
		}

		$checkingadmin = $this->session->userdata('pt_logged_admin');
		$this->accType = $this->session->userdata('pt_accountType');
		$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
    	$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');

		$this->role = $this->session->userdata('pt_role');
		$this->data['role'] = $this->role;

		if (!empty ($checkingadmin)) {
			$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
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
		$this->load->model('Admin/Airlines_model');
		$this->data['languages'] = pt_get_languages();
	}

	function index() {
		$this->load->helper('xcrud');
		$xcrud = xcrud_get_instance();
		$xcrud->language('vi');
		$xcrud->table('pt_airlines');
		$xcrud->join('air_group_id','pt_group_airlines','g_airline_id');
		$xcrud->order_by('air_id','desc');
		$xcrud->columns('air_name,pt_group_airlines.g_airline_name,air_iata_code,air_td_code,air_icao_code,air_country');
		$xcrud->label('air_iata_code','Mã IATA')->label('air_name','Hãng hàng không')->label('pt_group_airlines.g_airline_name','Liên minh')->label('air_td_code','Mã TD')->label('air_icao_code','Mã ICAO')->label('air_country','Thành phố');
		#$xcrud->fields('pmethod_title,pmethod_desc,pmethod_status, pmethod_order');
		$xcrud->unset_add();
		$xcrud->unset_view();
		$xcrud->unset_edit();
		$xcrud->unset_remove();
		$this->data['add_link'] = base_url().'admin/airlines/add';
		$xcrud->button(base_url() . $this->data['adminsegment'] . '/airlines/manage/{air_id}', 'Chỉnh sửa', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
		$delurl = base_url().'admin/ajaxcalls/delAirline';
        $xcrud->button("javascript: delfunc('{air_id}','$delurl')",'Xóa','fa fa-times', 'btn-danger',array('target'=>'_self'));
		$xcrud->search_columns('air_iata_code,air_name,pt_group_airlines.g_airline_name,air_td_code,air_icao_code,air_country');


		$xcrud->multiDelUrl = base_url().'admin/ajaxcalls/delMultipleAirlines';

		$this->data['content'] = $xcrud->render();
		$this->data['page_title'] = 'Hãng hàng không';
		$this->data['main_content'] = 'temp_view';
		$this->data['header_title'] = 'Hãng hàng không';
		$this->load->view('template', $this->data);
	}

	function add() {
		$addairline = $this->input->post('submittype');
		$this->data['submittype'] = "add";
		if (!empty ($addairline)) {
			$this->form_validation->set_rules('airname', 'Tên hãng hàng không', 'trim|required');
			$this->form_validation->set_rules('country', 'Thành phố', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
			}
			else {
				$postid = $this->Airlines_model->add_airline();
				$this->session->set_flashdata('flashmsgs', 'Thêm hãng hàng không thành công');
				echo "done";
			}
		}
		else{
			$this->data['groupairs'] = $this->Airlines_model->get_group_airs();
			$this->data['submittype'] = "add";
			$this->data['main_content'] = '/airlines/airline_view';
			$this->data['page_title'] = 'Thêm mới phương thức thanh toán';
			$this->data['headingText'] = 'Thêm hãng hàng không';
			$this->load->view('template', $this->data);
		}
	}

	function manage($id) {
		// if (empty ($air_id)) {
		// 	redirect('admin/airlines');
		// }
		$updateairline = $this->input->post('submittype');
		$postid = $this->input->post('airlineid');
		$this->data['submittype'] = "update";
		if (!empty($updateairline)) {
			$this->form_validation->set_rules('airname', 'Tên hãng hàng không', 'trim|required');
			$this->form_validation->set_rules('country', 'Thành phố', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
			}
			else {
				$this->Airlines_model->update_airline($postid);
				$this->session->set_flashdata('flashmsgs', 'Cập nhật hãng hàng không thành công');
				echo "done";
			}
		}
		else {
			$this->data['gdata'] = $this->Airlines_model->get_airline_data($id);
			if (empty ($this->data['gdata'])) {
				redirect('admin/airlines');
			}
			$this->data['groupairs'] = $this->Airlines_model->get_group_airs();
			$this->data['airlineid'] = $this->data['gdata'][0]->air_id;
			$this->data['main_content'] = '/airlines/airline_view';
			$this->data['page_title'] = 'Cập nhật hãng hàng không';
			$this->data['headingText'] = 'Cập nhật hãng hàng không';
			$this->load->view('template', $this->data);
		}
	}

}
