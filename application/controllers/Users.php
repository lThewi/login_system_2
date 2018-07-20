<?php
    class Users extends CI_Controller{


        function index(){
            $this->load->view('login');
        }

        /**
         * validating the form data, register a user, adding the data to the temp_user table and sending the validation mail
         */
        public function register(){
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]|trim');

            $this->form_validation->set_message('is_unique', 'That email is already used');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('register');
            } else {
                $enc_password = md5($this->input->post('password'));
                $mail = $this->input->post('email');
                $name = $this->input->post('name');
                $lastname = $this->input->post('lastname');
                $data['name'] = $name;
                $data['lastname'] = $lastname;

                $admin_mail = 'yyy';
                $lang_strings = json_decode($this->language_model->get_lang_strings_email());

                //preparing the mailcontent
                $this->email->from('vftestadresse@gmail.com', 'MyName');
                $this->email->to($mail);
                $this->email->subject($lang_strings->email_register_subject);
                $message = $lang_strings->email_register_body;


                $this->email->message($message);
                //adding user to temp_user table and sending the mail
                $temp_user = $this->user_model->add_temp_user();
                if($temp_user != FALSE){
                    if($this->email->send(FALSE)){
                        $this->email->to($admin_mail);
                        $this->email->send();
                        //redirect to login screen and posting data of the temp_user
                        $data['json_data'] = $temp_user;
                        redirect('users/login', $data);
                    } else {
                        redirect('users/register');
                    }
                } else {
                    echo 'Problem adding user to database';
                }
            }
        }

        public function add_multiple_users(){
            //loop over all rows and add them to the DB (with add_user)
            if($this->input->post('row')){
                $array_idx = 0;
                foreach($this->input->post('row') as $row => $value){
                    $type = $this->input->post($value);
                    $user = $this->user_model->add_user($value, $type);
                    $results[$array_idx] = $user;
                    $array_idx++;
                }
                $data['added_users'] = $results;
                //refresh page
                redirect('users/users_view', $data);
            };
            redirect('users/users_view');
        }

        public function login(){
            $this->form_validation->set_rules('mail', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->load->view('login');

            if($this->form_validation->run()){
                $mail = $_POST['mail'];
                $password = md5($_POST['password']);
                $user_data = $this->user_model->login($mail, $password);
                $user = json_decode($user_data);
                if ($user) {
                    if($user == 'wrong password'){
                        $this->session->set_flashdata('wrong_password', 'Das angegebene Passwort ist falsch.');
                        redirect('users/login', 'refresh');
                    } else {
                        $user_data = array(
                            'user_id' => $user->id,
                            'mail' => $mail,
                            'name' => $user->name,
                            'lastname' => $user->lastname,
                            'user_type' => $user->acc_type_id,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($user_data);
                        switch($user->acc_type_id){
                            case 1:
                                redirect('users/users_view');
                                break;
                            case 2:
                                redirect('users/home');
                                break;
                        }
                    }
                } else {
                    $this->session->set_flashdata('wrong_email', 'Die angegebene Email ist falsch.');
                    redirect('users/login', 'refresh');
                }
            }
        }

        public function logout(){
            $this->session->sess_destroy();
            redirect('users/login');
        }

        public function home(){
            if($this->session->userdata('logged_in') === TRUE){
                $this->load->view('home');
            } else {
                redirect('users/login');
            }
        }

        public function users_view(){
            if($this->session->userdata('logged_in') === TRUE){
                if($this->session->userdata('user_type') === '1'){
                    $temp_users = $this->user_model->get_all_temp_users();
                    $user_types = $this->user_model->get_user_types();
                    $users = $this->user_model->get_users();
                    $data['temp_users_json'] = $temp_users;
                    $data['user_types_json'] = $user_types;
                    $data['users_json'] = $users;

                    $this->load->view('header');
                    $this->load->view('users_view', $data);
                } else {
                    redirect('users/home');
                }
            } else {
                redirect('users/login');
            }
        }

        public function decline_user($id){
            $db_array = array(
                'declined' => TRUE
            );

            $email = json_decode($this->user_model->get_temp_user_email($id));

            if($this->user_model->update_temp_user($id, $db_array)){
                $lang_strings = json_decode($this->language_model->get_lang_strings_email());

                //preparing the mailcontent
                $this->email->from('vftestadresse@gmail.com', 'MyName');
                $this->email->to($email[0]->email);
                $this->email->subject($lang_strings->email_declined_subject);
                $this->email->message($lang_strings->email_declined_body);

                //sending mail
                if($this->email->send()){
                    echo json_encode(TRUE);
                } else {
                    echo json_encode(FALSE);
                }
            } else {
                echo json_encode(FALSE);
                return json_encode(FALSE);
            }
        }

        public function update_pending_order(){
            $order_array = json_decode($this->input->post('string'));
            $order = 10;
            foreach ($order_array as $item) {
                $db_array = array('table_order' => $order);
                $this->user_model->update_temp_user($item, $db_array);
                $order += 10;
            }
        }

        public function update_user_order(){
            $order_array = json_decode($this->input->post('string'));
            $order = 10;
            foreach ($order_array as $item) {
                $db_array = array('table_order' => $order);
                $this->user_model->update_user($item, $db_array);
                $order += 10;
            }
        }

        public function update_declined_order(){
            $order_array = json_decode($this->input->post('string'));
            $order = 10;
            foreach ($order_array as $item) {
                $db_array = array('table_order' => $order);
                $this->user_model->update_temp_user($item, $db_array);
                $order += 10;
            }
        }
    }