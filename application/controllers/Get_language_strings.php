<?php
class Get_language_strings extends CI_Controller{

    public function get_email_string(){
        $language_array['email_subject'] = 'Ihr Account bei uns.';
        $language_array['email_body'] = '<p>Vielen Dank für Ihre Registrierung!</p>
                                        <p>Ein Administartor wird sich in Kürze um Ihre Anfrage kümmern.</p>';

        return $language_array;
    }


}