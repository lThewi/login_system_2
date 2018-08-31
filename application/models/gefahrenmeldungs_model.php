<?php

class Gefahrenmeldungs_model extends CI_Model{
      public function __construct()
      {
            $this->load->database();
      }

      public function add_contact($email, $tel){
            //check if there already is contactdata
            $query = $this->db->get('gefahren_kontakte');
            if($query->num_rows() == 0){
                  $data = array(
                        'email' => $email,
                        'tel' => $tel
                  );
                  $query = $this->db->insert('gefahren_kontakte', $data);
                  return json_encode($query);
            } else {
                  return json_encode(false);
            }
      }

      public function get_contacts(){
            $query = $this->db->get('gefahren_kontakte');
            return json_encode($query->result());
      }

      public function get_contact_by_id($id){
            $this->db->where('id', $id);
            $query = $this->db->get('gefahren_kontakte');
            return json_encode($query->result());
      }

      public function update_contact($id, $email, $tel){
            $data = array(
                  'email' => $email,
                  'tel' => $tel
            );
            $this->db->where('id', $id);
            $query = $this->db->update('gefahren_kontakte', $data);

            return json_encode($query);
      }

      public function delete_contact($id){
            $this->db->where('id', $id);
            $query = $this->db->delete('gefahren_kontakte');

            return json_encode($query);
      }
}