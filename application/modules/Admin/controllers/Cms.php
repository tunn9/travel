<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Cms extends MX_Controller {
		public $role;

		function __construct() {
				modules :: load('Admin');
				$chk = modules :: run('Admin/validadmin');
				if (!$chk) {
					$this->session->set_userdata('prevURL', current_url());
						redirect('admin');
				}
				$this->load->library('Ckeditor');
				$this->data['ckconfig'] = array();
				$this->data['ckconfig']['toolbar'] = array(array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles'), array('NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'), array('Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'), array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),);
				$this->data['ckconfig']['language'] = 'en';
				$this->data['ckconfig']['height'] = '350px';
				$this->data['ckconfig']['filebrowserUploadUrl'] =  base_url().'home/cmsupload';
				$this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
				$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
                $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
                $this->role = $this->session->userdata('pt_role');
				$this->data['role'] = $this->role;

// $this->session->set_userdata('baseck',base_url());// $_SESSION['baseurlck'] = base_url();
                $this->data['languages'] = pt_get_languages();
		}

		public function index() {
				$this->load->helper('xcrud');
				$xcrud = xcrud_get_instance();
				$xcrud->language('vi');
				$xcrud->table('pt_cms');
				$xcrud->where('pt_cms_content.content_lang_id', DEFLANG);
				$xcrud->where('pt_cms_content.content_special', '0');
			//	$xcrud->where('page_slug !=', 'contact-us');
				$xcrud->join('page_id', 'pt_cms_content', 'content_page_id');
				$xcrud->order_by('pt_cms_content.content_page_id', 'desc');
				$xcrud->columns('pt_cms_content.content_page_title,page_slug,page_target,page_status');
				$xcrud->limit(50);
                $xcrud->unset_add();
                $xcrud->unset_view();
                $xcrud->unset_edit();
                $xcrud->unset_remove();
                $xcrud->label('pt_cms_content.content_page_title','Tên mục');
                $xcrud->label('page_slug','Tên trên đường dẫn');
                $xcrud->label('page_target','Mục tiêu trang');
                $xcrud->label('page_status','Trạng thái');
                $xcrud->button(base_url() .'admin/cms/pages/edit/{page_id}', 'Cập nhật', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
                $delurl = base_url().'admin/ajaxcalls/delPage';
                $xcrud->button("javascript: delfunc('{page_id}','$delurl')",'Xóa','fa fa-times', 'btn-danger',array('target'=>'_self'));
                $this->data['addpermission'] = true;
                $this->data['add_link'] = base_url().'admin/cms/pages/add';

                $xcrud->multiDelUrl = base_url().'admin/ajaxcalls/multiDelPage';
                $this->data['content'] = $xcrud->render();
				$this->data['page_title'] = 'Cài đặt trang';
				$this->data['main_content'] = 'temp_view';
				$this->data['header_title'] = 'Cài đặt trang';
                $this->load->view('Admin/template', $this->data);
		}

		public function pages($args, $pageid = null, $langid = null) {
				if ($args == null) {
						redirect('admin/cms');
				}
				elseif ($args == 'add') {
						$addpage = $this->input->post('action');
						$this->data['pages_titles'] = $this->Cms_model->get_cms_pages_title();
						if ($addpage == "add") {
								$this->form_validation->set_rules('pagetitle', 'Page Title', 'trim|required');
								$this->form_validation->set_rules('pageslug', 'Page Slug', 'trim');
								$this->form_validation->set_rules('keywords', 'Meta Keywords', 'trim');
								$this->form_validation->set_rules('pagedesc', 'Meta Description', 'trim');
								$this->form_validation->set_rules('pagebody', 'Page Content', 'trim');
								if ($this->form_validation->run() == FALSE) {
								}
								else {
										$pageid = $this->Cms_model->addpage();
                    $this->Cms_model->add_translation($this->input->post('translated'),$pageid);
									  $this->session->set_flashdata('flashmsgs', 'Page added Successfully');
										redirect('admin/cms');

								}
						}
						$this->data['action'] = 'add';
						$this->data['main_content'] = 'cms/manage';
						$this->data['page_title'] = 'Thêm trang';
						$this->load->view('template', $this->data);
				}
				elseif ($args == 'edit') {
// $delete =  $this->input->post('deletepage');
// $edit  =  $this->input->post('editpage');
// $pageid = $this->input->post('pageid');
						if (empty ($pageid)) {
								redirect('admin/cms');
						}
						else {
								$updatepage = $this->input->post('action');
								if ($updatepage == "update") {
								     	$pagetitle = $this->input->post('pagetitle');
										$this->form_validation->set_rules('pagetitle', 'Page Title', 'trim|required');

								if ($this->form_validation->run() == FALSE){

										}else{
									$result = $this->Cms_model->updatepage();
                  $this->Cms_model->update_translation($this->input->post('translated'),$pageid);
										}
								}
							  //	$this->data['pages_titles'] = $this->Cms_model->get_cms_pages_title(DEFLANG, $pageid);
								$this->data['pageid'] = $pageid;
								$this->data['action'] = "update";
								$this->data['pagedata'] = $this->Cms_model->get_page_data($pageid);
								$this->data['main_content'] = 'cms/manage';
								$this->data['page_title'] = 'Cập nhật trang';
								$this->load->view('template', $this->data);
						}
				}
				elseif ($args == 'translate' && $pageid != null && $langid != null) {
						$this->_translate_page($pageid, $langid);
				}
		}
// Edit page in other language

		public function _translate_page($pageid, $langid) {
				$this->data['langid'] = $langid;
				$add_trans_content = $this->input->post('add_trans');
				$update_trans_content = $this->input->post('update_trans');
				if (!empty ($add_trans_content)) {
						$this->form_validation->set_rules('pagetitle', 'Page Title', 'trim|required|is_unique[pt_cms_content.content_page_title]');
						if ($this->form_validation->run() == FALSE) {
						}
						else {
								$this->Cms_model->add_translation($langid, $pageid);
								$this->data['successmsg'] = 'Thêm nội dung thành công';
						}
				}
				if (!empty ($update_trans_content)) {
						$contentid = $this->input->post('contentid');
						$this->form_validation->set_rules('pagetitle', 'Page Title', 'trim|required');
						if ($this->form_validation->run() == FALSE) {
						}
						else {
								$this->Cms_model->update_translation($contentid);
								$this->data['successmsg'] = 'Cập nhật nội dung thành công';
						}
				}
				$this->data['tpage_content'] = $this->Cms_model->translated_content($pageid, $langid);
				$this->data['main_content'] = 'cms/cms-translate-page';
				$this->data['page_title'] = 'Trang dịch';
				$this->load->view('template', $this->data);
		}

		public function _manage_pages() {
				$this->data['all_pages'] = $this->Cms_model->get_all_cms_pages();
// $this->data['all_languages'] = $this->Translation_model->get_translation_languages();
				$this->data['all_languages'] = pt_get_languages();
				$this->data['main_content'] = 'cms/cms-manage-pages';
				$this->data['page_title'] = 'Bố cục trang';
				$this->load->view('template', $this->data);
		}

		public function menus($arg) {
		   $this->data['languages'] = pt_get_languages();
				if ($arg == 'manage') {
						$this->data['successmsg'] = $this->session->flashdata('flashmsgs');
						$this->data['selectmenu'] = $this->input->post('selectmenu');
						$this->data['updatemenu'] = $this->input->post('updatemenu');
						$this->data['addtomenu'] = $this->input->post('addtomenu');
						$addmenu = $this->input->post('addmenu');
						$menu = $this->input->post('menu');
						if (empty ($menu)) {
								$menu = '1';
						}
						if (!empty ($this->data['addtomenu'])) {
								$this->Menus_model->add_to_menu();
						}
						if (!empty ($this->data['updatemenu'])) {
								$this->Menus_model->update_menu_detail();
						}
						if (!empty ($menu)) {
								$this->data['menudetail'] = $this->Menus_model->get_menus($menu);
								$mitems = array();
								$menu_arr = json_decode($this->data['menudetail'][0]->menu_items);
								foreach ($menu_arr as $marr) {
										$mitems[] = $marr->id;
										if (!empty ($marr->children)) {
												foreach ($marr->children as $ch) {
														$mitems[] = $ch->id;
												}
										}
								}
								$this->data['menuarray'] = $mitems;
						}
						if (!empty ($addmenu)) {
								$this->Menus_model->add_menu();
						}
						$this->data['menus'] = $this->Menus_model->get_menus();
						$this->data['main_content'] = 'cms/cms-menus-manage';
						$this->data['page_title'] = 'Bố cục menu';
						$this->load->view('template', $this->data);
				}
				else {
						redirect('admin/cms');
				}
		}

		function my_baseURL() {
				if (isset ($_SERVER['HTTP_HOST'])) {
						$http = isset ($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
						$hostname = $_SERVER['HTTP_HOST'];
						$dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
						$tmplt = "%s://%s%s";
						$end = $dir;
						$base_url = sprintf($tmplt, $http, $hostname, $end);
				}
				else
						$base_url = 'http://localhost/';
				return $base_url;
		}

}
