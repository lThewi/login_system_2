<?php
class News_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_news($data){
        $result = $this->db->insert('news', $data);
        return json_encode($result);
    }

    public function get_all_news(){
        $this->db->order_by('table_order', 'ASC');
        $result = $this->db->get('news');
        return json_encode($result->result());
    }

    public function get_news_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('news');
        return json_encode($result->result());
    }

    public function get_category_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('news_categories');

        return json_encode($query->result());
    }

    public function get_all_categories(){
        $this->db->order_by('table_order', 'ASC');
        $result = $this->db->get('news_categories');
        return json_encode($result->result());
    }

    public function create_category($name){
        $db_array = array(
            'name' => $name
        );

        $query = $this->db->insert('news_categories', $db_array);
        return json_encode($query);
    }

    public function update_category($id, $name){
        $data = array(
            'name' => $name
        );
        $this->db->where('id', $id);
        $result = $this->db->update('news_categories', $data);
        return json_encode($result);
    }

    public function update_category_order($id, $data){
        $this->db->where('id', $id);
        $result = $this->db->update('news_categories', $data);
        return json_encode($result);
    }

    public function delete_category($id){
        $this->db->where('id', $id);
        $query = $this->db->delete('news_categories');

        return json_encode($query);
    }

    public function update_news($id, $data){
        $this->db->where('id', $id);
        $result = $this->db->update('news', $data);
        return json_encode($result);
    }

    public function delete_news($id){
        $this->db->where('id', $id);
        $result = $this->db->delete('news');
        return json_encode($result);
    }

    public function get_ten_news_items($current_id, $auth){
        $this->db->join('news_auth','news_auth.news_id = news.id');
        $this->db->where('news_auth.auth_id', $auth);
        $result = $this->db->limit(10, $current_id)->get('news');
        return json_encode($result->result());
    }

    public function get_news_auths_by_news_id($news_id){
        $this->db->where('news_id', $news_id);
        $query = $this->db->get('news_auth');

        return json_encode($query->result());
    }

    public function get_all_news_auths(){
        $query = $this->db->get('news_auth');

        return json_encode($query->result());
    }

    public function get_current_news_id(){
        $this->db->order_by('id', 'DESC');
        $this->db->select('id');
        $query = $this->db->get('news',0, 1);

        return json_encode($query->result());
    }

    public function check_for_auth($news_id, $auth_id){
        $this->db->where('news_id', $news_id);
        $this->db->where('auth_id', $auth_id);
        $query = $this->db->get('news_auth');

        return json_encode($query->result());
    }

    public function add_news_auth($user_type){
        $latest_news = json_decode($this->get_current_news_id());
        $check = json_decode($this->check_for_auth($latest_news[0]->id, $user_type));
        $db_array = array(
            'news_id' => $latest_news[0]->id,
            'auth_id' => $user_type
        );
        if(count($check) == 0){
            $result = $this->db->insert('news_auth', $db_array);
        } else {
            $result = false;
        }

        return $result;
    }

    public function delete_news_auths_by_news_id($news_id){
        $this->db->where('news_id', $news_id);
        $query = $this->db->delete('news_auth');

        return json_encode($query);
    }

    public function delete_news_auth($news_id, $auth_id){
        $this->db->where('news_id', $news_id);
        $this->db->where('auth_id', $auth_id);
        $query = $this->db->delete('news_auth');

        return json_encode($query);
    }
}