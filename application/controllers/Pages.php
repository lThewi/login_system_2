<?php
class Pages extends CI_Controller{
    public $graphics_path = 'assets/uploaded_images/';

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->show_pages();
    }

    public function show_pages(){
        if($this->session->userdata['logged_in'] == TRUE){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $strings_json = $this->language_model->get_lang_strings_pages();
            $data['strings_json'] = $strings_json;
            $data['all_pages_json'] = $this->Page_model->get_all_pages();
            $data['path'] = $this->graphics_path;


            $this->load->view('header', $header);
            $this->load->view('pages/show_pages', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_page(){
        if($this->session->userdata['logged_in'] == TRUE){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $strings_json = $this->language_model->get_lang_strings_pages();
            $data['strings_json'] = $strings_json;


            $strings = json_decode($this->language_model->get_lang_strings_pages());

            $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[pages.name]', array('is_unique' => $strings->page_not_unique, 'required' => $strings->page_name_req));
            $this->form_validation->set_rules('content', 'Content', 'required', array('required' => $strings->page_content_req));
            $this->form_validation->set_rules('date', 'Date', 'required', array('required' => $strings->page_date_req));

            if($this->form_validation->run() === FALSE) {
                $this->load->view('header', $header);
                $this->load->view('pages/create_page', $data);
            } else {
                //db_array
                $date = $this->input->post('date');
                if($date == ''){
                    $date = date('Y-m-d');
                }

                $db_array = array(
                    'name' => $this->input->post('name'),
                    'content' => $this->input->post('content'),
                    'created_at' => $date
                );
                //upload graphic and add it to the array
                $graphic_name = $this->upload_graphic('img');
                if($graphic_name != null){
                    $db_array['graphic'] = $graphic_name;
                } else {
                    $db_array['graphic'] = null;
                }

                //call model to insert data into db
                $result = $this->Page_model->create_new_page($db_array);
                if($result){
                    $this->session->set_flashdata('page_created', $strings->page_created);
                    redirect('pages/create_page');
                } else {
                    $this->session->set_flashdata('page_error', $strings->page_create_error);
                    if($graphic_name != null){
                        $path = $this->graphics_path . $graphic_name;
                        unlink($path);
                    }
                    redirect('pages/create_page');
                }
            }


        } else {
            redirect('users/login');
        }
    }

    public function modify_page($page_id){
        if($this->session->userdata['logged_in'] == TRUE){
            $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
            $strings_json = $this->language_model->get_lang_strings_pages();
            $data['strings_json'] = $strings_json;
            $data['page_json'] = $this->Page_model->get_page_by_id($page_id);
            $data['path_json'] = json_encode($this->graphics_path);

            $this->load->view('header', $header);
            $this->load->view('pages/modify_page', $data);

        } else {
            redirect('users/login');
        }
    }

    public function mod_page(){
        $db_array = array(
            'name' => $this->input->post('name'),
            'content' => $this->input->post('content'),
            'created_at' => $this->input->post('date'),
        );

        if($this->input->post('del_old') != null){
            $db_array['graphic'] = 'default-image.jpg';
            $this->delete_image($this->input->post('img_old'));
        }

        $graphic_name = $this->upload_graphic('img');
        if($graphic_name != 'default-image.jpg'){

            $db_array['graphic'] = $graphic_name;
            if($this->input->post('img_old') != 'default-image.jpg'){
                $this->delete_image($this->graphics_path.$this->input->post('img_old'));
            }
        }
        $strings = json_decode($this->language_model->get_lang_strings_pages());
        $result = $this->Page_model->modify_page($this->input->post('page_id'), $db_array);
        if($result){
            $this->session->set_flashdata('page_updated', $strings->page_updated);
            redirect('pages/show_pages');
        } else {
            $this->session->set_flashdata('page_update_error', $strings->page_update_error);
            redirect('pages/modify_page/'.$this->input->post('page_id'));
        }
    }

    public function upload_graphic($field){
        $this->load->library('upload');
        if(!$this->upload->do_upload($field)){
            $error = $this->upload->display_errors();
            $img_name = 'default-image.jpg';
            $this->session->set_flashdata('upload_error', $error);
        } else {
            $img_name = $this->upload->data('file_name');

            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->data('full_path');
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 40;
            $config['height']   = 40;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        return $img_name;
    }

    public function delete_page($id){
        $page = json_decode($this->Page_model->get_page_by_id($id));
        $image = $page[0]->graphic;

        if($image != null){
            $this->delete_image($image);
        }
        $strings = json_decode($this->language_model->get_lang_strings_pages);
        $result = $this->Page_model->delete_page($id);
        if($result){
            $this->session->set_flashdata('page_deleted', $strings->page_deleted);
            redirect('pages/show_pages');
        } else {
            $this->session->set_flashdata('page_delete_error', $strings->page_delete_error);
            redirect('pages/show_pages');
        }

    }

    public function delete_image($name){
        if($name != 'default-image.jpg'){
            $path = $this->graphics_path.$name;
            unlink($path);
        }
    }

    public function update_page_order(){
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach($order_array as $item){
            $db_array = array(
                'table_order' => $order
            );
            $result = $this->Page_model->modify_page($item, $db_array);
            $order += 10;
        }
    }
}