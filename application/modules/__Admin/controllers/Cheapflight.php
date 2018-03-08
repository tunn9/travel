<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Cheapflight extends MX_Controller
{
    public $role;
    public $xcrud;

    function __construct()
    {
        parent:: __construct();
        //modules :: load('Admin');
        $this->load->module("admin");
        $this->load->model('Admin/Cheap_flight_model');
        $this->data['c_model'] = $this->Countries_model;
        $this->data['countries'] = $this->data['c_model']->get_all_countries();
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['userid'] = $this->session->userdata('pt_logged_id');
        $this->data['modules'] = $this->Modules_model->get_all_modules();
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;

        $this->data['cheapflight_type'] = array('Một chiều', 'Khứ hồi');
        $this->data['cheapflight_status'] = array('Đã dừng','Khả dụng');
        $this->data['cheapflight_carrier'] = array('Vietnam Airlines', 'Jetstar Pacific', 'VietJet Air');
    }

    function index()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->language('vi');
        $xcrud->table('pt_cheapflight');
        $xcrud->order_by('cheapflight_index', 'asc');
        $xcrud->unset_add();
        $xcrud->unset_view();
        $xcrud->unset_edit();
        $xcrud->unset_remove();
        $this->data['addpermission'] = true;
        $xcrud->columns('title,startpoint,endpoint,godate,comebackdate,adt,chd,inf,type,price,carrier,status');
        $xcrud->column_callback('godate','fmtDate');
        $xcrud->column_callback('comebackdate','fmtDate');
        $xcrud->label('title', 'Tiêu đề')->label('startpoint', 'Điểm đi')->label('endpoint', 'Điểm đến')->label('godate', 'Ngày đi')
            ->label('comebackdate', 'Ngày về')->label('adt', 'Người lớn')->label('chd', 'Trẻ em')->label('inf', 'Em bé')
            ->label('type', 'Loại vé')->label('price', 'Giá')->label('carrier', 'Hãng vận chuyển')->label('status', 'Tình trạng');
        $xcrud->button(base_url() . 'admin/cheapflight/edit/{cheapflight_id}', 'Cập nhật', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));

        $delurl = base_url() . 'admin/ajaxcalls/delCheapFlight';
        $xcrud->multiDelUrl = base_url() . 'admin/ajaxcalls/delMultipleCheapFlight';

        $xcrud->button("javascript: delfunc('{cheapflight_id}','$delurl')", 'Xóa', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{cheapflight_id}'));

        $this->data['add_link'] = base_url() . 'admin/cheapflight/add';
        $this->data['content'] = $xcrud->render();

        $this->data['page_title'] = 'Chyến bay giá rẻ';
        $this->data['main_content'] = 'temp_view';
        $this->data['header_title'] = 'Chuyến bay giá rẻ';
        $this->load->view('template', $this->data);
    }

    function add() {
        $addcheapflight = $this->input->post('submittype');
        $this->data['submittype'] = "add";
        if (!empty ($addcheapflight)) {
            $this->form_validation->set_rules('title', 'Tiêu đề', 'trim|required');
            $this->form_validation->set_rules('startpoint', 'Điểm đi', 'trim|required');
            $this->form_validation->set_rules('endpoint', 'Điểm đến', 'trim|required');
            $this->form_validation->set_rules('godate', 'Ngày đi', 'trim|required');
            $this->form_validation->set_rules('comebackdate', 'Ngày về', 'trim|required');
            $this->form_validation->set_rules('adt', 'Người lớn', 'trim|required');
            $this->form_validation->set_rules('chd', 'Trẻ em', 'trim|required');
            $this->form_validation->set_rules('inf', 'Em bé', 'trim|required');
            $this->form_validation->set_rules('type', 'Loại vé', 'trim|required');
            $this->form_validation->set_rules('price', 'Giá', 'trim|required');
            $this->form_validation->set_rules('carrier', 'Hãng vận chuyển', 'trim|required');
            $this->form_validation->set_rules('status', 'Tình trạng', 'trim|required');
            $this->form_validation->set_rules('cheapflight_index', 'Vị trí', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
            }
            else {
                $this->Cheap_flight_model->add_cheap_flight();

                $this->session->set_flashdata('flashmsgs', 'Thêm chuyến bay thành công!');
                echo "done";
            }
        }
        else {
            $this->data['page_title'] = 'Thêm chuyến bay giá rẻ';
            $this->data['main_content'] = '/cheapflight/cheapflight';
            $this->data['header_title'] = 'Thêm chuyến bay giá rẻ';
            $this->data['headingText'] = 'Thêm chuyến bay giá rẻ';
            $this->load->view('template', $this->data);
        }
    }


    function edit($cheapflight_id) {
        $updatecheapflight = $this->input->post('submittype');
        $this->data['submittype'] = "update";
        //$cheapflight_id = $this->input->post('cheapflight_id');
        if (!empty($updatecheapflight)) {

            $this->form_validation->set_rules('title', 'Tiêu đề', 'trim|required');
            $this->form_validation->set_rules('startpoint', 'Điểm đi', 'trim|required');
            $this->form_validation->set_rules('endpoint', 'Điểm đến', 'trim|required');
            $this->form_validation->set_rules('godate', 'Ngày đi', 'trim|required');
            $this->form_validation->set_rules('comebackdate', 'Ngày về', 'trim|required');
            $this->form_validation->set_rules('adt', 'Người lớn', 'trim|required');
            $this->form_validation->set_rules('chd', 'Trẻ em', 'trim|required');
            $this->form_validation->set_rules('inf', 'Em bé', 'trim|required');
            $this->form_validation->set_rules('type', 'Loại vé', 'trim|required');
            $this->form_validation->set_rules('price', 'Giá', 'trim|required');
            $this->form_validation->set_rules('carrier', 'Hãng vận chuyển', 'trim|required');
            $this->form_validation->set_rules('status', 'Tình trạng', 'trim|required');
            $this->form_validation->set_rules('cheapflight_index', 'Vị trí', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
            }
            else {
                $this->Cheap_flight_model->update_cheap_flight($cheapflight_id);
                $this->session->set_flashdata('flashmsgs', 'Cập nhật chuyến bay thành công1');
                echo "done";
            }
        }
        else {
            @$this->data['cheapflightdata'] = $this->Cheap_flight_model->get_cheap_flight($cheapflight_id);

            $this->data['godate'] = pt_show_date_php($this->data['cheapflightdata'][0]->godate);
            $this->data['comebackdate'] = pt_show_date_php($this->data['cheapflightdata'][0]->comebackdate);
            $this->data['cheapflight_id'] = $this->data['cheapflightdata'][0]->cheapflight_id;
            $this->data['main_content'] = '/cheapflight/cheapflight';
            $this->data['header_title'] = 'Cập nhật chuyến bay';
            $this->data['headingText'] = 'Cập nhật chuyến bay';
            $this->load->view('template', $this->data);
        }
    }

}
