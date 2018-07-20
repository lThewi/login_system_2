<?php
class Page_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_new_page($data){
        $result = $this->db->insert('Pages', $data);
        return json_encode($result);
    }

    public function get_all_pages(){
        $this->db->order_by('table_order', 'ASC');
        $result = $this->db->get('Pages');
        return json_encode($result->result());
    }

    public function get_page_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('Pages');
        return json_encode($result->result());
    }

    public function get_page_by_name($name){
        $this->db->where('name', $name);
        $result = $this->db->get('Pages');
        return json_encode($result->result());
    }

    public function modify_page($id, $data){
        $this->db->where('id', $id);
        $result = $this->db->update('pages', $data);
        return json_encode($result);
    }

    public function delete_page($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('pages');
        return json_encode($result);
    }
}