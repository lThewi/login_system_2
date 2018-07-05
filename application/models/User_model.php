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
            /**
             * TODO: prüfen ob email bereits vergeben
             */
            echo $data;
            return $this->db->insert('users', $data);
        }

        public function add_temp_user($key, $password){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'lastname' => $this->input->post('lastname'),
                'password' => $password,
                'validation_key' => $key
            );
            $this->db->where('email', $this->input->post('email'));
            $is_already_registered = $this->db->get('users');
            if($is_already_registered->num_rows() > 0){
                return false;
            } else {
                return $this->db->insert('temp_users', $data);
            }
        }

        public function add_user($token){
            $temp_user = $this->db->get('temp_users');

            for ($idx = 0; $temp_user->num_rows(); $idx++) {
                $validation_key = md5($temp_user->row($idx)->validation_key . md5($temp_user->row($idx)->email));
                if ($validation_key == $token) {

                    $row = $temp_user->row($idx);
                    $data = array(
                        'email' => $row->email,
                        'password' => $row->password,
                        'name' => $row->name,
                        'lastname' => $row->lastname
                    );

                    $did_add_user = $this->db->insert('users', $data);
                    if ($did_add_user) {
                        $this->db->where('email', $temp_user->row($idx)->email);
                        $this->db->delete('temp_users');
                        $this->db->where('email', $row->email);
                        $user_id = $this->db->get('users');
                        //pw wird mit zurück gegeben -> muss geändert werden
                        return $data;
                    } else {
                        return false;
                    }
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
    }