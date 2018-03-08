<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Flightsback extends MX_Controller {

    public $chk;

	public function __construct()
	{
		parent::__construct();

		// Access Checkpoint
		// Module enabled/disabled checkpoint
		$chk = modules :: run('Home/is_main_module_enabled', 'flights');
		$this->role    = $this->session->userdata('pt_role');

		// If user is not log in then redirect the to admin panel.
		$this->data['userloggedin'] = $this->session->userdata('pt_logged_id');

		if (empty($this->data['userloggedin']))
		{
			// Redirect user to admin/index (Admin Dashboard)
			$urisegment =  $this->uri->segment(1);

			$this->session->set_userdata('prevURL', current_url());

			redirect($urisegment);
		}

		// If user is admin then assign `admin` to segment otherwise `supplier`
		$administrator = $this->session->userdata('pt_logged_admin');

		if ( ! empty ($administrator))
		{
			$this->data['adminsegment'] = "admin";
		}
		else
		{
			$this->data['adminsegment'] = "supplier";
		}

		// Usecase 1: If someone make changes in session then this check can be helpful.

		// If segment string is `admin` then validate it otherwise validated `supplier`
		if ($this->data['adminsegment'] == "admin")
		{
			$checkpoint = modules :: run('Admin/validadmin');
			if ( ! $checkpoint) // If checkpoint become fail
			{
				redirect('admin');
			}
		}
		else
		{
			$checkpoint = modules :: run('supplier/validsupplier');
			if ( ! $checkpoint) // If checkpoint become fail
			{
				redirect('supplier');
			}
		}

		// Assign PHP Travel app settings, get it from settings table.
        $this->data['appSettings'] = modules :: run('Admin/appSettings');

		$this->data['addpermission'] = true;

		if($this->role == "supplier" || $this->role == "admin")
		{
            $this->editpermission = pt_permissions("edithotels", $this->data['userloggedin']);
            $this->deletepermission = pt_permissions("deletehotels", $this->data['userloggedin']);

			$this->data['addpermission'] = pt_permissions("addhotels", $this->data['userloggedin']);
        }

		$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
		$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
	}

	public function index()
	{
		// Index page
	}

	public function settings()
	{
		$this->load->model('flights/Flights_model');
		$this->data['menu_status'] = $this->Flights_model->get_menu_status();
		$this->data['module_setting'] = $this->Flights_model->module_settings();
		$this->data['main_content'] = 'Flights/settings';
		$this->data['page_title'] = 'Flights Settings';

		$this->load->view('Admin/template', $this->data);
	}
}
