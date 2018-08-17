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
            $this->db->insert('users', $data);
            $this->db->where('email', $this->input->post('email'));
            $result = $this->db->get('users');
            return json_encode($result->result());
        }

        public function add_temp_user(){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'lastname' => $this->input->post('lastname'),
                'password' => md5($this->input->post('password')),
                'register_date' => date('Y-m-d')
            );
            $this->db->where('email', $this->input->post('email'));
            $is_already_registered = $this->db->get('users');
            if($is_already_registered->num_rows() > 0){
                return false;
            } else {
                $this->db->insert('temp_users', $data);
                $this->db->where('email', $this->input->post('email'));
                $result = $this->db->get('temp_users');
                return json_encode($result->result());
            }
        }

        public function delete_active_user($id){
            $this->db->where('id', $id);
            $result = $this->db->delete('users');
            return json_encode($result);
        }

        public function add_user_to_declined($data){
            $result = $this->db->insert('temp_users',$data);
            return json_encode($result);
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
                        'acc_type_id' => $user_type,
                        'register_date' => $row->register_date,
                        'last_login' => $row->last_login,
                    );

                    $did_add_user = $this->db->insert('users', $data);
                    if ($did_add_user) {
                        $this->db->where('id', $temp_id);
                        $this->db->delete('temp_users');

                        $this->db->where('email', $row->email);
                        $result = $this->db->get('users');
                        return json_encode($result->result());
                    } else {
                        return false;
                    }

                }
        }

        public function login($email, $password){
            $this->db->where('email', $email);
            $user_data = $this->db->get('users');

            if($user_data->num_rows() == 1) {
                if ($user_data->row(0)->password == $password) {
                    $user = $user_data->row(0);
                    //update lastlogin
                    $db_array = array(
                        'last_login' => date('Y-m-d')
                    );
                    $user_update = $this->update_user($user->id, $db_array);

                    return json_encode($user);
                } else {
                    return json_encode('wrong password');
                }
            } else {
                //TODO: update login for temp_user, change temp_user table, update user controller login function
                return false;
            }
        }

        public function get_user_types(){
            $result = $this->db->get('user_types');
            return json_encode($result->result());
        }

        public function get_all_temp_users(){
            $this->db->order_by('table_order', 'ASC');
            $result = $this->db->get('temp_users');
            return json_encode($result->result());
        }

        public function get_temp_user($temp_id){
            $this->db->where('id', $temp_id);
            $result = $this->db->get('temp_users');
            return json_encode($result->result());
        }

        public function get_users(){
            $this->db->order_by('table_order', 'ASC');
            $result = $this->db->get('users');
            return json_encode($result->result());
        }
        public function get_user($id){
            $this->db->where('id', $id);
            $result = $this->db->get('users');
            return json_encode($result->result());
        }

        public function update_user($id, $data){
            $this->db->where('id', $id);
            $result = $this->db->update('users', $data);
            return json_encode($result);
        }

        public function get_temp_user_email($id){
            $this->db->select('email');
            $this->db->where('id', $id);
            $result = $this->db->get('temp_users');
            return json_encode($result->result());
        }

        public function update_temp_user($id, $data){
            $this->db->where('id', $id);
            $result = $this->db->update('temp_users', $data);
            return $result;
        }

        public function get_user_by_email($email){
            $this->db->where('email', $email);
            $result = $this->db->get('users');
            return json_encode($result->result());
        }
    }