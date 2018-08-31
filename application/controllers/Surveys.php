<?php
class Surveys extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->show_surveys();
    }

    public function show_surveys(){
        if($this->session->userdata('logged_in') == TRUE){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $data['strings_json'] = $this->language_model->get_lang_strings_surveys();
            $data['survey_questions_json'] = $this->survey_model->get_survey_questions();
            $data['survey_answers_json'] = $this->survey_model->get_survey_answers();
            $data['survey_auth_json'] = $this->survey_model->get_all_auths();


            $this->load->view('header', $header);
            $this->load->view('surveys/show_surveys', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_survey(){
        if($this->session->userdata('logged_in') == TRUE){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $lang = $this->language_model->get_lang_strings_surveys();
            $data['strings_json'] = $lang;

            $data['user_types_json'] = $this->user_model->get_user_types();

            //set form validation rules
            $this->form_validation->set_rules('question','Question','trim');


            if(!$this->form_validation->run()){
                $this->load->view('header', $header);
                $this->load->view('surveys/create_survey', $data);
            } else {
                if($this->input->post('question') != null){
                    $result = json_decode($this->survey_model->create_new_mc_survey());
                    if($result){
                        $this->session->set_flashdata('survey_created', $lang->survey_created);
                        redirect('surveys/show_surveys');
                    } else {
                        redirect('surveys/create_survey');
                    }
                } else {
                    $result = json_decode($this->survey_model->create_new_r_survey());
                    if($result){
                        redirect('surveys/show_surveys');
                    } else {
                        redirect('surveys/create_survey');
                    }
                }
                $this->update_survey_order();
            }
        } else {
            redirect('users/login');
        }
    }

    public function show_result($qid){
        if($this->session->userdata('logged_in') == TRUE) {
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $data['strings_json'] = $this->language_model->get_lang_strings_surveys();

            $data['results_json'] = $this->survey_model->get_results_by_qid($qid);
            $data['question_json'] = $this->survey_model->get_question_by_qid($qid);
            $data['answers_json'] = $this->survey_model->get_answers_by_qid($qid);

            $this->load->view('header', $header);
            $this->load->view('surveys/show_result', $data);
        } else {
            redirect('users/login');
        }
    }

    public function get_results_by_qid(){
        $qid = $this->input->post('question_id');
        echo $this->survey_model->get_results_by_qid($qid);
    }

    public function get_answers_by_qid(){
        $qid = $this->input->post('question_id');
        echo $this->survey_model->get_answers_by_qid($qid);
    }

    public function get_question_by_qid(){
        $qid = $this->input->post('question_id');
        echo $this->survey_model->get_question_by_qid($qid);
    }

    public function get_sums_by_answers(){
        $answers = $this->input->post('answers');
        $type = $this->input->post('type');
        if($type == '1'){
            echo $this->survey_model->get_all_survey_results_by_answers($answers);
        } else {
            echo $this->survey_model->get_avg_by_anwser($answers);
        }        
    }

    public function update_survey_order(){
        if(isset($_POST['string'])){
            $order_array = json_decode($this->input->post('string'));
        } else {
            $result = json_decode($this->survey_model->get_survey_questions());
            foreach($result as $item){
                $order_array[] = $item->id;
            }
        }
        $order = 10;
        foreach($order_array as $item){
            $db_array = array(
                'table_order' => $order
            );
            $result = $this->survey_model->update_survey_question($item, $db_array);
            $order += 10;
        }
    }
}