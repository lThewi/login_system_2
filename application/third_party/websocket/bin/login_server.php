<?php
require __DIR__ . "/../vendor/autoload.php";
require 'get_login_data.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$login_server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new get_login_data()
        )
    ),8080
);

$login_server->run();