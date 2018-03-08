<?php

class Bookings_model extends CI_Model {
          private $data = array();

          function __construct() {
      // Call the Model constructor
              parent :: __construct();
              $this->load->model('Admin/Accounts_model');
              $this->load->model('Admin/Emails_model');
              $this->data['app_settings'] = $this->Settings_model->get_settings_data();
              $this->load->helper('invoice');
          }

          function admin_get_all_bookings($type = null) {
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
                pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
                booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($type)) {
                  $this->db->where('pt_bookings.booking_type', $type);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              return $this->db->get('pt_bookings')->result();
          }

      // get all bookings
          function get_all_bookings_back_admin() {
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
                pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
                booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings');
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings with limit
          function get_all_bookings_back_limit_admin($perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
      // $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by search for admin
          function search_all_bookings_back_limit_admin($term, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->like('pt_bookings.booking_type', $term);
              $this->db->or_like('pt_bookings.booking_id', $term);
              $this->db->or_like('pt_accounts.ai_first_name', $term);
              $this->db->or_like('pt_accounts.ai_last_name', $term);
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by advance search for admin
          function adv_search_all_bookings_back_limit_admin($data, $perpage = null, $offset = null, $orderby = null) {
              $invoice = $data["invoiceno"];
              $invoicefromdate = $data["invoicefromdate"];
              $invoicetodate = $data["invoicetodate"];
              $status = $data["status"];
              $customername = $data["customername"];
              $module = $data["module"];
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($invoice)) {
                  $this->db->where('pt_bookings.booking_id', $invoice);
              }
              if (!empty ($module)) {
                  $this->db->where('pt_bookings.booking_type', $module);
              }
              if (!empty ($status)) {
                  $this->db->where('pt_bookings.booking_status', $status);
              }
              if (!empty ($customername)) {
                  $this->db->like('pt_accounts.ai_first_name', $customername);
                  $this->db->or_like('pt_accounts.ai_last_name', $customername);
              }
              if (!empty ($invoicefromdate)) {
                  $this->db->where('pt_bookings.booking_date >=', $invoicefromdate);
                  $this->db->where('pt_bookings.booking_date <=', $invoicetodate);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // Get supplier's bookings
          function supplier_get_all_bookings($myitems) {
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings');
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // Get supplier's bookings in limit
          function supplier_get_all_bookings_limit($myitems, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by search for admin
          function search_all_bookings_back_limit_supplier($term, $myitems, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
                $this->db->like('pt_bookings.booking_type', $term);
              $this->db->or_like('pt_bookings.booking_id', $term);
              $this->db->or_like('pt_accounts.ai_first_name', $term);
              $this->db->or_like('pt_accounts.ai_last_name', $term);
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by advance search for admin
          function adv_search_all_bookings_back_limit_supplier($data, $myitems, $perpage = null, $offset = null, $orderby = null) {
              $invoice = $data["invoiceno"];
              $invoicefromdate = $data["invoicefromdate"];
              $invoicetodate = $data["invoicetodate"];
              $status = $data["status"];
              $customername = $data["customername"];
              $module = $data["module"];
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($invoice)) {
                  $this->db->where('pt_bookings.booking_id', $invoice);
              }
              if (!empty ($module)) {
                  $this->db->where('pt_bookings.booking_type', $module);
              }
              if (!empty ($status)) {
                  $this->db->where('pt_bookings.booking_status', $status);
              }
              if (!empty ($customername)) {
                  $this->db->like('pt_accounts.ai_first_name', $customername);
                  $this->db->or_like('pt_accounts.ai_last_name', $customername);
              }
              if (!empty ($invoicefromdate)) {
                  $this->db->where('pt_bookings.booking_date >=', $invoicefromdate);
                  $this->db->where('pt_bookings.booking_date <=', $invoicetodate);
              }
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

          function do_login_booking($username, $password) {
              $login = $this->Accounts_model->login_customer($username, $password);
              if ($login) {
                  $userid = $this->session->userdata('pt_logged_customer');
                  return $this->do_booking($userid);
              }
              else {
                  $bookingResult = array("error" => "yes", 'msg' => 'Invalid Email or Password');
                  return $bookingResult;
              }
          }

          function do_customer_booking() {
              $userid = $this->Accounts_model->signup_account('customers', '1');
              return $this->do_booking($userid);
          }

        function doGuestBooking($bookquick = null) 
        {
            $userid = $this->Accounts_model->signup_account('guest', '0');

            if(empty($bookquick))
            {
                return $this->do_booking($userid);
            }
            else
            {
                return $this->doQuickBooking($userid);
            }
        }

        // ======================================================================
        //                  Hotels, Tours And Cars Bookings
        // ======================================================================

        /**
         * Tours Booking
         */
        public function do_tours_booking($payload = array())
        {
             $this->load->library('currconverter');
             $this->load->library('Tours/Tours_lib');
     
             $itemid  = $payload['itemid'];
             $adults  = $payload['adults'];
             $child   =  $payload['children'];
             $infant  = $payload['infant'];
             $apiDate = $payload['tdate'];
             $checkin  = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
             $checkout = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
            
             $bookingData = json_decode($this->Tours_lib->getUpdatedDataBookResultObject($itemid, $adults,$child,$infant,NULL));
     
             // $grandtotal = $this->currconverter->convertPriceFloat($bookingData->grandTotal);
             $grandtotal = $this->currconverter->removeComma($bookingData->grandTotal);
             $checkin = databaseDate($checkin);
             $checkout = databaseDate($checkout);
             //$deposit = $this->currconverter->convertPriceFloat($bookingData->depositAmount);
             $extrabeds      = 0;
             $deposit = $this->currconverter->removeComma($bookingData->depositAmount);
             $tax = $this->currconverter->removeComma($bookingData->taxAmount);
             $paymethodfee = 0;
     
             //$this->currconverter->convertPriceFloat($bookingData->paymethodFee);
             $extrasTotalFee = $this->currconverter->removeComma($bookingData->extrasInfo->extrasTotalFee);
             $currCode = $bookingData->currCode;
             $currSymbol = $bookingData->currSymbol;
             $subitem = json_encode($bookingData->subitem);
             $extras = NULL;
             if (property_exists($bookingData->extrasInfo, 'extrasIndividualFee')) {
                 $extras = json_encode($bookingData->extrasInfo->extrasIndividualFee);
             }
             
             $stay = $bookingData->stay;
             $extrabedscharges = $this->currconverter->removeComma($bookingData->extraBedCharges);
             $refno = random_string('numeric', 4);
             $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;
     
             $couponRate = 0;
             $couponCode = 0;
     
             $coupon = $payload['couponid'];
             if($coupon > 0)
             {
                 $cResult = pt_applyCouponDiscount($coupon, $grandtotal);
                 $cResultDeposit = pt_applyCouponDiscount($coupon, $deposit);
                 $cResultTax = pt_applyCouponDiscount($coupon, $tax);
     
                 $couponRate = $cResult->value;
                 $couponCode = $cResult->code;
     
                 $grandtotal = $cResult->amount;
                 $deposit = $cResultDeposit->amount;
                 $tax = $cResultTax->amount;
     
                 $this->updateCoupon($coupon);
             }
     
             $data = array(
                 'booking_ref_no' => $refno, 
                 'booking_type' => 'tours', 
                 'booking_item' => $itemid, 
                 'booking_subitem' => $subitem, 
                 'booking_extras' => $extras, 
                 'booking_date' => time(), 
                 'booking_expiry' => time() + $expiry, 
                 'booking_user' => $payload['userId'], 
                 'booking_status' => 'unpaid', 
                 'booking_additional_notes' => $payload['additionalnotes'], 
                 'booking_total' => $grandtotal, 
                 'booking_remaining' => $grandtotal, 
                 'booking_checkin' => $checkin, 
                 'booking_checkout' => $checkout, 
                 'booking_nights' => $stay, 
                 'booking_adults' => $adults, 
                 'booking_child' => $child,
                 'booking_deposit' => $deposit, 
                 'booking_tax' => $tax, 
                 'booking_paymethod_tax' => $paymethodfee, 
                 'booking_extras_total_fee' => $extrasTotalFee, 
                 'booking_curr_code' => $currCode, 
                 'booking_curr_symbol' => $currSymbol, 
                 'booking_extra_beds' => $extrabeds, 
                 'booking_extra_beds_charges' => $extrabedscharges, 
                 'booking_coupon_rate' => $couponRate, 
                 'booking_coupon' => $couponCode, 
                 'booking_guest_info' => $passportInfo
             );
             $this->db->insert('pt_bookings', $data);
             $bookid = $this->db->insert_id();
     
             $bookingResult = array("error" => "yes", 'msg' => 'Error occured');
             
             $this->session->set_userdata("BOOKING_ID", $bookid);
             $this->session->set_userdata("REF_NO", $refno);
     
             $url = base_url() . 'invoice?id=' . $bookid . '&sessid=' . $refno;
             $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);
             $invoicedetails = invoiceDetails($bookid,$refno);
     
             $this->Emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
             $this->Emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
             $this->Emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
             $this->Emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
     
             return $bookingResult;
        }

        /**
         * Do tours guest booking
         */
        public function do_tours_guest_booking($payload = array())
        {
            $userid = $this->Accounts_model->signup_account('guest', '0');
            $payload['userId'] = $userid;

            return $this->do_tours_booking($payload);
        }
        
        /**
         * Hotels Booking
         *
         */
        public function do_hotels_booking($payload = array())
        {
            $this->load->library('currconverter');
            $this->load->library('Hotels/Hotels_lib');

            $error          = true;
            $itemid         = $payload['itemid'];
            $roomid         = $payload['subitemid'];
            $checkin        = $payload['checkin'];
            $checkout       = $payload['checkout'];
            $roomscount     = $payload['roomscount'];
            $bookingtype    = $payload['btype'];
            $extras         = NULL;
            $extrabeds      = 0;
            $passportInfo   = "";
            $apicheckin     = $payload['apicheckin'];
            $apicheckout    = $payload['apicheckout'];
            if( ! empty($apicheckin) )
            {
                $checkin    = date($this->data['app_settings'][0]->date_f, strtotime($apicheckin));
                $checkout   = date($this->data['app_settings'][0]->date_f, strtotime($apicheckout));  
            }

            $bookingData = json_decode($this->Hotels_lib->getUpdatedDataBookResultObject($itemid, $roomid, $checkin, $checkout, $roomscount, $extras, $extrabeds));
            if ($bookingData->stay <= 0) 
            {
                return $bookingResult = array("error" => "yes", 'msg' => 'Booking stay must be greater then zero');
            }
            

            $grandtotal = $this->currconverter->removeComma($bookingData->grandTotal);
            $checkin = databaseDate($checkin);
            $checkout = databaseDate($checkout);
            
            $deposit = $this->currconverter->removeComma($bookingData->depositAmount);
            $tax = $this->currconverter->removeComma($bookingData->taxAmount);
            $paymethodfee = 0;

            $extrasTotalFee = $this->currconverter->removeComma($bookingData->extrasInfo->extrasTotalFee);
            $currCode = $bookingData->currCode;
            $currSymbol = $bookingData->currSymbol;
            $subitem = json_encode($bookingData->subitem);
            $extras = json_encode($bookingData->extrasInfo->extrasIndividualFee);
            $stay = $bookingData->stay;
            $extrabedscharges = $this->currconverter->removeComma($bookingData->extraBedCharges);
            $refno = random_string('numeric', 4);
            $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;

            $couponRate = 0;
            $couponCode = 0;

            $coupon = $payload['couponid'];
            if($coupon > 0)
            {
                $cResult = pt_applyCouponDiscount($coupon, $grandtotal);
                $cResultDeposit = pt_applyCouponDiscount($coupon, $deposit);
                $cResultTax = pt_applyCouponDiscount($coupon, $tax);

                $couponRate = $cResult->value;
                $couponCode = $cResult->code;

                $grandtotal = $cResult->amount;
                $deposit = $cResultDeposit->amount;
                $tax = $cResultTax->amount;

                $this->updateCoupon($coupon);
            }


            $data = array(
                'booking_ref_no' => $refno, 
                'booking_type' => $bookingtype, 
                'booking_item' => $itemid, 
                'booking_subitem' => $subitem, 
                'booking_extras' => $extras, 
                'booking_date' => time(), 
                'booking_expiry' => time() + $expiry, 
                'booking_user' => $payload['userId'], 
                'booking_status' => 'unpaid', 
                'booking_additional_notes' => @$payload['additionalnotes'], 
                'booking_total' => $grandtotal, 
                'booking_remaining' => $grandtotal, 
                'booking_checkin' => $checkin, 
                'booking_checkout' => $checkout, 
                'booking_nights' => $stay, 
                'booking_adults' => $payload['adults'], 
                'booking_child' => $payload['children'],
                'booking_deposit' => $deposit, 
                'booking_tax' => $tax, 
                'booking_paymethod_tax' => $paymethodfee, 
                'booking_extras_total_fee' => $extrasTotalFee, 
                'booking_curr_code' => $currCode, 
                'booking_curr_symbol' => $currSymbol, 
                'booking_extra_beds' => $extrabeds, 
                'booking_extra_beds_charges' => $extrabedscharges, 
                'booking_coupon_rate' => $couponRate, 
                'booking_coupon' => $couponCode, 
                'booking_guest_info' => $passportInfo
            );
            $this->db->insert('pt_bookings', $data);
            $bookid = $this->db->insert_id();
            
            $this->session->set_userdata("BOOKING_ID", $bookid);
            $this->session->set_userdata("REF_NO", $refno);

            $this->db->insert('pt_booked_rooms', array(
                'booked_booking_id' => $bookid, 
                'booked_room_id' => $bookingData->subitem->id, 
                'booked_room_count' => $bookingData->subitem->count, 
                'booked_checkin' => $checkin, 
                'booked_checkout' => $checkout, 
                'booked_booking_status' => 'unpaid'
            ));

            $url = base_url() . 'invoice?id=' . $bookid . '&sessid=' . $refno;
            $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);
            $invoicedetails = invoiceDetails($bookid,$refno);

            $this->Emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);

            return $bookingResult;
        }

        /**
         * Hotels guest booking
         */
        public function do_hotels_guest_booking($payload = array()) 
        {
            $userid = $this->Accounts_model->signup_account('guest', '0');
            $payload['userId'] = $userid;

            return $this->do_hotels_booking($payload);
        }

        /**
         * Cars Booking
         *
         */
        public function do_cars_booking($payload = array())
        {
            $this->load->library('currconverter');
            $this->load->library('Cars/Cars_lib');

            $error          = true;
            $itemid         = $payload['itemid'];
            $roomid         = $payload['subitemid'];
            
            $pickupDate      = $payload['pickupDate'];
            $dropoffDate     = $payload['dropoffDate'];
            $pickuplocation  = $payload['pickuplocation'];
            $dropofflocation = $payload['dropofflocation'];
            $pickuptime      = $payload['pickupTime'];
            $droptime        = $payload['dropoffTime'];

            $roomscount     = $payload['roomscount'];
            $bookingtype    = $payload['btype'];
            $extras         = NULL;
            $extrabeds      = 0;
            $passportInfo   = "";
            
            $apiDate = $payload['cdate'];
            if( empty($apiDate) )
            {
                $checkin    =  $pickupDate;
                $checkout   =  $dropoffDate;
            }
            else
            {
                $checkin    = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
                $checkout   = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
            }

            $bookingData = json_decode($this->Cars_lib->getUpdatedDataBookResultObject($itemid, $extras, $pickuplocation, $dropofflocation, $pickupDate, $dropoffDate));

            $grandtotal = $this->currconverter->removeComma($bookingData->grandTotal);
            $checkin    = databaseDate($checkin);
            $checkout   = databaseDate($checkout);
            
            $deposit        = $this->currconverter->removeComma($bookingData->depositAmount);
            $tax            = $this->currconverter->removeComma($bookingData->taxAmount);
            $paymethodfee   = 0;

            $extrasTotalFee = $this->currconverter->removeComma($bookingData->extrasInfo->extrasTotalFee);
            $currCode       = $bookingData->currCode;
            $currSymbol     = $bookingData->currSymbol;
            $subitem        = json_encode($bookingData->subitem);
            $extras         = json_encode($bookingData->extrasInfo->extrasIndividualFee);
            $stay           = $bookingData->stay;
            $refno          = random_string('numeric', 4);
            $expiry         = $this->data['app_settings'][0]->booking_expiry * 86400;
            $couponRate     = 0;
            $couponCode     = 0;
            $extrabedscharges = $this->currconverter->removeComma($bookingData->extraBedCharges);

            $coupon = $payload['couponid'];
            if($coupon > 0)
            {
                $cResult        = pt_applyCouponDiscount($coupon, $grandtotal);
                $cResultDeposit = pt_applyCouponDiscount($coupon, $deposit);
                $cResultTax     = pt_applyCouponDiscount($coupon, $tax);

                $couponRate = $cResult->value;
                $couponCode = $cResult->code;

                $grandtotal = $cResult->amount;
                $deposit    = $cResultDeposit->amount;
                $tax        = $cResultTax->amount;

                $this->updateCoupon($coupon);
            }

            $data = array(
                'booking_ref_no' => $refno, 
                'booking_type' => $bookingtype, 
                'booking_item' => $itemid, 
                'booking_subitem' => $subitem, 
                'booking_extras' => $extras, 
                'booking_date' => time(), 
                'booking_expiry' => time() + $expiry, 
                'booking_user' => $payload['userId'], 
                'booking_status' => 'unpaid', 
                'booking_additional_notes' => '', 
                'booking_total' => $grandtotal, 
                'booking_remaining' => $grandtotal, 
                'booking_checkin' => $checkin, 
                'booking_checkout' => $checkout, 
                'booking_nights' => $stay, 
                'booking_adults' => $payload['adults'], 
                'booking_child' => $payload['children'],
                'booking_deposit' => $deposit, 
                'booking_tax' => $tax, 
                'booking_paymethod_tax' => $paymethodfee, 
                'booking_extras_total_fee' => $extrasTotalFee, 
                'booking_curr_code' => $currCode, 
                'booking_curr_symbol' => $currSymbol, 
                'booking_extra_beds' => $extrabeds, 
                'booking_extra_beds_charges' => $extrabedscharges, 
                'booking_coupon_rate' => $couponRate, 
                'booking_coupon' => $couponCode, 
                'booking_guest_info' => $passportInfo
            );
            $this->db->insert('pt_bookings', $data);
            $bookid = $this->db->insert_id();
            
            $this->session->set_userdata("BOOKING_ID", $bookid);
            $this->session->set_userdata("REF_NO", $refno);

            $this->db->insert('pt_booked_rooms', array(
                'booked_booking_id' => $bookid, 
                'booked_room_id' => $bookingData->subitem->id, 
                'booked_room_count' => $bookingData->subitem->count, 
                'booked_checkin' => $checkin, 
                'booked_checkout' => $checkout, 
                'booked_booking_status' => 'unpaid'
            ));

            $url = base_url() . 'invoice?id=' . $bookid . '&sessid=' . $refno;
            $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);
            $invoicedetails = invoiceDetails($bookid,$refno);

            $this->Emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);

            return $bookingResult;
         }
 
         /**
          * Cars guest booking
          */
         public function do_cars_guest_booking($payload = array()) 
         {
             $userid = $this->Accounts_model->signup_account('guest', '0');
             $payload['userId'] = $userid;
 
             return $this->do_cars_booking($payload);
         }

        
        // ============================== End: Bookings ======================================

        function do_booking($userid) {

            $error = true;
            $this->load->library('currconverter');
            $itemid = $this->input->post('itemid');
            $roomid = $this->input->post('subitemid');
            $checkin = $this->input->post('checkin');
            $checkout = $this->input->post('checkout');
            $roomscount = $this->input->post('roomscount');
            $bookingtype = $this->input->post('btype');
            $extras = $this->input->post('extras');
            $extrabeds = $this->input->post('bedscount');
            $passportInfo = "";
            if ($bookingtype == "hotels") {
                $apicheckin = $this->input->post('apicheckin');
                $apicheckout = $this->input->post('apicheckout');
                if(!empty($apicheckin)){
                    $checkin = date($this->data['app_settings'][0]->date_f, strtotime($apicheckin));
                    $checkout = date($this->data['app_settings'][0]->date_f, strtotime($apicheckout));  
                }


                $this->load->library('Hotels/Hotels_lib');
                $bookingData = json_decode($this->Hotels_lib->getUpdatedDataBookResultObject($itemid, $roomid, $checkin, $checkout, $roomscount, $extras, $extrabeds));
                if ($bookingData->stay < 1) {
                    $error = true;
                }
                else {
                    $error = false;
                }


            }
            elseif($bookingtype == "tours")
            {
                $passportInfo = json_encode($this->input->post('passport'));
                $adults = $this->input->post('adults');
                $child = $this->input->post('children');
                $infant = $this->input->post('infant');

                $apiDate = $this->input->post('tdate');
                if(empty($apiDate)){
                    $checkin = $this->input->post('date');
                    $checkout = $this->input->post('date');

                    if(empty($checkin)){
                    $checkin = $this->input->post('checkin');
                    $checkout = $this->input->post('checkin');
                    }

                }else{
                    $checkin = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
                    $checkout = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));


                }



                    $this->load->library('Tours/Tours_lib');
                    $bookingData = json_decode($this->Tours_lib->getUpdatedDataBookResultObject($itemid, $adults,$child,$infant,$extras));
                    $error = false;

            }
            elseif($bookingtype == "cars")
            {

                $apiDate = $this->input->post('cdate');
                if(empty($apiDate)){

                    $checkin =  $this->input->post('pickupDate');
                    $checkout =  $this->input->post('dropoffDate');


                }else{
                    $checkin = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
                    $checkout = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));


                }

                $pickup = $this->input->post('pickuplocation');
                $drop = $this->input->post('dropofflocation');
                $pickuptime = $this->input->post('pickupTime');
                $pickupdate = $this->input->post('pickupDate');
                $dropdate = $this->input->post('dropoffDate');
                $droptime = $this->input->post('dropoffTime');


                $this->load->library('Cars/Cars_lib');
                $bookingData = json_decode($this->Cars_lib->getUpdatedDataBookResultObject($itemid,$extras,$pickup,$drop,$pickupdate,$dropdate));
                $error = false;
            }



            // $grandtotal = $this->currconverter->convertPriceFloat($bookingData->grandTotal);
            $grandtotal = $this->currconverter->removeComma($bookingData->grandTotal);
            $checkin = databaseDate($checkin);
            $checkout = databaseDate($checkout);
            //$deposit = $this->currconverter->convertPriceFloat($bookingData->depositAmount);

            $deposit = $this->currconverter->removeComma($bookingData->depositAmount);
            $tax = $this->currconverter->removeComma($bookingData->taxAmount);
            $paymethodfee = 0;

            //$this->currconverter->convertPriceFloat($bookingData->paymethodFee);
            $extrasTotalFee = $this->currconverter->removeComma($bookingData->extrasInfo->extrasTotalFee);
            $currCode = $bookingData->currCode;
            $currSymbol = $bookingData->currSymbol;
            $subitem = json_encode($bookingData->subitem);
            $extras = json_encode($bookingData->extrasInfo->extrasIndividualFee);
            $adults = $this->input->post('adults');
            $child = $this->input->post('children');
            $stay = $bookingData->stay;
            $extrabedscharges = $this->currconverter->removeComma($bookingData->extraBedCharges);
            $refno = random_string('numeric', 4);
            $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;

            $couponRate = 0;
            $couponCode = 0;

            $coupon = $this->input->post('couponid');
            if($coupon > 0){

                $cResult = pt_applyCouponDiscount($coupon, $grandtotal);
                $cResultDeposit = pt_applyCouponDiscount($coupon, $deposit);
                $cResultTax = pt_applyCouponDiscount($coupon, $tax);

                $couponRate = $cResult->value;
                $couponCode = $cResult->code;

                $grandtotal = $cResult->amount;
                $deposit = $cResultDeposit->amount;
                $tax = $cResultTax->amount;


                $this->updateCoupon($coupon);

            }


            if (!$error) {
                $data = array('booking_ref_no' => $refno, 'booking_type' => $bookingtype, 'booking_item' => $itemid, 'booking_subitem' => $subitem, 'booking_extras' => $extras, 'booking_date' => time(), 'booking_expiry' => time() + $expiry, 'booking_user' => $userid, 'booking_status' => 'unpaid', 'booking_additional_notes' => $this->input->post('additionalnotes'), 'booking_total' => $grandtotal, 'booking_remaining' => $grandtotal, 'booking_checkin' => $checkin, 'booking_checkout' => $checkout, 'booking_nights' => $stay, 'booking_adults' => $adults, 'booking_child' => $child,
            //    'booking_payment_type' => $paymethod,
                'booking_deposit' => $deposit, 'booking_tax' => $tax, 'booking_paymethod_tax' => $paymethodfee, 'booking_extras_total_fee' => $extrasTotalFee, 'booking_curr_code' => $currCode, 'booking_curr_symbol' => $currSymbol, 'booking_extra_beds' => $extrabeds, 'booking_extra_beds_charges' => $extrabedscharges, 'booking_coupon_rate' => $couponRate, 'booking_coupon' => $couponCode, 'booking_guest_info' => $passportInfo);
                $this->db->insert('pt_bookings', $data);
                $bookid = $this->db->insert_id();
                $this->session->set_userdata("BOOKING_ID", $bookid);
                $this->session->set_userdata("REF_NO", $refno);

                if ($bookingtype == "hotels") {
                    $rdata = array('booked_booking_id' => $bookid, 'booked_room_id' => $bookingData->subitem->id, 'booked_room_count' => $bookingData->subitem->count, 'booked_checkin' => $checkin, 'booked_checkout' => $checkout, 'booked_booking_status' => 'unpaid');
                    $this->db->insert('pt_booked_rooms', $rdata);
                }
                elseif ($bookingtype == "cars") {
                    $cdata = array('booked_booking_id' => $bookid, 'booked_car_id' =>  $itemid, 'booked_pickupdate' => $checkin, 'booked_pickuptime' => $pickuptime, 'booked_pickuplocation' => $pickup, 'booked_dropofflocation' => $drop,'booked_dropoffDate' => databaseDate($dropdate), 'booked_dropoffTime' => $droptime, 'booked_booking_status' => 'unpaid');
                    $this->db->insert('pt_booked_cars', $cdata);
                }

                $url = base_url() . 'invoice?id=' . $bookid . '&sessid=' . $refno;
                $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);
                $invoicedetails = invoiceDetails($bookid,$refno);

                $this->Emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
                $this->Emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
                $this->Emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
                $this->Emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);

            }
            else {
                $bookingResult = array("error" => "yes", 'msg' => 'Error occured');
            }

            return $bookingResult;
        }


        //Do quick booking by admin
          function doQuickBooking($userid){


              $this->load->library('currconverter');
              $itemid = $this->input->post('itemid');
              $subitemid = $this->input->post('subitemid');
              $roomscount = $this->input->post('roomscount');
              $bookingtype = $this->input->post('btype');
              $quickDeposit = $this->input->post('quickDeposit');
              $extras = $this->input->post('extras');
              $perNight = $this->input->post('perNight');
              $grandtotal = $this->input->post('grandtotal');
              $stay = $this->input->post('stay');

              $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;
              $paymethodfee = 0;



              $extrabeds = 0;//$this->input->post('bedscount');

              if ($bookingtype == "hotels") {
                  $this->load->library('Hotels/Hotels_lib');
                  $extrasInfo = $this->Hotels_lib->extrasFee($extras);
                  $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
                  $subitemData = json_encode(array("id" => $subitemid, "price" => $perNight,"count" => $roomscount));

              }elseif($bookingtype == "tours"){
                $adults = $this->input->post('adults');
                $child = $this->input->post('children');
                $infant = $this->input->post('infants');


                  /* $checkin = $this->input->post('checkin');
                   $checkout = $this->input->post('checkin');
                        */


                  $this->load->library('Tours/Tours_lib');
                  $extrasInfo = $this->Tours_lib->extrasFee($extras);
                  $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
                  $bookingData = json_decode($this->Tours_lib->getUpdatedDataBookResultObject($itemid, $adults,$child,$infant,$extras));
                  $subitemData = json_encode($bookingData->subitem);
              }elseif($bookingtype == "cars"){


                  $this->load->library('Cars/Cars_lib');
                  $extrasInfo = $this->Cars_lib->extrasFee($extras);
                  $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
                  $bookingData = json_decode($this->Cars_lib->getUpdatedDataBookResultObject($itemid,$extras));
                  $subitemData = json_encode($bookingData->subitem);
              }

              $checkin = databaseDate($this->input->post('checkin'));
              $checkout = databaseDate($this->input->post('checkout'));
              $tax = $this->input->post('taxamount');

              $extrasTotalFee = $this->input->post('totalsupamount');

              $currCode = $this->input->post('currencycode');
              $currSymbol = $this->input->post('currencysign');

              $extrabedscharges = 0;//$this->currconverter->convertPriceFloat($bookingData->extraBedCharges);
              $refno = random_string('numeric', 4);

                  $data = array('booking_ref_no' => $refno, 'booking_type' => $bookingtype,
                    'booking_item' => $itemid,
                    'booking_subitem' => $subitemData,
                    'booking_extras' => $extrasData, 'booking_date' => time(),
                    'booking_expiry' => time() + $expiry, 'booking_user' => $userid,
                    'booking_status' => 'unpaid',
                    'booking_additional_notes' => "",
                    'booking_total' => $grandtotal,
                    'booking_remaining' => $grandtotal,
                    'booking_checkin' => $checkin,
                    'booking_checkout' => $checkout,
                    'booking_nights' => $stay,
                    'booking_adults' => '1',
                    'booking_child' => '0',
                   'booking_payment_type' => $this->input->post('paymethod'),
                  'booking_deposit' => $quickDeposit,
                  'booking_tax' => $tax,
                  'booking_paymethod_tax' => $paymethodfee,
                  'booking_extras_total_fee' => $extrasTotalFee,
                  'booking_curr_code' => $currCode,
                  'booking_curr_symbol' => $currSymbol,
                  'booking_extra_beds' => $extrabeds,
                  'booking_extra_beds_charges' => $extrabedscharges
                  );

                  $this->db->insert('pt_bookings', $data);
                  $bookid = $this->db->insert_id();



                  if ($bookingtype == "hotels") {
                      $rdata = array('booked_booking_id' => $bookid, 'booked_room_id' => $subitemid, 'booked_room_count' => $roomscount, 'booked_checkin' => $checkin, 'booked_checkout' => $checkout, 'booked_booking_status' => 'unpaid');
                      $this->db->insert('pt_booked_rooms', $rdata);
                  }
                  elseif ($bookingtype == "cars") {
                      $cdata = array('booked_booking_id' => $bookid, 'booked_car_id' => $this->input->post('itemid'), 'booked_checkin' => convert_to_unix($checkin), 'booked_checkout' => convert_to_unix($checkout), 'booked_booking_status' => 'unpaid');
                      $this->db->insert('pt_booked_cars', $cdata);
                  }

            $invoicedetails = invoiceDetails($bookid,$refno);

            $this->Emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);




          }

        //Update booking details
          function update_booking($id) {
            $status = $this->input->post('status');
            $deposit = $this->input->post('totaltopay');
            $total = $this->input->post('grandtotal');
            $bookingtype = $this->input->post('btype');
            $bookid = $this->input->post('bookingid');
            if($status == "paid"){
              $remaining = $total - $deposit;
              $paid = $deposit;
              $paytime = time();
            }else{
               $remaining = $total;
               $paid = 0;
            }

            $data = array(
              'booking_status' => $status,
              'booking_deposit' => $deposit,
              'booking_payment_type' => $this->input->post('paymethod'),
              'booking_remaining' => $remaining,
              'booking_amount_paid' => $paid,
              'booking_payment_date' => $paytime
              );
            $this->db->where('booking_id',$bookid);
            $this->db->update('pt_bookings',$data);

            if ($bookingtype == "hotels") {

            $rdata = array('booked_booking_status' => $status);
            $this->db->where('booked_booking_id', $bookid);
            $this->db->update('pt_booked_rooms', $rdata);

            }elseif ($bookingtype == "cars") {
            $cdata = array('booked_booking_status' => $status);
            $this->db->where('booked_booking_id', $bookid);
            $this->db->update('pt_booked_cars', $cdata);
            }

             if($status == "paid"){
              $refno = $this->input->post('refcode');

             $invoicedetails = invoiceDetails($bookid,$refno);

            $this->Emails_model->paid_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->paid_sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->paid_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->Emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);


             }

          }

          function delete_booking($id) {
              $this->db->where('booking_id', $id);
              $this->db->delete('pt_bookings');
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_rooms');
              $this->db->where('review_booking_id', $id);
              $this->db->delete('pt_reviews');
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_cars');
          }

          function cancel_booking($id) {
              $updata = array('booking_status' => 'cancelled');
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $updata);
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_rooms');
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_cars');
              $this->db->where('review_booking_id', $id);
              $this->db->delete('pt_reviews');
          }

        // change booking status to paid
          function booking_status_paid($id) {
              $this->db->select('booking_total,booking_deposit,booking_type');
              $this->db->where('booking_id', $id);
              $bk = $this->db->get('pt_bookings')->result();
              $btotal = $bk[0]->booking_total;
              $bdep = $bk[0]->booking_deposit;
              $btype = $bk[0]->booking_type;
              $data1 = array('booking_status' => 'paid', 'booking_amount_paid' => $bdep, 'booking_remaining' => $btotal - $bdep, 'booking_payment_date' => time());
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $data1);
              if ($btype == "hotels") {
                  $data2 = array('booked_booking_status' => 'paid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_rooms', $data2);
              }
              elseif ($btype == "cruises") {
                  $data2 = array('booked_booking_status' => 'paid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cruise_rooms', $data2);
              }
              elseif ($btype == "cars") {
                  $data3 = array('booked_booking_status' => 'paid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cars', $data3);
              }
          }

        // change booking status to unpaid
          function booking_status_unpaid($id) {
              $this->db->select('booking_total,booking_deposit,booking_type');
              $this->db->where('booking_id', $id);
              $bk = $this->db->get('pt_bookings')->result();
              $btotal = $bk[0]->booking_total;
              $bdep = $bk[0]->booking_deposit;
              $btype = $bk[0]->booking_type;
              $data1 = array('booking_status' => 'unpaid', 'booking_amount_paid' => 0, 'booking_remaining' => $btotal,);
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $data1);
              if ($btype == "hotels") {
                  $data2 = array('booked_booking_status' => 'unpaid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_rooms', $data2);
              }
              elseif ($btype == "cruises") {
                  $data2 = array('booked_booking_status' => 'unpaid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cruise_rooms', $data2);
              }
              elseif ($btype == "cars") {
                  $data3 = array('booked_booking_status' => 'unpaid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cars', $data3);
              }
          }

          function cancel_booking_approve($id) {
             // delete booking and send email
              $useremail = $this->userinfo_by_bookingid($id);
              $this->Emails_model->booking_approve_cancellation_email($useremail);
              $this->cancel_booking($id);
            //  $this->delete_booking($id);
          }

          function cancel_booking_reject($id) {
              $data = array('booking_cancellation_request' => '2');
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $data);
              $useremail = $this->userinfo_by_bookingid($id);
              $this->Emails_model->booking_reject_cancellation_email($useremail, $id);
          }

          function userinfo_by_bookingid($id) {
              $this->db->select('booking_user');
              $this->db->where('booking_id', $id);
              $res = $this->db->get('pt_bookings')->result();
              $user = $res[0]->booking_user;
              $uemail = $this->Accounts_model->get_user_email($user);
              return $uemail;
          }

          function get_booking_details_by_id($id) {
              $this->db->where('booking_id', $id);
              return $this->db->get('pt_bookings')->result();
          }

          function getBookingRefNo($id) {
              $this->db->select('booking_ref_no');
              $this->db->where('booking_id', $id);
              $res = $this->db->get('pt_bookings')->result();
              return $res[0]->booking_ref_no;
          }

          function bookingShortInfo($id){
            $this->db->select('booking_ref_no,booking_deposit,booking_type,booking_total,booking_deposit');
            $this->db->where('booking_id',$id);
            return $this->db->get('pt_bookings')->result();
          }

          function updateCoupon($couponid){

              $this->db->where('id',$couponid);
              $res = $this->db->get('pt_coupons')->result();
              $uses = $res[0]->uses + 1;

              $data = array(
                'uses' => $uses
                );
              $this->db->where('id',$couponid);

              $this->db->update('pt_coupons',$data);

          }

      }
