<?php
class Rules extends CI_Controller{
    public $image_path = 'assets/uploaded_images/';

    public function index(){
        redirect('rules/show_rules');
    }

    public function show_rules(){
        if($this->session->userdata('logged_in') == TRUE){
            $strings_json = $this->language_model->get_lang_strings_rules();

            $data['path_json'] = json_encode($this->image_path);
            $data['strings_json'] = $strings_json;
            $data['rules_json'] = $this->get_rules();

            $head['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $this->load->view('header', $head);
            $this->load->view('show_rules', $data);

        } else {
            redirect('users/login');
        }
    }



    public function get_rules(){
        $result = $this->rule_model->get_rules();
        return $result;
    }
}