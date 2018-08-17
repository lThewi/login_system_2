<?php

class Api extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        //header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Credentials: true');
        //header('Access-Control-Allow-headers: content-type, if-none-match');
        //header('Access-Control-Allow--Methods: POST,GET,OPTIONS');
        //header('Access-Control-Max-Age: 3600');
        //header('Content-Type: text/json, application/x-www-form-urlencoded');
    }

    public function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = json_decode($this->user_model->login($email, $password));

        if($query == 'wrong password') {
            $result = array(
                'logged_in' => false,
                'password' => false
            );
            echo json_encode($result);
        } else if(!$query) {
            $result = array(
                'logged_in' => false,
                'email' => false
            );
            echo json_encode($result);
        } else {
            $user_data = array(
                'user_id' => $query->id,
                'mail' => $email,
                'name' => $query->name,
                'lastname' => $query->lastname,
                'user_type' => $query->acc_type_id,
                'logged_in' => TRUE
            );
            echo json_encode($user_data);
        }
    }

    public function get_news_items(){
        $current_id = json_decode($_POST['current_id']);
        $query = $this->news_model->get_ten_news_items($current_id);

        echo $query;
    }

    public function new_device(){
        $token = $_POST['token'];
        $user_id = $_POST['user_id'];

        $result = $this->notifications_model->insert_device($token, $user_id);

        return $result;
    }

    public function test(){

        if(isset($_POST)) {
            $token = json_decode($this->input->post('token'));
            $message = json_encode($this->input->post('message'));
            $result = $this->notifications_model->push_message_to_all($token, $message);
            return json_encode($result);
        }

    }

    public function test_view(){
        $strings = $this->language_model->get_lang_strings_users();
        $strings_header = $this->language_model->get_lang_strings_navbar();
        $header['strings_json'] = $strings_header;
        $data['strings_json'] = $strings;
        $this->load->view('header', $header);
        $this->load->view('test_view', $data);
    }

}