<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Seiten</li>
        <li class="breadcrumb-item active">Seite erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_create ?>
            </div>
            <?php echo form_open_multipart('pages/create_page'); ?>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('page_created')) : ?>
                    <?php echo $this->session->flashdata('page_created'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('page_error')) : ?>
                    <?php echo $this->session->flashdata('page_error'); ?>
                <?php endif; ?>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name"><?php echo $strings->form_name ?></label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php echo set_value('name');?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date"><?php echo $strings->form_date ?></label>
                        <input type="text" name="date" class="flatpickr flatpickr-input form-control input"
                               placeholder="Datum auswählen" readonly="readonly" tabindex="0"  value="<?php echo set_value('date');?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="content"><?php echo $strings->form_content ?></label>
                    <textarea id="textarea-input" name="content" class="form-control"><?php echo set_value('content');?></textarea>
                </div>
                <div class="form-group">
                    <label><?php echo $strings->form_img ?></label>
                    <div class="form-control col-md-4">

                        <input type="file" name="img" id="img"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv"/>
                    </div>
                </div>
                <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->form_button_save ?>">
                <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->form_button_reset ?>">

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