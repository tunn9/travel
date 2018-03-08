<?php

class Flights_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_menu_status()
	{
		$this->db->select('page_id, slug_status');
		$dataAdapter = $this->db->get_where('pt_cms', array(
			'page_slug' => 'flights'
		));
		
		return $dataAdapter->row();
	}

	public function module_settings()
	{
		$dataAdapter = $this->db->get('pt_flights_settings');
		
		return $dataAdapter->row();
	}

	public function update_settings($payload)
	{
		$this->db->set('header_title', $payload['header_title']);
		$this->db->where('id', $payload['module_setting_id']);
		$this->db->update('pt_flights_settings');

		$this->db->set('slug_status', $payload['menu_status']);
		$this->db->where('page_id', $payload['page_id']);
		$this->db->update('pt_cms');
	}
}