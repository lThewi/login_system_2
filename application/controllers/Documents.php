<?php
class Documents extends CI_Controller{
    public function index(){
        $this->load->view('show_documents');
    }

    public function show_documents(){
        $this->load->view('show_documents');
    }

    public function create_document(){
        $data['categories_json'] = $this->get_categories();
        $this->load->view('create_document', $data);
    }

    public function create(){
        //preparing DB array
        $img_1 = $this->input->post('img_1');
        $img_2 = $this->input->post('img_2');
        $img_3 = $this->input->post('img_3');
        $db_array = array(
            'category' => $this->input->post('categories'),
            'technische_kennung' => $this->input->post('tech'),
            'name' => $this->input->post('name'),
            'checked_by' => $this->input->post('checked_by'),
            'created_date' =>  $this->input->post('date'),
            'text' => $this->input->post('content'),
            'imgs' => $img_1 . ',' . $img_2 . ',' . $img_3
        );

        //image upload config
        $config['upload_path'] = 'assets/uploaded_images';
        $config['allowed_types'] = 'tif|tiff|jpeg|jpg|png';
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $this->load->library('upload', $config);

        //model call to insert array into DB


        //if insert successful -> upload images to server

        if(!$this->upload->do_upload('img_1')){
            $error = $this->upload->display_errors();

            $this->session->set_flashdata('upload_error', $error);
        } else {
            $data = $this->upload->data();

            $this->session->set_flashdata('upload_success', 'File upload successful. ' . $data);
        }

        redirect('documents/show_documents');
    }

    public function get_categories(){
        $categories_json = $this->document_model->get_categories();
        return $categories_json;
    }
}