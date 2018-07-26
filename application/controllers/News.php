<?php
class News extends CI_Controller{
    public $image_path = 'assets/uploaded_images/';

    public function __construct()
    {
        parent::__construct();

    }

    public function index(){
        $this->show_news();
    }

    public function show_news(){
        if($this->session->userdata('logged_in') == true){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $data['all_news_json'] = $this->news_model->get_all_news();
            $data['strings_json'] = $this->language_model->get_lang_strings_news();

            $this->load->view('header', $header);
            $this->load->view('news/show_news', $data);

        } else {
            redirect('users/login');
        }
    }

    public function create_news(){
        if($this->session->userdata('logged_in') == true){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $lang = json_decode($this->language_model->get_lang_strings_news());
            $data['categories_json'] = $this->news_model->get_all_categories();
            $data['strings_json'] = $this->language_model->get_lang_strings_news();

            $this->form_validation->set_rules('title', 'Title', 'required', array('required' => $lang->news_formvalid_title));
            $this->form_validation->set_rules('content', 'Content', 'required', array('required' => $lang->news_formvalid_content));

            if(!$this->form_validation->run()){
                $this->load->view('header', $header);
                $this->load->view('news/create_news', $data);
            } else {
                $db_array = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'category_id' => $this->input->post('category'),
                );

                //wenn Berechtigungsstufen aus der DB abgerufen werden, länge des ergebnis-arrays abragen um
                //Abbruchbedingung für for-schleife zu erhalten
                $auth_string = '';
                for($idx = 1;$idx <= 4; $idx++){
                    $input_name = 'check'.$idx;
                    if($this->input->post($input_name) != null){
                        $auth_string .= $this->input->post($input_name).',';
                    } else {
                        $auth_string .= ' ,';
                    }
                }
                $db_array['auth_levels'] = $auth_string;

                $this->load->library('upload');
                //uploading images to server

                $img_name_1 = $this->upload_image('img_1');
                $img_name_2 = $this->upload_image('img_2');
                $img_name_3 = $this->upload_image('img_3');

                $db_array['img_1'] = $img_name_1;
                $db_array['img_2'] = $img_name_2;
                $db_array['img_3'] = $img_name_3;


                $result = $this->news_model->create_news($db_array);
                if($result){
                    $this->session->set_flashdata('news_created', $lang->news_create_success);
                    redirect('news/show_news');
                } else {
                    $this->session->set_flashdata('news_created_error', $lang->news_create_error);
                    redirect('news/create_news');
                }
            }
        } else {
            redirect('users/login');
        }
    }

    public function update_news($id){
        if($this->session->userdata('logged_in') == true){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $data['categories_json'] = $this->news_model->get_all_categories();
            $data['news_json'] = $this->news_model->get_news_by_id($id);
            $data['path_json'] = json_encode($this->image_path);
            $strings_json = $this->language_model->get_lang_strings_news();
            $data['strings_json'] = $strings_json;

            $strings = json_decode($strings_json);

                $this->load->view('header',$header);
                $this->load->view('news/update_news', $data);



        } else {
            redirect('users/login');
        }
    }

    public function mod_news(){
        $strings = json_decode($this->language_model->get_lang_strings_news());
        $this->form_validation->set_rules('title', 'Title', 'trim|required', array('required' => $strings->news_formvalid_title));
        $this->form_validation->set_rules('content', 'Content', 'trim|required', array('required' => $strings->news_formvalid_content));
        //preparing DB array
        $db_array = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'category_id' => $this->input->post('category'),
        );
        $auth_string = '';
        for($idx = 1;$idx <= 4; $idx++){
            $input_name = 'check'.$idx;
            if($this->input->post($input_name) != null){
                $auth_string .= $this->input->post($input_name).',';
            } else {
                $auth_string .= ' ,';
            }
        }
        $db_array['auth_levels'] = $auth_string;
        $this->load->library('upload');
        //uploading images to server
        $img_path_1 = $this->upload_image('img_1');
        $img_path_2 = $this->upload_image('img_2');
        $img_path_3 = $this->upload_image('img_3');
        if($img_path_1 != null){
            $db_array['img_1'] = $img_path_1;
            unlink($this->input->post('img_1_old'));
        }
        if($img_path_2 != null){
            $db_array['img_2'] = $img_path_2;
            unlink($this->input->post('img_3_old'));
        }
        if($img_path_3 != null){
            $db_array['img_3'] = $img_path_3;
            unlink($this->input->post('img_3_old'));
        }
        //model call to insert array into DB
        $result = $this->news_model->update_news($this->input->post('news_id'), $db_array);
        if($result){
            redirect('news/show_news');
        } else {
            $this->session->set_flashdata('database_error', $strings->doc_modify_error);
            redirect('news/update_news/'.$this->input->post('news_id'));
        }
    }

    public function delete_news($id){
        $news = json_decode($this->news_model->get_news_by_id($id));
        $img_1 = $news[0]->img_1;
        $img_2 = $news[0]->img_2;
        $img_3 = $news[0]->img_3;

        if($img_1 != null){
            $this->delete_image($img_1);
        }
        if($img_2 != null){
            $this->delete_image($img_2);
        }
        if($img_3 != null){
            $this->delete_image($img_3);
        }

        $result = $this->news_model->delete_news($id);
        redirect('news/show_news');
    }

    public function upload_image($field){
        if(!$this->upload->do_upload($field)){
            $error = $this->upload->display_errors();
            $img_name = null;
            //$this->session->set_flashdata('upload_error', 'Bild konnte nicht auf den Server geladen werden.');
        } else {
            $data = $this->upload->data();
            $img_name = $this->upload->data('file_name');
            $this->session->set_flashdata('upload_success', $data);
        }
        return $img_name;
    }

    public function delete_image($name){
        $path = $this->image_path.$name;
        unlink($path);
    }

    public function update_news_order(){
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach($order_array as $item){
            $db_array = array(
                'table_order' => $order
            );
            $result = $this->news_model->update_news($item, $db_array);
            $order += 10;
        }
    }
}