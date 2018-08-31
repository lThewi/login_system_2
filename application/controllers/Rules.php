<?php

class Rules extends CI_Controller{
    public $image_path = 'assets/uploaded_images/';

    public function index(){
        redirect('rules/show_rules');
    }

    public function show_rules(){
        if($this->session->userdata('logged_in') == TRUE){
            $strings_json = $this->language_model->get_lang_strings_rules();
            $strings = json_decode($strings_json);
            $data['path_json'] = json_encode($this->image_path);
            $data['strings_json'] = $strings_json;
            $data['rules_json'] = $this->get_rules();

            $head['strings_json'] = $this->language_model->get_lang_strings_navbar();
            
            //set rules
            $this->form_validation->set_rules('rule', 'Rule', 'required', array('required' => $strings->rule_field_required));

            if(!$this->form_validation->run()){
                $this->load->view('header', $head);
                $this->load->view('show_rules', $data);
            } else {
                $rule = $this->input->post('rule');
                $icon_name = $this->rule_model->add_icon('img');

                $result = json_decode($this->rule_model->add_rule($rule, $icon_name));
                if($result){
                    $this->update_rules_order();
                    $this->session->set_flashdata('create_rule', $strings->create_success);
                    redirect('rules/show_rules');
                } else {
                    $this->session->set_flashdata('create_rule', $strings->create_error);
                    redirect('rules/show_rules');
                }
            }
            

        } else {
            redirect('users/login');
        }
    }

    public function get_rules(){
        $result = $this->rule_model->get_rules();
        return $result;
    }

    public function delete_rule($id){
        $result = $this->rule_model->delete_rule($id);
        return $result;
    }

    public function update_rules_order(){
        if(isset($_POST['string'])){
            $order_array = json_decode($this->input->post('string'));
        } else {
            $result = json_decode($this->rule_model->get_rules());
            foreach($result as $item){
                $order_array[] = $item->id;
            }
        }
        $order = 10;
        foreach($order_array as $item){
            $db_array = array(
                'table_order' => $order
            );
            $result = $this->rule_model->update_rule($item, $db_array);
            $order += 10;
        }
    }
}