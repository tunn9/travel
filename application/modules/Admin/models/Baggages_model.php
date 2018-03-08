<?php

class Baggages_model extends CI_Model {
	public $langdef;

	function __construct() {
			// Call the Model constructor
			parent :: __construct();
			$this->langdef = DEFLANG;
	}

	// add baggage data
	function add_baggage($filename_db = null) {
			if (empty ($filename_db)) {
					$filename_db = "";
			}
			$this->db->select("baggage_id");
			$this->db->order_by("baggage_id", "desc");
			$query = $this->db->get('pt_baggages');
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
				'baggage_airline_name' => $airline_name,
				'baggage_airline_code' => $airline_code,
				'baggage_class' => $this->input->post('class_code'),
				'baggage_desc' => $this->input->post('desc'),
				'baggage_status' => $this->input->post('status'),
			);
			$this->db->insert('pt_baggages', $data);
			$postid = $this->db->insert_id();
			$this->add_translation($this->input->post('translated'),$postid);
	}

	// update ticket level data
	function update_baggage($id, $filename_db = null) {
			$this->db->select("baggage_id");
			$this->db->order_by("baggage_id", "desc");
			$query = $this->db->get('pt_baggages');
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
			// if (empty ($id)) {
			// 		$this->db->select("baggage_id");
			// 		$this->db->where("baggage_id !=", $id);
			// 		$this->db->where("pmethod_title", $this->input->post('title'));
			// 		$queryc = $this->db->get('pt_baggages')->num_rows();
			// 		// if ($queryc > 0) {
			// 		// 		$postslug = create_url_slug($this->input->post('title')) . "-" . $postlastid;
			// 		// }
			// 		// else {
			// 		// 		$postslug = create_url_slug($this->input->post('title'));
			// 		// }
			// }
			// else {
			// 		$this->db->select("ticket_level_id");
			// 		$this->db->where("ticket_level_id !=", $id);
			// 		// $this->db->where("post_slug", $this->input->post('slug'));
			// 		$queryc = $this->db->get('pt_baggages')->num_rows();
			// 		// if ($queryc > 0) {
			// 		// 		$postslug = create_url_slug($this->input->post('slug')) . "-" . $postlastid;
			// 		// }
			// 		// else {
			// 		// 		$postslug = create_url_slug($this->input->post('slug'));
			// 		// }
			// }
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
				'baggage_airline_name' => $airline_name,
				'baggage_airline_code' => $airline_code,
				'baggage_class' => $this->input->post('class_code'),
				'baggage_desc' => $this->input->post('desc'),
				'baggage_status' => $this->input->post('status'),
			);
			$this->db->where('baggage_id', $id);
			$this->db->update('pt_baggages', $data);
			$this->update_translation($this->input->post('translated'),$id);
	}

	function get_baggages_data($id) {
		$this->db->where('baggage_id', $id);
		return $this->db->get('pt_baggages')->result();
	}

	function delete_baggage($id) {
			$this->db->where('baggage_id', $id);
			$this->db->delete('pt_baggages');
			$this->db->where('item_id', $id);
			$this->db->delete('pt_baggages_translation');
	}

	function getBaggageTranslation($lang, $id) {
		$this->db->where('trans_lang', $lang);
		$this->db->where('item_id', $id);
		return $this->db->get('pt_baggages_translation')->result();
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
			$this->db->insert('pt_baggages_translation', $data);
		  }
		}
	}

	// Update translation of some fields data
	function update_translation($postdata,$id){

		foreach($postdata as $lang => $val){
			if(array_filter($val)){
				$title = $val['title'];
				$desc = $val['desc'];
				$transAvailable = $this->getBaggageTranslation($lang,$id);

				if(empty($transAvailable)){
					$data = array(
						'trans_title' => $title,
						'trans_desc' => $desc,
						'item_id' => $id,
						'trans_lang' => $lang
					);
					$this->db->insert('pt_baggages_translation', $data);
				}
				else{
					$data = array(
						'trans_title' => $title,
						'trans_desc' => $desc,
					);
					$this->db->where('item_id', $id);
					$this->db->where('trans_lang', $lang);
					$this->db->update('pt_baggages_translation', $data);
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
