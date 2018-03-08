<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class Baggages extends MX_Controller {
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
		// else {
		// 	$this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
		// }
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
		//if($this->accType == "admin"){
			$this->editpermission = pt_permissions("editblog", $this->data['userloggedin']);
			$this->deletepermission = pt_permissions("deleteblog", $this->data['userloggedin']);
			$this->data['addpermission'] = pt_permissions("addblog", $this->data['userloggedin']);
		//}
		$this->load->model('Admin/Baggages_model');
		$this->load->library('Ckeditor');
		$this->data['ckconfig'] = array();
		$this->data['ckconfig']['toolbar'] = array(array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles'), array('NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'), array('Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'), array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),);
		$this->data['ckconfig']['language'] = 'en';
		$this->data['ckconfig']['height'] = '350px';
		$this->data['ckconfig']['filebrowserUploadUrl'] =  base_url().'home/cmsupload';
		$this->langdef = DEFLANG;
		$this->data['languages'] = pt_get_languages();
	}

	function index() {

		$this->load->helper('xcrud');
		$xcrud = xcrud_get_instance();
		$xcrud->language('vi');
		$xcrud->table('pt_baggages');
		$xcrud->order_by('baggage_id','desc');
		$xcrud->columns('baggage_airline_name,baggage_class,baggage_desc,baggage_status');
		$xcrud->label('baggage_airline_name','Hãng vé')->label('baggage_class','Hạng vé')->label('baggage_desc','Thông tin hành lý')->label('baggage_status','Trạng thái');
		#$xcrud->fields('ticket_airline_name,ticket_airline_code,ticket_level_code');
		$xcrud->unset_add();
		$xcrud->unset_view();
		$xcrud->unset_edit();
		$xcrud->unset_remove();
		$this->data['add_link'] = base_url().'admin/baggages/add';
		if($this->editpermission){
			$xcrud->button(base_url() . $this->data['adminsegment'] . '/baggages/manage/{baggage_id}', 'Sửa', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
			// $xcrud->column_pattern('pmethod_title', '<a href="' . base_url() . $this->data['adminsegment'] . '/paymentmethods/manage/{pmethod_id}' . '">{value}</a>');
		}
		if($this->deletepermission){
		    $delurl = base_url().'admin/ajaxcalls/delBaggage';
            $xcrud->button("javascript: delfunc('{baggage_id}','$delurl')",'Xóa','fa fa-times', 'btn-danger',array('target'=>'_self'));
        }
		$xcrud->search_columns('baggage_airline_name,baggage_class,baggage_status');
		$xcrud->column_callback('baggage_status', 'create_status_icon');
		//$xcrud->multiDelUrl = base_url().'blog/blogajaxcalls/delMultiplePosts';

		$this->data['content'] = $xcrud->render();
		$this->data['page_title'] = 'Quản lý hành lý';
		$this->data['main_content'] = 'temp_view';
		$this->data['header_title'] = 'Quản lý hành lý';
		$this->load->view('template', $this->data);

	}

	function add() {
		$addpost = $this->input->post('action');
		if ($addpost == "add") {
			$this->form_validation->set_rules('class_code', 'Hạng vé', 'trim|required');
			$this->form_validation->set_rules('desc', 'Nội dung', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			}
			else {
				$postid = $this->Baggages_model->add_baggage();

				$this->session->set_flashdata('flashmsgs', 'Hành lý được thêm thành công');
				redirect('admin/baggages');
			}
		}
		$this->data['action'] = "add";
		$this->data['main_content'] = 'baggages/baggages-management';
		$this->data['page_title'] = 'Thêm hành lý';
		$this->load->view('Admin/template', $this->data);
	}

	function manage($pid) {
		if (empty ($pid)) {
			redirect('admin/baggages');
		}
		$updatepost = $this->input->post('action');
		$postid = $this->input->post('postid');
		$this->data['action'] = "update";
		if ($updatepost == "update" ) {
			$this->form_validation->set_rules('class_code', 'Hạng vé', 'trim|required');
			$this->form_validation->set_rules('desc', 'Nội dung', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			}
			else {
				$this->Baggages_model->update_baggage($pid);
				$this->session->set_flashdata('flashmsgs', 'Hành lý được thêm thành công');
				redirect('admin/baggages');
			}
		}
		else {
			$this->data['pdata'] = $this->Baggages_model->get_baggages_data($pid);
			if (empty ($this->data['pdata'])) {
				redirect('admin/baggages');
			}

			$this->data['main_content'] = 'baggages/baggages-management';
			$this->data['page_title'] = 'Cập nhật hành lý';
			$this->load->view('Admin/template', $this->data);
		}
	}

}
