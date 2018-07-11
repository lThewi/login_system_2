<?php
class Document_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function create_document($data){
        $result = $this->db->insert('documents');
        return json_encode($result->result());
    }

    public function get_categories(){
        $result = $this->db->get('doc_categories');
        return json_encode($result->result());
    }
}