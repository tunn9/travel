<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class Ticketlevels extends MX_Controller {
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
		$this->load->model('Admin/Ticket_level_model');
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
		$xcrud->table('pt_ticket_levels');
		$xcrud->order_by('ticket_level_id','desc');
		$xcrud->columns('ticket_airline_name,ticket_airline_code,ticket_level_code');
		$xcrud->label('ticket_airline_name','Hãng vé')->label('ticket_airline_code','Mã')->label('ticket_level_code','Hạng vé');
		$xcrud->fields('ticket_airline_name,ticket_airline_code,ticket_level_code');
		$xcrud->unset_add();
		$xcrud->unset_view();
		$xcrud->unset_edit();
		$xcrud->unset_remove();
		$this->data['add_link'] = base_url().'admin/ticketlevels/add';
		if($this->editpermission){
			$xcrud->button(base_url() . $this->data['adminsegment'] . '/ticketlevels/manage/{ticket_level_id}', 'Chỉnh sửa', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
			// $xcrud->column_pattern('pmethod_title', '<a href="' . base_url() . $this->data['adminsegment'] . '/paymentmethods/manage/{pmethod_id}' . '">{value}</a>');
		}
		if($this->deletepermission){
		    $delurl = base_url().'admin/ajaxcalls/delTicketLevel';
            $xcrud->button("javascript: delfunc('{ticket_level_id}','$delurl')",'Xóa','fa fa-times', 'btn-danger',array('target'=>'_self'));
        }
		$xcrud->search_columns('ticket_airline_name,ticket_level_code');

		//$xcrud->multiDelUrl = base_url().'blog/blogajaxcalls/delMultiplePosts';

		$this->data['content'] = $xcrud->render();
		$this->data['page_title'] = 'Quản lý hạng vé';
		$this->data['main_content'] = 'temp_view';
		$this->data['header_title'] = 'Quản lý hạng vé';
		$this->load->view('template', $this->data);

	}

	function add() {
		$addpost = $this->input->post('action');
		if ($addpost == "add") {
			$this->form_validation->set_rules('ticket_level_code', 'Hạng vé', 'trim|required');
			$this->form_validation->set_rules('desc', 'Nội dung', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			}
			else {
				$postid = $this->Ticket_level_model->add_ticket_level();

				$this->session->set_flashdata('flashmsgs', 'Hạng vé được thêm thành công');
				redirect('admin/ticketlevels');
			}
		}
		$this->data['action'] = "add";
		$this->data['main_content'] = 'ticketlevels/ticket-class-management';
		$this->data['page_title'] = 'Thêm hạng vé';
		$this->load->view('Admin/template', $this->data);
	}

	function manage($pid) {
		if (empty ($pid)) {
			redirect('admin/ticketlevels');
		}
		$updatepost = $this->input->post('action');
		$postid = $this->input->post('postid');
		$this->data['action'] = "update";
		if ($updatepost == "update" ) {
			$this->form_validation->set_rules('ticket_level_code', 'Hạng vé', 'trim|required');
			$this->form_validation->set_rules('desc', 'Nội dung', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			}
			else {
				$this->Ticket_level_model->update_ticket_level($pid);
				$this->session->set_flashdata('flashmsgs', 'Hạng vé được thêm thành công');
				redirect('admin/ticketlevels');
			}
		}
		else {
			$this->data['pdata'] = $this->Ticket_level_model->get_ticket_level_data($pid);
			if (empty ($this->data['pdata'])) {
				redirect('admin/ticketlevels');
			}

			$this->data['main_content'] = 'ticketlevels/ticket-class-management';
			$this->data['page_title'] = 'Cập nhật hạng vé';
			$this->load->view('Admin/template', $this->data);
		}
	}

}
