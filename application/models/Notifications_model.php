<?php
require_once 'vendor/autoload.php';

class Notifications_model extends CI_Model{
    public function  __construct()
    {
        $this->load->database();
        $this->load->library('xmlrpc');
        $this->load->library('xmlrpcs');
        
        putenv('GOOGLE_APPLICATION_CREDENTIALS=AppProject-5365c8dcaae1.json');
        $this->firebase_path = 'https://fcm.googleapis.com/v1/projects/appproject-112eb/messages:send';
        $this->client = new Google_Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->addScope('https://www.googleapis.com/auth/cloud-platform','https://www.googleapis.com/auth/firebase.messaging');
        $this->httpClient = $this->client->authorize();
    }

    public function insert_device($token, $user_id){
        $db_array = array(
            'token' => $token,
            'user_id' => $user_id,
        );
        $this->db->where('user_id', $user_id);
        $this->db->where('token', $token);
        $query_check = $this->db->get('push_devices');

        if($query_check->num_rows() == 0){
            $query = $this->db->insert('push_devices', $db_array);

            if($query) {
                return json_encode($token);
            } else {
                return json_encode(false);
            }
        } else {
            return json_encode(false);
        }
    }

    public function get_device_tokens_by_user($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('push_devices');

        return json_encode($query->result());
    }

    public function get_all_device_tokens(){
        $this->db->select('token');
        $query = $this->db->get('push_devices');

        return json_encode($query->result());
    }

    public function get_auth_name($auth_id){
        $this->db->where('id', $auth_id);
        $query = $this->db->get('user_types');

        return json_encode($query->result());
    }

    public function get_devices_by_user_type($user_type){
        $array = array();
        $this->db->where('acc_type_id', $user_type);
        $users = $this->db->get('users');
        foreach ($users as $user){
            $query = $this->get_device_tokens_by_user($user->id);
            $array[] = $query->result();
        }
        return json_encode($array);
    }

    public function push_message_to_all($title, $body){
        $device_tokens = json_decode($this->get_all_device_tokens());

        $this->push_message_to_token($device_tokens, $title, $body);
    }

    public function push_message_to_user($user_id, $title, $body){
        $device_tokens = json_decode($this->get_device_tokens_by_user($user_id));

        $this->push_message_to_token($device_tokens, $title, $body);
    }

    public function push_message_to_token($device_tokens, $title, $body){
        foreach ($device_tokens as $token) {
            $message = array(
                'message'=> array(
                    'token' => $token->token,
                    'notification' => array(
                        'title' => $title,
                        'body' => $body
                    )
                )
            );

            $response = $this->httpClient->post($this->firebase_path, array('json'=>$message));
            echo json_encode($response);
        }
    }

    public function push_message_to_topic($topic, $title, $body){
        $message = array(
            'message'=> array(
                'topic' => $topic,
                'notification' => array(
                    'title' => $title,
                    'body' => $body
                )
            )
        );

        $response = $this->httpClient->post($this->firebase_path, array('json'=>$message));
        echo json_encode($response);
    }
}