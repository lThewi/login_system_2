<?php
class Rule_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_rules(){
        $result = $this->db->get('texte_de');
        return json_encode($result->result());
    }
}