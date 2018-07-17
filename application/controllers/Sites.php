<?php
class Sites extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->show_sites();
    }

    public function show_sites(){
        if($this->session->userdata['logged_in'] == TRUE){
            $this->load->view('header');
            $this->load->view('show_sites');
        } else {
            redirect('users/login');
        }
    }

    public function create_site(){
        if($this->session->userdata['logged_in'] == TRUE){
            $this->load->view('header');
            $this->load->view('create_site');
        } else {
            redirect('users/login');
        }
    }

    public function create_new_site(){

    }
}