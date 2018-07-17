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
                <?php echo form_open_multipart('documents/create_category'); ?>
                <div class="card-body">
                    <?php if ($this->session->flashdata('created_category')) : ?>
                        <?php echo '<p class="alert alert-success">Kategorie erfolgreich erstellt</p>'; ?>
                    <?php endif; ?>


                    <div class="form-group col-md-8">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
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