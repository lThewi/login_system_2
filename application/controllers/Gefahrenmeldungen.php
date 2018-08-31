<?php

class Gefahrenmeldungen extends CI_Controller{
      public function index(){
            $this->contact();
      }

      public function contact($id = ''){
            if($this->session->userdata('logged_in') == true){
                  //get and set data
                  $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
                  $data['strings_json'] = $this->language_model->get_lang_strings_gefahrenmeldung();
                  $data['contacts_json'] = $this->gefahrenmeldungs_model->get_contacts();
                  $data['contact_json'] = null;

                  $strings = json_decode($data['strings_json']);
                  $data['form_func'] = 'gefahrenmeldungen/contact';

                  if($id != ''){
                        $data['form_func'] = 'gefahrenmeldungen/update_contact';
                        $data['contact_json'] = $this->gefahrenmeldungs_model->get_contact_by_id($id);
                  }

                  //set rules
                  $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[gefahren_kontakte.email]', array('required' => $strings->email_required, 'is_unique' => $strings->email_not_unique));
                  $this->form_validation->set_rules('tel', 'Tel', 'trim|required', array('required' => $strings->tel_required));

                  //if run=false load views
                  if(!$this->form_validation->run()){
                        $this->load->view('header', $header);
                        $this->load->view('gefahrenmeldungen/contact', $data);
                  } else {
                        $email = $this->input->post('email');
                        $tel = $this->input->post('tel');

                        $result = $this->gefahrenmeldungs_model->add_contact($email, $tel);

                        if($result == 'true'){
                              $this->session->set_flashdata('contact', $strings->create_success);
                              redirect('gefahrenmeldungen/contact');
                        } else {
                              $this->session->set_flashdata('contact', $strings->create_error);
                              redirect('gefahrenmeldungen/contact');
                        }
                  }

                  
            } else {
                  redirect('users/login');
            }
      }

      public function update_contact(){
            $strings = json_decode($this->language_model->get_lang_strings_gefahrenmeldung());
            $email = $this->input->post('email');
            $tel = $this->input->post('tel');
            $id = $this->input->post('id');

            $result = $this->gefahrenmeldungs_model->update_contact($id, $email, $tel);

            if($result){
                  $this->session->set_flashdata('updated_contact', $strings->update_success);
                  redirect('gefahrenmeldungen/contact');
            } else {
                  $this->session->set_flashdata('updated_contact', $strings->update_error);
                  redirect('gefahrenmeldungen/contact');
            }
      }

      public function delete_contact($id){
            $result = $this->gefahrenmeldungs_model->delete_contact($id);
            return json_encode($result);
      }
}