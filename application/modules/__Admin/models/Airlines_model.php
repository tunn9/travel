<?php

class Airlines_model extends CI_Model {
		public $langdef;

		function __construct() {
                // Call the Model constructor
				parent :: __construct();
				$this->langdef = DEFLANG;
		}

		function get_group_airs() {
			return $this->db->get('pt_group_airlines')->result();
		}
		
		
		function get_airline_data($id) {
		    $this->db->where('air_id', $id);
			return $this->db->get('pt_airlines')->result();
		}
		

		function shortInfo($id = null) {
			$result = array();
			$this->db->select('air_id,air_name');
			// if (!empty ($id)) {
			// 		$this->db->where('car_owned_by', $id);
			// }
			#$this->db->where('car_status', 'Yes');
			$this->db->order_by('air_id', 'desc');
			$airlines = $this->db->get('pt_airlines')->result();
			foreach($airlines as $air){
				$result[] = (object)array('id' => $air->air_id, 'title' => $air->air_name);
			}

			return $result;
		}


        // add airline data
		function add_airline() {
			$this->db->select("air_id");
			$this->db->order_by("air_id", "desc");
			$query = $this->db->get('pt_airlines');
			$lastid = $query->result();
			if (empty ($lastid)) {
				$postlastid = 1;
			}
			else {
				$postlastid = $lastid[0]->post_id + 1;
			}

			$postcount = $query->num_rows();
			$postorder = $postcount + 1;

			$data = array(
				'air_iata_code' => $this->input->post('iacode'),
				'air_name' => $this->input->post('airname'),
				'air_td_code' => $this->input->post('tdcode'),
				'air_icao_code' => $this->input->post('iccode'),
				'air_country' => $this->input->post('country'),
				'air_group_id' => $this->input->post('groupid')
			);
			$this->db->insert('pt_airlines', $data);
            $postid = $this->db->insert_id();
		}
		
		//update airline data
		function update_airline($id) {
		
			$data = array(
				'air_iata_code' => $this->input->post('iacode'),
				'air_name' => $this->input->post('airname'),
				'air_td_code' => $this->input->post('tdcode'),
				'air_icao_code' => $this->input->post('iccode'),
				'air_country' => $this->input->post('country'),
				'air_group_id' => $this->input->post('groupid')
			);
			$this->db->where('air_id', $id);
			$this->db->update('pt_airlines', $data);
		}
		
		// Delete airline data
		function delete_airline($id){
			$this->db->where('air_id',$id);
			$this->db->delete('pt_airlines');
		}


    	// function makeSlug($title,$postlastid = null){
        //                 $slug = create_url_slug($title);
        //                 $this->db->select("post_id");
		// 				$this->db->where("post_slug", $slug);
        //                 if(!empty($postlastid)){
        //                  $this->db->where('post_id !=',$postlastid);
        //                 }
		// 				$queryc = $this->db->get('pt_blog')->num_rows();
		// 				if ($queryc > 0) {
		// 						$slug = $slug."-".$postlastid;
		// 				}
        //                 return $slug;
    	// }
}
