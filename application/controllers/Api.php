<?php

class Api extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-headers: content-type, if-none-match');
        header('Access-Control-Allow--Methods: POST,GET,OPTIONS');
        header('Access-Control-Max-Age: 3600');
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
                'user_type_id' => $query->acc_type_id,
                'user_type' => $query->type_name,
                'logged_in' => TRUE
            );
            echo json_encode($user_data);
        }
    }

    public function get_news_items(){
        $current_id = $_POST['current_id'];
        $auth = $_POST['user_type_id'];
        $query = $this->news_model->get_ten_news_items($current_id, $auth);

        echo $query;
    }

    public function new_device(){
        $token = $_POST['token'];
        $user_id = $_POST['user_id'];

        $result = $this->notifications_model->insert_device($token, $user_id);

        return $result;
    }

    public function get_all_survey_questions(){
        $auth = $_POST['user_type_id'];
        echo $this->survey_model->get_survey_questions_by_auth($auth);
    }

    public function get_survey_answers_by_qid(){
        if(isset($_POST)){
            $qid = json_decode($_POST['question_id']);
            echo $this->survey_model->get_answers_by_qid($qid);
        }
    }

    public function push_result(){
        if(isset($_POST)){
            $value = json_decode($_POST['value']);
            $question_id = json_decode($_POST['question_id']);
            $answer_id = json_decode($_POST['answer_id']);
            $user_id = json_decode($_POST['user_id']);

            echo $this->survey_model->push_value_to_db($question_id, $answer_id, $value, $user_id);
        }
    }

    public function get_golden_rules(){
        echo $this->rule_model->get_rules();
    }

    public function get_report_contact(){
        echo $this->gefahrenmeldungs_model->get_contacts();
    }

    public function get_document_categories(){
        echo $this->document_model->get_categories();
    }

    public function get_documents(){
        echo $this->document_model->get_all_documents();
    }

    public function get_document_by_id(){
        $id = $_POST['doc_id'];
        echo $this->document_model->get_document($id);
    }

    public function get_faq(){
        echo $this->Faq_model->get_all_questions();
    }

    public function get_contact_persons(){
        echo $this->document_model->get_all_contactpersons();
    }
}