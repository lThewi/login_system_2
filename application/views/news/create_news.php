<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">News</li>
        <li class="breadcrumb-item active">News erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                News Beitrag erstellen
            </div>
            <?php echo form_open_multipart('news/create_news'); ?>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo '<p class="alert">' . $this->session->flashdata('database_error') . '</p>'; ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo '<p class="alert">Problem beim Hochladen des Bildes.</p>'; ?>
                <?php endif; ?>
                <?php
                $categories = json_decode($categories_json);

                foreach ($categories as $cat) {
                    $category_list[$cat->id] = $cat->name;
                }
                ?>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="title">Titel</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category">Kategorie</label>
                        <?php echo form_dropdown('category', $category_list, 1, array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content">Inhalt</label>
                    <textarea id="textarea-input" name="content" class="form-control"></textarea>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Berechtigungsstufen</label>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="1" id="check1" name="check1">
                            <label class="form-check-label">Berechtigungsstufe 1</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="2" id="check2" name="check2">
                            <label class="form-check-label">Berechtigungsstufe 2</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="3" id="check3" name="check3">
                            <label class="form-check-label">Berechtigungsstufe 3</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="4" id="check4" name="check4">
                            <label class="form-check-label">Berechtigungsstufe 4</label>
                        </div>
                    </div>
                </div>

                <label>Bilder (Optional, bis zu drei Bilder möglich)</label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="file" name="img_1" id="img_1"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv_1"/>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_2" id="img_2"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv_2"/>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_3" id="img_3"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv_3"/>
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
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: 'textarea',
            branding: false
        });

        $(".flatpickr").flatpickr({dateFormat: "Y-m-d"});

    });
</script>

</body>
</html>