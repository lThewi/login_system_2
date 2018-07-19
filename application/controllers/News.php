<?php
class News extends CI_Controller{
    public $image_path = 'assets/news_images/';

    public function __construct()
    {
        parent::__construct();

    }

    public function index(){
        $this->show_news();
    }

    public function show_news(){
        if($this->session->userdata('logged_in') == true){
            $data['all_news_json'] = $this->news_model->get_all_news();

            $this->load->view('header');
            $this->load->view('news/show_news', $data);

        } else {
            redirect('users/login');
        }
    }

    public function create_news(){
        if($this->session->userdata('logged_in') == true){
            $lang = json_decode($this->language_model->get_lang_strings_news());
            $data['categories_json'] = $this->news_model->get_all_categories();

            $this->form_validation->set_rules('title', 'Title', 'required', array('required' => $lang->news_formvalid_title));
            $this->form_validation->set_rules('content', 'Content', 'required', array('required' => $lang->news_formvalid_content));

            if(!$this->form_validation->run()){
                $this->load->view('header');
                $this->load->view('news/create_news', $data);
            } else {
                $config['upload_path'] = $this->image_path;
                $this->upload->initialize($config);


                $db_array = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'category_id' => $this->input->post('category'),
                    'img_1' => null,
                    'img_2' => null,
                    'img_3' => null,
                );

                //uploading images to server
                $img_name_1 = $this->upload_image('img_1');
                $img_name_2 = $this->upload_image('img_2');
                $img_name_3 = $this->upload_image('img_3');
                if($img_name_1 != null){
                    $db_array['img_1'] = $img_name_1;
                }
                if($img_name_2 != null){
                    $db_array['img_2'] = $img_name_2;
                }
                if($img_name_3 != null){
                    $db_array['img_3'] = $img_name_3;
                }

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
            $data['categories_json'] = $this->news_model->get_all_categories();
            $data['news_json'] = $this->news_model->get_news($id);

            $this->load->view('header');
            $this->load->view('news/create_news', $data);
        } else {
            redirect('users/login');
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

    public function mod_news(){

    }

    public function upload_image($field){
        if(!$this->upload->do_upload($field)){

            $img_name = null;
            $this->session->set_flashdata('upload_error', $this->upload->display_errors());
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
}