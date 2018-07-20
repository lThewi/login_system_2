<?php
class Documents extends CI_Controller{
    public $image_path = 'assets/uploaded_images/';


    public function index(){
        if($this->session->userdata('logged_in') == TRUE){
            $this->load->view('header');
            $this->load->view('documents/show_documents');
        } else {
            redirect('users/login');
        }
    }

    public function get_image_path(){
        return json_encode($this->image_path);
    }

    public function show_documents(){
        if($this->session->userdata('logged_in') == TRUE){
            $data['documents_json'] = $this->get_all_documents();
            $data['categories_json'] = $this->get_categories();

            $this->load->view('header');
            $this->load->view('documents/show_documents', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_document(){
        if($this->session->userdata('logged_in') == TRUE){
            $data['categories_json'] = $this->get_categories();
            $data['contact_persons'] = $this->get_all_contactpersons();

            $this->load->view('header');
            $this->load->view('documents/create_document', $data);
        } else {
            redirect('users/login');
        }
    }

    public function modify_document($doc_id){
        if($this->session->userdata('logged_in') == TRUE){
            $data['document_json'] = $this->get_document($doc_id);
            $data['categories_json'] = $this->get_categories();
            $data['contact_persons'] = $this->get_all_contactpersons();

            $this->load->view('header');
            $this->load->view('documents/modify_document', $data);
        } else {
            redirect('users/login');
        }
    }

    public function modify_contact($con_id){
        if($this->session->userdata('logged_in') == TRUE){
            $data['img_path'] = $this->get_image_path();
            $data['contact_json'] = $this->get_contact($con_id);

            $this->load->view('header');
            $this->load->view('contacts/modify_contactperson', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create_category(){
        if($this->session->userdata('logged_in') == TRUE){
            $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[doc_categories.name]');

            if(!$this->form_validation->run()){
                $this->load->view('header');
                $this->load->view('documents/create_category');
            } else {
                $this->load->view('header');
                $this->load->view('documents/create_category');
                $db_array = array(
                    'name' => $this->input->post('name')
                );
                $this->session->set_flashdata('created_category', 'Category created');
                $result = $this->document_model->create_category($db_array);
            }

        }else{
            redirect('users/login');
        }
    }

    public function create_contactperson(){
        if($this->session->userdata('logged_in') == TRUE){

                $this->load->view('header');
                $this->load->view('contacts/create_contactperson');

        } else {
            redirect('users/login');
        }
    }

    public function create_new_contact(){
        if($this->session->userdata('logged_in') == TRUE){
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('position', 'Position', 'required|trim');

            if($this->form_validation->run()){
                $image_name = $this->upload_contact_image('img');

                $db_array = array(
                    'name' => $this->input->post('name'),
                    'position' => $this->input->post('position'),
                    'tel' => $this->input->post('tel'),
                    'category_id' => $this->input->post('category'),
                    'img' => $image_name
                );

                $this->session->set_flashdata('contact_created', 'Conctact person created');
                $result = $this->document_model->create_contactperson($db_array);

                if($result){
                    $this->session->set_flashdata('contact_created', 'Die Kontaktperson wurde erfolgreich erstellt');
                    redirect('contacts/create_contactperson');
                } else {
                    $this->session->set_flashdata('site_error', 'Beim Eintragen der Kontaktperson in die Datenbank ist ein Fehler aufgetreten');
                    if($image_name != null){
                        $path = $this->image_path . $image_name;
                        unlink($path);
                    }
                }
            }
        } else {
            redirect('users/login');
        }
    }

    public function show_contactpersons(){
        if($this->session->userdata('logged_in') == TRUE){
            $data['contact_persons_json'] = $this->get_all_contactpersons();
            $data['img_path'] = $this->image_path;

            $this->load->view('header');
            $this->load->view('contacts/show_contactpersons', $data);
        } else {
            redirect('users/login');
        }
    }

    public function create(){
        //image upload config
        $config['upload_path'] = $this->image_path;
        $this->upload->initialize($config);

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
            'contact_person' => $this->input->post('contacts')
        );

        //model call to insert array into DB
        $result = $this->document_model->create_document($db_array);
        if($result){
            $this->session->set_flashdata('document_created', 'Document created');
            redirect('documents/show_documents');
        } else {
            unlink($img_path_1);
            unlink($img_path_2);
            unlink($img_path_3);
            $this->session->set_flashdata('database_error', 'Adding document to Database failed');
            redirect('documents/create_document');
        }
    }

    public function modify_con(){
        $db_array = array(
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position')
        );

        $img_name = $this->upload_contact_image('img');
        if($img_name != null){
            $db_array['img'] = $img_name;
            unlink($this->image_path.$this->input->post('img_old'));
        }

        $result = $this->document_model->modify_contactperson($this->input->post('con_id'), $db_array);
        if($result){
            redirect('contacts/show_contactpersons');
        } else {
            redirect('contacts/modify_contactperson');
        }
    }

    public function modify_doc(){
        //preparing DB array
        $db_array = array(
            'category' => $this->input->post('categories'),
            'technische_kennung' => $this->input->post('tech'),
            'name' => $this->input->post('name'),
            'checked_by' => $this->input->post('checked_by'),
            'created_date' =>  $this->input->post('date'),
            'text' => $this->input->post('content'),
            'contact_person' => $this->input->post()
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
            $config['width']     = 40;
            $config['height']   = 40;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
            $this->image_lib->clear();
        }

        return $img_name;
    }

    public function delete_image($name){
        $path = $this->image_path.$name;
        unlink($path);
    }

    public function delete_Document($doc_id){
        $document = json_decode($this->document_model->get_document($doc_id));
        $img_1 = $document[0]->img_1;
        $img_2 = $document[0]->img_2;
        $img_3 = $document[0]->img_3;

        if($img_1 != null){
            $this->delete_image($img_1);
        }
        if($img_2 != null){
            $this->delete_image($img_2);
        }
        if($img_3 != null){
            $this->delete_image($img_3);
        }

        $result = $this->document_model->delete_document($doc_id);
        redirect('documents/show_documents', 'refresh');
    }

    public function delete_contact($id){
        $contact = json_decode($this->get_contact($id));
        $img = $contact[0]->img;

        if($img != null){
            $this->delete_image($img);
        }

        $result = $this->document_model->delete_contactperson($id);
        return $result;
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

    public function get_all_contactpersons(){
        $contacts_json = $this->document_model->get_all_contactpersons();
        return $contacts_json;
    }

    public function get_contact($id){
        $contact_json = $this->document_model->get_contact($id);
        return $contact_json;
    }

    public function update_documents_order(){
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach($order_array as $item){
            $db_array = array(
                'table_order' => $order
            );
            $this->document_model->modify_document($item, $db_array);
            $order += 10;
        }
    }

    public function update_contactperson_order(){
        $order_array = json_decode($this->input->post('string'));
        $order = 10;
        foreach($order_array as $item){
            $db_array = array(
                'table_order' => $order
            );
            $this->document_model->modify_contactperson($item, $db_array);
            $order += 10;
        }
    }
}