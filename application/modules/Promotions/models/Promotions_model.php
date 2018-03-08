<?php

class Promotions_model extends CI_Model {
    public $langdef;
    function __construct()
    {
        parent::__construct();
        $this->langdef = DEFLANG;
    }
    function latest_posts($limit, $orderby = null) {
       $this->db->select('*');
        if ($orderby == "za") {
            $this->db->order_by('pt_cheapflight.title', 'desc');
        }
        elseif ($orderby == "az") {
            $this->db->order_by('pt_cheapflight.title', 'asc');
        }
        elseif ($orderby == "oldf") {
            $this->db->order_by('pt_cheapflight.cheapflight_id', 'asc');
        }
        elseif ($orderby == "newf") {
            $this->db->order_by('pt_cheapflight.cheapflight_id', 'desc');
        }
        elseif ($orderby == "ol") {
            $this->db->order_by('pt_cheapflight.post_order', 'asc');
        }

        $this->db->limit($limit);
        $res = $this->db->get('pt_cheapflight')->result();
        return $res;
    }
}