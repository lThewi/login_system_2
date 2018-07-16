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

            $this->load->view('header');
            $this->load->view('show_documents', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_document(){
        if($this->session->userdata('logged_in') == TRUE){
            $data['categories_json'] = $this->get_categories();

            $this->load->view('header');
            $this->load->view('create_document', $data);
        } else {
            redirect('users/login');
        }
    }

    public function modify_document($doc_id){
        if($this->session->userdata('logged_in') == TRUE){
            $data['document_json'] = $this->get_document($doc_id);
            $data['categories_json'] = $this->get_categories();

            $this->load->view('header');
            $this->load->view('modify_document', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_category(){
        if($this->session->userdata('logged_in') == TRUE){
            $this->load->view('header');
            $this->load->view('create_category');

            $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[doc_categories.name]');

            if($this->form_validation->run()){
                $db_array = array(
                    'name' => $this->input->post('name')
                );
                $result = $this->document_model->create_category($db_array);
            }

        }else{
            redirect('users/login');
        }
    }

    public function create_contactperson(){
        if($this->session->userdata('logged_in') == TRUE){
            $this->load->view('header');
            $this->load->view('create_contactperson');

            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('position', 'Position', 'required|trim');

            if($this->form_validation->run()){
                $image_name = $this->upload_contact_image('img');

                $db_array = array(
                    'name' => $this->input->post('name'),
                    'position' => $this->input->post('position'),
                    'img' => $image_name
                );

                $this->document_model->create_contactperson($db_array);
            }
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
            $this->session->set_flashdata('database_error', 'Adding document to Database failed');
            redirect('documents/create_document');
        }
    }

    public function upload_image($field){
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

    public function upload_contact_image($img){
        if(!$this->upload->do_upload($img)){
            $error = $this->upload->display_errors();
            $img_name = null;
            $this->session->set_flashdata('upload_error', $error);
        } else {
            $img_name = $this->upload->data('file_name');

            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->data('full_path');
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 400;
            $config['height']   = 400;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
            $this->image_lib->clear();
        }

        return $img_name;
    }

    // $path needs to be changed if project is not in root!!
    public function delete_image($name){
        $path = 'assets/uploaded_images/'.$name;
        unlink($path);
    }

    public function delete_Document($doc_id){
        $document = json_decode($this->document_model->get_document($doc_id));
        $img_1 = $document[0]->img_1;
        $img_2 = $document[0]->img_2;
        $img_3 = $document[0]->img_3;

        $this->delete_image($img_1);
        $this->delete_image($img_2);
        $this->delete_image($img_3);

        $result = $this->document_model->delete_document($doc_id);
        redirect('documents/show_documents');
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