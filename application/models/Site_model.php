<?php
class Site_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_new_site($data){
        $result = $this->db->insert('sites', $data);
        return json_encode($result);
    }

    public function get_all_sites(){
        $result = $this->db->get('sites');
        return json_encode($result->result());
    }

    public function get_site_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('sites');
        return json_encode($result->result());
    }

    public function get_site_by_name($name){
        $this->db->where('name', $name);
        $result = $this->db->get('sites');
        return json_encode($result->result());
    }
}