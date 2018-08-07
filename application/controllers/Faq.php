<?php

class Faq extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->show_faq();
    }

    public function show_faq(){
        if($this->session->userdata('logged_in') == TRUE ){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $data['faq_json'] = $this->Faq_model->get_all_questions();
            $strings_json = $this->language_model->get_lang_strings_faq();
            $data['strings_json'] = $strings_json;

            $this->load->view('header',$header);
            $this->load->view('faq/show_faq', $data);
        } else {
            redirect('users/login');
        }
    }

    public function modify_faq($id){
        if($this->session->userdata('logged_in') == TRUE ){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $data['faq_json'] = $this->Faq_model->get_question_by_id($id);
            $strings_json = $this->language_model->get_lang_strings_faq();
            $data['strings_json'] = $strings_json;

            $this->load->view('header', $header);
            $this->load->view('faq/modify_faq', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_faq(){
        if($this->session->userdata('logged_in') == TRUE ){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $strings_json = $this->language_model->get_lang_strings_faq();
            $data['strings_json'] = $strings_json;


            $strings = json_decode($strings_json);

            $this->form_validation->set_rules('question', 'Question', 'required', array('required' => $strings->faq_rules_question));
            $this->form_validation->set_rules('content', 'Content', 'required', array('required' => $strings->faq_rules_answer));

            if($this->form_validation->run() === FALSE) {
                $this->load->view('header', $header);
                $this->load->view('faq/create_faq', $data);
            } else {
                $db_array = array(
                    'question' => $this->input->post('question'),
                    'answer' => $this->input->post('content'),
                );

                $result = $this->Faq_model->create_faq($db_array);
                if($result){
                    $this->session->set_flashdata('faq_created', $strings->faq_created);
                    redirect('faq/show_faq');
                } else {
                    $this->session->set_flashdata('faq_error', $strings->faq_create_error);
                    redirect('faq/create_faq');
                }
            }


        } else {
            redirect('users/login');
        }
    }

    public function create_new_faq(){
        $strings = json_decode($this->language_model->get_lang_strings_faq());

        $this->form_validation->set_rules('question', 'Question', 'required', array('required' => $strings->faq_rules_question));
        $this->form_validation->set_rules('content', 'Content', 'required', array('required' => $strings->faq_rules_answer));

        if($this->form_validation->run()){
            $db_array = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('content'),
            );

            $result = $this->Faq_model->create_faq($db_array);
            if($result){
                $this->session->set_flashdata('faq_created', $strings->faq_created);
                redirect('faq/show_faq');
            } else {
                $this->session->set_flashdata('faq_error', $strings->faq_create_error);
                redirect('faq/create_faq');
            }
        }
    }

    public function delete_faq($id){
        $result = $this->Faq_model->delete_faq($id);

        if($result){
            $this->session->set_flashdata('');
            redirect('faq/show_faq');
        } else {
            $this->session->set_flashdata('');
            redirect('faq/show_faq');
        }
    }

    public function mod_faq(){
        $strings = json_decode($this->language_model->get_lang_strings_faq());

        $db_array = array(
            'question' => $this->input->post('question'),
            'answer' => $this->input->post('content')
        );
        if($db_array['answer'] == ''){
            $db_array['answer'] = '<p>...</p>';
        }

        $id = $this->input->post('id');

        $result = $this->Faq_model->update_faq($id, $db_array);

        if($result){
            $this->session->set_userdata('faq_updated', $strings->faq_modified);
            redirect('faq/show_faq');
        } else {
            $this->session->set_userdata('faq_update_error', $strings->faq_modify_error);
            redirect('faq/modify_faq/'.$id);
        }
    }
}