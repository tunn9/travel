<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Promotions extends MX_Controller {
    private $validlang;
    function __construct() {
        parent :: __construct();
        $this->load->model("Promotions/Promotions_model");
    }

    public function index() {
        $this->theme->view('promotions/promotions', $this->data, $this);
    }


}
