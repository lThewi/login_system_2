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
        $this->db->order_by('table_order', 'ASC');
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

    public function modify_contactperson($con_id, $data){
        $this->db->where('id', $con_id);
        $result = $this->db->update('contact_persons', $data);
        return json_encode($result);
    }

    public function modify_category($cat_id, $data){
        $this->db->where('id', $cat_id);
        $result = $this->db->update('doc_categories', $data);
        return json_encode($result);
    }

    public function delete_document($doc_id){
        $this->db->where('id', $doc_id);
        $result = $this->db->delete('documents');
        return json_encode($result);
    }

    public function delete_contactperson($con_id){
        $this->db->where('id', $con_id);
        $result = $this->db->delete('contact_persons');
        return json_encode($result);
    }

    public function create_category($data){
        $result = $this->db->insert('doc_categories', $data);
        return json_encode($result);
    }

    public function delete_category($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('doc_categories');
        return json_encode($result);
    }

    public function create_contactperson($data){
        $result = $this->db->insert('contact_persons', $data);
        return json_encode($result);
    }

    public function get_all_contactpersons(){
        $this->db->order_by('table_order', 'ASC');
        $result = $this->db->get('contact_persons');
        return json_encode($result->result());
    }

    public function get_contact($id){
        $this->db->where('id', $id);
        $result = $this->db->get('contact_persons');
        return json_encode($result->result());
    }

    public function get_category_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('doc_categories');
        return json_encode($result->result());
    }
}