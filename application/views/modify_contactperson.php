<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Dokumente</li>
        <li class="breadcrumb-item active">Ansprechpartner erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                Ansprechpartner erstellen
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('documents/modify_con'); ?>
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo '<p class="alert">' . $this->session->flashdata('database_error') . '</p>'; ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo '<p class="alert">' . $this->session->flashdata('upload_error') . '</p>'; ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('contact_created')) : ?>
                    <?php echo '<p class="alert alert-success">Kontakt erfolgreich erstellt</p>'; ?>
                <?php endif; ?>

                <?php
                    $contact = json_decode($contact_json);
                ?>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php echo set_value('name', $contact[0]->name)?>">
                        <input type="hidden" id="con_id" name="con_id" value="<?php echo $contact[0]->id; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="position">Position</label>
                        <input type="text" id="position" name="position" class="form-control" required value="<?php echo set_value('name', $contact[0]->position)?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="img">Kontaktbild</label>
                    <div class="form-control col-md-4 mb-3">
                        <input type="file" name="img" id="img"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_old" value="<?php echo $contact[0]->img?>">
                        <?php
                        if($contact[0]->img != null){
                            $path = json_decode($img_path);
                            $src = 'class="img-thumbnail mt-2" src="'.base_url().$path.$contact[0]->img.'"';
                        } else $src = 'class="img-thumbnail mt-2"';?>
                        <img id="img_pv" <?php echo $src;?>/>
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

</body>
</html>