<?php
class Notifications extends CI_Controller{
      public function index(){
            $this->send_push();
      }

      public function send_push(){
            if($this->session->userdata['logged_in'] == TRUE){
                  $strings_json = $this->language_model->get_lang_strings_notifications();   
                  $strings = json_decode($strings_json);
                  $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
                  $data['user_types_json'] = $this->user_model->get_user_types();
                  $data['strings_json'] = $strings_json; 

                  $user_types = json_decode($data['user_types_json']);

                  $this->form_validation->set_rules('title', 'Title', 'required', array('required' => $strings->error_title_required)); // custom error message missing
                  $this->form_validation->set_rules('message', 'Message', 'required', array('required' => $strings->error_message_required));// custom error message missing

                  if(!$this->form_validation->run()){
                        $this->load->view('header', $header);
                        $this->load->view('send_push', $data);
                  } else {
                        $title = $this->input->post('title');
                        $body = $this->input->post('message');
                        $result = false;

                        foreach ($user_types as $type){
                              $input_name = 'check'.$type->id;
                              if($type->id == 1 || $this->input->post($input_name) != null){                     
                                    $this->notifications_model->push_message_to_topic($type->type_name, $title, $body);
                                    $result = true;
                              }
                        }

                        if($result){
                              //set flashdata
                              $this->session->set_flashdata('send_success', $strings->send_success);
                              redirect('notifications/send_push');
                        } else {
                              //set flashdata
                              $this->session->set_flashdata('send_error', $strings->send_error);
                              redirect('notifications/send_push');
                        }
                  }
                  
              } else {
                  redirect('users/login');
              }
      }
}