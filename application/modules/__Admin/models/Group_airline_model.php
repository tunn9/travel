<?php

class Group_airline_model extends CI_Model {
		public $langdef;

		function __construct() {
                // Call the Model constructor
				parent :: __construct();
				$this->langdef = DEFLANG;
		}

        // add group airline
		function add_group_airline() {
			$this->db->select("g_airline_id");
			$this->db->order_by("g_airline_id", "desc");
			$query = $this->db->get('pt_group_airlines');
			$lastid = $query->result();
			if (empty ($lastid)) {
					$catlastid = 1;
			}
			else {
					$catlastid = $lastid[0]->g_airline_id + 1;
			}
			$this->db->select("g_airline_id");
			$this->db->where("g_airline_name", $this->input->post('name'));
			// $queryc = $this->db->get('pt_group_airlines')->num_rows();
			// if ($queryc > 0) {
			// 		$slug = create_url_slug($this->input->post('name')) . "-" . $catlastid;
			// }
			// else {
			// 		$slug = create_url_slug($this->input->post('name'));
			// }
			$data = array('g_airline_name' => $this->input->post('name'), 'g_airline_status' => $this->input->post('status'));
			$this->db->insert('pt_group_airlines', $data);
			$catid = $this->db->insert_id();
		}
		
		// delete group airline
		function delete_group_airline($groupid) {
				$this->db->where('g_airline_id', $groupid);
				$this->db->delete('pt_group_airlines');
		}

		// update group airline
		function update_group_airline() {
			$id = $this->input->post('groupid');
			// $this->db->select("g_airline_id");
			// $this->db->order_by("g_airline_id", "desc");
			// $query = $this->db->get('pt_group_airlines');
			// $lastid = $query->result();
			// if (empty ($lastid)) {
			// 		$catlastid = 1;
			// }
			// else {
			// 		$catlastid = $lastid[0]->g_airline_id + 1;
			// }
			// $this->db->select("g_airline_id");
			#$this->db->where("g_airline_id !=", $id);
			// $this->db->where("cat_slug", $this->input->post('slug'));
			// $queryc = $this->db->get('pt_blog_categories')->num_rows();
			// if ($queryc > 0) {
			// 		$slug = create_url_slug($this->input->post('name')) . "-" . $catlastid;
			// }
			// else {
			// 		$slug = create_url_slug($this->input->post('name'));
			// }
			//$data = array('cat_name' => $this->input->post('name'), 'cat_slug' => $slug, 'cat_status' => $this->input->post('status'));
			$data = array('g_airline_name' => $this->input->post('name'), 'g_airline_status' => $this->input->post('status'));
			$this->db->where('g_airline_id', $id);
			$this->db->update('pt_group_airlines', $data);
	    }
       
		function get_all_group_airlines() {
			$this->db->order_by('g_airline_id', 'desc');
			$query = $this->db->get('pt_group_airlines');
			$data['all'] = $query->result();
			$data['nums'] = $query->num_rows();
			return $data;
     	}
}
