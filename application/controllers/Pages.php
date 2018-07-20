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
            $data['all_pages_json'] = $this->Page_model->get_all_pages();
            $data['path'] = $this->graphics_path;


            $this->load->view('header');
            $this->load->view('pages/show_pages', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_page(){
        if($this->session->userdata['logged_in'] == TRUE){

                $this->load->view('header');
                $this->load->view('pages/create_page');


        } else {
            redirect('users/login');
        }
    }

    public function modify_page($page_id){
        if($this->session->userdata['logged_in'] == TRUE){
            $data['page_json'] = $this->Page_model->get_page_by_id($page_id);
            $data['path_json'] = $this->graphics_path;

            $this->load->view('header');
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

        $graphic_name = $this->upload_graphic('img');
        if($graphic_name != null){
            $db_array['img'] = $graphic_name;
            unlink($this->graphics_path.$this->input->post('img_old'));
        }

        $result = $this->Page_model->modify_page($this->input->post('page_id'), $db_array);
        if($result){
            $this->session->set_flashdata('page_updated', 'Die Seite wurde erfolgreich angepasst.');
            redirect('pages/show_pages');
        } else {
            $this->session->set_flashdata('page_update_error', 'Es gab ein Problem beim Eintragen in die Datenbank');
            redirect('pages/modify_page/'.$this->input->post('page_id'));
        }
    }

    public function create_new_page(){
        $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[pages.name]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');

        if($this->form_validation->run()){


            //db_array
            $db_array = array(
                'name' => $this->input->post('name'),
                'content' => $this->input->post('content'),
                'created_at' => $this->input->post('date')
            );
            //upload graphic and add it to array
            $graphic_name = $this->upload_graphic('img');
            if($graphic_name != null){
                $db_array['graphic'] = $graphic_name;
            } else {
                $db_array['graphic'] = null;
            }

            //call model to add data to db
            $result = $this->Page_model->create_new_page($db_array);
            if($result){
                $this->session->set_flashdata('page_created', 'Die Seite wurde erfolgreich erstellt');
                redirect('pages/create_page');
            } else {
                $this->session->set_flashdata('page_error', 'Beim Eintragen der Seite in die Datenbank ist ein Fehler aufgetreten');
                if($graphic_name != null){
                    $path = $this->graphics_path . $graphic_name;
                    unlink($path);
                }
                redirect('pages/create_page');
            }
        }
    }

    public function upload_graphic($field){

        if(!$this->upload->do_upload($field)){
            $error = $this->upload->display_errors();
            $img_name = null;
            $this->session->set_flashdata('upload_error', $error);
        } else {
            $data = $this->upload->data();
            $img_name = $this->upload->data('file_name');
            $this->session->set_flashdata('upload_success', $data);
        }
        return $img_name;
    }

    public function delete_page($id){
        $page = json_decode($this->Page_model->get_page_by_id($id));
        $image = $page[0]->graphic;

        if($image != null){
            $this->delete_image($image);
        }

        $result = $this->Page_model->delete_page($id);
        if($result){
            $this->session->set_flashdata('page_deleted', 'Die Seite wurde erfolgreich gelöscht.');
            redirect('pages/show_pages');
        } else {
            $this->session->set_flashdata('page_delete_error', 'Beim Löschen der Seite ist ein Fehler aufgetreten.');
            redirect('pages/show_pages');
        }

    }

    public function delete_image($name){
        $path = $this->graphics_path.$name;
        unlink($path);
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