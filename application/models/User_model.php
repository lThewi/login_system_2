<?php
    class User_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function register($enc_password){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'lastname' => $this->input->post('lastname'),
                'password' => $enc_password
            );
            echo $data;
            return $this->db->insert('users', $data);
        }

        public function add_temp_user(){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'lastname' => $this->input->post('lastname'),
                'password' => md5($this->input->post('password'))
            );
            $this->db->where('email', $this->input->post('email'));
            $is_already_registered = $this->db->get('users');
            if($is_already_registered->num_rows() > 0){
                return false;
            } else {
                return $this->db->insert('temp_users', $data);
            }
        }


        public function add_user($temp_id, $user_type){
            $this->db->where('id', $temp_id);
            $temp_user = $this->db->get('temp_users');

                if ($temp_user->num_rows() == 1) {

                    $row = $temp_user->row(0);
                    $data = array(
                        'email' => $row->email,
                        'password' => $row->password,
                        'name' => $row->name,
                        'lastname' => $row->lastname,
                        'acc_type_id' => $user_type
                    );

                    $did_add_user = $this->db->insert('users', $data);
                    if ($did_add_user) {
                        $this->db->where('id', $temp_id);
                        $this->db->delete('temp_users');
                        return true;
                    } else {
                        return false;
                    }

                }
        }

        public function login($mail, $password){
            $this->db->where('email', $mail);
            $user = $this->db->get('users');

            if($user->num_rows() == 1){
                if($user->row(0)->password == $password){
                    return $user->row(0);
                } else {
                    return 'wrong password' ;
                }
            } else {
                return false;
            }
        }

        public function get_user_types(){
            $result = $this->db->get('user_types');
            return $result->result();
        }

        public function get_all_temp_users(){
            $result = $this->db->get('temp_users');
            return $result->result();
        }

        public function get_temp_user($temp_id){
            $this->db->where('id', $temp_id);
            $result = $this->db->get('temp_users');
            return $result;
        }

        public function get_users(){
            $result = $this->db->get('users');
            return $result->result();
        }
    }