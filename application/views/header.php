<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/coreui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/coreui-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flatpickr.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show sidebar-show">
<!--<header class="app-header navbar">
    <a href="#" class="navbar-brand">
        <div class="navbar-brand-full">Admin Dashboard</div>
        <div class="navbar-brand-minimized">Admin</div>
    </a>


    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
    </ul>
</header>-->
<div><!--class="app-body"-->
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">Allgemein</li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>users/users_view" class="nav-link">
                        <div class="nav-icon cui-puzzle"></div>
                        Benutzerverwaltung
                    </a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-puzzle"></div>
                        Dokumente
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/create_document" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Dokument erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/create_category" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Kategorie erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/show_documents" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Dokumente anzeigen
                            </a>
                        </li>
                    </ul>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-puzzle"></div>
                        Kontaktpersonen
                    </a>
                    <ul class="nav-dropdown-items">
                        <a href="<?php echo base_url(); ?>documents/create_contactperson" class="nav-link">
                            <div class="nav-icon cui-puzzle"></div>
                            Kontakt erstellen
                        </a>
                        <a href="<?php echo base_url(); ?>documents/show_contactpersons" class="nav-link">
                            <div class="nav-icon cui-puzzle"></div>
                            Kontakte anzeigen
                        </a>
                    </ul>
                </li>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-puzzle"></div>
                        News
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>news/create_news" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Beitrag erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>news/show_news" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                News anzeigen
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-puzzle"></div>
                        Seiten
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/create_page" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Seite erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/show_pages" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Seiten anzeigen
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-puzzle"></div>
                        FAQ
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>faq/create_faq" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                Frage erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>faq/show_faq" class="nav-link">
                                <div class="nav-icon cui-puzzle"></div>
                                FAQ anzeigen
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>users/logout" class="nav-link">
                        <div class="nav-icon cui-account-logout"></div>
                        Abmelden
                    </a>
                </li>

            </ul>

        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>