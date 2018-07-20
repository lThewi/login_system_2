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
            $data['faq_json'] = $this->Faq_model->get_all_questions();

            $this->load->view('header');
            $this->load->view('faq/show_faq', $data);
        } else {
            redirect('users/login');
        }
    }

    public function modify_faq($id){
        if($this->session->userdata('logged_in') == TRUE ){
            $data['faq_json'] = $this->Faq_model->get_question_by_id($id);

            $this->load->view('header');
            $this->load->view('faq/modify_faq', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_faq(){
        if($this->session->userdata('logged_in') == TRUE ){
            $this->load->view('header');
            $this->load->view('faq/create_faq');
        } else {
            redirect('users/login');
        }
    }

    public function create_new_faq(){
        $this->form_validation->set_rules('question', 'Question', 'required', array('required' => 'Sie müssen eine Frage angeben.'));
        $this->form_validation->set_rules('content', 'Content', 'required', array('required' => 'Sie müssen eine Antwort angeben.'));

        if($this->form_validation->run()){
            $db_array = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('content'),
            );

            $result = $this->Faq_model->create_faq($db_array);
            if($result){
                $this->session->set_flashdata('faq_created', 'Die Frage wurde erfolgreich erstellt.');
                redirect('faq/show_faq');
            } else {
                $this->session->set_flashdata('faq_error', 'Beim Eintragen in die Datenbank ist ein Fehler aufgetreten.');
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
            $this->session->set_userdata('faq_updated', 'Die Frage wurde erfolgreich bearbeitet.');
            redirect('faq/show_faq');
        } else {
            $this->session->set_userdata('faq_update_error', 'Beim Speichern der Änderungen ist ein Fehler aufgetreten.');
            redirect('faq/modify_faq/'.$id);
        }
    }
}