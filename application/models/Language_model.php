<?php
class Language_model extends CI_Model{

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

    public function get_lang_strings_news(){
        $language_array['news_formvalid_title'] = '<div class="alert alert-warning">Sie müssen einen Titel für den Beitrag angeben.</div>';
        $language_array['news_formvalid_content'] = '<div class="alert alert-warning">Sie müssen einen Inhalt für den Beitrag angeben.</div>';
        $language_array['news_create_error'] = 'Beim Speichern des Beitrags ist ein Fehler aufgetreten.';
        $language_array['news_create_success'] = 'Der Beitrag wurde erfolgreich gespeichert.';

        return json_encode($language_array);
    }
}