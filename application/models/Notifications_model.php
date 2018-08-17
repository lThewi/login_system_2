<?php
class Notifications_model extends CI_Model{
    public function  __construct()
    {
        $this->load->database();
        $this->load->library('xmlrpc');
        $this->load->library('xmlrpcs');
    }

    public function insert_device($token, $user_id){
        $db_array = array(
            'token' => $token,
            'user_id' => $user_id,
        );

        $query = $this->db->insert('push_devices', $db_array);

        if($query) {
            return json_encode($token);
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

    public function push_message_to_all($a_token, $message){
        $device_tokens = json_decode($this->get_all_device_tokens());
        $firebase_path = 'https://fcm.googleapis.com/fcm/send';
        $access_token = $a_token;

        foreach ($device_tokens as $token) {
            $headers = array(
            'Authorization: Bearer '. $access_token,//self::$API_SERVER_KEY,
            'Content-Type:application/x-www-form-urlencoded'
        );
            $fields = array(
                'to' => $token->token,
                'priority' => 10,
                'notification' => array('title' => 'Message Test', 'body' =>  $message ,'sound'=>'Default' ),
            );
            // Open connection
            $ch = curl_init();
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $firebase_path);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            // Execute post
            $result = curl_exec($ch);
            // Close connection
            curl_close($ch);
            echo $result;

        }
    }

    public function requestAccess(){
        $acces_token = 0;
        $path = 'https://appproject-112eb.firebaseapp.com/__/auth/handler';
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $path);
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);

        return $result;
    }
}