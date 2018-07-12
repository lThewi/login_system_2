<?php
class Documents extends CI_Controller{
    public function index(){
        if($this->session->userdata('logged_in') == TRUE){
            $this->load->view('show_documents');
        } else {
            redirect('users/login');
        }
    }

    public function show_documents(){
        if($this->session->userdata('logged_in') == TRUE){
            $data['documents_json'] = $this->get_all_documents();
            $data['categories_json'] = $this->get_categories();
            $this->load->view('show_documents', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_document(){
        if($this->session->userdata('logged_in') == TRUE){
            $data['categories_json'] = $this->get_categories();
            $this->load->view('create_document', $data);
        } else {
            redirect('users/login');
        }
    }

    public function modify_document($doc_id){
        if($this->session->userdata('logged_in') == TRUE){
            $data['document_json'] = $this->get_document($doc_id);
            $data['categories_json'] = $this->get_categories();
            $this->load->view('modify_document', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create(){
        //image upload config
        $config['upload_path'] = 'assets/uploaded_images';
        $config['allowed_types'] = 'tif|tiff|jpeg|jpg|png';
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $this->load->library('upload', $config);

        //uploading images to server
        $img_path_1 = $this->upload_image('img_1');
        $img_path_2 = $this->upload_image('img_2');
        $img_path_3 = $this->upload_image('img_3');

        //preparing DB array
        $db_array = array(
            'category' => $this->input->post('categories'),
            'technische_kennung' => $this->input->post('tech'),
            'name' => $this->input->post('name'),
            'checked_by' => $this->input->post('checked_by'),
            'created_date' =>  $this->input->post('date'),
            'text' => $this->input->post('content'),
            'img_1' => $img_path_1,
            'img_2' => $img_path_2,
            'img_3' => $img_path_3,
            'contact_person' => null
        );

        //model call to insert array into DB
        $result = $this->document_model->create_document($db_array);
        if($result){
            redirect('documents/show_documents');
        } else {
            unlink($img_path_1);
            unlink($img_path_2);
            unlink($img_path_3);
            $this->session->set_flashdata('database_error', 'Adding document to Database failed');
            redirect('documents/create_document');
        }
    }

    public function modify(){
        //image upload config
        $config['upload_path'] = 'assets/uploaded_images';
        $config['allowed_types'] = 'tif|tiff|jpeg|jpg|png';
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $this->load->library('upload', $config);

        //preparing DB array
        $db_array = array(
            'category' => $this->input->post('categories'),
            'technische_kennung' => $this->input->post('tech'),
            'name' => $this->input->post('name'),
            'checked_by' => $this->input->post('checked_by'),
            'created_date' =>  $this->input->post('date'),
            'text' => $this->input->post('content'),
            'contact_person' => null
        );

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
        $result = $this->document_model->modify_document($this->input->post('doc_id'), $db_array);
        if($result){
            redirect('documents/show_documents');
        } else {
            //unlink($img_path_1);
            //unlink($img_path_2);
            //unlink($img_path_3);
            $this->session->set_flashdata('database_error', 'Adding document to Database failed');
            redirect('documents/create_document');
        }
    }

    public function upload_image($field){
        if(!$this->upload->do_upload($field)){
            $error = $this->upload->display_errors();
            $img_path = null;
            $this->session->set_flashdata('upload_error', $error);
        } else {
            $data = $this->upload->data();
            $img_path = $this->upload->data('file_name');
            $this->session->set_flashdata('upload_success', $data);
        }
        return $img_path;
    }

    public function get_categories(){
        $categories_json = $this->document_model->get_categories();
        return $categories_json;
    }

    public function get_all_documents(){
        $documents_json = $this->document_model->get_all_documents();
        return $documents_json;
    }

    public function get_document($doc_id){
        $doc_json = $this->document_model->get_document($doc_id);
        return $doc_json;
    }
}