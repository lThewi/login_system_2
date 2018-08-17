<?php

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Credentials: true');
        //header('Access-Control-Allow-headers: content-type, if-none-match');
        header('Access-Control-Allow--Methods: POST,GET,OPTIONS');
        //header('Access-Control-Max-Age: 3600');
        //header('Content-Type: text/json, application/x-www-form-urlencoded');
    }


    function index()
    {
        redirect('users/login');
    }

    /**
     * validating the form data, register a user, adding the data to the temp_user table and sending the validation mail
     */
    public function register()
    {
        $string_json = $this->language_model->get_lang_strings_users();
        $string = json_decode($string_json);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]|is_unique[temp_users.email]', array('valid_email' => $string->no_valid_email_error));
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]|trim', array('matches' => $string->pw_confirm_error));

        $this->form_validation->set_message('is_unique', $string->register_email_unique);

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('name', $this->input->post('name'));
            $this->session->set_flashdata('lastname', $this->input->post('lastname'));
            $this->session->set_flashdata('mail', $this->input->post('email'));

            $strings_json = $this->language_model->get_lang_strings_register();
            $data['strings_json'] = $strings_json;
            $this->load->view('register', $data);
        } else {
            $enc_password = md5($this->input->post('password'));
            $mail = $this->input->post('email');
            $name = $this->input->post('name');
            $lastname = $this->input->post('lastname');
            $data['name'] = $name;
            $data['lastname'] = $lastname;

            $admin_mail = 'yyy';
            $lang_strings = json_decode($this->language_model->get_lang_strings_email());
            $strings = json_decode($this->language_model->get_lang_strings_users());

            //preparing the mailcontent
            $this->email->from('vftestadresse@gmail.com', 'MyName');
            $this->email->to($mail);
            $this->email->subject($lang_strings->email_register_subject);
            $message = $lang_strings->email_register_body;
            $this->email->message($message);


            //adding user to temp_user table and sending the mail
            $temp_user = $this->user_model->add_temp_user();
            if ($temp_user != FALSE) {
                if ($this->email->send(FALSE)) {
                    $this->email->to($admin_mail);
                    $this->email->send();
                    //redirect to login screen and posting data of the temp_user
                    $data['json_data'] = $temp_user;
                    redirect('users/login', $data);
                } else {
                    redirect('users/login');
                }
            } else {
                echo $strings->user_register_error;
            }
        }
    }

    public function add_multiple_users()
    {
        //loop over all rows and add them to the DB (with add_user)
        if ($this->input->post('row')) {
            $array_idx = 0;
            foreach ($this->input->post('row') as $row => $value) {
                $type = $this->input->post($value);
                $user = $this->user_model->add_user($value, $type);
                $results[$array_idx] = $user;
                $array_idx++;
            }
            $data['added_users'] = $results;
            //refresh page
            redirect('users/users_view');
        };
        redirect('users/users_view');
    }

    public function re_add_user($id)
    {
        $temp_user = json_decode($this->get_temp_user_by_id($id));
        $result = $this->user_model->add_user($id, 2);
    }

    public function decline_multiple_users()
    {
        //loop over all rows and add them to the DB (with add_user)
        $db_array = array(
            'declined' => TRUE
        );
        $lang_strings = json_decode($this->language_model->get_lang_strings_email());
        $rows = json_decode($this->input->post('json_string'));

        foreach ($rows as $value) {

            $email = json_decode($this->user_model->get_temp_user_email($value));

            if ($this->user_model->update_temp_user($value, $db_array)) {

                //preparing the mailcontent
                $this->email->from('vftestadresse@gmail.com', 'MyName');
                $this->email->to($email[0]->email);
                $this->email->subject($lang_strings->email_declined_subject);
                $this->email->message($lang_strings->email_declined_body);

                //sending mail
                if ($this->email->send()) {
                    //echo json_encode(TRUE);
                } else {
                    //echo json_encode(FALSE);
                }
            } else {
                //echo json_encode(FALSE);
                //return json_encode(FALSE);
            }
        }
    }

    public function update_user($id)
    {
        $strings_json = $this->language_model->get_lang_strings_update_user();

        $data['user_json'] = $this->get_active_user_by_id($id);
        $data['types_json'] = $this->user_model->get_user_types();
        $data['strings_json'] = $strings_json;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('lastname', 'Lastame', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if (!$this->form_validation->run()) {
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $this->load->view('header', $header);
            $this->load->view('update_user', $data);
        } else {

        }
    }

    public function mod_user()
    {
        $strings_json = $this->language_model->get_lang_strings_update_user();

        $this->form_validation->set_rules('name', 'Name', 'required', array('required'));
        $this->form_validation->set_rules('lastname', 'Lastame', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $db_array = array(
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'acc_type_id' => $this->input->post('acc_type'),
            );

            $result = $this->user_model->update_user($id, $db_array);

            if ($result) {
                redirect('users/users_view');
            }
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('mail', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $strings = $this->language_model->get_lang_strings_login();

        $data['strings_json'] = $strings;


        $this->load->view('login', $data);

        if ($this->form_validation->run()) {
            $this->session->set_flashdata('mail', $this->input->post('mail'));

            $strings = json_decode($this->language_model->get_lang_strings_users());
            $mail = $_POST['mail'];
            $password = md5($_POST['password']);
            $user_data = $this->user_model->login($mail, $password);
            $user = json_decode($user_data);
            if ($user) {
                if ($user == 'wrong password') {
                    $this->session->set_flashdata('wrong_password', $strings->user_login_pw);
                    return redirect('users/login');
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

                    switch ($user->acc_type_id) {
                        case 1:
                            redirect('users/users_view');
                            break;
                        case 2:
                            redirect('users/home');
                            break;
                    }
                }
            } else {
                $this->session->set_flashdata('wrong_email', $strings->user_login_mail);
                return redirect('users/login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('users/login');
    }

    public function home()
    {
        if ($this->session->userdata('logged_in') === TRUE) {
            $this->load->view('home');
        } else {
            redirect('users/login');
        }
    }

    public function users_view()
    {
        if ($this->session->userdata('logged_in') === TRUE) {
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $strings_json = $this->language_model->get_lang_strings_dashboard();
            $data['strings_json'] = $strings_json;
            if ($this->session->userdata('user_type') === '1') {
                $temp_users = $this->user_model->get_all_temp_users();
                $user_types = $this->user_model->get_user_types();
                $users = $this->user_model->get_users();
                $data['temp_users_json'] = $temp_users;
                $data['user_types_json'] = $user_types;
                $data['users_json'] = $users;

                $this->load->view('header', $header);
                $this->load->view('users_view', $data);
            } else {
                redirect('users/home');
            }
        } else {
            redirect('users/login');
        }
    }

    public function reset_password($auth_string = null){
        if($auth_string != null) {
            $show = FALSE;
            $temp = FALSE;
            $users_json = $this->user_model->get_users();
            $users = json_decode($users_json);
            foreach ($users as $user) {
                $hash = md5($user->id).md5($user->email);

                if ($hash == $auth_string) {
                    $data['user_json'] = json_encode($user);
                    $show = TRUE;
                    break;
                }
            }
            if(!$show){
                $temp_users_json = $this->user_model->get_all_temp_users();
                $temp_users = json_decode($temp_users_json);
                foreach($temp_users as $user){
                    $hash = md5($user->id).md5($user->email);

                    if ($hash == $auth_string) {
                        $data['user_json'] = json_encode($user);
                        $show = TRUE;
                        $temp = TRUE;
                        break;
                    }
                }
            }

            if ($show) {
                $strings = $this->language_model->get_lang_strings_reset_password();
                $data['strings_json'] = $strings;
                $data['temp'] = $temp;
                $this->load->view('reset_password', $data);
                //db calls insbesondere get_user_by_email

            } else {
                redirect('users/login');
            }
        } else {
            redirect('users/login');
        }
    }

    public function reset_pw(){
        $strings = $this->language_model->get_lang_strings_reset_password();

        $this->form_validation->set_rules('password', 'Password', 'required|trim', array('required' => $strings->pw_error));
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]', array('required' =>$strings->cpw_error, 'matches' => $strings->pw_confirm_error));

        if($this->form_validation->run()){
            $id = $this->input->post('id');
            $temp = $this->input->post('temp');
            $password = md5($this->input->post('password'));
            $db_array = array(
                'password' => $password
            );
            if($temp = 0){
                $result = $this->user_model->update_user($id,$db_array);
            } else {
                $result = $this->user_model->update_temp_user($id,$db_array);
            }

            if($result){
                $this->session->set_flashdata('reset_success', $strings->pw_reset_success);
                redirect('users/login');
            } else {
                $this->session->set_flashdata('reset_error', $strings->pw_reset_error);
                redirect('users/login');
            }
        } else {
            redirect('users/login');
        }
    }

    public function reset_pw_email(){
        $strings_json = $this->language_model->get_lang_strings_reset_password();
        $strings = json_decode($strings_json);

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array(
            'required' => $strings->email_error,
            'valid_email' => $strings->email_valid_error,
        ));
        if(!$this->form_validation->run()){
            $data['strings_json'] = $strings_json;
            $this->load->view('reset_pw_email', $data);
        } else {
            $mail = $this->input->post('email');

            $lang_strings = json_decode($this->language_model->get_lang_strings_email());

            //preparing the mailcontent
            $this->email->from('vftestadresse@gmail.com', 'MyName');
            $this->email->to($mail);
            $this->email->subject($lang_strings->email_reset_subject);

            $user = json_decode($this->get_user_by_email($mail));

            $token = md5($user[0]->id).md5($mail);
            $link = '<a href="'.base_url().'users/reset_password/'.$token.'">'.$lang_strings->email_reset_link_text.'</a>';
            $message = $lang_strings->email_reset_body.$link.'</br>';

            $this->email->message($message);

            if($this->email->send()){
                redirect('users/login');
            } else {
                redirect('users/reset_pw_email');
            }
        }
    }

    public function decline_user($id)
    {
        $db_array = array(
            'declined' => TRUE
        );

        $email = json_decode($this->user_model->get_temp_user_email($id));

        if ($this->user_model->update_temp_user($id, $db_array)) {
            $lang_strings = json_decode($this->language_model->get_lang_strings_email());

            //preparing the mailcontent
            $this->email->from('vftestadresse@gmail.com', 'MyName');
            $this->email->to($email[0]->email);
            $this->email->subject($lang_strings->email_declined_subject);
            $this->email->message($lang_strings->email_declined_body);

            //sending mail
            if ($this->email->send()) {
                echo json_encode(TRUE);
            } else {
                echo json_encode(FALSE);
            }
        } else {
            echo json_encode(FALSE);
            return json_encode(FALSE);
        }
    }

    public function decline_active_user($id)
    {
        $user = json_decode($this->user_model->get_user($id));

        $db_array = array(
            'email' => $user[0]->email,
            'name' => $user[0]->name,
            'lastname' => $user[0]->lastname,
            'password' => $user[0]->password,
            'register_date' => $user[0]->register_date,
            'last_login' => $user[0]->last_login,
            'declined' => 1,
        );

        $result_temp = $this->user_model->add_user_to_declined($db_array);
        if ($result_temp) {
            $result_delete = $this->user_model->delete_active_user($id);
        }
    }

    public function update_pending_order()
    {
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach ($order_array as $item) {
            $db_array = array('table_order' => $order);
            $this->user_model->update_temp_user($item, $db_array);
            $order += 10;
        }
    }

    public function update_user_order()
    {
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach ($order_array as $item) {
            $db_array = array('table_order' => $order);
            $this->user_model->update_user($item, $db_array);
            $order += 10;
        }
    }

    public function update_declined_order()
    {
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach ($order_array as $item) {
            $db_array = array('table_order' => $order);
            $this->user_model->update_temp_user($item, $db_array);
            $order += 10;
        }
    }

    public function get_temp_user_by_id($id)
    {
        return $this->user_model->get_temp_user($id);
    }

    public function get_active_user_by_id($id)
    {
        return $this->user_model->get_user($id);
    }

    public function get_user_by_email($email){
        return $this->user_model->get_user_by_email($email);
    }
}