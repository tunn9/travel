<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class PaymentMethods extends MX_Controller {
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
		$seturl = $this->uri->segment(3);
		if ($seturl != "settings") {
			$chk = modules :: run('Home/is_main_module_enabled', 'blog');
			if (!$chk) {
				redirect("admin");
			}
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
		//if($this->accType == "admin"){
			$this->editpermission = pt_permissions("editblog", $this->data['userloggedin']);
			$this->deletepermission = pt_permissions("deleteblog", $this->data['userloggedin']);
			$this->data['addpermission'] = pt_permissions("addblog", $this->data['userloggedin']);
		//}
		$this->load->model('Admin/Payment_methods_model');
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
		$xcrud->table('pt_payment_methods');
		$xcrud->order_by('pmethod_id','desc');
		$xcrud->columns('pmethod_title,pmethod_desc,pmethod_order, pmethod_status');
		$xcrud->label('pmethod_title','Tên phương thức')->label('pmethod_desc','Nội dung')->label('pmethod_order','Thứ tự')->label('pmethod_status','Trạng thái');
		#$xcrud->fields('pmethod_title,pmethod_desc,pmethod_status, pmethod_order');
		$xcrud->unset_add();
		$xcrud->unset_view();
		$xcrud->unset_edit();
		$xcrud->unset_remove();
		$this->data['add_link'] = base_url().'admin/paymentmethods/add';
		if($this->editpermission){
			$xcrud->button(base_url() . $this->data['adminsegment'] . '/paymentmethods/manage/{pmethod_id}', 'Chỉnh sửa', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
			// $xcrud->column_pattern('pmethod_title', '<a href="' . base_url() . $this->data['adminsegment'] . '/paymentmethods/manage/{pmethod_id}' . '">{value}</a>');
		}
		if($this->deletepermission){
		    $delurl = base_url().'admin/ajaxcalls/delPaymentMethod';
            $xcrud->button("javascript: delfunc('{pmethod_id}','$delurl')",'Xóa','fa fa-times', 'btn-danger',array('target'=>'_self'));
        }
		$xcrud->search_columns('pmethod_title,pmethod_status');
		$xcrud->column_callback('pmethod_order', 'orderInputPaymentMethod');
		$xcrud->column_callback('pmethod_created_at','fmtDate');
		$xcrud->column_callback('pmethod_status', 'create_status_icon');

		//$xcrud->multiDelUrl = base_url().'blog/blogajaxcalls/delMultiplePosts';

		$this->data['content'] = $xcrud->render();
		$this->data['page_title'] = 'Phương thức thanh toán';
		$this->data['main_content'] = 'temp_view';
		$this->data['header_title'] = 'Phương thức thanh toán';
		$this->load->view('template', $this->data);

	}

	function add() {

		$addpost = $this->input->post('action');
		if ($addpost == "add") {
			$this->form_validation->set_rules('title', 'Tên phương thức thanh toán', 'trim|required');
			$this->form_validation->set_rules('desc', 'Nội dung phương thức thanh toán', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			}
			else {
				$postid = $this->Payment_methods_model->add_payment_method();

				$this->session->set_flashdata('flashmsgs', 'Phương thức thanh toán được thêm thành công');
				redirect('admin/paymentmethods');
			}
		}
		$this->data['action'] = "add";
		$this->data['main_content'] = 'paymentmethods/payment-method-management';
		$this->data['page_title'] = 'Thêm mới phương thức thanh toán';
		$this->load->view('Admin/template', $this->data);
	}

	function manage($pid) {
		if (empty ($pid)) {
			redirect('admin/paymentmethods');
		}
		$updatepost = $this->input->post('action');
		$postid = $this->input->post('postid');
		$this->data['action'] = "update";
		if ($updatepost == "update" ) {
			$this->form_validation->set_rules('title', 'Tên phương thức thanh toán', 'trim|required');
			$this->form_validation->set_rules('desc', 'Nội dung phương thức thanh toán', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
			}
			else {
				$this->Payment_methods_model->update_payment_method($pid);
				$this->session->set_flashdata('flashmsgs', 'Phương thức thanh toán được thêm thành công');
				redirect('admin/paymentmethods');
			}
		}
		else {
			$this->data['pdata'] = $this->Payment_methods_model->get_payment_method_data($pid);
			if (empty ($this->data['pdata'])) {
				redirect('admin/paymentmethods');
			}

			$this->data['main_content'] = 'paymentmethods/payment-method-management';
			$this->data['page_title'] = 'Chỉnh sửa phương thức thanh toán';
			$this->load->view('Admin/template', $this->data);
		}
	}

}
