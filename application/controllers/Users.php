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

                //setting up the mail system
                $this->load->library('email', array('mailtype'=>'html'));
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'smtp.gmail.com';
                $config['smtp_port'] = 465;
                $config['smtp_user'] = 'vftestadresse@gmail.com';
                $config['smtp_pass'] = 'xxx';
                $config['smtp_crypto'] = 'ssl';
                $config['crlf'] = "\r\n";
                $config['newline'] = "\r\n";
                $this->email->initialize($config);

                $admin_mail = 'yyy';

                //preparing the mailcontent
                $this->email->from('vftestadresse@gmail.com', 'MyName');
                $this->email->to($admin_mail);
                $this->email->subject('Ihr Account bei uns');
                $message = '<p>Vielen Dank für Ihre Registrierung</p>';
                $message .= '<p>Name: '. $name . ' ' . $lastname . ', Email: '. $mail .'</p>';

                $this->email->message($message);
                //adding user to temp_user table and sending the mail
                if($this->user_model->add_temp_user()){
                    /**
                     * TODO: sending second mail to user
                     */
                    if($this->email->send()){
                        redirect('users/login');
                    } else {
                        $this->email->print_debugger();
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
                foreach($this->input->post('row') as $row => $value){
                    echo $value.'<br/>';
                    $type = $this->input->post($value);
                    $this->user_model->add_user($value, $type);
                }
            };

            //refresh page
            redirect('users/users_view');
        }

        public function login(){
            $this->form_validation->set_rules('mail', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->load->view('login');

            if($this->form_validation->run()){
                $mail = $_POST['mail'];
                $password = md5($_POST['password']);
                $user = $this->user_model->login($mail, $password);
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
                    $data['temp_users'] = $temp_users;
                    $data['user_types'] = $user_types;
                    $data['users'] = $users;
                    $this->load->view('users_view', $data);
                } else {
                    redirect('users/home');
                }
            } else {
                redirect('users/login');
            }
        }
    }