<?php
class Language_model extends CI_Model{
    public $language_array;

    public function __construct()
    {
        //$this->load->database();
    }

    public function get_lang_strings_email(){
        $language_array['email_register_subject'] = 'Ihr Account bei uns.';
        $language_array['email_register_body'] = '<p>Vielen Dank für Ihre Registrierung!</p><p>Ein Administartor wird sich in Kürze um Ihre Anfrage kümmern.</p>';
        $language_array['email_declined_subject'] = 'Ihr Account wurde abgelehnt';
        $language_array['email_declined_body'] = 'Die Aktivierung Ihres Accounts wurde von einem Administrator abgelehnt. Bei Fragen erreichen Sie uns unter platzhalter@mail.de';


        return json_encode($language_array);
    }
}