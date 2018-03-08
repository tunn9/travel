<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

class MX_Controller
{
	public $autoload = array();
	public $data = array();
	public $appSettings;

	public function __construct()
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);

		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		$this->appSettings = $this->Settings_model->get_settings_data();
		$this->data['app_settings'] = $this->appSettings;

        $this->load->library('Browser');
        $browser = new Browser();
        $this->data['ismobile'] = $browser->isMobile();

	}

	public function _dd($data)
	{
		var_dump($data);
		exit();
	}

	public function __get($class) {
		return CI::$APP->$class;
	}

	public function frontData(){
		//$this->data['lang_set'] = $this->theme->_data['lang_set'];

		$headerMenu = getHeaderMenu($this->data['lang_set']);


		$this->data['headerMenu'] = $headerMenu;
		$this->data['ishome'] = $this->uri->segment(1);
		$this->data['currenturl'] = uri_string();

		$this->data['isRTL'] = isRTL($this->data['lang_set']);
		$this->data['allowreg'] = $this->data['app_settings'][0]->allow_registration;
		$this->data['allowsupplierreg'] = $this->data['app_settings'][0]->allow_supplier_registration;
		$this->data['tripmodule'] = $this->ptmodules->is_mod_available_enabled("tripadvisor");
		$this->data['mSettings'] = mobileSettings();
		$this->data['footersocials'] = pt_get_footer_socials();
		$this->data['languageList'] = pt_get_languages();

		return $this->data;


	}

	public function setMetaData($title = null, $desc = null, $keywords = null ){

		if(empty($title)){
			$this->data['pageTitle'] = $this->appSettings[0]->home_title;
		}else{
			$this->data['pageTitle'] = $title;
		}

		if(empty($desc)){
			$this->data['metadescription'] = $this->appSettings[0]->meta_description;
		}else{
			$this->data['metadescription'] = $desc;
		}

		if(empty($keywords)){
			$this->data['metakeywords'] = $this->appSettings[0]->keywords;
		}else{
			$this->data['metakeywords'] = $keywords;
		}


	}
}
