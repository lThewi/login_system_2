<?php
class Faq_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_faq($data){
        $result = $this->db->insert('faq', $data);
        return json_encode($result);
    }

    public function get_all_questions(){
        $result = $this->db->get('faq');
        return json_encode($result->result());
    }

    public function get_question_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('faq');
        return json_encode($result->result());
    }

    public function delete_faq($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('faq');
        return json_encode($result);
    }

    public function update_faq($id, $data){
        $this->db->where('id', $id);
        $result = $this->db->update('faq', $data);
        return json_encode($result);
    }
}