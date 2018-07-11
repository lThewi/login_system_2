<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/coreui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flatpickr.min.css">
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
                            <a href="<?php echo base_url(); ?>documents/create_document" class="nav-link active">
                                <div class="nav-icon icon-people"></div>
                                Dokument erstellen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>documents/show_documents" class="nav-link">
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
            <li class="breadcrumb-item active">Dokument erstellen</li>
        </ol>
        <div class="container-fluid">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Dokument erstellen
                </div>
                <?php echo form_open_multipart('documents/create'); ?>
                <div class="card-body">
                    <?php
                        $categories = json_decode($categories_json);
                        foreach ($categories as $cat){
                            $category_list[$cat->id] = $cat->name;
                        }
                    ?>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="category">Kategorie</label>
                            <?php echo form_dropdown('categories', $category_list, 1, array('class' => 'form-control', 'id' => 'category')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="tech">Technische Kennung</label>
                            <input type="text" id="tech" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="days">Erstellungsdatum</label>
                            <input type="text" class="flatpickr flatpickr-input form-control input" placeholder="Datum auswählen" readonly="readonly" tabindex="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="checked_by">Geprüft von</label>
                        <input type="text" id="checked_by" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Freitext</label>
                        <textarea id="textarea-input" name="content" class="form-control"></textarea>
                    </div>
                    <label>Bilder (Optional, bis zu drei Bilder möglich)</label>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <input type="file" name="img_1" id="img_1"
                                   accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" name="img_2" id="img_2"
                                   accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" name="img_3" id="img_3"
                                   accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        </div>
                    </div>
                        <input type="submit" class="btn btn-lg btn-primary" value="Speichern">
                        <input type="reset" class="btn btn-lg btn-danger" value="Zurücksetzen">

                        <?php echo form_close(); ?>

                    </div>
                </div>
    </main>
</div>


<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/flatpickr.min.js"></script>

<script>
    $(document).ready(function() {
        tinymce.init({
            selector: 'textarea',
            branding: false
        });
        $(".flatpickr").flatpickr({dateFormat: "Y-m-d"});
    });
</script>

</body>
</html>