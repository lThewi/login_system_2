<?php
class Survey_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_new_mc_survey(){
        $data['user_types_json'] = $this->user_model->get_user_types();
        $strings = json_decode($this->language_model->get_lang_strings_surveys());

        $question = $this->input->post('question');
        $answer_counter = intval($this->input->post('counter'));

        //upload image
        $img_name = $this->upload_image('img');

        //insert question to db
        $questions_array = array(
            'question' => $question,
            'survey_type' => 1, //multiple choice
            'image' => $img_name
        );
        $query_question = $this->db->insert('survey_questions', $questions_array);
        $question_id = json_decode($this->get_latest_question_id());

        //iterate over all answers and insert each into the database
        for($idx = 1; $idx <= $answer_counter; $idx++){
            $field_name = 'answer'.$idx;
            $answer = $this->input->post($field_name);
            $answer_array = array(
                'answer' => $answer,
                'question_id' => $question_id[0]->id
            );
            $query_answer = $this->db->insert('survey_answers', $answer_array);
            if(!$query_answer){
                return false;
            }
        }

        //adding usertypes to auth table
        $user_types = json_decode($data['user_types_json']);
        $title = $strings->push_title;
        $body = $question;
        foreach ($user_types as $type){
            $input_name = 'check'.$type->id;
            if($type->id == 1 || $this->input->post($input_name) != null){
                $this->survey_model->add_auth($question_id[0]->id,$type->id);
                if($this->input->post('push') == 'on'){
                    $this->notifications_model->push_message_to_topic($type->type_name, $title, $body);
                }
            }
        }
        //return true or false to controller
        return $query_question;
    }

    public function create_new_r_survey(){
        $data['user_types_json'] = $this->user_model->get_user_types();
        $strings = json_decode($this->language_model->get_lang_strings_surveys());

        $question = $this->input->post('questionRating');

        //upload image
        $img_name = $this->upload_image('img-rating');

        //insert question to db
        $questions_array = array(
            'question' => $question,
            'survey_type' => 2, //rating
            'image' => $img_name
        );
        $query_question = $this->db->insert('survey_questions', $questions_array);
        $question_id = json_decode($this->get_latest_question_id());

        $answer_array = array(
            'answer' => 'Rating',
            'question_id' => $question_id[0]->id
        );
        $query_answer = $this->db->insert('survey_answers', $answer_array);


        //adding usertypes to auth table
        $user_types = json_decode($data['user_types_json']);
        $title = $strings->push_title;
        $body = $question;
        foreach ($user_types as $type){
            $input_name = 'check-rating'.$type->id;
            if($type->id == 1 || $this->input->post($input_name) != null){
                $this->survey_model->add_auth($question_id[0]->id,$type->id);
                if($this->input->post('push-rating') == 'on'){
                    $this->notifications_model->push_message_to_topic($type->type_name, $title, $body);
                }
            }
        }
        //return true or false to controller
        return $query_question;
    }

    public function get_latest_question_id(){
        $this->db->order_by('id', 'DESC');
        $this->db->select('id');
        $query = $this->db->get('survey_questions',0,1);

        return json_encode($query->result());
    }

    public function upload_image($name){
        $this->load->library('upload');
        if(!$this->upload->do_upload($name)){
            $error = $this->upload->display_errors();
            $img_name = null;
        } else {
            $data = $this->upload->data();
            $img_name = $this->upload->data('file_name');
            $this->session->set_flashdata('upload_success', $data);
        }
        return $img_name;
    }

    public function add_auth($question_id, $auth_id){
        $data = array(
            'question_id' => $question_id,
            'user_type_id' => $auth_id
        );
        $query = $this->db->insert('survey_auth', $data);
        return json_encode($query);
    }

    public function get_all_auths(){
        $this->db->select('survey_auth.id, survey_auth.question_id, survey_auth.user_type_id, COUNT(users.acc_type_id) as participants');
        $this->db->join('users', 'survey_auth.user_type_id = users.acc_type_id', 'left outer');
        $this->db->group_by('survey_auth.question_id');
        $query = $this->db->get('survey_auth');

        return json_encode($query->result());
    }

    public function get_auths($question_id){
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('survey_auth');

        return json_encode($query->result());
    }

    public function get_survey_questions(){
        $this->db->select('survey_questions.id,survey_questions.question, survey_questions.time_created, survey_questions.survey_type, survey_questions.image, COUNT(survey_results.question_id) as votes');
        $this->db->join('survey_results', 'survey_questions.id = survey_results.question_id', 'left outer');
        $this->db->group_by('survey_questions.id');
        $query = $this->db->get('survey_questions');
        //--> aktuell fehlerhafte daten, da user in der App noch mehrfach abstimmen können (zu testzwecken).        
        return json_encode($query->result());
    }

    public function get_survey_answers(){
        $query = $this->db->get('survey_answers');

        return json_encode($query->result());
    }

    public function get_survey_results(){
        $query = $this->db->get('survey_results');

        return json_encode($query->result());
    }

    public function get_question_by_qid($qid){
        $this->db->where('id', $qid);
        $query = $this->db->get('survey_questions');

        return json_encode($query->result());
    }

    public function get_answers_by_qid($qid){
        $this->db->where('question_id', $qid);
        $query = $this->db->get('survey_answers');

        return json_encode($query->result());
    }

    public function get_results_by_qid($qid){
        $this->db->where('question_id', $qid);
        $query = $this->db->get('survey_results');

        return json_encode($query->result());
    }

    public function push_value_to_db($question_id, $answer_id, $value, $user_id){
        $array = array(
            'user_id' => $user_id,
            'question_id' => $question_id,
            'answer_id' => $answer_id,
            'value' => $value
        );
        $this->db->where('user_id', $user_id);
        $this->db->where('question_id', $question_id);
        $check_query = $this->db->get('survey_results');
        if($check_query->num_rows() == 0){
            $query = $this->db->insert('survey_results', $array);
            return json_encode($query);
        } else {
            return json_encode(false);
        }
    }

    public function get_result_sum($answer_id){
        $this->db->select_sum('value');
        $this->db->where('answer_id', $answer_id);
        $query = $this->db->get('survey_results');
        return json_encode($query->result());
    }

    public function get_avg_result($answer_id){
        $this->db->select_avg('value');
        $this->db->where('answer_id', $answer_id);
        $query = $this->db->get('survey_results');
        return json_encode($query->result());
    }

    public function get_all_survey_results_by_answers($answers_array_json){
        $answers_array = json_decode($answers_array_json);
        $result_array;
        foreach($answers_array as $answer){
            $sum = json_decode($this->get_result_sum($answer->id));
            $result_array[] = array(
                'answer_id' => $answer->id,
                'sum' => $sum[0]->value
            );
        }
        return json_encode($result_array);
    }

    public function get_avg_by_anwser($answers_json){
        $answers = json_decode($answers_json);
        $result_array;
        foreach($answers as $answer){
            $avg = json_decode($this->get_avg_result($answer->id));
            $result_array = array(
                'answer_id' => $answer->id,
                'avg' => $avg[0]->value
            );
        }
        return json_encode($result_array);
    }

    public function delete_survey($question_id){
        //delete question
        $this->db->where('id', $question_id);
        $query_question = $this->db->delete('survey_questions');
        if($query_question){
            //delete answers
            $this->db->where('question_id', $question_id);
            $query_answers = $this->db->delete('survey_answers');
            if($query_answers){
                //delete results
                $this->db->where('question_id', $question_id);
                $query_results = $this->db->delete('survey_results');
                if($query_results){
                    //delete auths
                    $this->db->where('question_id', $question_id);
                    $query_auths = $this->db->delete('survey_auth');
                    if($query_auths){
                        return json_encode($query_auths);
                    } else {
                        return json_encode(false);
                    }
                } else {
                    return json_encode(false);
                }
            } else {
                return json_encode(false);
            }
        } else {
            return json_encode(false);
        }
    }
}