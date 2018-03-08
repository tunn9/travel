<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Flightsback extends MX_Controller {
        public $accType = "";
        public $role = "";
        public  $editpermission = true;
        public  $deletepermission = true;
		function __construct() {
				$seturl = $this->uri->segment(3);
				if ($seturl != "settings") {
						$chk = modules :: run('Home/is_main_module_enabled', 'flights');
						if (!$chk) {
								backError_404($this->data);
						}
				}
				$checkingadmin = $this->session->userdata('pt_logged_admin');
				$this->accType = $this->session->userdata('pt_accountType');
				$this->role = $this->session->userdata('pt_role');

		        $this->data['userloggedin'] = $this->session->userdata('pt_logged_id');
				if (empty ($this->data['userloggedin'])) {
					$urisegment =  $this->uri->segment(1);
					$this->session->set_userdata('prevURL', current_url());
						redirect($urisegment);
				}
				if (!empty ($checkingadmin)) {
						$this->data['adminsegment'] = "admin";
				}
				else {
						$this->data['adminsegment'] = "supplier";
				}
				if ($this->data['adminsegment'] == "admin") {

						$chkadmin = modules :: run('Admin/validadmin');
						if (!$chkadmin) {

								redirect('admin');
						}
				}
				else {
						$chksupplier = modules :: run('supplier/validsupplier');
						if (!$chksupplier) {
								redirect('supplier');
						}
				}

                $this->data['appSettings'] = modules :: run('Admin/appSettings');
				$this->load->library('Ckeditor');
				$this->data['ckconfig'] = array();
				$this->data['ckconfig']['toolbar'] = array(array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles'), array('NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'), array('Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'), array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),);
				$this->data['ckconfig']['language'] = 'en';
				//$this->data['ckconfig']['filebrowserUploadUrl'] =  base_url().'home/cmsupload';
				$this->load->helper('Flights/flights');
				$this->data['languages'] = pt_get_languages();
				$this->load->helper('xcrud');
				$this->data['c_model'] = $this->countries_model;
				$this->data['tripadvisor'] = $this->ptmodules->is_mod_available_enabled("tripadvisor");
                $this->data['addpermission'] = true;
                if($this->role == "supplier" || $this->role == "admin"){
                $this->editpermission = pt_permissions("editflights", $this->data['userloggedin']);
                $this->deletepermission = pt_permissions("deleteflights", $this->data['userloggedin']);
                $this->data['addpermission'] = pt_permissions("addflights", $this->data['userloggedin']);
                }



				$this->data['all_countries'] = $this->Countries_model->get_all_countries();
				$this->load->helper('settings');
				$this->load->model('Admin/Accounts_model');
				$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
				$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');

		}

		function index(){

			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('pt_flights');
			$xcrud->change_type('thumbnail', 'image', false, array(
			'width' => 450,
			'path' => '../../'.PT_FLIGHTS_SLIDER_UPLOAD));

		//	$xcrud->columns('social_icon,social_name,social_link,social_order,social_status');
			$xcrud->column_class('thumnail','zoom_img');
			$xcrud->column_callback('status', 'create_status_icon');

			$xcrud->multiDelUrl = "";

			$this->data['content'] = $xcrud->render();
			$this->data['page_title'] = 'Quản lý hãng bay đối tác';
			$this->data['main_content'] = 'temp_view';
			$this->data['header_title'] = 'Quản lý hãng bay đối tác';
			$this->load->view('Admin/template', $this->data);

		}

		function settings(){
				$isadmin = $this->session->userdata('pt_logged_admin');
				if (empty ($isadmin)) {
						redirect($this->data['adminsegment'] . '/Flights/');
				}
				$this->data['all_countries'] = $this->Countries_model->get_all_countries();
				$updatesett = $this->input->post('updatesettings');
				$addsettings = $this->input->post('add');
				$updatetypesett = $this->input->post('updatetype');

				if (!empty ($updatesett)) {
						$this->Flights_model->updateflightsettings();
						redirect('admin/Flights/settings');
				}

                if (!empty ($addsettings)) {
                    $id = $this->Flights_model->addSettingsData();
                    $this->Flights_model->updateSettingsTypeTranslation($this->input->post('translated'),$id);
                    redirect('admin/Flights/settings');

				}

                if (!empty ($updatetypesett)) {
                   $this->Flights_model->updateSettingsData();
                   $this->Flights_model->updateSettingsTypeTranslation($this->input->post('translated'),$this->input->post('settid'));
                    redirect('admin/Flights/settings');

				}

				$this->LoadXcrudflightsettings("hamenities");
				$this->LoadXcrudflightsettings("htypes");
				$this->LoadXcrudflightsettings("hpayments");
				$this->LoadXcrudflightsettings("ramenities");
				$this->LoadXcrudflightsettings("rtypes");
                $this->data['typeSettings'] = $this->Flights_model->get_flight_settings_data();
				$this->data['all_flights'] = $this->Flights_model->all_Flights_names();
				@ $this->data['settings'] = $this->Settings_model->get_front_settings("flights");
				$this->data['main_content'] = 'Flights/settings';
				$this->data['page_title'] = 'flights Settings';
				$this->load->view('Admin/template', $this->data);
		}
// Add flights

		public function add() {
                 if(!$this->data['addpermission']){
                 backError_404($this->data);

				  }else{
                $this->load->model('Admin/Uploads_model');
				$addflight = $this->input->post('submittype');

                $this->data['submittype'] = "add";

				if (!empty ($addflight)) {
						$this->form_validation->set_rules('flightname', 'flight Name', 'trim|required');
						$this->form_validation->set_rules('flightdesc', 'Description', 'trim|required');
						$this->form_validation->set_rules('flightcity', 'Location', 'trim|required');
						if ($this->form_validation->run() == FALSE) {
								echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
						}
						else {
								$flightid = $this->Flights_model->add_flight($this->data['userloggedin']);
								$this->Flights_model->add_translation($this->input->post('translated'), $flightid);
								$this->session->set_flashdata('flashmsgs', 'flight added Successfully');
								echo "done";
						}
				}
				else {
						$this->data['main_content'] = 'Flights/manage';
						$this->data['page_title'] = 'Add flight';
						$this->data['headingText'] = 'Add flight';
						$this->data['default_checkin_out'] = $this->Settings_model->get_default_checkin_out();
						$this->data['checkin'] = $this->data['default_checkin_out'][0]->front_checkin_time;
						$this->data['checkout'] = $this->data['default_checkin_out'][0]->front_checkout_time;
						$this->data['htypes'] = pt_get_hsettings_data("htypes");
						$this->data['hamts'] = pt_get_hsettings_data("hamenities");
						$this->data['hpayments'] = pt_get_hsettings_data("hpayments");
						$this->data['all_flights'] = $this->Flights_model->select_related_flights($this->data['userloggedin']);
						$this->load->model('Admin/Locations_model');
						$this->data['locations'] = $this->Locations_model->getLocationsBackend();
						$this->load->view('Admin/template', $this->data);
				}
			}
		}

		function manage($flightslug) {
				if (empty ($flightslug)) {
						redirect($this->data['adminsegment'] . '/Flights/');
				}
               if(!$this->editpermission){
                 echo "<center><h1>Access Denied</h1></center>";
                 backError_404($this->data);
				  }else{
				$updateflight = $this->input->post('submittype');
				$this->data['submittype'] = "update";
				$flightid = $this->input->post('flightid');
				if (!empty ($updateflight)) {
						$this->form_validation->set_rules('flightname', 'flight Name', 'trim|required');
						$this->form_validation->set_rules('flightdesc', 'Description', 'trim|required');
						$this->form_validation->set_rules('flightcity', 'Location', 'trim|required');
						if ($this->form_validation->run() == FALSE) {
								echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
						}
						else {
								$this->Flights_model->update_flight($flightid);
								$this->Flights_model->update_translation($this->input->post('translated'), $flightid);
								$this->session->set_flashdata('flashmsgs', 'flight Updated Successfully');
								echo "done";
						}
				}
				else {
						@ $this->data['hdata'] = $this->Flights_model->get_flight_data($flightslug);
						$comfixed = @ $this->data['hdata'][0]->flight_comm_fixed;
						$comper = $this->data['hdata'][0]->flight_comm_percentage;
						if ($comfixed > 0) {
								$this->data['flightdepositval'] = $comfixed;
								$this->data['flightdeposittype'] = "fixed";
						}
						else {
								$this->data['flightdepositval'] = $comper;
								$this->data['flightdeposittype'] = "percentage";
						}
						$taxfixed = $this->data['hdata'][0]->flight_tax_fixed;
						$taxper = $this->data['hdata'][0]->flight_tax_percentage;
						if ($taxfixed > 0) {
								$this->data['flighttaxval'] = $taxfixed;
								$this->data['flighttaxtype'] = "fixed";
						}
						else {
								$this->data['flighttaxval'] = $taxper;
								$this->data['flighttaxtype'] = "percentage";
						}
						if ($this->data['adminsegment'] == "supplier") {
								if ($this->data['userloggedin'] != $this->data['hdata'][0]->flight_owned_by) {
										redirect($this->data['adminsegment'] . '/Flights/');
								}
						}
						$this->data['main_content'] = 'Flights/manage';
						$this->data['page_title'] = 'Manage flight';
						$this->data['headingText'] = 'Update ' . $this->data['hdata'][0]->flight_title;
						$locInfo = pt_LocationsInfo($this->data['hdata'][0]->flight_city);
						$this->data['locationName'] = $locInfo->city.", ".$locInfo->country;
						$this->data['checkin'] = $this->data['hdata'][0]->flight_check_in;
						$this->data['checkout'] = $this->data['hdata'][0]->flight_check_out;
						$this->data['hrelated'] = explode(",", $this->data['hdata'][0]->flight_related);
						$this->data['featuredfrom'] = pt_show_date_php($this->data['hdata'][0]->flight_featured_from);
						$this->data['featuredto'] = pt_show_date_php($this->data['hdata'][0]->flight_featured_to);
						$this->data['htypes'] = pt_get_hsettings_data("htypes");
						$this->data['hamts'] = pt_get_hsettings_data("hamenities");
						$this->data['flightamt'] = explode(",", $this->data['hdata'][0]->flight_amenities);
						$this->data['hpayments'] = pt_get_hsettings_data("hpayments");
						$this->data['flightpaytypes'] = explode(",", $this->data['hdata'][0]->flight_payment_opt);
						$this->data['all_flights'] = $this->Flights_model->select_related_flights($this->data['userloggedin']);
						$this->load->model('Admin/Locations_model');
						$this->data['locations'] = $this->Locations_model->getLocationsBackend();
						$this->data['flightid'] = $this->data['hdata'][0]->flight_id;
						$this->load->view('Admin/template', $this->data);
				}
			}
		}
		// Rooms functions

		// public function rooms($args = null, $editroom = null) 
		// {
		// 	$isadmin = $this->session->userdata('pt_logged_admin');
		// 	$userid = '';
		// 	if (empty ($isadmin)) {
		// 			$userid = $this->session->userdata('pt_logged_supplier');
		// 	}
		// 	if(!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission){
		// 		backError_404($this->data);

		// 	}
		// 	else{
		// 		$this->load->model('Admin/Uploads_model');
		// 		if ($args == 'add') {
		// 				$this->data['submittype'] = "add";
		// 				$addroom = $this->input->post('submittype');
		// 				if (!empty ($addroom)) {
		// 						$this->form_validation->set_rules('basicprice', 'Room Basic Price', 'trim|required');
		// 						$this->form_validation->set_rules('flightid', 'flight Name', 'trim|required');
		// 						$this->form_validation->set_rules('roomtype', 'Room Type', 'trim|required');
		// 						if ($this->form_validation->run() == FALSE) {
		// 								echo '<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ' . validation_errors() . '</div><br>';
		// 						}
		// 						else {
		// 								if (isset ($_FILES['defaultphoto']) && !empty ($_FILES['defaultphoto']['name'])) {
		// 										echo $this->Uploads_model->__room_default();
		// 										$this->session->set_flashdata('flashmsgs', 'Room added Successfully');
		// 								}
		// 								else {
		// 										$roomid = $this->Rooms_model->add_room();
		// 										$this->Rooms_model->add_translation($this->input->post('translated'), $roomid);
		// 										echo "done";
		// 										$this->session->set_flashdata('flashmsgs', 'Room added Successfully');
		// 								}
		// 						}
		// 				}
		// 				else {
		// 						$isadmin = $this->session->userdata('pt_logged_admin');
		// 						$userid = '';
		// 						if (empty ($isadmin)) {
		// 								$userid = $this->session->userdata('pt_logged_supplier');
		// 						}
		// 						$this->data['flights'] = $this->Flights_model->all_Flights_names($userid);
		// 						$this->data['flightid'] = $this->input->post('flightid');
		// 						$this->data['main_content'] = 'Flights/rooms/manage';
		// 						$this->data['page_title'] = 'Add Room';
		// 						$this->data['headingText'] = 'Add Room';
		// 						$this->load->view('Admin/template', $this->data);
		// 				}
		// 		}
		// 		elseif ($args == "manage" && !empty ($editroom)) {

		// 				$this->data['submittype'] = "update";
		// 				$updateroom = $this->input->post('submittype');
		// 				if (!empty ($updateroom)) {
		// 						$room_id = $this->input->post('roomid');
		// 						$this->form_validation->set_rules('basicprice', 'Basic Price', 'trim|required');
		// 						$this->form_validation->set_rules('roomtype', 'Room Type', 'trim|required');
		// 						if ($this->form_validation->run() == FALSE) {
		// 								echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
		// 						}
		// 						else {
		// 								$this->Rooms_model->update_room($room_id);
		// 								$this->Rooms_model->update_translation($this->input->post('translated'), $room_id);
		// 								$this->session->set_flashdata('flashmsgs', 'Room Updated Successfully');
		// 								echo "done";
		// 						}
		// 				}
		// 				else {
		// 						$this->data['rdata'] = $this->Rooms_model->getRoomData($editroom);
		// 						if (empty ($this->data['rdata'])) {
		// 								redirect('admin/Flights/rooms/');
		// 						}
		// 						$isadmin = $this->session->userdata('pt_logged_admin');
		// 						$userid = '';
		// 						if (empty ($isadmin)) {
		// 								$userid = $this->session->userdata('pt_logged_supplier');
		// 								$myrooms = pt_my_rooms($userid);
		// 								if (!in_array($editroom, $myrooms)) {
		// 										redirect('supplier/flights');
		// 								}
		// 						}
		// 						$this->data['flights'] = $this->Flights_model->all_Flights_names($userid);
		// 						$this->data['room_images'] = $this->Rooms_model->room_images($editroom);

		// 						$selectedyear = $this->input->get("year");
		// 						$this->data['curryear'] = date("Y");
		// 						if ($selectedyear > date("Y") + 3 || $selectedyear < date("Y")) {
		// 								$selectedyear = date("Y");
		// 						}
		// 						if (empty ($selectedyear)) {
		// 								$this->data['year'] = date("Y");
		// 						}
		// 						else {
		// 								$this->data['year'] = $selectedyear;
		// 						}
		// 						$this->load->library('Flights/Flights_calendar_lib');
		// 						$this->data['calendar'] = $this->Flights_calendar_lib;
		// 						$this->data['main_content'] = 'Flights/rooms/manage';
		// 						$this->data['page_title'] = 'Edit Room';
		// 						$this->data['headingText'] = 'Update ' . $this->data['rdata'][0]->room_title;
		// 						$this->load->view('Admin/template', $this->data);
		// 				}
		// 		}
		// 		elseif ($args == "availability" && !empty ($editroom)) {


		// 			$room_count = GetRoomQuantity($editroom);
		// 			$this->data['room_count'] =  $room_count;

		// 			//start update availability
		// 			$updateavail = $this->input->post('updateavail');
		// 			if(!empty($updateavail)){
		// 			$ids_list = $this->input->post('ids_list');
		// 			$ids_list_array = explode(',', $ids_list);

		// 			foreach($ids_list_array as $key){

		// 				$sql = 'UPDATE pt_rooms_availabilities SET ';
		// 				for($day = 1; $day <= 31; $day ++){
		// 					// input validation
		// 					$aval_day = isset($_POST['aval_'.$key.'_'.$day]) ? $_POST['aval_'.$key.'_'.$day] : '0';
		// 					if($day > 1) $sql .= ', ';
		// 					$sql .= 'd'.$day.' = '.(int)$aval_day;
		// 				}
		// 				$sql .= ' WHERE id = '.$key.' AND room_id = '.$editroom;

		// 			$this->db->query($sql);


		// 			}
		// 			$this->session->set_flashdata('flashmsgs', "Availability Updated Successfully");
		// 			redirect(current_url());
		// 			}
		// 			//end update availability

		// 			$weeks = array('Su','Mo','Tu','We','Th','Fr','Sa');
		// 			$months = array('','January','February','March','April','May','June','July','August','September','October','November','December');
		// 			/*$months[1] = 'January';
		// 			$months[2] = 'February';
		// 			$months[3] = 'March';
		// 			$months[4] = 'April';
		// 			$months[5] = 'May';
		// 			$months[6] = 'June';
		// 			$months[7] = 'July';
		// 			$months[8] = 'August';
		// 			$months[9] = 'September';
		// 			$months[10] = 'October';
		// 			$months[11] = 'November';
		// 			$months[12] = 'December';*/
		// 			$year 	       = isset($_REQUEST['year']) ? $_REQUEST['year'] : 'current';
		// 			$ids_list 	   = '';
		// 			$max_days 	   = 0;
		// 			$output        = '';
		// 			$output_week_days = '';
		// 			$current_month = date('m');
		// 			$current_year  = date('Y');
		// 			$selected_year  = ($year == 'next') ? $current_year+1 : $current_year;



		// 			$output .= '<input type="hidden" name="rid" value="'.$editroom.'">';
		// 			$output .= '<input type="hidden" name="year" value="'.$year.'">';

		// 			$output .= '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
		// 			$output .= '<tr><td colspan="39">&nbsp;</td></tr>';

		// 			$count = 0;
		// 			$week_day = date('w', mktime('0', '0', '0', '1', '1', $selected_year));
		// 			// fill empty cells from the beginning of month line
		// 			while($count < $week_day){
		// 				$td_class = (($count == 0 || $count == 6) ? 'day_td_w' : '');	// 0 - 'Sun', 6 - 'Sat'
		// 				$output_week_days .= '<td class="'.$td_class.'">'.$weeks[$count].'</td>';
		// 				$count++;
		// 			}
		// 			// fill cells at the middle
		// 			for($day = 1; $day <= 31; $day ++){
		// 				$week_day = date('w', mktime('0', '0', '0', '1', $day, $selected_year));
		// 				$td_class = (($week_day == 0 || $week_day == 6) ? 'day_td_w' : '');	// 0 - 'Sun', 6 - 'Sat'
		// 				$output_week_days .= '<td class="'.$td_class.'">'.$weeks[$week_day].'</td>';
		// 			}
		// 			$max_days = $count + 31;
		// 			// fill empty cells at the end of month line
		// 			if($max_days < 37){
		// 				$count=0;
		// 				while($count < (37-$max_days)){
		// 					$week_day++;
		// 					$count++;
		// 					$week_day_mod = $week_day % 7;
		// 					$td_class = (($week_day_mod == 0 || $week_day_mod == 6) ? 'day_td_w' : '');	// 0 - 'Sun', 6 - 'Sat'
		// 					$output_week_days .= '<td class="'.$td_class.'">'.$weeks[$week_day_mod].'</td>';
		// 				}
		// 				$max_days += $count;
		// 			}

		// 			// draw week days
		// 			$output .= '<tr style="text-align:center;background-color:#cccccc;">';
		// 			$output .= '<td style="text-align:left;background-color:#ffffff;">';
		// 			$output .= '<select name="selYear" class="changeyear" id="'.current_url().'">';
		// 			$output .= '<option value="current" '.(($year == 'current') ? 'selected="selected"' : '').'>'.$current_year.'</option>';
		// 			$output .= '<option value="next" '.(($year == 'next') ? 'selected="selected"' : '').'>'.($current_year+1).'</option>';
		// 			$output .= '</select>';
		// 			$output .= '</td>';
		// 			$output .= '<td align="center" style="padding:0px 4px;background-color:#ffffff;">&nbsp;</td>';
		// 			$output .= $output_week_days;
		// 			$output .= '</tr>';

		// 			$sql = 'SELECT * FROM pt_rooms_availabilities WHERE room_id = '.$editroom.' AND y = '.(($selected_year == $current_year) ? '0' : '1').' ORDER BY m ASC';
		// 			$room = $this->db->query($sql);

		// 			foreach($room->result() as $res){
		// 				$selected_month = $res->m;
		// 				if($selected_month == $current_month) $tr_class = 'm_current';
		// 				else $tr_class = (($i%2==0) ? 'm_odd' : 'm_even');

		// 				$output .= '<tr align="center" class="'.$tr_class.'">';
		// 				$output .= '<td align="left"><br>&nbsp;<b>'.$months[$selected_month].'</b></td>';
		// 				$output .= '<td><br><span class="btn btn-default btn-xs pointer" id="'.$res->id.'" ><i class="fa fa-angle-double-right"></i></span></td>';
		// 				$max_day = GetMonthMaxDay($selected_year, $selected_month);

		// 				// fill empty cells from the beginning of month line
		// 				$count = date('w', mktime('0', '0', '0', $selected_month, 1, $selected_year));
		// 				$max_days -= $count; /* subtract days that were missed from the beginning of the month */
		// 				while($count--) $output .= '<td></td>';
		// 				// fill cells at the middle
		// 				for($day = 1; $day <= $max_day; $day ++){  $dd = 'd'.$day;
		// 					if($res->$dd >= $room_count){
		// 						$day_color = 'dc_all';
		// 					}else if($res->$dd > 0 && $res->$dd < $room_count){
		// 						$day_color = 'dc_part';
		// 					}else{
		// 						$day_color = 'dc_none';
		// 					}
		// 					$week_day = date('w', mktime('0', '0', '0', $selected_month, $day, $selected_year));
		// 					$td_class = (($week_day == 0 || $week_day == 6) ? 'day_td_w' : 'day_td'); // 0 - 'Sun', 6 - 'Sat'
		// 					$output .= '<td class="'.$td_class.'"><label class="l_day">'.$day.'</label><br><input class="txtval day_a '.$day_color.'" maxlength="3" name="aval_'.$res->id.'_'.$day.'" id="aval_'.$res->id.'_'.$day.'" value="'.$res->$dd.'" data-current="'.$res->$dd.'"  data-max="'.$room_count.'" /></td>';
		// 				}
		// 				// fill empty cells at the end of the month line
		// 				while($day <= $max_days){
		// 					$output .= '<td></td>';
		// 					$day++;
		// 				}
		// 				$output .= '</tr>';
		// 				if($ids_list != '') $ids_list .= ','.$res->id;
		// 				else $ids_list = $res->id;
		// 			}


		// 			$output .= '<tr><td colspan="39">&nbsp;</td></tr>';
		// 			$output .= '<tr><td colspan="39" nowrap="nowrap" height="5px"></td></tr>';
		// 			$output .= '<tr><td colspan="39"><div class="dc_all" style="width:16px;height:15px;float: left;margin:1px;"></div> &nbsp;- Available</td></tr>';
		// 			$output .= '<tr><td colspan="39"><div class="dc_part" style="width:16px;height:15px;float:left;margin:1px;"></div> &nbsp;- Partially Available </td></tr>';
		// 			$output .= '<tr><td colspan="39"><div class="dc_none" style="width:16px;height:15px;float:left;margin:1px;"></div> &nbsp;- Not Available</td></tr>';
		// 			$output .= '</table>';
		// 			$output .= '<input type="hidden" name="ids_list" value="'.$ids_list.'">';


		// 			//$this->data['sqldata'] = $room->result();
		// 			$this->data['calendar'] = $output;
		// 			$this->data['main_content'] = 'Flights/rooms/availability';
		// 			$this->data['page_title'] = 'Room Availability';
		// 			$this->load->view('Admin/template', $this->data);

		// 		}
		// 		elseif ($args == "prices" && !empty ($editroom)) {
		// 				$this->data['delurl'] = base_url().'admin/flightajaxcalls/deleteRoomPrice';
		// 				$action = $this->input->post('action');
		// 				$this->data['errormsg'] = '';
		// 				if($action == "add"){
		// 				$this->form_validation->set_rules('fromdate', 'From Date', 'trim|required');
		// 				$this->form_validation->set_rules('todate', 'To Date', 'trim|required');

		// 				if ($this->form_validation->run() == FALSE) {
		// 					$this->data['errormsg'] = '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
		// 				}else{
		// 			//	 $datefmt = $this->input->post('dateformat');
		// 				$roomid = $this->input->post('roomid');

		// 				$this->Rooms_model->addRoomPrices($roomid);
		// 				redirect($this->data['adminsegment'].'/Flights/rooms/prices/'.$roomid);
		// 				}


		// 				}elseif($action == "update"){
		// 				$this->Rooms_model->updateRoomPrices($this->input->post('pricesdata'));
		// 				redirect($this->data['adminsegment'].'/Flights/rooms/prices/'.$editroom);

		// 				}



		// 				$this->data['prices'] = $this->Rooms_model->getRoomPrices($editroom);
		// 				$this->data['room'] = $this->Rooms_model->getRoomData($editroom);
		// 				$this->data['roomid'] = $editroom;
		// 				$this->data['main_content'] = 'Flights/rooms/prices';
		// 				$this->data['page_title'] = 'Room Prices';
		// 				$this->load->view('Admin/template', $this->data);
		// 		}
		// 		else {	
		// 				$this->load->helper('xcrud');
		// 				$xcrud = xcrud_get_instance();
		// 				$xcrud->table('pt_rooms');
		// 				$xcrud->join('room_flight', 'pt_flights', 'flight_id');
		// 				$xcrud->join('room_type', 'pt_Flights_types_settings', 'sett_id');

		// 				$xcrud->column_class('extras_image', 'zoom_img');
		// 				$xcrud->order_by('room_id', 'desc');
		// 				$xcrud->columns('pt_Flights_types_settings.sett_name,pt_flights.flight_title,room_quantity,room_basic_price,extra_bed,extra_bed_charges,room_min_stay,room_status');
		// 				$xcrud->search_columns('room_title,pt_flights.flight_title,pt_Flights_types_settings.sett_name,room_quantity');
		// 				if($this->role == "supplier"){
		// 				$xcrud->where('pt_flights.flight_owned_by',$this->data['userloggedin']);
		// 				}

		// 				$xcrud->column_pattern('pt_Flights_types_settings.sett_name', '<a href="' . base_url() . $this->data['adminsegment'] . '/Flights/rooms/manage/{room_id}' . '">{value}</a>');

		// 				$xcrud->label('pt_flights.flight_title','flight')->label('room_basic_price','Price')->label('room_quantity','Qty')->label('room_status','Status');
		// 				$xcrud->label('pt_Flights_types_settings.sett_name', 'Room Type');
		// 				$xcrud->label('room_min_stay', 'Gallery');
		// 				$xcrud->label('extra_bed', 'Prices');
		// 				$xcrud->label('extra_bed_charges', 'Availability');
		// 				$xcrud->column_callback('pt_rooms.room_status', 'create_status_icon');
		// 				$xcrud->column_callback('room_min_stay', 'roomGallery');
		// 				$xcrud->column_callback('extra_bed', 'roomPrices');
		// 				$xcrud->column_callback('extra_bed_charges', 'roomAvail');
		// 				$xcrud->limit(100);

		// 			//	$xcrud->unset_add();
		// 				$xcrud->unset_edit();
		// 				$xcrud->unset_remove();
		// 				$xcrud->unset_view();
		// 				//$xcrud->button(base_url() . '', 'Translate', 'fa fa-flag', '', array('target' => '_blank'));
		// 				$xcrud->button(base_url() . $this->data['adminsegment'] . '/Flights/rooms/manage/{room_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
		// 				$delurl = base_url().'admin/flightajaxcalls/delRoom';
		// 				$xcrud->button("javascript: delfunc('{room_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self','id' => '{room_id}'));

		// 				$xcrud->multiDelUrl = base_url().'admin/flightajaxcalls/delMultipleRooms';
		// 				$this->data['content'] = $xcrud->render();
		// 				$this->data['page_title'] = 'Rooms Management';
		// 				$this->data['main_content'] = 'xview';
		// 				$this->data['header_title'] = 'Rooms Management';
		// 				$this->data['add_link'] = base_url() . 'admin/Flights/rooms/add';
		// 				$this->load->view('Admin/template', $this->data);

		// 		}
		// 	}
		// }
		
		function translate($flightslug, $lang = null) 
		{
			$this->load->library('Flights/Flights_lib');
			$this->Flights_lib->set_flightid($flightslug);
			$add = $this->input->post('add');
			$update = $this->input->post('update');
			if (empty ($lang)) {
					$lang = $this->langdef;
			}
			else {
					$lang = $lang;
			}
			$this->data['lang'] = $lang;
			if (empty ($flightslug)) {
					redirect($this->data['adminsegment'] . '/Flights/');
			}
			if (!empty ($add)) {
					$language = $this->input->post('langname');
					$flightid = $this->input->post('flightid');
					$this->Flights_model->add_translation($language, $flightid);
					redirect($this->data['adminsegment'] . "/Flights/translate/" . $flightslug . "/" . $language);
			}
			if (!empty ($update)) {
					$slug = $this->Flights_model->update_translation($lang, $flightslug);
					redirect($this->data['adminsegment'] . "/Flights/translate/" . $slug . "/" . $lang);
			}
			$hdata = $this->Flights_lib->flight_details();
			if ($lang == $this->langdef) {
					$flightsdata = $this->Flights_lib->flight_short_details();
					$this->data['flightsdata'] = $flightsdata;
					$this->data['transpolicy'] = $flightsdata[0]->flight_policy;
					$this->data['transadditional'] = $flightsdata[0]->flight_additional_facilities;
					$this->data['transdesc'] = $flightsdata[0]->flight_desc;
					$this->data['transtitle'] = $flightsdata[0]->flight_title;
			}
			else {
					$flightsdata = $this->Flights_lib->translated_data($lang);
					$this->data['flightsdata'] = $flightsdata;
					$this->data['transid'] = $flightsdata[0]->trans_id;
					$this->data['transpolicy'] = $flightsdata[0]->trans_policy;
					$this->data['transadditional'] = $flightsdata[0]->trans_additional;
					$this->data['transdesc'] = $flightsdata[0]->trans_desc;
					$this->data['transtitle'] = $flightsdata[0]->trans_title;
			}
			$this->data['flightid'] = $this->Flights_lib->get_id();
			$this->data['lang'] = $lang;
			$this->data['slug'] = $flightslug;
			$this->data['language_list'] = pt_get_languages();
			if ($this->data['adminsegment'] == "supplier") {
					if ($this->data['userloggedin'] != $hdata[0]->flight_owned_by) {
							redirect($this->data['adminsegment'] . '/Flights/');
					}
			}
			$this->data['main_content'] = 'Flights/translate';
			$this->data['page_title'] = 'Translate flight';
			$this->load->view('Admin/template', $this->data);
		}

		function gallery($id) {
				$this->load->library('Flights/Flights_lib');
				$this->Flights_lib->set_flightid($id);
				$this->data['itemid'] = $this->Flights_lib->get_id();
				$this->data['images'] = $this->Flights_model->flightGallery($id);
                $this->data['imgorderUrl'] = base_url().'admin/flightajaxcalls/update_image_order';
                $this->data['uploadUrl'] = base_url().'Flights/flightsback/galleryUpload/Flights/';
                $this->data['delimgUrl'] = base_url().'admin/flightajaxcalls/delete_image';
                $this->data['appRejUrl'] = base_url().'admin/flightajaxcalls/app_rej_himages';
                $this->data['makeThumbUrl'] = base_url().'admin/flightajaxcalls/makethumb';
                $this->data['delMultipleImgsUrl'] = base_url().'admin/flightajaxcalls/deleteMultipleflightImages';
                $this->data['fullImgDir'] = PT_Flights_SLIDER;
                $this->data['thumbsDir'] =PT_Flights_SLIDER_THUMBS;
				$this->data['main_content'] = 'Flights/gallery';
				$this->data['page_title'] = 'flight Gallery';
				$this->load->view('Admin/template', $this->data);
		}

        function roomgallery($id) {
				$this->data['images'] = $this->Rooms_model->roomGallery($id);
                $this->data['imgorderUrl'] = base_url().'admin/flightajaxcalls/update_room_image_order';
                $this->data['uploadUrl'] = base_url().'Flights/flightsback/galleryUpload/rooms/';
                $this->data['delimgUrl'] = base_url().'admin/flightajaxcalls/delete_room_image';
                $this->data['appRejUrl'] = base_url().'admin/flightajaxcalls/app_rej_rimages';
                $this->data['makeThumbUrl'] = base_url().'admin/flightajaxcalls/room_makethumb';
                $this->data['delMultipleImgsUrl'] = base_url().'admin/flightajaxcalls/deleteMultipleRoomImages';
                $this->data['fullImgDir'] = PT_ROOMS_IMAGES;
                $this->data['thumbsDir'] = PT_ROOMS_THUMBS;
               	$this->data['itemid'] = $id;
                $this->data['main_content'] = 'Flights/gallery';
				$this->data['page_title'] = 'Room Gallery';
				$this->load->view('Admin/template', $this->data);
		}

		function galleryUpload($type, $id) {
				$this->load->library('image_lib');
				if (!empty ($_FILES)) {
						$tempFile = $_FILES['file']['tmp_name'];
						$fileName = $_FILES['file']['name'];
						$fileName = str_replace(" ", "-", $_FILES['file']['name']);
						$fig = rand(1, 999999);
						$saveFile = $fig . '_' . $fileName;

						if (strpos($fileName,'php') !== false) {

						}else{

                        if($type == "flights"){
						$targetPath = PT_Flights_SLIDER_UPLOAD;
                        }elseif($type == "rooms"){
                        $targetPath = PT_ROOMS_IMAGES_UPLOAD;
                        }

						$targetFile = $targetPath . $saveFile;
						move_uploaded_file($tempFile, $targetFile);
						$config['image_library'] = 'gd2';
						$config['source_image'] = $targetFile;

						if($type == "flights"){
						$config['new_image'] = PT_Flights_SLIDER_THUMBS_UPLOAD;
						}elseif($type == "rooms"){
						$config['new_image'] = PT_ROOMS_THUMBS_UPLOAD;
						}

						$config['thumb_marker'] = '';
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = THUMB_WIDTH;
						$config['height'] = THUMB_HEIGHT;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						modules :: run('Admin/watermark/apply',$targetFile);

                        if($type == "flights"){
                    /* Add images name to database with respective flight id */
						$this->Flights_model->addPhotos($id, $saveFile);
                        }elseif($type == "rooms"){
                    /* Add images name to database with respective room id */
                        $this->Rooms_model->addPhotos($id, $saveFile);
                        }

                    }
				}
		}

		function LoadXcrudflightsettings($type) 
		{
				$xc = "xcrud" . $type;
				$xc = xcrud_get_instance();
				$xc->table('pt_Flights_types_settings');
				$xc->where('sett_type', $type);
				$xc->order_by('sett_id', 'desc');
				$xc->button('#sett{sett_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('data-toggle' => 'modal'));
				$delurl = base_url().'admin/flightajaxcalls/delTypeSettings';
               	$xc->button("javascript: delfunc('{sett_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self','id' => '{sett_id}'));


                if($type == "rtypes" || $type == "htypes"){
                $xc->columns('sett_name,sett_status');
                }else{
                 if($type == "hamenities"){
                 $xc->columns('sett_img,sett_name,sett_selected,sett_status');
                $xc->column_class('sett_img', 'zoom_img');
				$xc->change_type('sett_img', 'image', false, array('width' => 200, 'path' => '../../'.PT_Flights_ICONS_UPLOAD, 'thumbs' => array(array('height' => 150, 'width' => 120, 'crop' => true, 'marker' => ''))));

                 }else{
                $xc->columns('sett_name,sett_selected,sett_status');
                }

                 }
                $xc->search_columns('sett_name,sett_selected,sett_status');
                $xc->label('sett_name', 'Name')->label('sett_selected', 'Selected')->label('sett_status', 'Status')->label('sett_img', 'Icon');
                $xc->unset_add();
				$xc->unset_edit();
				$xc->unset_remove();
				$xc->unset_view();
				$xc->multiDelUrl = base_url().'admin/flightajaxcalls/delMultiTypeSettings/'.$type;
				$this->data['content' . $type] = $xc->render();
		}

        function extras(){


		if($this->data['adminsegment'] == "supplier"){

			 $supplierflights = $this->Flights_model->all_flights($this->data['userloggedin']);
			 $allflights = $this->Flights_model->all_flights();

			 echo  modules :: run('Admin/extras/listings','flights',$allflights, $supplierflights);

		}else{


			 $flights = $this->Flights_model->all_flights();

			echo  modules :: run('Admin/extras/listings','flights',$flights);

		}


        }

        function reviews(){

         echo  modules :: run('Admin/Reviews/listings','flights');
        }

}
