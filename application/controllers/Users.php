<?php
    class Users extends CI_Controller{
        function index(){
            $this->load->view('login');
        }

        /**
         * validating the form data, register a user, adding the data to the temp_user table and sending the validation mail
         */
        public function register(){
            $data['title'] = 'Sign up';

            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]|trim');

            $this->form_validation->set_message('is_unique', 'That email is already used');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('register', $data);
            } else {
                $enc_password = md5($this->input->post('password'));

                //generate the email token/key
                $unique_id = md5(uniqid());
                $key = md5($unique_id . md5($this->input->post('email')));

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

                //preparing the mailcontent
                $this->email->from('vftestadresse@gmail.com', 'MyName');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Aktivieren Sie Ihren Account');
                $message = '<p>Vielen Dank für Ihre Registrierung</p>';
                $message .= '<p><a href="'.base_url().'users/validate_user/'.$key.'">Klicken Sie hier um den Account zu aktivieren</a></p>';

                $this->email->message($message);

                //adding user to temp_user table and sending the mail
                if($this->user_model->add_temp_user($unique_id, $enc_password)){
                    if($this->email->send()){
                        redirect('users/login');
                    } else {
                        redirect('users/register');
                    }
                } else {
                    echo 'Problem adding user to database';
                }
            }
        }

        /**
         * called when user opens the validation link. Calls the add user function from the User_model.
         * if this function returns data the user is logged in, if it returns false the user has not been add
         * to the db.
         * @param $key is the token from the validation link
         */
        public function validate_user($key){
            if($data = $this->user_model->add_user($key)){
                $data = array(
                    'is_logged_in' => 1
                );
                $this->session->set_userdata($data);
                redirect('users/home');
            } else {
                echo 'failed to add user';
            }
        }

        /**
         * destroys the session to assure there is no userdata
         * sets rules for the login form
         */
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
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($user_data);

                        $this->session->set_flashdata('user_logged_in', 'You are now logged in');
                        redirect('users/home');
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
    }