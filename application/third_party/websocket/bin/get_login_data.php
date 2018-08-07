<?php


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class get_login_data implements MessageComponentInterface{
    public function __construct()
    {
    }

    public function index(){
        //echo json_encode('test');
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // TODO: Implement onMessage() method.
        echo $msg;
        //Users::remote_login($msg);
    }

    public function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
        echo json_encode('test');
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
        echo json_encode('An error occured.');
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // TODO: Implement onOpen() method.
        echo json_encode('success');
    }
}