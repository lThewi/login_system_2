<?php
class News_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_news($data){
        $result = $this->db->insert('news', $data);
        return json_encode($result);
    }

    public function get_all_news(){
        $this->db->order_by('table_order', 'ASC');
        $result = $this->db->get('news');
        return json_encode($result->result());
    }

    public function get_news_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('news');
        return json_encode($result->result());
    }

    public function get_all_categories(){
        $result = $this->db->get('news_categories');
        return json_encode($result->result());
    }

    public function update_news($id, $data){
        $this->db->where('id', $id);
        $result = $this->db->update('news', $data);
        return json_encode($result);
    }

    public function delete_news($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('news');
        return json_encode($result);
    }

    public function get_ten_news_items($current_id){
        $result = $this->db->get('news', $current_id+10, $current_id);
        return json_encode($result->result());
    }
}