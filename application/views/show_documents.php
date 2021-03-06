<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/coreui.min.css">
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

<div ><!--class="app-body"-->
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">Allgemein</li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>users/users_view" class="nav-link">
                        <div class="nav-icon icon-people"></div>
                        Benutzerverwaltung
                    </a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a href="#" class="nav-link nav-dropdown-toggle">
                        <div class="nav-icon icon-people"></div>
                        Dokumente
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="<?php echo base_url();?>documents/create_document" class="nav-link">
                                <div class="nav-icon icon-people"></div>
                                Dokument erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url();?>documents/show_documents" class="nav-link active">
                                <div class="nav-icon icon-people"></div>
                                Dokumente anzeigen
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>users/logout" class="nav-link">
                        <div class="nav-icon icon-people"></div>
                        Abmelden
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Dokumente</li>
            <li class="breadcrumb-item active">Dokumente anzeigen</li>
        </ol>
        <div class="container-fluid">
        <?php
            $categories = json_decode($categories_json);
            $documents = json_decode($documents_json);

            foreach ($categories as $cat){
                $print_table = FALSE;
                foreach ($documents as $doc){
                    if($doc->category === $cat->id){
                        $print_table = TRUE;
                        break;
                    }
                }
                echo '<div class="card card-accent-primary">';
                    echo '<div class="card-header">'.$cat->name.'</div>';
                    echo '<div class="card-body" id="'.$cat->name.'">';
                    if($print_table) {
                        echo '<table class="table table-responsive-sm table-hover table-outline">';
                            echo '<thead class="thead-light">';
                                echo '<tr>';
                                    echo '<th>Technische Kennung</th>';
                                    echo '<th>Name</th>';
                                    echo '<th>Optionen</th>';
                                echo '<tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            foreach ($documents as $doc) {
                                if ($doc->category === $cat->id) {
                                    echo '<tr>';
                                        echo '<td>' . $doc->technische_kennung . '</td>';
                                        echo '<td>' . $doc->name . '</td>';
                                        echo '<td><a href="'.base_url().'documents/modify_document/'.$doc->id.'" class="btn btn-md btn-primary">Bearbeiten</a></td>';
                                    echo '</tr>';
                                }
                            }
                            echo '</tbody>';
                        echo '</table>';
                    } else echo 'Keine Einträge in dieser Kategorie';
                    echo '</div>';
                echo '</div>';
            }
        ?>


        </div>
    </main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
</body>
</html>