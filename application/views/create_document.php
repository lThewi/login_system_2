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
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo '<p class="alert">' . $this->session->flashdata('database_error') . '</p>'; ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo '<p class="alert">Problem beim Hochladen des Bildes.</p>'; ?>
                <?php endif; ?>
                <?php
                $categories = json_decode($categories_json);
                $contacts = json_decode($contact_persons);
                foreach ($categories as $cat) {
                    $category_list[$cat->id] = $cat->name;
                }
                foreach ($contacts as $contact) {
                    $contact_list[$contact->name] = $contact->name;
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
                        <input type="text" name="tech" id="tech" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date">Erstellungsdatum</label>
                        <input type="text" name="date" class="flatpickr flatpickr-input form-control input"
                               placeholder="Datum auswählen" readonly="readonly" tabindex="0">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="checked_by">Geprüft von</label>
                        <input type="text" name="checked_by" id="checked_by" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contacts">Kontaktperson</label>
                        <?php echo form_dropdown('contacts', $contact_list, 0, array('class' => 'form-control', 'id' => 'contacts')); ?>
                    </div>
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