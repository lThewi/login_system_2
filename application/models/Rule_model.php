<?php
class Rule_model extends CI_Model{
    public $image_path = 'assets/uploaded_images/';
    public function __construct()
    {
        $this->load->database();
    }

    public function add_rule($text, $icon){

        $db_array = array(
            'text' => $text,
            'icon' => $icon
        );

        $query = $this->db->insert('texte_de', $db_array);

        return json_encode($query);
    }

    public function get_rules(){
        $this->db->order_by('table_order', 'ASC');
        $result = $this->db->get('texte_de');
        return json_encode($result->result());
    }

    public function delete_rule($id){
        $this->db->where('id', $id);
        $data = $this->db->get('texte_de');
        $rule = $data->result();
        $this->delete_icon($rule[0]->icon);
        $this->db->where('id', $id);
        $query = $this->db->delete('texte_de');

        return json_encode($query);
    }

    public function delete_icon($name){
        if($name != 'default-image.jpg'){
            $path = $this->image_path.$name;
            unlink($path);
        }
    }

    public function add_icon($name){
        if(!$this->upload->do_upload($name)){
            $error = $this->upload->display_errors();
            $img_name ='default-image.jpg';
        } else {
            $data = $this->upload->data();
            $img_name = $this->upload->data('file_name');
            $this->session->set_flashdata('upload_success', $data);
        }
        return $img_name;
    }

    public function update_rule($id, $data){
        $this->db->where('id', $id);
        $query = $this->db->update('texte_de', $data);
        return json_encode($query);
    }
}