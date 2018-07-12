<?php
class Language_model extends CI_Model{
    public function __construct()
    {
        //$this->load->database();
    }

    public function get_lang_strings_de(){
        $language_array['email_subject'] = 'Ihr Account bei uns.';
        $language_array['email_body'] = '<p>Vielen Dank für Ihre Registrierung!</p><p>Ein Administartor wird sich in Kürze um Ihre Anfrage kümmern.</p>';


        return json_encode($language_array);
    }
}