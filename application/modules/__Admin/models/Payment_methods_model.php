<?php

class Payment_methods_model extends CI_Model {
		public $langdef;

		function __construct() {
                // Call the Model constructor
				parent :: __construct();
				$this->langdef = DEFLANG;
		}

        // add Payment method data
		function add_payment_method($filename_db = null) {
				if (empty ($filename_db)) {
						$filename_db = "";
                }
				$this->db->select("pmethod_id");
				$this->db->order_by("pmethod_id", "desc");
				$query = $this->db->get('pt_payment_methods');
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
					'pmethod_title' => $this->input->post('title'),
					'pmethod_desc' => $this->input->post('desc'),
					'pmethod_status' => $this->input->post('status'),
					'pmethod_order' => $postorder,
					'pmethod_created_at' => time(),
					'pmethod_updated_at' => time()
				);
				$this->db->insert('pt_payment_methods', $data);
                $postid = $this->db->insert_id();
                $this->add_translation($this->input->post('translated'),$postid);
        }

        // update Payment method data
		function update_payment_method($id, $filename_db = null) {
				$this->db->select("pmethod_id");
				$this->db->order_by("pmethod_id", "desc");
				$query = $this->db->get('pt_payment_methods');
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
				if (empty ($slug)) {
						$this->db->select("pmethod_id");
						$this->db->where("pmethod_id !=", $id);
						$this->db->where("pmethod_title", $this->input->post('title'));
						$queryc = $this->db->get('pt_payment_methods')->num_rows();
						// if ($queryc > 0) {
						// 		$postslug = create_url_slug($this->input->post('title')) . "-" . $postlastid;
						// }
						// else {
						// 		$postslug = create_url_slug($this->input->post('title'));
						// }
				}
				else {
						$this->db->select("pmethod_id");
						$this->db->where("pmethod_id !=", $id);
						// $this->db->where("post_slug", $this->input->post('slug'));
						$queryc = $this->db->get('pt_payment_methods')->num_rows();
						// if ($queryc > 0) {
						// 		$postslug = create_url_slug($this->input->post('slug')) . "-" . $postlastid;
						// }
						// else {
						// 		$postslug = create_url_slug($this->input->post('slug'));
						// }
				}
				$data = array('pmethod_title' => $this->input->post('title'), 'pmethod_desc' => $this->input->post('desc'), 'pmethod_status' => $this->input->post('status'), 'pmethod_updated_at' => time());
				$this->db->where('pmethod_id', $id);
				$this->db->update('pt_payment_methods', $data);
                $this->update_translation($this->input->post('translated'),$id);
		}

        // update post order
		function update_payment_method_order($id, $order) {
				$data = array('pmethod_order' => $order);
				$this->db->where('pmethod_id', $id);
				$this->db->update('pt_payment_methods', $data);
		}

		function get_payment_method_data($id) {
		    $this->db->where('pmethod_id', $id);
			return $this->db->get('pt_payment_methods')->result();
	    }

		function delete_payment_method($id) {
				$this->db->where('pmethod_id', $id);
				$this->db->delete('pt_payment_methods');
                $this->db->where('item_id', $id);
				$this->db->delete('pt_payment_method_translation');
		}

		
    	function getPaymentMethodTranslation($lang, $id) {
			$this->db->where('trans_lang', $lang);
			$this->db->where('item_id', $id);
			return $this->db->get('pt_payment_method_translation')->result();
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
				$this->db->insert('pt_payment_method_translation', $data);
              }
            }
		}

        // Update translation of some fields data
		function update_translation($postdata,$id){

			foreach($postdata as $lang => $val){
				if(array_filter($val)){
					$title = $val['title'];
					$desc = $val['desc'];
					$transAvailable = $this->getPaymentMethodTranslation($lang,$id);

					if(empty($transAvailable)){
						$data = array(
							'trans_title' => $title,
							'trans_desc' => $desc,
							'item_id' => $id,
							'trans_lang' => $lang
						);
						$this->db->insert('pt_payment_method_translation', $data);
					}
					else{
						$data = array(
							'trans_title' => $title,
							'trans_desc' => $desc,
						);
						$this->db->where('item_id', $id);
						$this->db->where('trans_lang', $lang);
						$this->db->update('pt_payment_method_translation', $data);
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
