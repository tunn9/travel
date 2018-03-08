<?php

class Ticket_level_model extends CI_Model {
		public $langdef;

		function __construct() {
                // Call the Model constructor
				parent :: __construct();
				$this->langdef = DEFLANG;
		}

        // add ticket level data
		function add_ticket_level($filename_db = null) {
				if (empty ($filename_db)) {
						$filename_db = "";
                }
				$this->db->select("ticket_level_id");
				$this->db->order_by("ticket_level_id", "desc");
				$query = $this->db->get('pt_ticket_levels');
				$lastid = $query->result();
				if (empty ($lastid)) {
					$postlastid = 1;
				}
				else {
					$postlastid = $lastid[0]->post_id + 1;
				}

				$postcount = $query->num_rows();
				$postorder = $postcount + 1;

				$airline_code =  $this->input->post('airline_code');
				$airline_name = "";
				if($airline_code == "VN"){
					$airline_name = "Vietnam Airlines";
				} else if($airline_code == "BL"){
					$airline_name = "Jetstar Pacific";
				} else {
					$airline_name = "Vietjet Air";
				}

				$data = array(
					'ticket_level_code' => $this->input->post('ticket_level_code'),
					'ticket_level_desc' => $this->input->post('desc'),
					'ticket_airline_name' => $airline_name,
					'ticket_airline_code' => $airline_code,
				);
				$this->db->insert('pt_ticket_levels', $data);
                $postid = $this->db->insert_id();
                $this->add_translation($this->input->post('translated'),$postid);
        }

        // update ticket level data
		function update_ticket_level($id, $filename_db = null) {
				$this->db->select("ticket_level_id");
				$this->db->order_by("ticket_level_id", "desc");
				$query = $this->db->get('pt_ticket_levels');
				$lastid = $query->result();
				if (empty ($lastid)) {
						$postlastid = 1;
				}
				else {
						$postlastid = $lastid[0]->post_id + 1;
				}
				$postcount = $query->num_rows();
				$postorder = $postcount + 1;
				// $slug = $this->input->post('slug');
				if (empty ($id)) {
						$this->db->select("ticket_level_id");
						$this->db->where("ticket_level_id !=", $id);
						$this->db->where("pmethod_title", $this->input->post('title'));
						$queryc = $this->db->get('pt_ticket_levels')->num_rows();
						// if ($queryc > 0) {
						// 		$postslug = create_url_slug($this->input->post('title')) . "-" . $postlastid;
						// }
						// else {
						// 		$postslug = create_url_slug($this->input->post('title'));
						// }
				}
				else {
						$this->db->select("ticket_level_id");
						$this->db->where("ticket_level_id !=", $id);
						// $this->db->where("post_slug", $this->input->post('slug'));
						$queryc = $this->db->get('pt_ticket_levels')->num_rows();
						// if ($queryc > 0) {
						// 		$postslug = create_url_slug($this->input->post('slug')) . "-" . $postlastid;
						// }
						// else {
						// 		$postslug = create_url_slug($this->input->post('slug'));
						// }
				}
				$airline_code =  $this->input->post('airline_code');
				$airline_name = "";
				if($airline_code == "VN"){
					$airline_name = "Vietnam Airlines";
				} else if($airline_code == "BL"){
					$airline_name = "Jetstar Pacific";
				} else {
					$airline_name = "Vietjet Air";
				}
				$data = array(
					'ticket_level_code' => $this->input->post('ticket_level_code'),
					'ticket_level_desc' => $this->input->post('desc'),
					'ticket_airline_name' => $airline_name,
					'ticket_airline_code' => $airline_code,
				);
				$this->db->where('ticket_level_id', $id);
				$this->db->update('pt_ticket_levels', $data);
                $this->update_translation($this->input->post('translated'),$id);
		}

		function get_ticket_level_data($id) {
		    $this->db->where('ticket_level_id', $id);
			return $this->db->get('pt_ticket_levels')->result();
	    }

		function delete_ticket_level($id) {
				$this->db->where('ticket_level_id', $id);
				$this->db->delete('pt_ticket_levels');
                $this->db->where('item_id', $id);
				$this->db->delete('pt_ticket_levels_translation');
		}

    	function getTicketLevelTranslation($lang, $id) {
			$this->db->where('trans_lang', $lang);
			$this->db->where('item_id', $id);
			return $this->db->get('pt_ticket_levels_translation')->result();
	    }

        // Adds translation of some fields data
		function add_translation($postdata,$id) {
		  foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $title = $val['title'];
                $desc = $val['desc'];

                $data = array(
					'trans_title' => $title,
					'trans_desc' => $desc,
					'item_id' => $id,
					'trans_lang' => $lang
                );
				$this->db->insert('pt_ticket_levels_translation', $data);
              }
            }
		}

        // Update translation of some fields data
		function update_translation($postdata,$id){

			foreach($postdata as $lang => $val){
				if(array_filter($val)){
					$title = $val['title'];
					$desc = $val['desc'];
					$transAvailable = $this->getTicketLevelTranslation($lang,$id);

					if(empty($transAvailable)){
						$data = array(
							'trans_title' => $title,
							'trans_desc' => $desc,
							'item_id' => $id,
							'trans_lang' => $lang
						);
						$this->db->insert('pt_ticket_levels_translation', $data);
					}
					else{
						$data = array(
							'trans_title' => $title,
							'trans_desc' => $desc,
						);
						$this->db->where('item_id', $id);
						$this->db->where('trans_lang', $lang);
						$this->db->update('pt_ticket_levels_translation', $data);
					}
				}
            }
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
