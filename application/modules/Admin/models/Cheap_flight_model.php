<?php

class Cheap_flight_model extends CI_Model
{

    function __construct()
    {
// Call the Model constructor
        parent:: __construct();
    }

    function get_cheap_flights()
    {
        var_dump('1111111111111111'); die();
        $this->db->order_by('cheapflighr_index', 'asc');
        $q = $this->db->get('pt_cheapflight')->result();
        return $q;
    }

    function get_cheap_flight($id){
        $this->db->where('cheapflight_id',$id);
        return $this->db->get('pt_cheapflight')->result();
    }

// add offer
    function add_cheap_flight()
    {
        $godate = $this->input->post('godate');
        $comebackdate = $this->input->post('comebackdate');

        $data = array(
            'title' => $this->input->post('title'),
            'startpoint' => $this->input->post('startpoint'),
            'endpoint' => $this->input->post('endpoint'),
            'godate' => convert_to_unix($godate),
            'comebackdate' => convert_to_unix($comebackdate),
            'adt' =>$this->input->post('adt'),
            'chd' => $this->input->post('chd'),
            'inf' => $this->input->post('inf'),
            'type' => $this->input->post('type'),
            'price' => $this->input->post('price'),
            'carrier' => $this->input->post('carrier'),
            'status' => $this->input->post('status'),
            'cheapflight_index' => $this->input->post('cheapflight_index')
        );
        $this->db->insert('pt_cheapflight', $data);
    }

//udpate Special Offer
    function update_cheap_flight($id)
    {
        $godate = $this->input->post('godate');
        $comebackdate = $this->input->post('comebackdate');

        $data = array(
            'title' => $this->input->post('title'),
            'startpoint' => $this->input->post('startpoint'),
            'endpoint' => $this->input->post('endpoint'),
            'godate' => convert_to_unix($godate),
            'comebackdate' => convert_to_unix($comebackdate),
            'adt' =>$this->input->post('adt'),
            'chd' => $this->input->post('chd'),
            'inf' => $this->input->post('inf'),
            'type' => $this->input->post('type'),
            'price' => $this->input->post('price'),
            'carrier' => $this->input->post('carrier'),
            'status' => $this->input->post('status'),
            'cheapflight_index' => $this->input->post('cheapflight_index')
        );
        $this->db->where('cheapflight_id', $id);
        $this->db->update('pt_cheapflight', $data);
    }

    // Delete CheapFlight
    function deleteCheapFlight($id){
        $this->db->where('cheapflight_id',$id);
        $this->db->delete('pt_cheapflight');

    }


}