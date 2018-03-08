<?php

class Promotions_lib {
    // Protected variables
    protected $ci = null;
    protected $db;
    protected $lang;

    function __construct()
    {
        // get the CI Instance
        $this->ci = & get_instance();
        $this->db = $this->ci->db;
        $this->ci->load->model('Promotions/Promotions_model');
        $lang = $this->ci->session->userdata('set_lang');
        $detaullang = pt_get_default_language();

        $this->set_lang($this->ci->session->userdata('set_lang'));
        $this->langdef = DEFLANG;
    }
    function set_lang($lang){
        if (empty ($lang)) {
            $defaultlang = pt_get_default_language();
            $this->lang = $defaultlang;
        }
        else {
            $this->lang = $lang;
        }
    }
    function settings() {

    }
    function lastestPromotionsHomePage() {
        $results =  new stdClass;
        $posts = $this->ci->Promotions_model->latest_posts(13, 'za');
        $results->promotions_posts = array();
        foreach ($posts as $p){
            $results->promotions_posts[] = (object)array(
                'id' => $p->cheapflight_id,
                'title' => $p->title,
                'price' => $p->price,
                'startpoint' => $p->startpoint,
                'endpoint' => $p->endpoint,
                'godate' => $p->godate,
                'comebackdate' => $p->comebackdate,
                'type' => $p->type
            );
        }
        return $results;
    }
}