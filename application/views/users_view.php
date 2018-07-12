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
                    <a href="<?php echo base_url(); ?>users/users_view" class="nav-link active">
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
                            <a href="<?php echo base_url();?>documents/show_documents" class="nav-link">
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
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Nicht aktivierte Accounts
                </div>
                <div class="card-body" id="pending-users">
                    <?php echo form_open('users/add_multiple_users') ?>
                    <table class="table table-responsive-sm table-hover table-outline">
                        <thead class="thead-light">
                        <tr>
                            <th><!--<label><input type="checkbox" id="check-all"></label>--></th>
                            <th><strong>Name</strong></th>
                            <th><strong>Nachname</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Accounttyp</strong></th>
                        </tr>
                        </thead>

                        <?php
                        $user_types = json_decode($user_types_json);
                        $temp_users = json_decode($temp_users_json);
                        foreach ($user_types as $user_type) {
                            $types[$user_type->id] = $user_type->name;
                        }
                        foreach ($temp_users as $temp_user) {
                            $dropdown_name = $temp_user->id;
                            echo '<tr>
                                <td>'. form_checkbox('row[]', $temp_user->id, FALSE) .'</td>
                                <td>'. $temp_user->name .'</td>
                                <td>'. $temp_user->lastname .'</td>
                                <td>'. $temp_user->email .'</td>
                                <td>'. form_dropdown($dropdown_name, $types, 2, array('class' => 'form-control')) .'</td>
                                </tr>';
                        }
                        ?>
                    </table>
                    <input type="submit" value="Hinzufügen" class="btn btn-lg btn-primary">
                    <?php echo form_close() ?>
                </div>
            </div>
            <div class="card card-accent-primary">
                <div class="card-header">
                    Aktivierte Accounts
                </div>
                <div class="card-body" id="users">
                    <table class="table table-responsive-sm table-hover table-outline">
                        <thead class="thead-light">
                        <tr>
                            <th><strong>Name</strong></th>
                            <th><strong>Nachname</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Accounttyp</strong></th>
                        </tr>
                        </thead>

                        <?php
                        $users = json_decode($users_json);
                        foreach ($users as $user) {
                            echo '<tr>
                                <td>'. $user->name .'</td>
                                <td>'. $user->lastname .'</td>
                                <td>'. $user->email .'</td>
                                <td>'. $user->acc_type_id .'</td>
                                </tr>';
                        }?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
</body>
</html>