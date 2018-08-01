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
<?php $strings = json_decode($strings_json) ?>
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="#" class="navbar-brand">
        <div class="navbar-brand-full">Admin Dashboard</div>
        <div class="navbar-brand-minimized">Admin</div>
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none mr-auto" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!--<ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
    </ul>-->
</header>
<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title"><?php echo $strings->nav_group_1 ?></li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>users/users_view" class="nav-link">
                        <div class="nav-icon cui-dashboard"></div>
                        <?php echo $strings->dashboard ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>rules/show_rules" class="nav-link">
                        <div class="nav-icon cui-list"></div>
                        <?php echo $strings->rules ?>
                    </a>
                </li>
                <li class="nav-title"><?php echo $strings->nav_group_2 ?></li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-file"></div>
                        <?php echo $strings->documents ?>
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/create_document" class="nav-link">
                                <div class="nav-icon cui-file"></div>
                                <?php echo $strings->documents_create ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/show_documents" class="nav-link">
                                <div class="nav-icon cui-file"></div>
                                <?php echo $strings->documents_show ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/create_category" class="nav-link">
                                <div class="nav-icon cui-file"></div>
                                <?php echo $strings->category_create ?>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-user"></div>
                        <?php echo $strings->contacts ?>
                    </a>
                    <ul class="nav-dropdown-items">
                        <a href="<?php echo base_url(); ?>documents/create_contactperson" class="nav-link">
                            <div class="nav-icon cui-user-follow"></div>
                            <?php echo $strings->contacts_create ?>
                        </a>
                        <a href="<?php echo base_url(); ?>documents/show_contactpersons" class="nav-link">
                            <div class="nav-icon cui-user"></div>
                            <?php echo $strings->contacts_show ?>
                        </a>
                    </ul>
                </li>
                </li>
                <li class="nav-title"><?php echo $strings->nav_group_3 ?></li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-globe"></div>
                        <?php echo $strings->news ?>
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>news/create_news" class="nav-link">
                                <div class="nav-icon cui-globe"></div>
                                <?php echo $strings->news_create ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>news/show_news" class="nav-link">
                                <div class="nav-icon cui-globe"></div>
                                <?php echo $strings->news_show ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-layers"></div>
                        <?php echo $strings->pages ?>
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/create_page" class="nav-link">
                                <div class="nav-icon cui-layers"></div>
                                <?php echo $strings->pages_create ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/show_pages" class="nav-link">
                                <div class="nav-icon cui-layers"></div>
                                <?php echo $strings->pages_show ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon cui-info"></div>
                        <?php echo $strings->faq ?>
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>faq/create_faq" class="nav-link">
                                <div class="nav-icon cui-info"></div>
                                <?php echo $strings->faq_create ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>faq/show_faq" class="nav-link">
                                <div class="nav-icon cui-info"></div>
                                <?php echo $strings->faq_show ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-title"><?php echo $strings->nav_group_4 ?></li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>users/logout" class="nav-link">
                        <div class="nav-icon cui-account-logout"></div>
                        <?php echo $strings->logout ?>
                    </a>
                </li>

            </ul>

        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>