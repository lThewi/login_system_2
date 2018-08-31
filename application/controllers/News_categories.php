<?php 

class News_categories extends CI_Controller{
      public function index(){
            
      }

      public function create_category($id = ''){
            if($this->session->userdata('logged_in') == true){
                  //get/set data
                  $header['strings_json'] = $this->language_model->get_lang_strings_navbar();
                  $data['strings_json'] = $this->language_model->get_lang_strings_categories();
                  $data['categories'] = $this->news_model->get_all_categories();
                  $data['category'] = null;
                  $data['form_func'] = 'news_categories/create_category';

                  if($id != ''){
                        $data['category'] = $this->news_model->get_category_by_id($id);
                        $data['form_func'] = 'news_categories/update_category';
                  }

                  $strings = json_decode($data['strings_json']);

                  //set rules
                  $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[news_categories.name]', array('required' => $strings->required, 'is_unique' => $strings->not_unique));

                  if(!$this->form_validation->run()){
                        $this->load->view('header', $header);
                        $this->load->view('news/news_categories', $data);
                  } else {
                        $name = $this->input->post('name');
                        $this->update_news_category_order();
                        $result = json_decode($this->news_model->create_category($name));

                        if($result == true){
                              $this->session->set_flashdata('category', $strings->create_success);
                              redirect('news_categories/create_category');
                        } else {
                              $this->session->set_flashdata('category', $strings->create_error);
                              redirect('news_categories/create_category');
                        }
                  }
            } else {
                  redirect('users/login');
            }
      }

      public function update_category(){
            if($this->session->userdata('logged_in') == true){
                  $cat_id = $this->input->post('cat_id');
                  $name = $this->input->post('name');

                  $result = $this->news_model->update_category($cat_id, $name);
                  $strings = json_decode($this->language_model->get_lang_strings_documents());

                  if($result == 'true'){
                        $this->session->set_flashdata('updated_category', $strings->cat_updated);
                        redirect('news_categories/create_category');
                  } else {
                        $this->session->set_flashdata('updated_category', $strings->cat_update_error);
                        redirect('news_categories/create_category');
                  }
            } else {
                  redirect('users/login');
            }
      }

      public function delete_category($id){
            $result = $this->news_model->delete_category($id);
            if($result == 'true'){
                  $this->session->set_flashdata('updated_category', $strings->cat_updated);
                  redirect('news_categories/create_category');
            } else {
                  $this->session->set_flashdata('updated_category', $strings->cat_updated);
                  redirect('news_categories/create_category');
            }
      }

      public function update_news_category_order(){
            if(isset($_POST['string'])){
                  $order_array = json_decode($this->input->post('string'));
            } else {
                  $result = json_decode($this->news_model->get_all_categories());
                  foreach($result as $item){
                        $order_array[] = $item->id;
                  }
            }
            $order = 10;
            foreach($order_array as $item){
                  $db_array = array(
                        'table_order' => $order
                  );
                  $result = $this->news_model->update_category_order($item, $db_array);
                  $order += 10;
            }
      }
}