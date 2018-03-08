<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Bookings extends MX_Controller {
    public $role;
    public  $editpermission = true;
    public  $deletepermission = true;
    function __construct() {
        modules :: load('Admin');
        $chkadmin = modules :: run('Admin/validadmin');
        if (!$chkadmin) {
            $this->session->set_userdata('prevURL', current_url());
            redirect('admin');
        }
        $this->data['app_settings'] = $this->Settings_model->get_settings_data();
        $checkingadmin = $this->session->userdata('pt_logged_admin');
        if (!empty ($checkingadmin)) {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        }
        else {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
        }
        if (!empty ($checkingadmin)) {
            $this->data['adminsegment'] = "admin";
        }
        else {
            $this->data['adminsegment'] = "supplier";
        }

        $this->load->model('Admin/Bookings_model');
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;
        $this->data['addpermission'] = true;
        if($this->role == "admin"){
        $this->editpermission = pt_permissions("editbooking", $this->data['userloggedin']);
        $this->deletepermission = pt_permissions("deletebooking", $this->data['userloggedin']);
        $this->data['addpermission'] = pt_permissions("addbooking", $this->data['userloggedin']);
        }

        $this->lang->load("back", "vi");
    }

    function index()
    {
        if (! $this->data['addpermission'] && ! $this->editpermission && ! $this->deletepermission) {
            backError_404($this->data);
        } else {
            
            $this->load->helper('xcrud');
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_bookings');
            $xcrud->language('vi');
            // $xcrud->join('booking_user', 'pt_accounts', 'accounts_id');
            $xcrud->order_by('booking_pnr', 'desc');
            $xcrud->columns('booking_pnr,booking_name, booking_email,booking_phone,booking_date,booking_note');
            $xcrud->label('booking_pnr', 'PNR')
                ->label('booking_name', 'Tên khách hàng')
                ->label('booking_email', 'Địa chỉ email')
                ->label('booking_phone', 'Điện Thoại')
                ->label('booking_date', 'Ngày đặt')
                ->label('booking_note', 'Ghi chú');
            $xcrud->column_callback('booking_date', 'fmtDate');
            // $xcrud->column_callback('booking_status', 'bookingStatusBtns');
            $xcrud->search_columns('booking_pnr,booking_name,booking_email,booking_phone');
            $xcrud->button(base_url() . $this->data['adminsegment'] . '/bookings/view/{booking_type}/{booking_id}', 'Xem', 'fa fa-search-plus', 'btn btn-primary', array(
                'target' => '_self'
            ));
            
            if ($this->editpermission) {
                $xcrud->button(base_url() . $this->data['adminsegment'] . '/bookings/edit/{booking_type}/{booking_id}', 'Chỉnh sửa', 'fa fa-edit', 'btn btn-warning', array(
                    'target' => '_self'
                ));
            }
            if ($this->deletepermission) {
                $delurl = base_url() . 'admin/bookings/delBooking';
                $xcrud->multiDelUrl = base_url() . 'admin/bookings/delMultipleBookings';
                
                $xcrud->button("javascript: delfunc('{booking_id}','$delurl')", 'Xóa', 'fa fa-times', 'btn-danger', array(
                    'target' => '_self',
                    'id' => '{booking_id}'
                ));
            }
            
            $this->data['add_link'] = '';
            $xcrud->limit(50);
            $xcrud->unset_add();
            $xcrud->unset_view();
            $xcrud->unset_remove();
            $xcrud->unset_edit();
            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Quản lý đặt vé';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Quản lý đặt vé';
            
            $this->load->view('template', $this->data);
        }
    }



// delete single booking
    function delBooking() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $id = $this->input->post('id');
            $this->Bookings_model->delete_booking($id);
            $this->session->set_flashdata('flashmsgs', "Deleted Successfully");
        }
    }

        // Delete Multiple Bookings
    function delMultipleBookings()
    {
        if (! $this->input->is_ajax_request()) {
            redirect('admin');
        } else {
            $items = $this->input->post('items');
            foreach ($items as $item) {
                $this->Bookings_model->delete_booking($item);
            }
        }
    }

// change booking status to paid
    function booking_status_paid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $bookinglist = $this->input->post('booklist');
            foreach ($bookinglist as $id) {
                $this->Bookings_model->booking_status_paid($id);
            }
            $this->session->set_flashdata('flashmsgs', "Status Changed to Paid Successfully");
        }
    }

// change booking status to unpaid
    function booking_status_unpaid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $bookinglist = $this->input->post('booklist');
            foreach ($bookinglist as $id) {
                $this->Bookings_model->booking_status_unpaid($id);
            }
            $this->session->set_flashdata('flashmsgs', "Status Changed to Unpaid Successfully");
        }
    }

//change single bookin status to paid
    function single_booking_status_paid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $id = $this->input->post('id');
            $this->Bookings_model->booking_status_paid($id);
        }
    }

//change single bookin status to unpaid
    function single_booking_status_unpaid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $id = $this->input->post('id');
            $this->Bookings_model->booking_status_unpaid($id);
        }
    }

// cancellation request
    function cancelrequest($action) {
        $id = $this->input->post('id');
        if ($action == 'approve') {
            $this->Bookings_model->cancel_booking_approve($id);
        }
        else {
            $this->Bookings_model->cancel_booking_reject($id);
        }
    }

//resend invoice
    function resendinvoice() {
        $invoiceid = $this->input->post('id');
        $refno = $this->input->post('refno');
        $this->load->helper('invoice');
        $invoicedetails = invoiceDetails($invoiceid, $refno);
        $this->load->model('emails_model');
        $this->Emails_model->resend_invoice($invoicedetails);
    }

    function view($module, $id)
    {
        $this->load->helper('invoice');
        $this->load->model('Payments_model');
        $this->data['paygateways'] = $this->Payments_model->getAllPaymentsBack();
        $this->data['supptotal'] = 0;
        $updatebooking = $this->input->post('updatebooking');
        if (! empty($updatebooking)) {
            $this->Bookings_model->update_booking($id);
            redirect(base_url() . "admin/bookings");
        }
        if (! empty($module) && ! empty($id)) {
            $this->data['chklib'] = $this->ptmodules;
            $refNo = $this->Bookings_model->getBookingRefNo($id);
            $this->data['bdetails'] = invoiceDetails($id, $refNo);
            $this->data['service'] = $this->data['bdetails']->module;
            $this->data['applytax'] = "yes";
            foreach ($this->data['bdetails']->bookingExtras as $extras) {
                $bookedextras[] = $extras->id;
                $extrasprices[] = $extras->price;
            }
            $this->data['bookedsups'] = $bookedextras;
            $this->data['supptotal'] = array_sum($extrasprices);
            // hotels module
            if ($module == "hotels") {
                $this->load->library('Hotels/Hotels_lib');
                $this->Hotels_lib->set_id($this->data['bdetails']->itemid);
                $this->Hotels_lib->hotel_short_details();
                $this->data['tax_type'] = $this->Hotels_lib->tax_type;
                $this->data['tax_val'] = $this->Hotels_lib->tax_value;
                $this->data['commtype'] = $this->Hotels_lib->comm_type;
                $this->data['commvalue'] = $this->Hotels_lib->comm_value;
                $this->data['selectedroom'] = $this->data['bdetails']->subItem->id;
                $this->data['subitemprice'] = $this->data['bdetails']->subItem->price;
                $this->data['rquantity'] = $this->data['bdetails']->subItem->quantity;
                $this->data['rtotal'] = $this->data['bdetails']->subItem->price * $this->data['bdetails']->subItem->quantity * $this->data['bdetails']->nights;
                $this->data['hrooms'] = $this->Hotels_lib->rooms_id_title_only();
                $this->data['sups'] = $this->Hotels_lib->hotelExtras();
                $this->data['hotelslib'] = $this->Hotels_lib;
                $this->data['totalrooms'] = $this->Hotels_lib->room_total_quantity($this->data['bdetails']->subItem->id);
                $this->data['checkinlabel'] = "Check-In";
                $this->data['checkoutlabel'] = "Check-Out";
            }
            
            $this->data['main_content'] = 'modules/bookings/view';
            $this->data['page_title'] = 'Chi tiết đặt chỗ';
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/bookings');
        }
    }
    
    

    function edit($module, $id)
    {
        if (! $this->editpermission) {
            echo "<center><h1>Access Denied</h1></center>";
            backError_404($this->data);
        } else {
            $this->load->helper('invoice');
            $this->load->model('Payments_model');
            $this->data['paygateways'] = $this->Payments_model->getAllPaymentsBack();
            $this->data['supptotal'] = 0;
            $updatebooking = $this->input->post('updatebooking');
            if (! empty($updatebooking)) {
                $this->Bookings_model->update_booking($id);
                redirect(base_url() . "admin/bookings");
            }
            if (! empty($module) && ! empty($id)) {
                $this->data['chklib'] = $this->ptmodules;
                $refNo = $this->Bookings_model->getBookingRefNo($id);
                $this->data['bdetails'] = invoiceDetails($id, $refNo);
                $this->data['service'] = $this->data['bdetails']->module;
                $this->data['applytax'] = "yes";
                foreach ($this->data['bdetails']->bookingExtras as $extras) {
                    $bookedextras[] = $extras->id;
                    $extrasprices[] = $extras->price;
                }
                $this->data['bookedsups'] = $bookedextras;
                $this->data['supptotal'] = array_sum($extrasprices);
                // hotels module
                if ($module == "hotels") {
                    $this->load->library('Hotels/Hotels_lib');
                    $this->Hotels_lib->set_id($this->data['bdetails']->itemid);
                    $this->Hotels_lib->hotel_short_details();
                    $this->data['tax_type'] = $this->Hotels_lib->tax_type;
                    $this->data['tax_val'] = $this->Hotels_lib->tax_value;
                    $this->data['commtype'] = $this->Hotels_lib->comm_type;
                    $this->data['commvalue'] = $this->Hotels_lib->comm_value;
                    $this->data['selectedroom'] = $this->data['bdetails']->subItem->id;
                    $this->data['subitemprice'] = $this->data['bdetails']->subItem->price;
                    $this->data['rquantity'] = $this->data['bdetails']->subItem->quantity;
                    $this->data['rtotal'] = $this->data['bdetails']->subItem->price * $this->data['bdetails']->subItem->quantity * $this->data['bdetails']->nights;
                    $this->data['hrooms'] = $this->Hotels_lib->rooms_id_title_only();
                    $this->data['sups'] = $this->Hotels_lib->hotelExtras();
                    $this->data['hotelslib'] = $this->Hotels_lib;
                    $this->data['totalrooms'] = $this->Hotels_lib->room_total_quantity($this->data['bdetails']->subItem->id);
                    $this->data['checkinlabel'] = "Check-In";
                    $this->data['checkoutlabel'] = "Check-Out";
                }
                
                $this->data['main_content'] = 'modules/bookings/edit';
                $this->data['page_title'] = 'Chính sửa đặt chỗ';
                $this->load->view('template', $this->data);
            } else {
                redirect('admin/bookings');
            }
        }
    }

    function dashboardBookings()
    {
        if (! $this->data['addpermission'] && ! $this->editpermission && ! $this->deletepermission) {
//            backError_404($this->data);
        } else {
            $this->load->helper('xcrud');
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_bookings');
            $xcrud->join('booking_user', 'pt_accounts', 'accounts_id');
            $xcrud->order_by('booking_id', 'desc');
            $xcrud->columns('booking_pnr,booking_name, booking_email,booking_phone,booking_date,booking_note');
            $xcrud->label('booking_pnr', 'PNR')
            ->label('booking_name', 'Tên khách hàng')
            ->label('booking_email', 'Địa chỉ email')
            ->label('booking_phone', 'Điện Thoại')
            ->label('booking_date', 'Ngày đặt')
            ->label('booking_note', 'Ghi chú');
            $xcrud->column_callback('booking_date', 'fmtDate');
            $xcrud->column_callback('booking_date', 'fmtDate');
            //$xcrud->column_callback('booking_status', 'bookingStatusBtns');
            $xcrud->search_columns('booking_pnr,booking_name,booking_email,booking_phone');
            $xcrud->button(base_url() . $this->data['adminsegment'] . '/bookings/view/{booking_type}/{booking_id}', 'Xem', 'fa fa-search-plus', 'btn btn-primary', array(
                'target' => '_self'
            ));
            
            if ($this->editpermission) {
                $xcrud->button(base_url() . $this->data['adminsegment'] . '/bookings/edit/{booking_type}/{booking_id}', 'Chỉnh sửa', 'fa fa-edit', 'btn btn-warning', array(
                    'target' => '_self'
                ));
            }
            if ($this->deletepermission) {
                $delurl = base_url() . 'admin/bookings/delBooking';
                $xcrud->multiDelUrl = base_url() . 'admin/bookings/delMultipleBookings';
                
                $xcrud->button("javascript: delfunc('{booking_id}','$delurl')", 'Xóa', 'fa fa-times', 'btn-danger', array(
                    'target' => '_self',
                    'id' => '{booking_id}'
                ));
            }
            
            $this->data['add_link'] = '';
            $xcrud->unset_add();
            $xcrud->unset_view();
            $xcrud->unset_remove();
            $xcrud->unset_edit();
            $xcrud->unset_print();
            $xcrud->unset_csv();
            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Đặt vé gần đây';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Đặt vé gần đây';
            $this->load->view('temp_view', $this->data);
        }
    }

    function split_subitem($string) {
        return explode("_", $string);
    }
}
