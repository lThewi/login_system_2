<?php
class Document_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function create_document($data){
        $result = $this->db->insert('documents', $data);
        return json_encode($result);
    }

    public function get_categories(){
        $result = $this->db->get('doc_categories');
        return json_encode($result->result());
    }

    public function get_all_documents(){
        $result = $this->db->get('documents');
        return json_encode($result->result());
    }

    public function get_document($doc_id){
        $this->db->where('id', $doc_id);
        $result = $this->db->get('documents');
        return json_encode($result->result());
    }

    public function modify_document($doc_id, $data){
        $this->db->where('id', $doc_id);
        $result = $this->db->update('documents', $data);
        return json_encode($result);
    }
}