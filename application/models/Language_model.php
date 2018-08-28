<?php
class Language_model extends CI_Model{

    public function __construct()
    {
        //$this->load->database();
    }

    public function get_lang_strings_navbar(){
        $language_array['nav_group_1'] = 'Allgemein';
        $language_array['nav_group_2'] = 'Dokumente';
        $language_array['nav_group_3'] = 'Seiten';
        $language_array['nav_group_4'] = 'Sonstiges';
        $language_array['dashboard'] = 'Benutzerverwaltung';
        $language_array['documents'] = 'Dokumente';
        $language_array['documents_create'] = 'Dokument erstellen';
        $language_array['documents_show'] = 'Dokumente anzeigen';
        $language_array['category_create'] = 'Kategorie erstellen';
        $language_array['contacts'] = 'Kontakte';
        $language_array['contacts_create'] = 'Kontakt erstellen';
        $language_array['contacts_show'] = 'Kontakte anzeigen';
        $language_array['news'] = 'News';
        $language_array['news_create'] = 'News erstellen';
        $language_array['news_show'] = 'News anzeigen';
        $language_array['pages'] = 'Seiten';
        $language_array['pages_show'] = 'Seiten anzeigen';
        $language_array['pages_create'] = 'Seite erstellen';
        $language_array['faq'] = 'FAQ';
        $language_array['faq_show'] = 'FAQ anzeigen';
        $language_array['faq_create'] = 'FAQ erstellen';
        $language_array['logout'] = 'Abmelden';
        $language_array['rules'] = 'Goldene Regeln';
        $language_array['surveys'] = 'Umfragen';
        $language_array['surveys_create'] = 'Umfrage erstellen';
        $language_array['surveys_show'] = 'Umfragen Anzeigen';
        $language_array['surveys_results_show'] = 'Ergebnisse Anzeigen';
        $language_array['notifications_send'] = 'Push-Nachricht';

        return json_encode($language_array);
    }

    public function get_lang_strings_email(){
        $language_array['email_register_subject'] = 'Ihr Account bei uns.';
        $language_array['email_register_body'] = '<p>Vielen Dank für Ihre Registrierung!</p><p>Ein Administartor wird sich in Kürze um Ihre Anfrage kümmern.</p>';
        $language_array['email_declined_subject'] = 'Ihr Account wurde abgelehnt';
        $language_array['email_declined_body'] = 'Die Aktivierung Ihres Accounts wurde von einem Administrator abgelehnt. Bei Fragen erreichen Sie uns unter platzhalter@mail.de';
        $language_array['email_reset_body'] = 'Um Ihr passwort zurückzusetzen klicken Sie bitte auf den nachfolgenden Link. Falls Sie ihr Passwort nicht zurücksetzen möchten, ignorieren Sie diese Nachricht.</br></br>';
        $language_array['email_reset_subject'] = 'Passwort vergessen';
        $language_array['email_reset_link_text'] = 'Passwort zurücksetzen.';


        return json_encode($language_array);
    }

    public function get_lang_strings_users(){
        $language_array['user_register_error'] = '<div class="alert alert-warning">Beim Eintragen des Nutzers in die Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['user_login_pw'] = '<div class="alert alert-warning">Das angegebene Passwort ist falsch.</div>';
        $language_array['user_login_mail'] = '<div class="alert alert-warning">Die angegebene Email-Adresse existiert nicht.</div>';
        $language_array['register_email_unique'] = '<div class="alert alert-warning">Die angegebene Email-Adresse wird bereits verwendet.</div>';
        $language_array['register_valid_mail_error'] = '<div class="alert alert-warning">Sie müssen eine gültige Email-Adresse angeben.</div>';
        $language_array['pw_confirm_error'] = '<div class="alert alert-warning">Sie müssen das gleiche Passwort eingeben.</div>';
        $language_array['no_valid_email_error'] = '<div class="alert alert-warning">Sie müssen eine gültige Email-Adresse angeben.</div>';

        return json_encode($language_array);
    }

    public function get_lang_strings_news(){
        $language_array['news_formvalid_title'] = '<div class="alert alert-warning">Sie müssen einen Titel für den Beitrag angeben.</div>';
        $language_array['news_formvalid_content'] = '<div class="alert alert-warning">Sie müssen einen Inhalt für den Beitrag angeben.</div>';
        $language_array['news_create_error'] = '<div class="alert alert-error">Beim Speichern des Beitrags ist ein Fehler aufgetreten.</div>';
        $language_array['news_create_success'] = '<div class="alert alert-success">Der Beitrag wurde erfolgreich gespeichert.</div>';

        $language_array['card_header_create'] = 'News Beitrag erstellen';
        $language_array['card_header_mod'] = 'News Beitrag bearbeiten';
        $language_array['card_header_show'] = 'News';
        $language_array['form_title'] = 'Titel';
        $language_array['form_category'] = 'Kategorie';
        $language_array['form_content'] = 'Inhalt';
        $language_array['form_auth_level'] = 'Berechtigungsstufen';
        $language_array['form_img'] = 'Bilder (Optional, bis zu drei Bilder möglich)';
        $language_array['form_button_save'] = 'Speichern';
        $language_array['form_button_reset'] = 'Zurücksetzen';
        $language_array['button_delete'] = 'Löschen';
        $language_array['button_mod'] = 'Bearbeiten';
        $language_array['table_options'] = 'Optionen';
        $language_array['del_old_image'] = 'Dieses Bild entfernen';
        $language_array['push_title'] = 'Neuer Beitrag!';

        return json_encode($language_array);
    }

    public function get_lang_strings_pages(){
        $language_array['page_updated'] = '<div class="alert alert-success">Die Seite wurde erfolgreich angepasst.</div>';
        $language_array['page_update_error'] = '<div class="alert alert-danger">Es gab ein Problem beim Eintragen in die Datenbank.</div>';
        $language_array['page_created'] = '<div class="alert alert-success">Die Seite wurde erfolgreich erstellt.</div>';
        $language_array['page_create_error'] = '<div class="alert alert-danger">Beim Eintragen der Seite in die Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['page_deleted'] = '<div class="alert alert-success">Die Seite wurde erfolgreich gelöscht.</div>';
        $language_array['page_create_error'] = '<div class="alert alert-danger">Beim Löschen der Seite aus der Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['page_not_unique'] = '<div class="alert alert-danger">Dieser Name ist bereits vergeben.</div>';
        $language_array['page_name_req'] = '<div class="alert alert-danger">Sie müssen einen Namen angeben.</div>';
        $language_array['page_content_req'] = '<div class="alert alert-danger">Sie müssen Inhalt angeben.</div>';
        $language_array['page_date_req'] = '<div class="alert alert-danger">Sie müssen ein Datum angeben.</div>';

        $language_array['card_header_create'] = 'Seite erstellen';
        $language_array['card_header_mod'] = 'Seite bearbeiten';
        $language_array['card_header_show'] = 'Alle Seiten';
        $language_array['form_name'] = 'Name';
        $language_array['form_date'] = 'Erstelldatum';
        $language_array['form_content'] = 'Inhalt';
        $language_array['form_img'] = 'Bild';
        $language_array['form_button_save'] = 'Speichern';
        $language_array['form_button_reset'] = 'Zurücksetzen';
        $language_array['table_options'] = 'Optionen';
        $language_array['table_button_mod'] = 'Bearbeiten';
        $language_array['table_button_delete'] = 'Löschen';
        $language_array['del_old_image'] = 'Dieses Bild entfernen';

        return json_encode($language_array);
    }

    public function get_lang_strings_documents(){
        $language_array['cat_created'] = '<div class="alert alert-success">Die Kategorie wurde erfolgreich erstellt.</div>';
        $language_array['cat_created_error'] = '<div class="alert alert-danger">Beim Erstellen der Kategorie ist ein Fehler aufgetreten.</div>';
        $language_array['cat_updated'] = '<div class="alert alert-success">Die Kategorie wurde erfolgreich bearbeitet.</div>';
        $language_array['cat_not_unique'] = '<div class="alert alert-danger">Diese Kategorie existiert bereits. Geben Sie bitte einen anderen Namen an oder verwenden die existierenden Kategorien.</div>';
        $language_array['contact_created'] = '<div class="alert alert-success">Die Kontaktperson wurde erfolgreich hinzugefügt.</div>';
        $language_array['contact_create_error'] = '<div class="alert alert-danger">Beim Eintragen der Kontaktperson in die Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['doc_created'] = '<div class="alert alert-success">Das Dokument wurde erfolgreich erstellt.</div>';
        $language_array['doc_create_error'] = '<div class="alert alert-danger">Beim Eintragen des Dokuments in die Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['doc_modified'] = '<div class="alert alert-success">Das Dokument wurde erfolgreich angepasst.</div>';
        $language_array['doc_modify_error'] = '<div class="alert alert-danger">Beim Eintragen der Änderungen in die Datenbank ist ein Fehler aufgetreten.</div>';

        return json_encode($language_array);
    }

    public function get_lang_strings_document_create(){
        $language_array['name_not_unique'] = '<div class="alert alert-danger">Dieser Name ist bereits vergeben.</div>';
        $language_array['tech_not_unique'] = '<div class="alert alert-danger">Diese Technische Kennung ist bereits vergeben.</div>';
        $language_array['name_required'] = '<div class="alert alert-warning">Sie müssen einen Namen anbeben.</div>';
        $language_array['tech_required'] = '<div class="alert alert-warning">Sie müssen eine Technische Kennung angeben.</div>';
        $language_array['checked_by_required'] = '<div class="alert alert-warning">Sie müssen das Feld "Geprüft von" ausfüllen.</div>';
        $language_array['content_required'] = '<div class="alert alert-warning">Sie müssen einen Inhalt angeben.</div>';

        $language_array['card_header'] = 'Dokument erstellen';
        $language_array['card_header_mod'] = 'Dokument bearbeiten';
        $language_array['form_name'] = 'Name';
        $language_array['form_category'] = 'Kategorie';
        $language_array['form_tech'] = 'Technische Kennung';
        $language_array['form_date'] = 'Erstellungsdatum';
        $language_array['form_checked_by'] = 'Geprüft von';
        $language_array['form_contact'] = 'Kontaktperson';
        $language_array['form_text'] = 'Freitext';
        $language_array['form_img'] = 'Bilder (Optional, bis zu drei Bilder möglich)';
        $language_array['form_button_save'] = 'Speichern';
        $language_array['form_button_reset'] = 'Zurücksetzen';
        $language_array['no_contacts'] = 'Keine Kontaktpersonen gefunden!';
        $language_array['contacts_list'] = 'Keine Kontaktperson ausgewählt';
        $language_array['del_old_image'] = 'Dieses Bild entfernen';

        return json_encode($language_array);
    }

    public function get_lang_strings_document_show(){
        $language_array['table_tech'] = 'Technische Kennung';
        $language_array['table_name'] = 'Name';
        $language_array['table_date'] = 'Erstelldatum';
        $language_array['table_options'] = 'Otionen';
        $language_array['button_mod'] = 'Bearbeiten';
        $language_array['button_delete'] = 'Löschen';
        $language_array['no_entries'] = 'Keine Einträge in dieser Kategorie';

        return json_encode($language_array);
    }

    public function get_lang_strings_categories(){
        $language_array['card_header_create'] = 'Kategorie erstellen';
        $language_array['card_header_show'] = 'Kategorien';
        $language_array['table_category'] = 'Kategorie';
        $language_array['table_options'] = 'Optionen';
        $language_array['button_delete'] = 'Löschen';
        $language_array['button_mod'] = 'Bearbeiten';
        $language_array['form_name'] = 'Name';
        $language_array['form_button_save'] = 'Speichen';
        $language_array['form_button_reset'] = 'Zurücksetzen';
        $language_array['no_entries'] = 'Keine Einträge.';

        return json_encode($language_array);
    }

    public function get_lang_strings_contacts(){
        $language_model['card_header'] = 'Ansprechpartner erstellen';
        $language_model['card_header_mod'] = 'Ansprechpartner bearbeiten';
        $language_model['card_header_show'] = 'Ansprechpartner';
        $language_model['form_name'] = 'Name';
        $language_model['form_position'] = 'Position';
        $language_model['form_tel'] = 'Tel./Mobil';
        $language_model['form_contact_area'] = 'Kontaktbereich';
        $language_model['form_img'] = 'Kontaktbild';
        $language_model['form_button_save'] = 'Speichern';
        $language_model['form_button_reset'] = 'Zurücksetzen';
        $language_model['table_options'] = 'Optionen';
        $language_model['button_delete'] = 'Löschen';
        $language_model['button_mod'] = 'Bearbeiten';
        $language_model['del_old_image'] = 'Dieses Bild entfernen';

        return json_encode($language_model);
    }

    public function get_lang_strings_faq(){
        $language_array['faq_rules_question'] = '<div class="alert alert-warning">Sie müssen eine Frage angeben.</div>';
        $language_array['faq_rules_answer'] = '<div class="alert alert-warning">Sie müssen eine Antwort angeben.</div>';
        $language_array['faq_created'] = '<div class="alert alert-success">Die Frage wurde erfolgreich erstellt.</div>';
        $language_array['faq_create_error'] = '<div class="alert alert-danger">Beim Eintragen in die Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['faq_modified'] = '<div class="alert alert-success">Die Frage wurde erfolgreich bearbeitet.</div>';
        $language_array['faq_modify_error'] = '<div class="alert alert-danger">Beim Eintragen der Änderungen in die Datenbank ist ein Fehler aufgetreten.</div>';

        $language_array['card_header_create'] = 'Frage erstellen';
        $language_array['card_header_mod'] = 'Frage bearbeiten';
        $language_array['card_header_show'] = 'FAQs';
        $language_array['form_question'] = 'Frage';
        $language_array['form_content'] = 'Antwort';
        $language_array['form_button_save'] = 'Speichern';
        $language_array['form_button_reset'] = 'Zurücksetzen';
        $language_array['button_mod'] = 'Bearbeiten';
        $language_array['button_delete'] = 'Löschen';

        return json_encode($language_array);
    }

    public function get_lang_strings_login(){
        $language_array['login_text_email'] = 'E-MAIL';
        $language_array['login_text_password'] = 'PASSWORT';
        $language_array['login_text_head'] = 'Melden Sie sich mit Ihrem Account an.';
        $language_array['login_text_button'] = 'ANMELDEN';
        $language_array['login_forgot_password'] = 'Passwort vergessen?';
        $language_array['login_reg_text_headline'] = 'Registrieren Sie sich';
        $language_array['login_reg_text_head'] = 'Sie haben noch keinen Account bei uns? Registrieren Sie sich.';
        $language_array['login_reg_text_button'] = 'Registrieren Sie sich jetzt!';

        return json_encode($language_array);
    }

    public function get_lang_strings_register(){
        $language_array['register_text_headline'] = 'Registrierung';
        $language_array['register_text_head'] = 'Erstellen Sie Ihren Account';
        $language_array['register_text_firstname'] = 'Vorname';
        $language_array['register_text_lastname'] = 'Nachname';
        $language_array['register_text_password'] = 'Passwort';
        $language_array['register_text_cpassword'] = 'Passwort wiederholen';
        $language_array['register_text_rbutton'] = 'REGISTRIEREN';
        $language_array['register_text_lbutton'] = 'Zurück zum Login';

        return json_encode($language_array);
    }

    public function get_lang_strings_dashboard(){
        $language_array['card_header_pending'] = 'Nicht aktivierte Accounts';
        $language_array['card_header_active'] = 'Aktivierte Accounts';
        $language_array['card_header_declined'] = 'Abgelehnte Accounts';
        $language_array['table_header_firstname'] = 'Name';
        $language_array['table_header_lastname'] = 'Nachname';
        $language_array['table_header_email'] = 'Email';
        $language_array['table_header_date'] = 'Registrierungsdatum';
        $language_array['table_header_type'] = 'Accounttyp';
        $language_array['table_header_last_login'] = 'Letzter Login';
        $language_array['table_header_options'] = 'Optionen';
        $language_array['table_button_add'] = 'Hinzufügen';
        $language_array['table_button_decline'] = 'Ablehnen';
        $language_array['table_button_mod'] = 'Bearbeiten';

        return json_encode($language_array);
    }

    public function get_lang_strings_update_user(){
        $language_array['form_button_save'] = 'Speichern';
        $language_array['form_button_reset'] = 'Zurücksetzen';
        $language_array['form_name'] = 'Vorname';
        $language_array['form_lastname'] = 'Nachname';
        $language_array['form_type'] = 'Account Typ';
        $language_array['form_email'] = 'Email-Adresse';
        $language_array['card_header_mod'] = 'Nutzer bearbeiten';

        $language_array['email_required'] = '<div class="alert alert-warning">Sie müssen eine gültige Email-Adresse eingeben.</div>';
        $language_array['name_required'] = '<div class="alert alert-warning">Sie müssen einen Namen eingeben.</div>';
        $language_array['lastname_required'] = '<div class="alert alert-warning">Sie müssen einen Nachnamen eingeben.</div>';

        return json_encode($language_array);
    }

    public function get_lang_strings_reset_password(){
        $language_array['reset_text_password'] = 'Passwort';
        $language_array['reset_text_cpassword'] = 'Passwort bestätigen';
        $language_array['reset_card_header'] = 'Passwort zurücksetzen';
        $language_array['reset_text_head'] = 'Geben Sie ein neues Passwort ein.';
        $language_array['reset_text_button'] = 'Zurücksetzen';
        $language_array['reset_text_button_email'] = 'Abschicken';
        $language_array['reset_text_email'] = 'E-Mail';
        $language_array['reset_text_head_email'] = 'Geben Sie Ihre E-Mail Adresse ein.';
        $language_array['email_card_header'] = 'Passwort vergessen';
        $language_array['reset_text_back_link'] = 'Zurück zum Login.';

        $language_array['pw_confirm_error'] = '<div class="alert alert-warning">Die eingegebenen Passwörter müssen übereinstimmen.</div>';
        $language_array['pw_error'] = '<div class="alert alert-warning">Sie müssen ein Passwort eingeben.</div>';
        $language_array['cpw_error'] = '<div class="alert alert-warning">Sie müssen das Passwort bestätigen.</div>';
        $language_array['email_error'] = '<div class="alert alert-warning">Sie müssen Ihre E-Mail Adresse eingeben.</div>';
        $language_array['email_valid_error'] = '<div class="alert alert-warning">Sie müssen eine gültige E-Mail Adresse eingeben.</div>';
        $language_array['pw_reset_success'] = '<div class="alert alert-success">Ihr Passwort wurde erfolgreich geändert. Sie können sich jetzt einloggen.</div>';
        $language_array['pw_reset_error'] = '<div class="alert alert-danger">Beim Zurücksetzen Ihres Passwortes ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.</div>';

        return json_encode($language_array);
    }

    public function get_lang_strings_rules(){
        $language_array['breadcrumb_1'] = 'Admin';
        $language_array['breadcrumb_2'] = 'Goldene Regeln';
        $language_array['card_header_show'] = 'Goldene Regeln';
        $language_array['card_header_add'] = 'Regel hinzufügen';
        $language_array['table_number'] = 'Nummer';
        $language_array['table_icon'] = 'Icon';
        $language_array['table_text'] = 'Regel';
        $language_array['table_options'] = 'Optionen';
        $language_array['form_label_rule'] = 'Regel';
        $language_array['form_label_image'] = 'Bild';
        $language_array['form_button_save'] = 'Speichern';
        $language_array['table_button_delete'] = 'Löschen';
        $language_array['create_success'] = '<div class="alert alert-success">Die Regel wurde gespeichert</div>';
        $language_array['create_error'] = '<div class="alert alert-danger">Beim Eintragen der Regel in die Datenbank ist ein Fehler aufgetreten.</div>';
        $language_array['rule_field_required'] = '<div class="alert alert-warning">Sie müssen eine Regel eingeben.</div>';

        return json_encode($language_array);
    }

    public function get_lang_strings_surveys(){
        $language_array['breadcrumb_1'] = 'Admin';
        $language_array['breadcrumb_2'] = 'Umfragen';
        $language_array['breadcrumb_3'] = 'Umfrage erstellen';
        $language_array['breadcrumb_4'] = 'Umfragen anzeigen';
        $language_array['breadcrumb_5'] = 'Ergebnis';
        $language_array['card_header_create'] = 'Neue Umfrage erstellen';
        $language_array['card_header_show'] = 'Umfragen anzeigen';
        $language_array['form_question'] = 'Frage';
        $language_array['form_answer'] = 'Antwort';
        $language_array['button_add_answer'] = 'Antwort hinzufügen';
        $language_array['button_reset'] = 'Zurücksetzen';
        $language_array['button_save'] = 'Speichern';
        $language_array['button_delete'] = 'Löschen';
        $language_array['button_switch'] = 'Rating Umfrage';
        $language_array['button_switch_back'] = 'Multiple Choice Umfrage';
        $language_array['form_auth_level'] = 'Berechtigte Nutzergruppen';
        $language_array['form_image'] = 'Bild einfügen (Optional)';
        $language_array['switch_label'] = 'Benachrichtigung versenden';
        $language_array['push_title'] = 'Neue Umfrage!';
        $language_array['table_head_img'] = 'Bild';
        $language_array['table_head_question'] = 'Frage';
        $language_array['table_head_type'] = 'Umfragentyp';
        $language_array['table_head_date'] = 'Erstellungsdatum';
        $language_array['table_head_options'] = 'Optionen';
        $language_array['survey_type_mc'] = 'Multiple Choice';
        $language_array['survey_type_r'] = 'Rating';
        $language_array['table_button_results'] = 'Ergebnisse anzeigen';
        $language_array['button_back'] = 'Zurück';
        $language_array['result_card_body_header'] = 'Ergbniss:';
        $language_array['table_head_votes'] = 'Eingegangene Votes / Teilnehmer';
        $language_array['survey_created'] = '<div class="alert alert-success">Die Umfrage wurde erfolgreich erstellt</div>';
        $language_array[''] = '';

        return json_encode($language_array);
    }

    public function get_lang_strings_notifications(){
        $language_array['breadcrumb_1'] = 'Admin';
        $language_array['breadcrumb_2'] = 'Push-Nachricht senden';
        $language_array['form_title'] = 'Titel eingeben';
        $language_array['form_body'] = 'Nachricht eingeben';
        $language_array['form_button_send'] = 'Nachricht senden';
        $language_array['card_header'] = 'Push-Nachricht senden';
        $language_array['form_auth_level'] = 'Nutzergruppen';
        $language_array['error_title_required'] = '<div class="alert alert-warning">Sie müssen einen Titel angeben.</div>';
        $language_array['error_message_required'] = '<div class="alert alert-warning">Sie müssen eine Nachricht angeben.</div>';
        $language_array['send_success'] = '<div class="alert alert-success">Die Nachricht wurde versendet.</div>';
        $language_array['send_error'] = '<div class="alert alert-danger">Beim Senden der Nachricht ist ein Fehler aufgetreten.</div>';
        $language_array[''] = '';

        return json_encode($language_array);
    }
}